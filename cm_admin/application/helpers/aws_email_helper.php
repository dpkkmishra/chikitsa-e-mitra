<?php
if(!function_exists("send_email")){
	require_once FCPATH.'ses/vendor/autoload.php';
	function send_email($email=null, $subject=null, $message=null){
		
		$m = new SimpleEmailServiceMessage();
		$m->addTo($email);
		$m->setFrom('IION <deepak@brahma.io>');
		$m->setSubject($subject);
		$m->setMessageFromString('',$message);

		$ses = new SimpleEmailService(AMAZON_S3_ACCESS_KEY, AMAZON_S3_PASSWORD);
		return $ses->sendEmail($m);
	}
}
