<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

Class Authentication extends REST_Controller 
{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('standard_model');
    }


    public function index_get() {
        if($this->session->userdata('is_logged')) {
            redirect(base_url());
        } else {
            $this->load->view('login_view');
        }
    }

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
            $family_id = $this->input->post('family_id');
            $mobile = $this->input->post('mobile');
            
            if(empty($family_id)) {
                $this->response(array('status' => false, 'message' => 'Please provide Family ID!'));
            } else if (empty($mobile)) {
                $this->response(array('status' => false, 'message' => 'Please provide 10 digit Mobile number!'));
            } else {
                $user = $this->login_validate($family_id, $mobile);

                if (isset($user->id)) {
                    if($user->mobile == $mobile) {
                        $arrRtn['otp'] = mt_rand(100000, 999999);

                        $update_query['table'] = 'users';
                        $update_query['condition'] = array(
                            'id' => $user->id,
                        );
                        
                        $this->standard_model->set_query_data($update_query);
                        
                        $id = $this->standard_model->update($arrRtn);

                        $this->load->helper('aws');
                        $message_data['mobile'] = $mobile;
                        $message_data['message'] = $arrRtn['otp'] ." is your OTP for Chikitsha e-Mitra.";
                        $message_data['name'] = $mobile;
                        
                        $status = send_message($message_data);
                        $this->response(array('status' => true, 'otp_pending' => 1, 'message' => 'OTP sent successfully!'));
                    } else {
                        $this->response(array('status' => false, 'message' => 'Family ID or Mobile is not valid!'));
                    }                    
                } else {
                    $otp = mt_rand(100000, 999999);
                    $hof_details = $this->get_from_bhamashah($family_id, $mobile, $otp);

                    if(isset($hof_details->MOBILE_NO) && $hof_details->MOBILE_NO !='') {
                        $hof_details->MOBILE_NO = '9009781991';
                        if($hof_details->MOBILE_NO == $mobile) {
                            $this->load->helper('aws');
                            $message_data['mobile'] = $mobile;
                            $message_data['message'] = $otp ." is your OTP for Chikitsha e-Mitra.";
                            $message_data['name'] = $mobile;
                            
                            $status = send_message($message_data);
                            
                            $this->response(array('status' => true, 'otp_pending' => 1, 'message' => 'OTP sent successfully!'));
                        } else {
                            $this->response(array('status' => false, 'message' => 'Family ID or Mobile is not valid!'));
                        }
                    } else {
                        $this->response(array('status' => false, 'message' => 'Mobile not associated! Contact Bhamashah.'));
                    }

                    $this->response(array('status' => false, 'message' => 'Username or Mobile not valid!'));
                }
            }
        } else {
            $this->response(array('status' => false, 'message' => 'Recaptcha: '.$status['error-codes'][0]));
        }
    }

    public function get_from_bhamashah($family_id = 'YSGIMEC', $mobile="", $otp="") {
        if($family_id == "") {
            return;
        }

        $client_id = 'ad7288a4-7764-436d-a727-783a977f1fe1';

        $url = "https://apitest.sewadwaar.rajasthan.gov.in/app/live/Service/hofAndMember/ForApp/".$family_id."?client_id=".$client_id;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $bhamashah_data=curl_exec($ch);
        curl_close($ch);
        $bhamashah_data = json_decode($bhamashah_data);

        if(isset($bhamashah_data->hof_Details)) {
            $bhamashah_data->hof_Details->MOBILE_NO = '9009781991';
            if($bhamashah_data->hof_Details->MOBILE_NO == $mobile) {
                $hof = $this->update_users($bhamashah_data->hof_Details, 1, $otp);

                foreach ($bhamashah_data->family_Details as $data) {
                    $this->update_users($data,0,$otp);
                }

                if($hof) {
                    return $bhamashah_data->hof_Details;            
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function update_users($data, $is_hof=0, $otp=''){
        if(isset($data->BHAMASHAH_ID)) {
            $d['bhamashah_id'] = $data->BHAMASHAH_ID;
        }
        if(isset($data->MEMBER_AADHAR_ID)) {
            $d['aadhar_id'] = $data->MEMBER_AADHAR_ID;
        }
        if(isset($data->AADHAR_ID)) {
            $d['aadhar_id'] = $data->AADHAR_ID;
        }        
        if(isset($data->FAMILYIDNO)) {
            $d['family_id_no'] = $data->FAMILYIDNO;
        }
        if(isset($data->M_ID)) {
            $d['member_id'] = $data->M_ID;
        }
        if(isset($data->NAME_ENG)) {
            $d['name_eng'] = $data->NAME_ENG;
        }
        if(isset($data->RELATION_ENG)) {
            $d['relation'] = $data->RELATION_ENG;
        }
        if(isset($data->MOBILE)) {
            $d['mobile'] = $data->MOBILE;
        }
        if(isset($data->MOBILE_NO)) {
            $d['mobile'] = $data->MOBILE_NO;
        }        
        if(isset($data->EMAIL)) {
            $d['email'] = $data->EMAIL;
        }
        if(isset($data->GENDER)) {
            $d['gender'] = $data->GENDER;
        }        
        if(isset($data->DOB)) {
            $d['DOB'] = $data->DOB;
        }

        $d['status'] = 'active';
        $d['DOJ'] = date('Y-m-d H:i:s');
        

        if($is_hof == 1) {
            $d['is_hof'] = 1;
        }

        $d['otp'] = $otp;

        $data_query['table'] = 'users';
        $this->standard_model->set_query_data($data_query);
        $id = $this->standard_model->insert_and_id($d);

        return $id;
    }
    
    public function login_validate($family_id, $mobile)
    {
        $data['table']  = 'users';
        $data['field']  = 'id, name_eng as name, mobile';
        $data['condition'] = array(
            'family_id_no' => $family_id,
            'is_hof' => 1            
        );
        $data['limit'] = 1;
        $this->standard_model->set_query_data($data);
        $result = $this->standard_model->select();

        return $result;
    }    

    public function validate_otp_post(){
        $mobile = $this->input->post('mobile');
        $otp = $this->input->post('otp');

        if( $mobile != '' && $otp != '' ){
            $data_query['table'] = 'users';
            $data_query['field'] = 'id, otp, name_eng as full_name';
            $data_query['condition'] = array(
                'mobile' => $mobile
            );
            $data_query['limit'] = 1;
            
            $this->standard_model->set_query_data($data_query);
            $res = $this->standard_model->select();

            if(isset($res->id) && $res->otp == $otp) {
                
                $session_data['id'] = $res->id;
                $session_data['full_name'] = $res->full_name;
                $session_data['mobile'] = $mobile;
                $session_data['is_logged'] = TRUE;
                $this->session->set_userdata($session_data);

                if($res->id) {
                    $this->response(array('status' => true, 'full_name' => $res->full_name));
                } else {
                    $this->response(array('status' => false, 'message' => 'Try Again!'));
                }
            } else {
                $this->response(array('status' => false, 'message' => 'Invalid OTP!'));
            }
        } else {
            $this->response(array('status' => false, 'message' => 'Empty Email or Password!'));
        }
    }

       // Logout from admin page
    public function logout_get() {
        
        $this->session->sess_destroy();
        redirect(base_url());
    }    
}