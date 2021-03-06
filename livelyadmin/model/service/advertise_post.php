<?php
class ModelServiceAdvertisePost extends Model {

    public function editAdvertisePost($post_id,$data) {
        $post = $this->getAdvertisePost($post_id,true);
        if(!empty($post['advertise_id']) && ( $post['user_id'] == $this->user->getId() || $post['in_charge'] == $this->user->getId())){
            if(!$this->validateState($post_id)){
                return -2;
            }
            if(!empty($post['locker']) && $post['locker']!=$this->user->getId()){
                return -1;
            }
            $fields = array(
                'headline'      => $data['headline'],
                'text'          => $data['text'],
                'status'        => (int)$this->config->get('ad_post_robot_review'),
                'note'          => strip_tags(trim($data['note'])),
            //    'user_id'       => strtolower($post['from']) == 'member' ? 0 : (int)$this->user->getId(),
                'date_modified' => date('Y-m-d H:i:s')
            );
            if(strtolower($post['from']) == 'backend' && !$post['user_id']){
                $fields['user_id'] = strtolower($post['from']) == 'member' ? 0 : (int)$this->user->getId();
            }
            $history = array(
                'post_id'       => $post_id,
                'advertise_id'  => $post['advertise_id'],
                'from'          => "backend",
                'status'        => (int)$this->config->get('ad_post_robot_review'),
                'note'          => strip_tags(trim($data['note'])),
                'user_id'       => (int)$this->user->getId(),
                'date_added'    => date('Y-m-d H:i:s')
            );

            $this->db->update("advertise_post",array('post_id'=>$post_id), $fields);
            
            return $this->db->insert("advertise_post_history", $history);
        }
        
        return false;
    }


    public function getAdvertisePost($post_id) {

        $sql = "SELECT ap.*,w.domain,w.status website_status,a.advertise_sn,a.product_id,a.target_url,a.note ad_note FROM `" . DB_PREFIX . "advertise_post` ap
        LEFT JOIN ".DB_PREFIX."advertise a ON a.advertise_id = ap.advertise_id LEFT JOIN ".DB_PREFIX."website w ON w.website_id = ap.website_id  WHERE ap.post_id = '" . (int)$post_id . "' ";

        $query = $this->db->query($sql);

        return $query->num_rows ? $query->row : false;

    }

    public function getAdvertisePosts($data = array()) {
        $sql = "SELECT ap.*,w.domain ,a.advertise_sn,a.product_id FROM `" . DB_PREFIX . "advertise_post` ap
        LEFT JOIN ".DB_PREFIX."website w ON w.website_id = ap.website_id LEFT JOIN ".DB_PREFIX."advertise a ON a.advertise_id = ap.advertise_id
        WHERE w.status = '1' AND ap.status > '".$this->config->get('ad_post_pending')."'";

        if(!$this->user->isSupervisor()){
            $sql .= " AND ap.user_id = '".$this->user->getId()."'";
        }
        if (!empty($data['filter_post_sn'])) {
            $sql .= " AND ap.post_sn = '" . $this->db->escape($data['filter_post_sn']) . "'";
        }
        if (!empty($data['filter_advertise_id'])) {
            $sql .= " AND ap.advertise_id = '" . (int)$data['filter_advertise_id'] . "'";
        }
        if (!empty($data['filter_advertise_sn'])) {
            $sql .= " AND a.advertise_sn LIKE '" . $data['filter_advertise_sn'] . "%'";
        }

        if (!empty($data['filter_status'])) {
            $sql .= " AND ap.status = '" . (int)$data['filter_status'] . "'";
        }
        if (!empty($data['filter_in_charge'])) {
            $sql .= " AND ap.in_charge = '" . (int)$data['filter_in_charge'] . "'";
        }

        if (isset($data['filter_author'])) {
            $sql .= " AND ap.user_id = '" . (int)$data['filter_author'] . "'";
        }
        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND a.customer_id = '" . (int)$data['filter_customer_id'] . "'";
        }  
        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(ap.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if (!empty($data['filter_date_modified'])) {
            $sql .= " AND DATE(ap.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }

        if (!empty($data['filter_modified_start'])) {
            $sql .= " AND DATE(ap.date_modified) >= DATE('" . $this->db->escape($data['filter_modified_start']) . "')";
        }

        if (!empty($data['filter_modified_end'])) {
            $sql .= " AND DATE(ap.date_modified) <= DATE('" . $this->db->escape($data['filter_modified_end']) . "')";
        }

        $sort_data = array(
            'ap.advertise_id',
            'a.advertise_sn',
            'ap.post_sn',
            'ap.from',
            'ap.status',
            'a.customer_id',
            'ap.user_id',
            'ap.date_modified',
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY ap.date_modified";
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

    public function getTotalAdvertisePosts($data = array()) {
        $sql = "SELECT COUNT(ap.post_id) AS total FROM `" . DB_PREFIX . "advertise_post` ap LEFT JOIN ".DB_PREFIX."advertise a ON a.advertise_id = ap.advertise_id LEFT JOIN ".DB_PREFIX."website w ON w.website_id = ap.website_id
        WHERE w.status = '1' AND ap.status > '".$this->config->get('ad_post_pending')."'";

        if(!$this->user->isSupervisor()){
            $sql .= " AND ap.user_id = '".$this->user->getId()."'";
        }
        if (!empty($data['filter_advertise_sn'])) {
            $sql .= " AND a.advertise_sn LIKE '" . $data['filter_advertise_sn'] . "%'";
        }

        if (!empty($data['filter_post_sn'])) {
            $sql .= " AND ap.post_sn = '" . $this->db->escape($data['filter_post_sn']) . "'";
        }
        if (!empty($data['filter_from'])) {
            $sql .= " AND ap.`from` = '" . $this->db->escape($data['filter_from']) . "'";
        }

        if (!empty($data['filter_status'])) {
            $sql .= " AND ap.status = '" . (int)$data['filter_status'] . "'";
        }
        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND a.customer_id = '" . (int)$data['filter_customer_id'] . "'";
        }  

        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(ap.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if (!empty($data['filter_date_modified'])) {
            $sql .= " AND DATE(ap.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }

        if (!empty($data['filter_modified_start'])) {
            $sql .= " AND DATE(ap.date_modified) >= DATE('" . $this->db->escape($data['filter_modified_start']) . "')";
        }

        if (!empty($data['filter_modified_end'])) {
            $sql .= " AND DATE(ap.date_modified) <= DATE('" . $this->db->escape($data['filter_modified_end']) . "')";
        }
        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getAdvertisePostHistories($post_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }

        $query = $this->db->query("SELECT aph.*, aps.name AS status FROM " . DB_PREFIX . "advertise_post_history aph
        LEFT JOIN " . DB_PREFIX . "advertise_post_status aps ON (aph.status = aps.status_id AND aps.language_id = '" . (int)$this->config->get('config_language_id') . "')
        WHERE aph.post_id = '" . (int)$post_id . "'  ORDER BY aph.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

        return $query->rows;
    }

    public function getTotalAdvertisePostHistories($post_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "advertise_post_history WHERE post_id = '" . (int)$post_id . "'");

        return $query->row['total'];
    }

    public function getAdvertiseTargeting($advertise_id) {
        $data = array(
            'one' => true,
            'field' => 'at.*,ats.name',
            'alias'=>'at',
            'join' => array(
                array(
                    'table' => 'advertise_targeting_status',
                    'alias' => 'ats',
                    'on' => "ats.status_id = at.status AND ats.language_id ='".$this->config->get('config_language_id')."'"
                )
            ),
            'condition' => array(
                'advertise_id' => $advertise_id
            )
        );
        return $this->db->fetch('advertise_targeting',$data);
    }
    public function getAdvertisePhoto($advertise_id) {
        $data = array(
            'one' => true,
            'field' => 'ap.*,aps.name',
            'alias'=>'ap',
            'join' => array(
                array(
                    'table' => 'advertise_photo_status',
                    'alias' => 'aps',
                    'on' => "aps.status_id = ap.status AND aps.language_id ='".$this->config->get('config_language_id')."'"
                )
            ),
            'condition' => array(
                'advertise_id' => $advertise_id
            )
        );
        return $this->db->fetch('advertise_photo',$data);
    }
    public function validateState($entry_id){
        $data = array(
            'one'       => true,
            'alias'     => 'am',  
            'field'     => array('at.status'),
            'join'      => array(
                array(
                    'table' => 'advertise',
                    'alias' => 'a',
                    'on'    => 'a.advertise_id = am.advertise_id'
                ),
                array(
                    'table' => 'advertise_targeting',
                    'alias' => 'at',
                    'on'    => 'a.targeting_id = at.targeting_id'
                )
            ),
            'condition' => array(
                'targeting_id' => $entry_id
            )
        );        
        $result = $this->db->fetch('advertise_targeting',$data);
        if(isset($result['status']) && in_array($result['status'], $this->config->get('ad_targeting_levels'))){
            return true;
        }
        return false;
    }
}