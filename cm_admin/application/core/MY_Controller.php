<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');

class MY_Controller extends REST_Controller {

	public function __construct(){
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
		
	}
}

 ?>
