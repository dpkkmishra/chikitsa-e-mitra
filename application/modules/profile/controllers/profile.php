<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

   public function __construct(){
        parent::__construct();        
        $this->load->model('standard_model');        
    }

    /*public function index_get() {
        $data['section'] = "Profile";
        $data['main_view'] = 'profile_view';
        $data['title'] = 'Profile';
                
        $this->load->view('master', $data);
    }*/

    public function detail_get( $id=0, $show_data="" ) {
         if($id!=0 && is_numeric($id)) {
            $data['title'] = 'Users';           
            if($show_data == "detail"){
                $data['main_view'] = 'reports_details';
            } else {
                $data['main_view'] = 'reports_list';
            }
        } else {
            $data['hof_details'] = $this->get_details();
            $data['family_members'] = $this->get_family_members($data['hof_details']->family_id_no);
            $data['main_view'] = 'profile_view';
            $data['title'] = 'Profile';                   
        }

        $this->load->view('master', $data);
    }   

    private function get_family_members($family_id_no =0 )  {
        $data['table'] = 'users';
        $data['database'] = 'read_db';
        $data['field'] = '*';
        $data['condition'] = array(
            'family_id_no' => $family_id_no
        );

        $this->standard_model->set_query_data($data);
        $result = $this->standard_model->select();

        return $result;
    }

    private function get_details(){
        $data['table'] = 'users';
        $data['database'] = 'read_db';
        $data['field'] = '*';
        $data['condition'] = array(
          'id'   => $this->session->userdata('id'),
        );

        $this->standard_model->set_query_data($data);
        $result = $this->standard_model->select();

        return $result;
    }    

    public function reports_get() {
        $data['section'] = "Reports";
        $data['main_view'] = 'reports_list';
        $data['title'] = 'Reports';

        $data['hof_details'] = $this->get_hof_details();

        echo "<pre>";
        print_r($data);
        echo "</pre>";
        return;

                
        $this->load->view('master', $data);
    }    
}