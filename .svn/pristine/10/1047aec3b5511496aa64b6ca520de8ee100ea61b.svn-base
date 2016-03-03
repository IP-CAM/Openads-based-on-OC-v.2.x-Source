<?php
class ModelAccountTemplate extends Model {
    public function addTargetingTemplate($data){

        $tmp = array(
            'targeting_sn'  => isset($data['targeting_sn']) ? trim($data['targeting_sn']) : '',
            'product_id'    => $data['product_id'],
            'customer_id'   => $this->customer->getId(),
            'location'      => isset($data['location']) && is_array($data['location']) ? implode(",",$data['location']) : '',
            'other_location'=> isset($data['other_location']) ? trim(strip_tags($data['other_location'])) : '',
            'gender'        => isset($data['gender']) ? (int)$data['gender'] : '',
            'age_min'       => isset($data['age_min']) ? (int)$data['age_min'] : 18,
            'age_max'       => isset($data['age_max']) ? (int)$data['age_max'] : 65,
            'language'      => isset($data['language']) && is_array($data['language']) ? implode(",",$data['language']) :'',
            'other_language'=> isset($data['other_language']) ? trim(strip_tags($data['other_language'])) :'',
            'interest'      => isset($data['interest']) ? trim(strip_tags($data['interest'])) :'',
            'behavior'      => isset($data['behavior']) ? trim(strip_tags($data['behavior'])) :'',
            'more'          => isset($data['more']) ? trim(strip_tags($data['more'])) :'',
            'note'          => isset($data['note']) ? trim(strip_tags($data['note'])) : '',
            'audience'      => isset($data['audience']) ? (int)($data['audience']) : '', 
            'user_id'       => 0,
            'date_added'    => date('Y-m-d H:i:s')
        );
        return $this->db->insert('advertise_targeting_template',$tmp);

    } 

    public function editTargetingTemplate($data){
        if(!isset($data['template'])){ return false;}
        $tmp = array(
            'targeting_sn'  => isset($data['targeting_sn']) ? trim($data['targeting_sn']) : '',
            'product_id'    => $data['product_id'],
            'customer_id'   => $this->customer->getId(),
            'location'      => isset($data['location']) && is_array($data['location']) ? implode(",",$data['location']) : '',
            'other_location'=> isset($data['other_location']) ? trim(strip_tags($data['other_location'])) : '',
            'gender'        => isset($data['gender']) ? (int)$data['gender'] : '',
            'age_min'       => isset($data['age_min']) ? (int)$data['age_min'] : 18,
            'age_max'       => isset($data['age_max']) ? (int)$data['age_max'] : 65,
            'language'      => isset($data['language']) && is_array($data['language']) ? implode(",",$data['language']) :'',
            'other_language'=> isset($data['other_language']) ? trim(strip_tags($data['other_language'])) :'',
            'interest'      => isset($data['interest']) ? trim(strip_tags($data['interest'])) :'',
            'behavior'      => isset($data['behavior']) ? trim(strip_tags($data['behavior'])) :'',
            'more'          => isset($data['more']) ? trim(strip_tags($data['more'])) :'',
            'note'          => isset($data['note']) ? trim(strip_tags($data['note'])) : '',
            'audience'      => isset($data['audience']) ? (int)($data['audience']) : '', 
            'user_id'       => 0,
            'date_modified' => date('Y-m-d H:i:s')
        );
        return $this->db->update('advertise_targeting_template',array('template_id'=>$data['template']),$tmp);

    }     

    public function delete($template_id){
        $ads = $this->getTotalAds($template_id);
        if($ads){
            return false;
        }else{
            return $this->db->delete("advertise_targeting_template",array('template_id'=>$template_id));
        }
    }

    public function getTargetingTemplate($template_id){
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."advertise_targeting_template WHERE customer_id = '".$this->customer->getId()."' AND template_id = '".$template_id."'");
        if($query->num_rows){
            $data = $query->row;
            $_location = explode(",", $data['location']);
            if(is_array($_location)){
                $data['location'] = $_location;
            }
            $_language = explode(",", $data['language']);
            if(is_array($_language)){
                $data['language'] = $_language;
            }           
            return $data;
        } 
        return false;
    }

    public function getTemplates($product_id){
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."advertise_targeting_template WHERE customer_id = '".$this->customer->getId()."' AND product_id = '".$product_id."'");
        return $query->rows;
    }

    public function getAdTemplates($data = array()) {
        $sql = "SELECT * FROM ".DB_PREFIX."advertise_targeting_template att WHERE customer_id = '".$this->customer->getId()."'";

        if (!empty($data['filter_interest'])) {
            $sql .= " AND interest LIKE '%" . $this->db->escape($data['filter_interest']) . "%'";
        }
        if (!empty($data['filter_gender'])) {
            $sql .= " AND gender = '" . (int)$data['filter_gender'] . "'";
        }
        if (!empty($data['filter_targeting_sn'])) {
            $sql .= " AND targeting_sn LIKE '" . $data['filter_targeting_sn'] . "%'";
        }
        if (isset($data['filter_status'])) {
            $sql .= " AND status = '" . (int)$data['filter_status'] . "'";
        }   
        if (isset($data['filter_product'])) {
            $sql .= " AND product_id = '" . (int)$data['filter_product'] . "'";
        }              
        if (isset($data['filter_language'])) {
            $sql .= " AND FIND_IN_SET('".(int)$data['filter_language']."',language)";
        }   
        if (isset($data['filter_location'])) {
            $sql .= " AND FIND_IN_SET('".(int)$data['filter_location']."',location)";
        }         
        $sort_data = array(
            'targeting_sn',
            'product_id',
            'location',
            'gender',
            'audience',
            'age_min',
            'language',
            'status',
        );
        $sql .= " ORDER BY  ";
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .=  $data['sort'];
        } else {
            $sql .= "targeting_sn";
        }

        if (isset($data['order']) && ($data['order'] == 'ASC')) {
            $sql .= " ASC";
        } else {
            $sql .= " DESC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalAdTemplates($data = array()) {
        $sql = "SELECT COUNT(template_id) AS total FROM `" . DB_PREFIX . "advertise_targeting_template`  WHERE customer_id = '".$this->customer->getId()."'";
        if (!empty($data['filter_interest'])) {
            $sql .= " AND interest LIKE '%" . $this->db->escape($data['filter_interest']) . "%'";
        }
        if (!empty($data['filter_gender'])) {
            $sql .= " AND gender = '" . (int)$data['filter_gender'] . "'";
        }
        if (isset($data['filter_status'])) {
            $sql .= " AND status = '" . (int)$data['filter_status'] . "'";
        }    
        if (isset($data['filter_product'])) {
            $sql .= " AND product_id = '" . (int)$data['filter_product'] . "'";
        }                   
        if (!empty($data['filter_targeting_sn'])) {
            $sql .= " AND targeting_sn LIKE '" . $data['filter_targeting_sn'] . "%'";
        }
        if (isset($data['filter_language'])) {
            $sql .= " AND FIND_IN_SET('".(int)$data['filter_language']."',language)";
        }   
        if (isset($data['filter_location'])) {
            $sql .= " AND FIND_IN_SET('".(int)$data['filter_location']."',location)";
        }       
        $query = $this->db->query($sql);

        return $query->row['total'];
    }
    public function getAdTemplate($template_id) {
        $query = $this->db->query("SELECT template_id,targeting_sn,product_id,location,other_location,language,other_language,age_min,age_max,gender,interest,behavior,more,audience FROM ".DB_PREFIX."advertise_targeting_template WHERE template_id = '".(int)$template_id."'");
        if($query->num_rows){
            $data = $query->row;
            $_location = explode(",", $data['location']);
            if(is_array($_location)){
                $data['location'] = $_location;
            }
            $_language = explode(",", $data['language']);
            if(is_array($_language)){
                $data['language'] = $_language;
            }           
            return $data;
        } 
        return false;
    }


    public function getTotalAds($template_id){
        $query = $this->db->query("SELECT COUNT(targeting_id) AS total FROM ".DB_PREFIX."advertise_targeting WHERE template_id = '".(int)$template_id."'");

        return isset($query->row['total']) ? $query->row['total'] : 0 ;
    }
}