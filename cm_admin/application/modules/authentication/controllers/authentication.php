<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

Class Authentication extends REST_Controller 
{
    public function __construct() {
        parent::__construct();

        if(INFLUENCER_URL) {
            header('access-control-allow-origin:'.INFLUENCER_URL);
        } else {
            header('access-control-allow-origin: *');
        }

        header('access-control-allow-credentials: true');       
        header('access-control-allow-headers:x-requested-with, Content-Type, origin, authorization, accept, client-security-token');
        header('access-control-allow-methods:GET,POST,PUT,DELETE,OPTIONS');
        header('access-control-max-age:3600');

        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
           header( "HTTP/1.1 200 OK" );
           exit();
        }

        $this->load->model('standard_model');
    }

    // Show login page
    // public function index_get() {
    //     $this->response('Invalid data');
    // }

    public function setCST_get() {
        $cst = $this->input->get('cst');
        setcookie('cloud.token', $cst, time() + (86400 * 30), "/");
    }


    // Check for user login process
    public function login_post() {
        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));

        
        $is_recaptcha_verified = false;
        
        $this->load->helper('agents');
        $userIP = get_ip_address();
        if($userIP=="::1") {
            $userIP = '127.0.0.1';
        }
        
        $url="https://www.google.com/recaptcha/api/siteverify?secret=".RECAPTCHA_SECRET."&response=".$recaptchaResponse."&remoteip=".$userIP;

        $this->load->library('curl');
        $response = $this->curl->simple_get($url);

        $status= json_decode($response, true);

        if($status['success']) {
            $is_recaptcha_verified = true;
        }

        if( $is_recaptcha_verified ) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $update_arr['__xdt'] = bin2hex(openssl_random_pseudo_bytes(12));
            
            if (empty($email)) {
                $this->response(array('status' => false, 'message' => 'Invalid Email!'));
            } else if (empty($password)) {
                $this->response(array('status' => false, 'message' => 'Invalid Password!'));
            } else {
                $user = $this->login_validate($email, $password);
                if (isset($user->id)) {
                    $update_arr['id'] = $user->id;
                    $update_arr['is_301_redirect'] = $user->is_301_redirect;                    
                    $update_arr['name'] = $user->name;
                    $update_arr['email'] = $user->email;

                    if($user->is_email_verified == 0) {
                        $this->send_verification_email($user->email);
                        $this->response(array('status' => true, 'influencer_name' => $user->name, 'otp_pending' => 1));
                    }

                    if($user->status != "active") {
                        $this->response(array('status' => true, 'influencer_name' => $user->name, 'influencer_status' => $user->status));
                    }
                    
                    if($this->update_token($update_arr)) {
                        // cloud session token
                        $cst = $this->generate_JWT_token($update_arr);
                        $this->response(array('status' => true, 'cst' => $cst));
                    } else {
                        $this->response(array('status' => false, 'message' => 'Try Again!'));
                    }
                    
                } else {
                    $this->response(array('status' => false, 'message' => 'Username or Password not valid!'));
                }
            }
        } else {
            $this->response(array('status' => false, 'message' => 'Recaptcha: '.$status['error-codes'][0]));
        }
    }

    public function resend_otp_post(){
        $email_to = $this->input->post('email');
        if($email_to) {
            $res = $this->send_verification_email($email_to);
            $this->response($res);
        } else {
            $this->response(array('status' => false, 'message' => 'Email is missing!'));
        }
    }

    private function send_verification_email($email_to ="") {
        if($email_to =="") {
            return array('status' => false, 'message' => 'Email is missing!');
        }
        $user = $this->get_influencer_detail($email_to);
        $this->load->helper('aws_email');
        $msg = $this->load->view('otp_email_view', $user, true);
        try{                
            if (send_email($email_to, 'IION Influencer OTP Verification', $msg)) {
                return array('status' => true, 'message' => 'Mail sent successfully!');
            } else {
                return array('status' => false, 'message' => 'Error while sending mail!');
            }
        } catch(Exception $e){
            $this->response(array('status' => false , 'message'=>  "Something wrong"));
        }
    }

    private function get_influencer_detail($email){
        $data['table']  = 'users';
        $data['field']  = 'id, otp, full_name as name';
        $data['condition'] = array(
            'email' => $email
        );
        $data['limit'] = 1;
        $this->standard_model->set_query_data($data);
        $result = $this->standard_model->select();  

        if (isset($result->id)) {
            return $result;
        } else {
            return false;
        }
    }

    private function generate_JWT_token($tokenData = null){
        if($tokenData==null) {
            return 0;
        } else {
            $this->load->helpers(array('jwt', "authorization"));
            $output['token'] = AUTHORIZATION::generateToken($tokenData);
            return $output['token'];
        }
    }

    public function gen_password_get($password="upzyde")
    {
        $this->load->library('Bcrypt');
        $hash = $this->bcrypt->hash_password($password);
        echo $hash;
    } 
   
    public function login_validate($email, $password)
    {
        $this->load->library('Bcrypt');
        $hash = $this->bcrypt->hash_password($password);
        
        $data['table']  = 'users';
        $data['field']  = 'id, full_name as name, email, password, user_status as status, is_301_redirect, is_email_verified';
        $data['condition'] = array(
            'email' => $email
        );
        $data['limit'] = 1;
        $this->standard_model->set_query_data($data);
        $result = $this->standard_model->select();  

        if (isset($result->password)) {
            if ($this->bcrypt->check_password($password, $result->password)) {
                return $result;                
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function register_post(){

        $data['full_name'] = $this->input->post('name');
        if(!$data['full_name'] || $data['full_name'] == "") {
            $invalid = array(
                'status' => false,
                'message' => "Invalid Name!"
            );
            $this->response($invalid);
        }
        
        $exploded_name = explode(" ", $data['full_name']);
        $data['f_name'] = $exploded_name[0];
        if(sizeof($exploded_name) > 1) {
            $data['l_name'] = $exploded_name[sizeof($exploded_name)-1];
        }

        $data['email'] = $this->input->post('email');
        if(!$data['email'] || $data['email'] == "") {
            $invalid = array(
                'status' => false,
                'message' => "Invalid Email!"
            );
            $this->response($invalid);
        }
        $data['fb_pages'] = "";
        if($this->input->post('fb_pages')) {
            $data['fb_pages'] = $this->input->post('fb_pages');
        }
        $data['other_sources'] = "";
        if($this->input->post('other_sources')) {
            $data['other_sources'] = $this->input->post('other_sources');
        }

        if(($data['other_sources'] && $data['other_sources']!='') || ($data['fb_pages'] && $data['fb_pages'] != "")) {

            $is_account_available = $this->check_available_email($data['email']);

            if($is_account_available) {
                $invalid = array(
                    'status' => false,
                    'message' => "This email is already registered!"
                );
                $this->response($invalid);
            } else {                
                $this->load->library('Bcrypt');
                $unhashed = $this->input->post('password');
                $data['password'] = $this->bcrypt->hash_password($unhashed);            
                $data['user_role'] = "influencer";
                $data['user_status'] = "pending";
                $data['otp'] = mt_rand(100000, 999999);
                $data['joining_date'] = date('Y-m-d H:i:s');

                $this->load->helper('agents');
                $data['registration_ip'] = get_ip_address();

                if($data['registration_ip'] == "::1") {
                    $data['registration_ip'] = '27.5.3.53';
                }

                // $country = get_country();
                $country = get_country_by_ip($data['registration_ip']);
                $data['country'] = strtoupper(trim($country['country_name']));

                $data_query['table'] = 'users';
                
                $this->standard_model->set_query_data($data_query);
                $id = $this->standard_model->insert_and_id($data);

                if($id) {
                    $this->send_verification_email($data['email']);
                    $valid = array(
                        'status' => true,
                        'message' => "Account Registered"
                    );
                    $this->response($valid);
                }
            }
            
        } else {
            $invalid = array(
                'status' => false,
                'message' => "Provide atleast a facebook page or a source!"
            );
            $this->response($invalid);
        }        
    }

    public function what_country_get(){
        $this->load->helper('agents');
        $data['ip'] = get_ip_address();

        if($data['ip'] == "::1") {
            $data['ip'] = '27.7.245.155';
        }

        // $country = get_country();
        $country = get_country_by_ip($data['ip']);
        $data['country'] = strtoupper(trim($country['country_name']));

        $this->response($data);        
    }

    private function check_available_email($email="") {
        if($email == '') {
            return 0;
        }

        $data['table'] = 'users';
        $data['field'] = 'id';
        $data['condition'] = array(
            'email' => $email
        );
        $data['limit'] = 1;
        
        $this->standard_model->set_query_data($data);
        $res = $this->standard_model->select();

        if(isset($res->id)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function validate_otp_post(){
        $email = $this->input->post('email');
        $otp = $this->input->post('otp');

        if( $email != '' && $otp != '' ){
            $data_query['table'] = 'users';
            $data_query['field'] = 'id, otp, full_name';
            $data_query['condition'] = array(
                'email' => $email
            );
            $data_query['limit'] = 1;
            
            $this->standard_model->set_query_data($data_query);
            $res = $this->standard_model->select();

            if(isset($res->id) && $res->otp == $otp) {
                $update_query['table'] = 'users';
                $update_query['condition'] = array(
                    'id' => $res->id,
                );
                $d = array(
                    'is_email_verified'=> 1
                );
                $this->standard_model->set_query_data($update_query);
                $id = $this->standard_model->update($d);
                if($id) {
                    $this->response(array('status' => true, 'influencer_name' => $res->full_name));
                } else {
                    $this->response(array('status' => false, 'message' => 'Try Again!'));
                }
            } else {
                $this->response(array('status' => false, 'message' => 'Invalid OTP!'));
            }
        } else {
            $this->response(array('status' => true, 'message' => 'Empty Email or Password!'));
        }
    }

    private function update_token($userdata, $action="login") {
        if(isset($userdata['__xdt'])) {
            $return = 0;
            if($action == "logout") {
                $data['table'] = 'login_history';
                $data['condition'] = array(
                    'device_token' => $userdata['__xdt'], 
                );
                $d = array(                    
                    'date_logout'=> date('Y-m-d H:i:s')
                );
                $this->standard_model->set_query_data($data);
                $id = $this->standard_model->update($d);
                if($id) {
                    $return = 1;
                }
            } else {
                $data['table'] = 'login_history';
                $data['field'] = 'id, ip';
                $data['condition'] = array(
                    'device_token' => $userdata['__xdt'],
                    'date_logout' => 'IS NULL',
                    'user_type' => 'admin',
                    'expire_time >=' => date('Y-m-d H:i:s')
                );
                $data['limit'] = 1;
                
                $this->standard_model->set_query_data($data);
                $res = $this->standard_model->select();

                $this->load->helper('agents');
                $userIP = get_ip_address();
                if($userIP=="::1") {
                    $userIP = '127.0.0.1';
                }

                if(isset($res->id) && ($res->ip == $userIP)) {
                    $return = 1;
                } else {
                    $d = array(
                        'user_id' => $userdata['id'],
                        'ip' => $userIP,
                        'user_type' => 'influencer',
                        'platform'=> $_SERVER['HTTP_USER_AGENT'],                
                        'device_token' => $userdata['__xdt'],
                        'expire_time'=>  date('Y-m-d H:i:s', strtotime('+30 days')),
                        'date_login'=> date('Y-m-d H:i:s')
                    );                    
                    $this->standard_model->set_query_data($data);
                    $id = $this->standard_model->insert_and_id($d);
                    if($id) {
                        $return = 1;
                    }
                }
            }
            return $return;                
        } else {
            return 0;
        }
    }

    // Logout from admin page
    public function logout_get() {     

        $this->load->helper('cookie');
        $arrRtn['token'] = $this->input->cookie('auth_key', false);

        if($arrRtn['token']) {
            $this->update_token($arrRtn, 'logout');
        }

        delete_cookie("auth_key");

        if (isset($_COOKIE['auth_key'])) {
            unset($_COOKIE['auth_key']);
        }
        $this->response(array('status' => true));        
    }

    public function me_get(){
         
        $this->load->helper('cookie');
        $auth_header = $this->input->get_request_header('Authorization');        
        if ($auth_header) {

            if (preg_match('/Bearer\s(\S+)/', $auth_header, $matches)) {
                $auth_header = $matches[1];
            }
            
            $decodedToken = false;
            try {
                $this->load->helpers(array('jwt', "authorization"));
                $decodedToken = AUTHORIZATION::validateToken($auth_header);
            } catch (Exception $e) {                
                $invalid = array(
                    'status' => false,
                    'redirect'  => true,
                    'message' => $e->getMessage()
                );
                $this->response($invalid, 401);
            }

            // $this->response($decodedToken);

            if (isset($decodedToken->id) && isset($decodedToken->__xdt)) {
                    $this->load->model('standard_model');
                    $data['table'] = 'login_history';
                    $data['field'] = 'login_history.id, ip, user_id, f_name as name';

                    $data['condition'] = array(
                        'user_id' => $decodedToken->id,
                        'device_token' => $decodedToken->__xdt,
                        'date_logout' => '0000-00-00 00:00:00',
                        'expire_time >=' => date('Y-m-d H:i:s')
                    );
                    
                    $data['join']  = array(
                        "users" => "users.id = login_history.user_id",
                    );
                    $data['limit'] = 1;
                    
                    $this->standard_model->set_query_data($data);
                    $res = $this->standard_model->select();

                    $this->load->helper('agents');
                    $userIP = get_ip_address();
                    if($userIP=="::1") {
                        $userIP = '127.0.0.1';
                    }

                    if(isset($res->id) && ($res->ip == $userIP)) {
                        $res_data['status'] = true;                
                        $res_data['data'] = array(
                            /*'id' => $res->id,*/
                            'name' => $res->name 
                        );
                        $this->response($res_data);
                        
                    } else {
                        delete_cookie("__cst");
                        if (isset($_COOKIE['__cst'])) {
                            unset($_COOKIE['__cst']);
                        }
                        delete_cookie("__logged");
                        if (isset($_COOKIE['__logged'])) {
                            unset($_COOKIE['__logged']);
                        }

                        $this->response(array(
                            'status'  => false,                            
                            'redirect'  => true,
                            'message' => 'Unauthorized Access!',
                        ), 401);
                    }
            } else {
                $this->response(array(
                    'status'  => false,
                    'redirect'  => true,
                    'message' => 'Unauthorized Access!',
                ), 401);
            }
        } else {
            $this->response(array(
                'status'  => false,                
                'message' => 'Unauthorized Access!',
            ), 401);
        }        
    }
}