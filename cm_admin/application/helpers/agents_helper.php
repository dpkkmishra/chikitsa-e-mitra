<?php 

require APPPATH .'vendor/autoload.php';

use GeoIp2\Database\Reader;

	function get_ip_address() {

        $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');

        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (validate_ip($ip)) {
                        return $ip;
                    }
                }
            }
        }
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;        
    }

    function validate_ip($ip) {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }
        return true;
    }

    function get_country_by_ip($ip) {
        $country_data = array();
        $reader = new Reader(FCPATH .'GeoIP2-Country.mmdb');

        $country = $reader->country($ip); #geoip_country_code_by_addr($gi, $ip);

         $country_data = array(
            'country_name' => $country->country->name,
            'country_code' => $country->country->isoCode
        );

        return $country_data;
    }

    function get_country() {
        $country_data['country_name'] = 'NOTSET';
        $country_data['country_code'] = 'NOTSET';
        if( isset($_SERVER['HTTP_CF_IPCOUNTRY'])) {

            $this->load->helper('country');
             $country_data = array(
                'country_name' => country_code_to_name( $_SERVER['HTTP_CF_IPCOUNTRY'] ), 
                'country_code' => $_SERVER['HTTP_CF_IPCOUNTRY']
            );
        }
        return $country_data;
    }


?>