<?php
class LoginModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function chk_usr_crdntls($email, $pass) {
        try {
            $query = $this->db->select('
				u.id,
				u.name,
				u.email,
				u.contact_no,
				u.user_role,
                ur.designation
				')
                ->from('users as u')
                ->join('user_credentials as uc', 'u.id=uc.user_id', 'inner')
                ->join('user_roles as ur', 'u.user_role=ur.id', 'left')
                ->where('u.email', $email)
                ->where('uc.password', $pass)
                ->where('u.is_active', 1)
                ->get();
            if ($query->num_rows() > 0) {
                $rowData = $query->row();
                return $rowData;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    
}

?>
