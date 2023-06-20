
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->pageData = [];
        if ($this->session->userdata('loggedInUsrData')) {
            $this->pageData['loggedInUsrData'] = $this->session->userdata('loggedInUsrData');
        }else{
			redirect('login', 'refresh');
		}
    }

	public function dashboard(){
		
		$this->load->view('manage/dashboard',$this->pageData);
	}

	public function profile(){
		$userData = new stdClass();
		$userInfoUrl = base_url('get-single-user-info');
		$requestData = array(
			'user_id'=>$this->pageData['loggedInUsrData']->id
		);
		$header[0] = 'form-data';
		$input['token'] = JWT::encode($requestData,JWT_TOKEN);
		$urlJsonData = $this->restclient->post($userInfoUrl,$input,$header);
		if ($urlJsonData->info->http_code == 200) {
			$userData->apiResponse = json_decode($urlJsonData->response);
			if ($userData->apiResponse->responseCode == 200) {
				if(isset($userData->apiResponse->responseData) && !empty($userData->apiResponse->responseData)){
					$this->pageData['userData'] = $userData->apiResponse->responseData;
				}
			}
		}
        $this->load->view('manage/profile',$this->pageData);
	}

	public function update_profile(){
		try{
			if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
				if(isset($_POST['name']) && !empty($_POST['name'])){
					if(isset($_POST['email']) && !empty($_POST['email'])){
						if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
							if(isset($_POST['address']) && !empty($_POST['address'])){
								
								$requestData = array(
									'name' => $_POST['name'],
									'email' => $_POST['email'],
									'contact_no' => $_POST['contact_no'],
									'address' => $_POST['address'],
									'updated_by' => $this->pageData['loggedInUsrData']->id,
									'updated_datetime' => DATETIME
								);
								$updateStatus = $this->UserModel->update_data($_POST['user_id'],$requestData);
								
								if($updateStatus==false){
									$this->response['responseCode'] = 500;
									$this->response['responseMessage'] = "Error While Updating User.";
									echo json_encode($this->response); exit;
								}else{

									if(isset($_FILES['profile_picture']['name']) && !empty($_FILES['profile_picture']['name'])){
										$uploads_dir	= 'uploads/user_profile_picture/';
										$tmp_name 		= $_FILES["profile_picture"]["tmp_name"];
										$file_name 			= basename($_FILES["profile_picture"]["name"]);
										$uploadStatus 	= move_uploaded_file($tmp_name, "$uploads_dir/$file_name");
										
										/* upload profile_picture image file */
										if(isset($uploadStatus) && $uploadStatus==true){
											/* update data  */
											$result = $this->UserModel->update_data($_POST['user_id'],array(                                  
												'profile_picture' => $file_name,                                    
												"updated_datetime" => DATETIME
											));
											if($result==false){ 
												$resp['responseCode'] = 200;
												$resp['responseMessage'] =  "Error While updating Profile Picture.";
												return json_encode($resp); exit;    
											}

										}else{
											$resp['responseCode'] = 500;
											$resp['responseMessage'] =  "Error While Uploading Profile Image.";
											return json_encode($resp); exit;
										}
									}

									$this->response['responseCode'] = 200;
									$this->response['responseMessage'] = 'User Updated Successfully.';
									$this->response['redirectUrl'] = base_url('profile');
									echo json_encode($this->response); exit;
								}
								
							}else{
								$resp['responseCode'] = 404;
								$resp['responseMessage'] =  "Address is Required.";
								return json_encode($resp); exit;
							}
						}else{
							$resp['responseCode'] = 404;
							$resp['responseMessage'] =  "Contact is Required.";
							return json_encode($resp); exit;
						}
					}else{
						$resp['responseCode'] = 404;
						$resp['responseMessage'] =  "Email is Required.";
						return json_encode($resp); exit;
					}
				}else{
					$resp['responseCode'] = 404;
					$resp['responseMessage'] =  "Name is Required.";
					return json_encode($resp); exit;
				}
			}else{
				$resp['responseCode'] = 404;
				$resp['responseMessage'] =  "User ID is Required.";
				return json_encode($resp); exit;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/* student management module start */
	public function add_student(){
		$subjectData = new stdClass();
		$subjectListUlr = base_url('all-subject-list');
		$urlJsonData = $this->restclient->post($subjectListUlr);
		if ($urlJsonData->info->http_code == 200) {
			$subjectData->apiResponse = json_decode($urlJsonData->response);
			if ($subjectData->apiResponse->responseCode == 200) {
				if(isset($subjectData->apiResponse->responseData) && !empty($subjectData->apiResponse->responseData)){
					$this->pageData['subjectData'] = $subjectData->apiResponse->responseData;
				}
			}
		}
        $this->load->view('manage/add_student',$this->pageData);
    }

	public function save_student(){
		try{
			if(isset($_POST['name']) && !empty($_POST['name'])){
				if(isset($_POST['email']) && !empty($_POST['email'])){
					if(isset($_POST['contact']) && !empty($_POST['contact'])){
						if(isset($_POST['address']) && !empty($_POST['address'])){
							if(isset($_POST['subject_id']) && !empty($_POST['subject_id'])){
										if(isset($_POST['is_active']) && !empty($_POST['is_active'])){
											$requestData = array(
												'enrollment_id' => $this->random_alpanumeric(9),
												'name' => $_POST['name'],
												'email' => $_POST['email'],
												'contact' => $_POST['contact'],
												'address' => $_POST['address'],
												'subject_id' => $_POST['subject_id'],
												'is_active' => $_POST['is_active'],
												'created_by' => $this->pageData['loggedInUsrData']->id,
												'created_datetime' => DATETIME
											);
											$lastInsertedId = $this->StudentModel->save_student($requestData);
											if($lastInsertedId==false){
												$this->response['responseCode'] = 500;
												$this->response['responseMessage'] = "Error While Adding Student.";
												echo json_encode($this->response); exit;
											}else{
												$this->response['responseCode'] = 200;
												$this->response['responseMessage'] = 'Student Added Successfully.';
												$this->response['redirectUrl'] = base_url('view-students');
												echo json_encode($this->response); exit;
											}
										}else{
											$resp['responseCode'] = 404; 
											$resp['responseMessage'] =  "Status is Required.";
											return json_encode($resp); exit;
										}
									
							}else{
								$resp['responseCode'] = 404;
								$resp['responseMessage'] =  "Subject is Required.";
								return json_encode($resp); exit;
							}
						}else{
							$resp['responseCode'] = 404;
							$resp['responseMessage'] =  "Address is Required.";
							return json_encode($resp); exit;
						}
					}else{
						$resp['responseCode'] = 404;
						$resp['responseMessage'] =  "Contact is Required.";
						return json_encode($resp); exit;
					}
				}else{
					$resp['responseCode'] = 404;
					$resp['responseMessage'] =  "Email is Required.";
					return json_encode($resp); exit;
				}
			}else{
				$resp['responseCode'] = 404;
				$resp['responseMessage'] =  "Name is Required.";
				return json_encode($resp); exit;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function edit_student($student_id){
		$studentData = new stdClass();
		$studentInfoUrl = base_url('get-single-student-info');
		$requestData = array(
			'student_id'=>$student_id
		);
		$header[0] = 'form-data';
		$input['token'] = JWT::encode($requestData,JWT_TOKEN);
		$urlJsonData = $this->restclient->post($studentInfoUrl,$input,$header);
		if ($urlJsonData->info->http_code == 200) {
			$studentData->apiResponse = json_decode($urlJsonData->response);
			if ($studentData->apiResponse->responseCode == 200) {
				if(isset($studentData->apiResponse->responseData) && !empty($studentData->apiResponse->responseData)){
					$this->pageData['studentData'] = $studentData->apiResponse->responseData;
				}
			}
		}
		$subjectData = new stdClass();
		$subjectListUlr = base_url('all-subject-list');
		$urlJsonData = $this->restclient->post($subjectListUlr);
		if ($urlJsonData->info->http_code == 200) {
			$subjectData->apiResponse = json_decode($urlJsonData->response);
			if ($subjectData->apiResponse->responseCode == 200) {
				if(isset($subjectData->apiResponse->responseData) && !empty($subjectData->apiResponse->responseData)){
					$this->pageData['subjectData'] = $subjectData->apiResponse->responseData;
				}
			}
		}
		$this->load->view('manage/edit_student',$this->pageData);
	}

	public function update_student(){
		try{
			if(isset($_POST['student_id']) && !empty($_POST['student_id'])){
				if(isset($_POST['name']) && !empty($_POST['name'])){
					if(isset($_POST['email']) && !empty($_POST['email'])){
						if(isset($_POST['contact']) && !empty($_POST['contact'])){
							if(isset($_POST['address']) && !empty($_POST['address'])){
								if(isset($_POST['subject_id']) && !empty($_POST['subject_id'])){
									if(isset($_POST['is_active']) && !empty($_POST['is_active'])){
										$requestData = array(
											'name' => $_POST['name'],
											'email' => $_POST['email'],
											'contact' => $_POST['contact'],
											'address' => $_POST['address'],
											'subject_id' => $_POST['subject_id'],
											'is_active' => $_POST['is_active'],
											'updated_by' => $this->pageData['loggedInUsrData']->id,
											'updated_datetime' => DATETIME
										);
										$updateStatus = $this->StudentModel->update_data($_POST['student_id'],$requestData);
										if($updateStatus==false){
											$this->response['responseCode'] = 500;
											$this->response['responseMessage'] = "Error While Adding Student.";
											echo json_encode($this->response); exit;
										}else{
											$this->response['responseCode'] = 200;
											$this->response['responseMessage'] = 'Student Updated Successfully.';
											$this->response['redirectUrl'] = base_url('view-students');
											echo json_encode($this->response); exit;
										}
									}else{
										$resp['responseCode'] = 404;
										$resp['responseMessage'] =  "Status is Required.";
										return json_encode($resp); exit;
									}
								}else{
									$resp['responseCode'] = 404;
									$resp['responseMessage'] =  "Subject is Required.";
									return json_encode($resp); exit;
								}
							}else{
								$resp['responseCode'] = 404;
								$resp['responseMessage'] =  "Address is Required.";
								return json_encode($resp); exit;
							}
						}else{
							$resp['responseCode'] = 404;
							$resp['responseMessage'] =  "Contact is Required.";
							return json_encode($resp); exit;
						}
					}else{
						$resp['responseCode'] = 404;
						$resp['responseMessage'] =  "Email is Required.";
						return json_encode($resp); exit;
					}
				}else{
					$resp['responseCode'] = 404;
					$resp['responseMessage'] =  "Name is Required.";
					return json_encode($resp); exit;
				}
			}else{
				$resp['responseCode'] = 404;
				$resp['responseMessage'] =  "Student ID is Required.";
				return json_encode($resp); exit;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function student_details($student_id){
		$studentData = new stdClass();
		$studentInfoUrl = base_url('get-single-student-info');
		$requestData = array(
			'student_id'=>$student_id
		);
		$header[0] = 'form-data';
		$input['token'] = JWT::encode($requestData,JWT_TOKEN);
		$urlJsonData = $this->restclient->post($studentInfoUrl,$input,$header);
		if ($urlJsonData->info->http_code == 200) {
			$studentData->apiResponse = json_decode($urlJsonData->response);
			if ($studentData->apiResponse->responseCode == 200) {
				if(isset($studentData->apiResponse->responseData) && !empty($studentData->apiResponse->responseData)){
					$this->pageData['studentData'] = $studentData->apiResponse->responseData;
				}
			}
		}

		$studentScoreData = new stdClass();
		$studentScoreUrl = base_url('get-single-student-score');
		$requestData = array(
			'student_id'=>$student_id
		);
		$header[0] = 'form-data';
		$input['token'] = JWT::encode($requestData,JWT_TOKEN);
		$urlJsonData = $this->restclient->post($studentScoreUrl,$input,$header);
		if ($urlJsonData->info->http_code == 200) {
			$studentScoreData->apiResponse = json_decode($urlJsonData->response);
			if ($studentScoreData->apiResponse->responseCode == 200) {
				if(isset($studentScoreData->apiResponse->responseData) && !empty($studentScoreData->apiResponse->responseData)){
					$this->pageData['studentScoreData'] = $studentScoreData->apiResponse->responseData;
				}
			}
		}

		$this->load->view('manage/student_details',$this->pageData);
	}

	public function view_students(){
		$studentData = new stdClass();
		$studentListUlr = base_url('all-student-list');
		$urlJsonData = $this->restclient->get($studentListUlr);
		if ($urlJsonData->info->http_code == 200) {
			$studentData->apiResponse = json_decode($urlJsonData->response);
			if ($studentData->apiResponse->responseCode == 200) {
				if(isset($studentData->apiResponse->responseData) && !empty($studentData->apiResponse->responseData)){
					$this->pageData['studentData'] = $studentData->apiResponse->responseData;
				}
			}
		}
		$this->load->view('manage/view_students',$this->pageData);
	}

	public function delete_student(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update student status in database table name as 'students' */
            $querystatus = $this->StudentModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_by" => $this->pageData['loggedInUsrData']->id,
                "updated_datetime" => DATETIME
            ));
            if($querystatus==true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = 'Student Deleted Successfully.';
                $resp['redirectUrl'] = base_url('view-students');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Student Deletion.';
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = 'Student Id Is Required.';
            echo json_encode($resp); exit;
        }
    }

    public function activate_student(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update Item status in database table name as 'students' */
            $querystatus = $this->StudentModel->update_data($_POST['id'], array(
                "is_active" => 1,
				"updated_by" => $this->pageData['loggedInUsrData']->id,
                "updated_datetime" => DATETIME
            ));
            if($querystatus==true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = 'Student Activated Successfully.';
                $resp['redirectUrl'] = base_url('view-students');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Student Deletion.';
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = 'Student Id Is Required.';
            echo json_encode($resp); exit;
        }
    }

    public function deactivate_student(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update Item status in database table name as 'students' */
            $querystatus = $this->StudentModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_by" => $this->pageData['loggedInUsrData']->id,
                "updated_datetime" => DATETIME
            ));
            if($querystatus==true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = 'Student Deactivated Successfully.';
                $resp['redirectUrl'] = base_url('view-students');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Student Deletion.';
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = 'Student Id Is Required.';
            echo json_encode($resp); exit;
        }
    }

	/* student management module end */

	/* subject management module start */
	public function add_subject(){
        $this->load->view('manage/add_subject',$this->pageData);
    }

	public function save_subject(){
		try{
			if(isset($_POST['name']) && !empty($_POST['name'])){

				if(isset($_POST['is_active']) && !empty($_POST['is_active'])){
					$requestData = array(
						'name' => $_POST['name'],
						'is_active' => $_POST['is_active'],
						'created_by' => $this->pageData['loggedInUsrData']->id,
						'created_datetime' => DATETIME
					);
					$lastInsertedId = $this->SubjectModel->save_subject($requestData);
					if($lastInsertedId==false){
						$this->response['responseCode'] = 500;
						$this->response['responseMessage'] = "Error While Adding Subject.";
						echo json_encode($this->response); exit;
					}else{
						$this->response['responseCode'] = 200;
						$this->response['responseMessage'] = 'Subject Added Successfully.';
						$this->response['redirectUrl'] = base_url('view-subjects');
						echo json_encode($this->response); exit;
					}
				}else{
					$resp['responseCode'] = 404; 
					$resp['responseMessage'] =  "Status is Required.";
					return json_encode($resp); exit;
				}
								
			}else{
				$resp['responseCode'] = 404;
				$resp['responseMessage'] =  "Name is Required.";
				return json_encode($resp); exit;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function edit_subject($subject_id){
		$subjectData = new stdClass();
		$studentInfoUrl = base_url('get-single-subject-info');
		$requestData = array(
			'subject_id'=>$subject_id
		);
		$header[0] = 'form-data';
		$input['token'] = JWT::encode($requestData,JWT_TOKEN);
		$urlJsonData = $this->restclient->post($studentInfoUrl,$input,$header);
		if ($urlJsonData->info->http_code == 200) {
			$subjectData->apiResponse = json_decode($urlJsonData->response);
			if ($subjectData->apiResponse->responseCode == 200) {
				if(isset($subjectData->apiResponse->responseData) && !empty($subjectData->apiResponse->responseData)){
					$this->pageData['subjectData'] = $subjectData->apiResponse->responseData;
				}
			}
		}
		$this->load->view('manage/edit_subject',$this->pageData);
	}

	public function update_subject(){
		try{
			if(isset($_POST['subject_id']) && !empty($_POST['subject_id'])){
				if(isset($_POST['name']) && !empty($_POST['name'])){

					if(isset($_POST['is_active']) && !empty($_POST['is_active'])){
						$requestData = array(
							'name' => $_POST['name'],
							'is_active' => $_POST['is_active'],
							'updated_by' => $this->pageData['loggedInUsrData']->id,
							'updated_datetime' => DATETIME
						);
						$updateStatus = $this->SubjectModel->update_data($_POST['subject_id'],$requestData);
						if($updateStatus==false){
							$this->response['responseCode'] = 500;
							$this->response['responseMessage'] = "Error While Adding Subject.";
							echo json_encode($this->response); exit;
						}else{
							$this->response['responseCode'] = 200;
							$this->response['responseMessage'] = 'Subject Updated Successfully.';
							$this->response['redirectUrl'] = base_url('view-subjects');
							echo json_encode($this->response); exit;
						}
					}else{
						$resp['responseCode'] = 404;
						$resp['responseMessage'] =  "Status is Required.";
						return json_encode($resp); exit;
					}
				}else{
					$resp['responseCode'] = 404;
					$resp['responseMessage'] =  "Name is Required.";
					return json_encode($resp); exit;
				}
			}else{
				$resp['responseCode'] = 404;
				$resp['responseMessage'] =  "Student ID is Required.";
				return json_encode($resp); exit;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function subject_details($subject_id){
		$subjectData = new stdClass();
		$subjectInfoUrl = base_url('get-single-subject-info');
		$requestData = array(
			'subject_id'=>$subject_id
		);
		$header[0] = 'form-data';
		$input['token'] = JWT::encode($requestData,JWT_TOKEN);
		$urlJsonData = $this->restclient->post($subjectInfoUrl,$input,$header);
		if ($urlJsonData->info->http_code == 200) {
			$subjectData->apiResponse = json_decode($urlJsonData->response);
			if ($subjectData->apiResponse->responseCode == 200) {
				if(isset($subjectData->apiResponse->responseData) && !empty($subjectData->apiResponse->responseData)){
					$this->pageData['subjectData'] = $subjectData->apiResponse->responseData;
				}
			}
		}
		$this->load->view('manage/subject_details',$this->pageData);
	}

	public function view_subjects(){
		$studentData = new stdClass();
		$studentListUlr = base_url('all-subject-list');
		$urlJsonData = $this->restclient->get($studentListUlr);
		if ($urlJsonData->info->http_code == 200) {
			$studentData->apiResponse = json_decode($urlJsonData->response);
			if ($studentData->apiResponse->responseCode == 200) {
				if(isset($studentData->apiResponse->responseData) && !empty($studentData->apiResponse->responseData)){
					$this->pageData['subjectData'] = $studentData->apiResponse->responseData;
				}
			}
		}
		$this->load->view('manage/view_subjects',$this->pageData);
	}

	public function delete_subject(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update subject status in database table name as 'subjects' */
            $querystatus = $this->SubjectModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_by" => $this->pageData['loggedInUsrData']->id,
                "updated_datetime" => DATETIME
            ));
            if($querystatus==true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = 'Subject Deleted Successfully.';
                $resp['redirectUrl'] = base_url('view-subjects');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Subject Deletion.';
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = 'Subject Id Is Required.';
            echo json_encode($resp); exit;
        }
    }

    public function activate_subject(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update Item status in database table name as 'subject' */
            $querystatus = $this->SubjectModel->update_data($_POST['id'], array(
                "is_active" => 1,
				"updated_by" => $this->pageData['loggedInUsrData']->id,
                "updated_datetime" => DATETIME
            ));
            if($querystatus==true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = 'Subject Activated Successfully.';
                $resp['redirectUrl'] = base_url('view-subjects');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Subject Deletion.';
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = 'Subject Id Is Required.';
            echo json_encode($resp); exit;
        }
    }

    public function deactivate_subject(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update Item status in database table name as 'subjects' */
            $querystatus = $this->SubjectModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_by" => $this->pageData['loggedInUsrData']->id,
                "updated_datetime" => DATETIME
            ));
            if($querystatus==true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = 'Subject Deactivated Successfully.';
                $resp['redirectUrl'] = base_url('view-subjects');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Subject Deletion.';
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = 'Subject Id Is Required.';
            echo json_encode($resp); exit;
        }
    }

	/* subject management module end */

}
