<?php

class SubjectModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function all_subject_list() {
        try {
            $query = $this->db->select('id,name,is_active,created_by')
                ->from('subjects')
                ->where_in('is_active', array(1,2))
                ->order_by('id','desc')
                ->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function save_subject($post_data){
        try {
            $this->db->trans_begin();
            $this->db->insert('subjects',$post_data);
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $insert_id = $this->db->insert_id();
                $logData = array(
                    'user_id'=>$post_data['created_by'],
                    'activity_message'=>'Subject Added'
                );
                $this->db->insert('logs',$logData);
                $this->db->trans_commit();
                return $insert_id;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_single_subject_info($subject_id){
        try {
            $query = $this->db->select('
                s.id,
                s.name,
                s.is_active,
                s.created_datetime
				')
                ->from('subjects as s')
                ->where('s.id',$subject_id)
                ->where('s.is_active', 1)
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

    public function update_data($id,$post_data){
        try {
            $this->db->trans_begin();
            $this->db->where('id',$id)->update('subjects',$post_data);
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $logData = array(
                    'user_id'=>$post_data['updated_by'],
                    'activity_message'=>'Subject Updated'
                );
                $this->db->insert('logs',$logData);
                $this->db->trans_commit();
                return true;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
}

?>
