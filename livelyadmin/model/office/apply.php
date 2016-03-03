<?php
class ModelOfficeApply extends Model {

    public function addApply($data){
        $fields = array(
            'date'          => $data['date'],
            'time_id'       => $data['time_id'],
            'week'          => date('W',strtotime($data['date']))            
        );
        $this->load->model('office/time');
        $time = $this->model_office_time->getTime($data['time_id']);
        if(!empty($time['time_name'])){
            $fields['time_name'] = $time['time_name'];
        }
        if(isset($time['price'])){
            $fields['price'] = $time['price'];
        }
        return $this->db->insert('office_apply',$fields);
    }
    public function deleteApply($apply_id){
        $this->db->delete('office_apply',array('apply_id'=>$apply_id));
        $this->db->delete('office_applicant',array('apply_id'=>$apply_id));
    }

    public function getApplyByDay($day,$time_id){
        $date = date('Y-m-d',strtotime($day));
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."office_apply WHERE DATE(date) = '".$this->db->escape($date)."' AND time_id = '".(int)$time_id."'");
        return $query->row;
    }

    public function getApplicantsByApplyId($apply_id){
        $query = $this->db->query("SELECT ou.* FROM ".DB_PREFIX."office_applicant oa LEFT JOIN ".DB_PREFIX."office_user ou ON oa.office_id = ou.office_id WHERE oa.apply_id = '".$apply_id."'");
        return $query->rows;
    }

    public function addApplicant($apply_id,$office_id){
        $this->db->insert('office_applicant',array('apply_id'=>$apply_id,'office_id'=>$office_id,'date_added'=> date('Y-m-d H:i:s')));
        return true;
    }

    public function deleteApplicant($apply_id,$office_id){
        $this->db->delete('office_applicant',array('apply_id'=>$apply_id,'office_id'=>$office_id));
        return true;
    }

    public function getApplyTimesByWeek($week){
        $query = $this->db->query("SELECT DISTINCT time_name FROM ".DB_PREFIX."office_apply WHERE week = '".(int)$week."'");
        return $query->rows;
    }

    public function getTotalAppliesByWeek($week){
        $query = $this->db->query("SELECT COUNT(apply_id) total FROM ".DB_PREFIX."office_apply WHERE week = '".(int)$week."'");
        return $query->row['total'];
    }
}