<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

    public function __construct(){
        parent::__construct();        
        $this->load->model('standard_model');        
    }

    public function index_get() {
        /*$data['main_view'] = 'user_list_view';
        $data['title'] = 'Users';
                
        $this->load->view('master', $data);*/
    }
    public function hospitals_get($id=0) {
    	if($id != 0 && is_numeric($id)) {
    		$data['main_view'] = 'hospital_detail_view';
	        $data['title'] = 'Hospitals - ';
    	} else {
	        $data['main_view'] = 'hospital_list_view';
	        $data['title'] = 'Hospitals List';
    	}
                
        $this->load->view('master', $data);
    }

    public function doctors_get($id=0) {
    	if($id != 0 && is_numeric($id)) {
    		$data['main_view'] = 'doctors_detail_view';
	        $data['title'] = 'Doctor - ';
    	} else {
	        $data['main_view'] = 'doctors_list_view';
	        $data['title'] = 'Doctors List';    		
    	}
                
        $this->load->view('master', $data);
    }

    public function pathology_get($id=0) {
    	if($id != 0 && is_numeric($id)) {
    		$data['main_view'] = 'pathology_detail_view';
	        $data['title'] = 'Pathology - ';
    	} else {
	        $data['main_view'] = 'pathology_list_view';
	        $data['title'] = 'Pathology List';
    	}
                
        $this->load->view('master', $data);
    }

    public function register_get($id=0) {        
        $data['main_view'] = 'register_view';
        $data['title'] = 'Register Account';        
                
        $this->load->view('master', $data);
    }

}