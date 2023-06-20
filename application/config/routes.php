<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/* user login routes start */
$route['login'] = 'LoginController/login';
$route['login-auth'] = 'LoginController/login_auth';
$route['chk-login'] = 'ApiController/chk_login';
$route['logout'] = 'LoginController/logout';
/* user login routes end */
$route['dashboard'] = 'UserController/dashboard';
$route['profile'] = 'UserController/profile';

$route['get-single-user-info'] = 'ApiController/get_single_user_info';
$route['update-profile'] = 'UserController/update_profile';


/* students module routes start */
$route['add-student'] = 'UserController/add_student';
$route['view-students'] = 'UserController/view_students';
$route['all-student-list'] = 'ApiController/all_student_list';
$route['save-student'] = 'UserController/save_student';

$route['all-subject-list'] = 'ApiController/all_subject_list';

$route['get-single-student-info'] = 'ApiController/get_single_student_info';
$route['student-details/(:any)'] = 'UserController/student_details/$1';
$route['deactivate-student'] = 'UserController/deactivate_student';
$route['activate-student'] = 'UserController/activate_student';
$route['delete-student'] = 'UserController/delete_student';
$route['student-info'] = 'ApiController/student_info';
$route['edit-student/(:any)'] = 'UserController/edit_student/$1';
$route['update-student'] = 'UserController/update_student';
/* student module routes end */

/* subject module routes start */
$route['add-subject'] = 'UserController/add_subject';
$route['view-subjects'] = 'UserController/view_subjects';
$route['all-subject-list'] = 'ApiController/all_subject_list';
$route['save-subject'] = 'UserController/save_subject';

$route['get-single-subject-info'] = 'ApiController/get_single_subject_info';
$route['subject-details/(:any)'] = 'UserController/subject_details/$1';
$route['deactivate-subject'] = 'UserController/deactivate_subject';
$route['activate-subject'] = 'UserController/activate_subject';
$route['delete-subject'] = 'UserController/delete_subject';
$route['subject-info'] = 'ApiController/subject_info';
$route['edit-subject/(:any)'] = 'UserController/edit_subject/$1';
$route['update-subject'] = 'UserController/update_subject';
/* subject module routes end */

$route['get-single-student-score'] = 'ApiController/get_single_student_score';
