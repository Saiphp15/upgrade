<?php

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function update_data($id,$post_data){
        try {
            $this->db->trans_begin();
            $this->db->where('id',$id)->update('users',$post_data);
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
                return true;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_single_user_info($user_id){
        try {
            $query = $this->db->select('
                u.id,
                u.name,
                u.email,
                u.contact_no,
                u.address,
                u.profile_picture,
                u.user_role,
                u.is_active,
                u.created_datetime
				')
                ->from('users as u')
                ->where('u.id',$user_id)
                ->where('u.is_active', 1)
                ->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
}

?>
