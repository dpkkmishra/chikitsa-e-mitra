<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct(){
        parent::__construct();        
        $this->load->model('standard_model');        
    }

    public function index_get() {
        $data['section'] = "dashboard";
        $data['main_view'] = 'dashboard_view';
        $data['title'] = 'Dashboard';
                
        $this->load->view('master', $data);
    }    
}