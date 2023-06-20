<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends MY_Controller {

	public function login(){
		$this->load->view('manage/login');
	}

	public function login_auth(){
		try{
			if(isset($_POST['email']) && !empty($_POST['email'])){
				if(isset($_POST['password']) && !empty($_POST['password'])){
					$usrData = new stdClass();
					$chkLoginUlr = base_url('chk-login');
					$requestData = array(
						'email' => $_POST['email'],
						'password' => $_POST['password']
					);
					$header[0] = 'form-data';
					$inptData['token'] = JWT::encode($requestData, JWT_TOKEN); /* send request to api */
					$urlJsonData = $this->restclient->post($chkLoginUlr, $inptData, $header);
					if ($urlJsonData->info->http_code == 200) {
						$usrData->apiResponse = json_decode($urlJsonData->response);
						if ($usrData->apiResponse->responseCode == 200) {
							if(isset($usrData->apiResponse->responseData) && !empty($usrData->apiResponse->responseData)){
								$this->session->set_userdata('loggedInUsrData',$usrData->apiResponse->responseData); /* set user session */
								$this->response['responseCode'] = $usrData->apiResponse->responseCode;
								$this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
								$this->response['redirectUrl'] = base_url('dashboard');
								echo json_encode($this->response); exit;
							}else{
								$this->response['responseCode'] = 404;
								$this->response['responseMessage'] = 'LoggedIn User Data Not Found.';
								echo json_encode($this->response); exit;
							}
						} else {
							$this->response['responseCode'] = $usrData->apiResponse->responseCode;
							$this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
							echo json_encode($this->response); exit;
						}
					}
				}else{
					$resp['responseCode'] = 404;
					$resp['responseMessage'] =  "Password is Required.";
					return json_encode($resp); exit;
				}
			}else{
				$resp['responseCode'] = 404;
				$resp['responseMessage'] =  "Password is Required.";
				return json_encode($resp); exit;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
    }

	public function logout(){
		try {
            $this->session->unset_userdata('loggedInUsrData');
            $this->session->sess_destroy();
            redirect(base_url('login'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
	}
}

?>
