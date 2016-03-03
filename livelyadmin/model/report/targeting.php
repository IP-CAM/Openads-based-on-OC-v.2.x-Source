<?php
class ModelReportTargeting extends Model {
    private function getPublishesByKey($publish){
        $tmp = array();
        switch (strtolower($publish)) {
            case 'indesign':
                $tmp = (array)$this->config->get('report_ad_publish_indesign');
                break;
            case 'waiting':
                $tmp = (array)$this->config->get('report_ad_publish_waiting');
                break;
            case 'doing':
                $tmp = (array)$this->config->get('report_ad_publish_doing');
                break;
            case 'running':
                $tmp = (array)$this->config->get('report_ad_publish_running');
                break;
            case 'banned':
                $tmp = (array)$this->config->get('report_ad_publish_banned');
                break;
        }
        return $tmp;
    }
    public function getAdTargetings($data = array()) {

        $sql = "SELECT at.*,att.targeting_sn,a.product_id,a.target_url,a.advertise_sn,a.publish,a.ad_account FROM ".DB_PREFIX."advertise_targeting at LEFT JOIN ".DB_PREFIX."advertise_targeting_template att ON att.template_id = at.template_id LEFT JOIN ".DB_PREFIX."advertise a ON at.advertise_id = a.advertise_id WHERE a.publish >= '".$this->config->get('ad_publish_indesign')."' ";

        if (!empty($data['filter_interest'])) {
            $sql .= " AND at.interest LIKE '%" . $this->db->escape($data['filter_interest']) . "%'";
        }
        if (!empty($data['filter_gender'])) {
            $sql .= " AND at.gender = '" . (int)$data['filter_gender'] . "'";
        }
        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND a.customer_id = '" . (int)$data['filter_customer_id']. "'";
        }
        if (!empty($data['filter_target_url'])) {
            $sql .= " AND a.`target_url` LIKE '%" . $this->db->escape($data['filter_target_url']) . "%'";
        }
        if (!empty($data['filter_targeting_sn'])) {
            $sql .= " AND att.targeting_sn LIKE '" . $data['filter_targeting_sn'] . "%'";
        }
        if (!empty($data['filter_advertise_sn'])) {
            $sql .= " AND a.advertise_sn LIKE '" . $data['filter_advertise_sn'] . "%'";
        }        
        if (!empty($data['filter_publish'])) {
            $publish = array();
            $publishes = explode(",", $data['filter_publish']);
            if(is_array($publishes)){
                foreach ($publishes as $item) {
                    $publish = array_merge($publish ,$this->getPublishesByKey($item));
                }
            }
            $sql .= " AND a.publish IN (" . $this->db->escape(implode(",", $publish)) . ")";
        }      
        if (isset($data['filter_language'])) {
            $sql .= " AND FIND_IN_SET('".(int)$data['filter_language']."',at.language)";
        }   
        if (isset($data['filter_location'])) {
            $sql .= " AND FIND_IN_SET('".(int)$data['filter_location']."',at.location)";
        }         
        $sort_data = array(
            'att.targeting_sn',
            'a.publish',
            'at.customer_id',
            'at.location',
            'at.gender',
            'a.target_url',
            'at.audience',
            'at.age_min',
            'at.language',
            'a.advertise_sn',
        );
        $sql .= " ORDER BY  ";//IF(at.targeting_sn > 0 ,0,1) ,
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .=  $data['sort'];
        } else {
            $sql .= "att.targeting_sn";
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

    public function getTotalAdTargetings($data = array()) {
        $sql = "SELECT COUNT(at.targeting_id) AS total FROM `" . DB_PREFIX . "advertise_targeting` at LEFT JOIN ".DB_PREFIX."advertise_targeting_template att ON att.template_id = at.template_id LEFT JOIN ".DB_PREFIX."advertise a ON at.advertise_id = a.advertise_id WHERE a.publish >= '".$this->config->get('ad_publish_indesign')."'  ";
        if (!empty($data['filter_interest'])) {
            $sql .= " AND at.interest LIKE '%" . $this->db->escape($data['filter_interest']) . "%'";
        }
        if (!empty($data['filter_gender'])) {
            $sql .= " AND at.gender = '" . (int)$data['filter_gender'] . "'";
        }
        if (!empty($data['filter_publish'])) {
            $publish = array();
            $publishes = explode(",", $data['filter_publish']);
            if(is_array($publishes)){
                foreach ($publishes as $item) {
                    $publish = array_merge($publish ,$this->getPublishesByKey($item));
                }
            }
            $sql .= " AND a.publish IN (" . $this->db->escape(implode(",", $publish)) . ")";
        }    
        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND a.customer_id = '" . (int)$data['filter_customer_id']. "'";
        }
        if (!empty($data['filter_target_url'])) {
            $sql .= " AND a.`target_url` LIKE '%" . $this->db->escape($data['filter_target_url']) . "%'";
        }        
        if (!empty($data['filter_targeting_sn'])) {
            $sql .= " AND att.targeting_sn LIKE '" . $data['filter_targeting_sn'] . "%'";
        }
        if (!empty($data['filter_advertise_sn'])) {
            $sql .= " AND a.advertise_sn LIKE '" . $data['filter_advertise_sn'] . "%'";
        } 
        if (isset($data['filter_language'])) {
            $sql .= " AND FIND_IN_SET('".(int)$data['filter_language']."',at.language)";
        }   
        if (isset($data['filter_location'])) {
            $sql .= " AND FIND_IN_SET('".(int)$data['filter_location']."',at.location)";
        }       
        $query = $this->db->query($sql);

        return $query->row['total'];
    }
    public function getAdTargeting($targeting_id) {
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."advertise_targeting WHERE targeting_id = '".(int)$targeting_id."'");
        return $query->row;
    }

    public function editAdTargeting($data){
        if(empty($data['targeting_id'])){
            return false;
        }
        $targeting = $this->getAdTargeting($data['targeting_id']);  
        if(in_array($this->user->getId(), array_merge($this->config->get('ad_group_manager'),$this->config->get('ad_group_publisher')))){
            $fields = array();
            if(isset($data['field']) && strtolower(trim($data['field'])) == 'targeting_sn'){
                $fields['targeting_sn'] = trim($data['value']);
            }
            if(isset($data['field']) && strtolower(trim($data['field'])) == 'audience'){
                $fields['audience'] = (int)$data['value'];
            }
            if($fields)
            $this->db->update('advertise_targeting',array('targeting_id'=>$data['targeting_id']),$fields);
            return true;
        }
        return false;        
    }

}