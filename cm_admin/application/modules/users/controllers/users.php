<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct(){
        parent::__construct();        
        $this->load->model('standard_model');        
    }

    public function list_get( $id=0, $show_data="" ) {
    	if($id!=0 && is_numeric($id)) {
		  	$data['title'] = 'Users';		  	
	        if($show_data == "report"){
	        	$data['main_view'] = 'report_view';
	        } else {
	    		$data['main_view'] = 'user_detail_view';		        
	        }
    	} else {    		
	        $data['main_view'] = 'user_list_view';
	        $data['title'] = 'Users';
	                
    	}

	    $this->load->view('master', $data);
    }    

}