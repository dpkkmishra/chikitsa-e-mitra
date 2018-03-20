<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');

class MY_Controller extends REST_Controller {

	public function __construct(){
		parent::__construct();
		
        if(!$this->session->userdata('is_logged')){
             redirect('/login');
        }
	}
}

 ?>
