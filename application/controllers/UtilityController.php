<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UtilityController extends MY_Controller {

	public function generate_pass(){
        $password = $_REQUEST['password'];
        $pass = hash_hmac("SHA256", $password, SECRET_KEY);
        echo '<pre>'; print_r($pass); exit;
    }
}
