<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $response,$session,$pageData,$loggedInUsrData;

    public function __construct() {
        parent::__construct();
        $this->response = array("responseCode" => 0, "responseMessage" => "", "responseData" => array());
    }

    public function is_native_app_token_validate($apiValidToken) {
        $nativeapptoken = json_decode(NATIVEAPPTOKENS);
        if (isset($nativeapptoken) && !empty($nativeapptoken)) {
            if (in_array($apiValidToken, $nativeapptoken)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function callAPI($method, $url, $data){
        
        $curl = curl_init();
        switch ($method){
           case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
           case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                break;
           default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        /* OPTIONS: */
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'APIKEY: 111111111111111111111',
           'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        /* EXECUTE: */
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

    function random_alpanumeric($maxlength) {
        $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $return_str = "";
        for ( $x=0; $x<=$maxlength; $x++ ) {
            $return_str .= $chary[rand(0, count($chary)-1)];
        }
        return $return_str;
    }

}

?>
