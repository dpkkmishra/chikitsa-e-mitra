<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'third_party/aws/aws-autoloader.php';    	

use Aws\Sns\SnsClient;

function send_message($message_data=null)
{    
	$params = array(
	    'credentials' => array(
            'key'    => 'AKIAJHRWF32QWGTWW3PQ',
            'secret' => 'irSk2uqxkiGz/VnNsXiVErZ9uq1D8+siWISh6VN6'		        
	    ),
	    'region' => 'us-east-1', // < your aws from SNS Topic region
	    'version' => 'latest'
	);

	$sns = new \Aws\Sns\SnsClient($params);

	$args = array(
	    "SenderId" => 'ST0CKT',
	    "SMSType" => "Transactional",
	    "Message" => $message_data['message'],
	    "PhoneNumber" => "+91".$message_data['mobile']
	);

	$result = $sns->publish($args);

	/*echo "<pre>";
	var($result);
	echo "</pre>";*/

	if ($result) {
		return true;
	} else {
		return false;
	}		
}
