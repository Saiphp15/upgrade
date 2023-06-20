<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function api_token_validation() {
        $apiValidToken = $this->input->post('apiValidToken');
        $apiFunctionName = $this->input->post('apiFunctionName');
        $apiRequestToken = $this->input->post('apiRequestToken');
        if (isset($apiValidToken) && !empty($apiValidToken)) {
            $isValidTokenResult = $this->is_native_app_token_validate($apiValidToken);
            if ($isValidTokenResult == false) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Invalid Request';
            } else {
                if (isset($apiRequestToken) && !empty($apiRequestToken)) {
                    if (method_exists($this, $apiFunctionName)) {
                        $respData = new stdClass();
                        $aipUrl = base_url('ApiController/' . $apiFunctionName);
                        $inptData['token'] = $apiRequestToken;
                        $header[0] = 'form-data';
                        $urlJsonData = $this->restclient->post($aipUrl, $inptData, $header);
                        if ($urlJsonData->info->http_code == 200) {
                            $respData->apiResponse = json_decode($urlJsonData->response);
                            $this->response['responseCode'] = $respData->apiResponse->responseCode;
                            $this->response['responseMessage'] = $respData->apiResponse->responseMessage;
                            if (isset($respData->apiResponse->resultRecordCount) && !empty($respData->apiResponse->resultRecordCount)) {
                                $this->response['resultRecordCount'] = $respData->apiResponse->resultRecordCount;
                            }
                            $this->response['responseData'] = $respData->apiResponse->responseData;
                            echo json_encode($this->response); exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Invalid Request';
                        echo json_encode($this->response); exit;
                    }
                } else {
                    if (method_exists($this, $apiFunctionName)) {
                        $respData = new stdClass();
                        $aipUrl = base_url('ApiController/' . $apiFunctionName);
                        $urlJsonData = $this->restclient->post($aipUrl);
                        if ($urlJsonData->info->http_code == 200) {
                            $respData->apiResponse = json_decode($urlJsonData->response);
                            $this->response['responseCode'] = $respData->apiResponse->responseCode;
                            $this->response['responseMessage'] = $respData->apiResponse->responseMessage;
                            $this->response['responseData'] = $respData->apiResponse->responseData;
                            echo json_encode($this->response); exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Invalid Request';
                        echo json_encode($this->response); exit;
                    }
                }
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = 'Invalid Request';
            echo json_encode($this->response); exit;
        }
    }

	public function chk_login() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['email']) & !empty($decode_data['email'])) {
                if (!filter_var($decode_data['email'], FILTER_VALIDATE_EMAIL)) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Invalid Email.';
                    echo json_encode($this->response); exit;
                }
                if (isset($decode_data['password']) & !empty($decode_data['password'])) {
                    /* check user exist with this email & password */
                    $email = trim($decode_data['email'], " ");
                    $pass1 = trim($decode_data['password'], " ");
                    $pass = hash_hmac("SHA256", $pass1, SECRET_KEY);
                    $usrData = $this->LoginModel->chk_usr_crdntls($email, $pass);
                    if ($usrData == false) {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = "Incalid Credentials.";
                        echo json_encode($this->response); exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = 'Success.';
                        $this->response['responseData'] = $usrData;
                        echo json_encode($this->response); exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Password Required.';
                    echo json_encode($this->response); exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Email Required.';
                echo json_encode($this->response); exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response); exit;
        }
    }

    public function all_student_list(){
        $itemData = $this->StudentModel->all_student_list();
        if ($itemData == false) {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = "Records Not Found.";
            echo json_encode($this->response); exit;
        } else {
            $this->response['responseCode'] = 200;
            $this->response['responseMessage'] = 'Success.';
            $this->response['responseData'] = $itemData;
            echo json_encode($this->response); exit;
        }
    }

    public function all_subject_list(){
        $subjectData = $this->SubjectModel->all_subject_list();
        if ($subjectData == false) {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = "Records Not Found.";
            echo json_encode($this->response); exit;
        } else {
            $this->response['responseCode'] = 200;
            $this->response['responseMessage'] = 'Success.';
            $this->response['responseData'] = $subjectData;
            echo json_encode($this->response); exit;
        }
    }

    
    public function get_single_student_score(){
        $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
        if(isset($decode_data['student_id']) && !empty($decode_data['student_id'])){
            $studentScoreData = $this->StudentModel->get_single_student_score($decode_data['student_id']);
            if ($studentScoreData == false) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = "Records Not Found.";
                echo json_encode($this->response); exit;
            } else {
                $this->response['responseCode'] = 200;
                $this->response['responseMessage'] = 'Success.';
                $this->response['responseData'] = $studentScoreData;
                echo json_encode($this->response); exit;
            }
        }else{
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = "Student Id Required.";
            echo json_encode($this->response); exit;
        }
    }

    public function get_single_student_info(){
        $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
        if(isset($decode_data['student_id']) && !empty($decode_data['student_id'])){
            $studentData = $this->StudentModel->get_single_student_info($decode_data['student_id']);
            if ($studentData == false) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = "Records Not Found.";
                echo json_encode($this->response); exit;
            } else {
                $this->response['responseCode'] = 200;
                $this->response['responseMessage'] = 'Success.';
                $this->response['responseData'] = $studentData;
                echo json_encode($this->response); exit;
            }
        }else{
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = "Student Id Required.";
            echo json_encode($this->response); exit;
        }
    }

    public function get_single_user_info(){
        $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
        if(isset($decode_data['user_id']) && !empty($decode_data['user_id'])){
            $userData = $this->UserModel->get_single_user_info($decode_data['user_id']);
            if ($userData == false) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = "Records Not Found.";
                echo json_encode($this->response); exit;
            } else {
                $this->response['responseCode'] = 200;
                $this->response['responseMessage'] = 'Success.';
                $this->response['responseData'] = $userData;
                echo json_encode($this->response); exit;
            }
        }else{
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = "User Id Required.";
            echo json_encode($this->response); exit;
        }
    }

    public function get_single_subject_info(){
        $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
        if(isset($decode_data['subject_id']) && !empty($decode_data['subject_id'])){
            $subjectData = $this->SubjectModel->get_single_subject_info($decode_data['subject_id']);
            if ($subjectData == false) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = "Records Not Found.";
                echo json_encode($this->response); exit;
            } else {
                $this->response['responseCode'] = 200;
                $this->response['responseMessage'] = 'Success.';
                $this->response['responseData'] = $subjectData;
                echo json_encode($this->response); exit;
            }
        }else{
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = "Subject Id Required.";
            echo json_encode($this->response); exit;
        }
    }

}



?>
