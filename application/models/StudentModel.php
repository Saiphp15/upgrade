<?php

class StudentModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function all_student_list() {
        try {
            $query = $this->db->select('
				s.id,
				s.name,
                s.email,
				s.contact,
                s.address,
                s.subject_id,
                sb.name as subject_name,
                s.is_active,
                s.created_by,
                s.created_datetime
				')
                ->from('students as s')
                ->join('subjects as sb', 's.subject_id=sb.id', 'left')
                ->where_in('s.is_active', array(1,2))
                ->order_by('s.id','desc')
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

    public function save_student($post_data){
        try {
            $this->db->trans_begin();
            $this->db->insert('students',$post_data);
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $insert_id = $this->db->insert_id();
                $logData = array(
                    'user_id'=>$post_data['created_by'],
                    'activity_message'=>'Student Added'
                );
                $this->db->insert('logs',$logData);
                $this->db->trans_commit();
                return $insert_id;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_single_student_info($student_id){
        try {
            $query = $this->db->select('
                s.id,
                s.name,
                s.email,
                s.contact,
                s.address,
                s.subject_id,
                sb.name as subject_name,
                s.is_active,
                s.created_datetime
				')
                ->from('students as s')
                ->join('subjects as sb', 's.subject_id=sb.id', 'left')
                ->where('s.id',$student_id)
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

    
    public function get_single_student_score($student_id){
        try {
            $query = $this->db->select('
                    scores.student_id,
                    s.name as student_name,
                    scores.subject_id,
                    sb.name as subject_name,
                    scores.marks
				')
                ->from('scores')
                ->join('students as s', 'scores.student_id=s.id', 'left')
                ->join('subjects as sb', 'scores.subject_id=sb.id', 'left')
                ->where('s.id',$student_id)
                ->where_in('s.is_active', array(1,2))
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

    public function update_data($id,$post_data){
        try {
            $this->db->trans_begin();
            $this->db->where('id',$id)->update('students',$post_data);
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $logData = array(
                    'user_id'=>$post_data['updated_by'],
                    'activity_message'=>'Student Updated'
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
