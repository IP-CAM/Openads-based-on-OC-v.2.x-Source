<?php
class ModelServiceTemplate extends Model {

    public function getTemplates($data = array()) {

        $sql = "SELECT * FROM ".DB_PREFIX."advertise_targeting_template WHERE 1  ";

        if (!empty($data['filter_interest'])) {
            $sql .= " AND interest LIKE '%" . $this->db->escape($data['filter_interest']) . "%'";
        }
        if (!empty($data['filter_gender'])) {
            $sql .= " AND gender = '" . (int)$data['filter_gender'] . "'";
        }
        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND customer_id = '" . (int)$data['filter_customer_id']. "'";
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
        if (isset($data['filter_status'])) {
            $sql .= " AND status = '".(int)$data['filter_status']."'";
        }                  
        $sort_data = array(
            'targeting_sn',
            'customer_id',
            'location',
            'gender',
            'status',
            'audience',
            'age_min',
            'language',
        );
        $sql .= " ORDER BY  ";//IF(targeting_sn > 0 ,0,1) ,
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

    public function getTotalTemplates($data = array()) {
        $sql = "SELECT COUNT(template_id) AS total FROM `" . DB_PREFIX . "advertise_targeting_template` WHERE 1 ";
        if (!empty($data['filter_interest'])) {
            $sql .= " AND interest LIKE '%" . $this->db->escape($data['filter_interest']) . "%'";
        }
        if (!empty($data['filter_gender'])) {
            $sql .= " AND gender = '" . (int)$data['filter_gender'] . "'";
        }   
        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND customer_id = '" . (int)$data['filter_customer_id']. "'";
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
        if (isset($data['filter_status'])) {
            $sql .= " AND status = '".(int)$data['filter_status']."'";
        }               
        $query = $this->db->query($sql);

        return $query->row['total'];
    }
    public function getTemplate($template_id) {
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."advertise_targeting_template WHERE template_id = '".(int)$template_id."'");
        return $query->row;
    }

    public function editTemplate($data){
        if(empty($data['template_id'])){
            return false;
        }
        $template = $this->getTemplate($data['template_id']);  
        if(in_array($this->user->getId(), array_merge($this->config->get('ad_group_manager'),$this->config->get('ad_group_publisher')))){
            $fields = array();
            if(isset($data['field']) && strtolower(trim($data['field'])) == 'targeting_sn'){
                $fields['targeting_sn'] = trim($data['value']);
            }
            if(isset($data['field']) && strtolower(trim($data['field'])) == 'audience'){
                $fields['audience'] = (int)$data['value'];
            }
            if($fields)
            $this->db->update('advertise_targeting_template',array('template_id'=>$data['template_id']),$fields);
            return true;
        }
        return false;        
    }

}