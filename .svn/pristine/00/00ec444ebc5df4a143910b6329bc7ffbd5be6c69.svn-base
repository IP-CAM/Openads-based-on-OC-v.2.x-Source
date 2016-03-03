<?php
class ModelServiceWebsite extends Model {
    public function addWebsite($data){
        $customer = $this->db->fetch('customer',array('one'=>true,'condition'=>array('customer_id'=>$data['customer_id'])));
        $fields = array(
            'from'          => 'backend',
            'product_id'    => $data['product_id'],
            'domain'        => $data['domain'],
            'note'          => $data['note'],
            'alias'         => isset($data['alias']) ? trim($data['alias']) : '',
            'customer_id'   => $data['customer_id'],
            'in_charge'     => empty($customer['in_charge']) ? $this->user->getId() : (int)$customer['in_charge'],
            'status'        => 1,
            'date_added'    => date('Y-m-d H:i:s'),
            'date_modified' => date('Y-m-d H:i:s')
        );
        $website_id = $this->db->insert('website',$fields);

        return $website_id;
    }
    public function editWebsite($data){
        if(empty($data['website_id'])){
            return false;
        }
        $website = $this->getWebsite($data['website_id'],true);  

        $fields = array();
        if(isset($data['field'])){
            switch(strtolower(trim($data['field']))){
                case 'domain':
                    $fields['domain'] = htmlspecialchars_decode($data['value']);
                    break;
                case 'product_id':
                    $fields['product_id'] = (int)$data['value'];
                    $this->db->update('advertise',array('website_id'=>$data['website_id']),array('product_id'=>(int)$data['value']));
                    break;
                case 'status':
                    $fields['status'] = ((int)$website['status'] == 0);
                    $this->addWebsiteHistory($data['website_id'],$fields['status']);
                    break;
                case 'show':
                    $fields['show'] = ((int)$website['show'] == 0 );
                    break;
            }

        }else{
            if(isset($data['product_id'])) {
                $fields['product_id'] = (int)$data['product_id'];
            }
            if(isset($data['domain'])) {
                $fields['domain'] = htmlspecialchars_decode($data['domain']);
            }
            if(isset($data['note'])) {
                $fields['note'] = htmlspecialchars_decode($data['note']);
            }
        }
        if($fields){
            $this->db->update('website',array('website_id'=>$data['website_id']),$fields);
            return true;
        }
        return false;

    }

    public function deleteWebsite($website_id) {

        $advertises = $this->db->fetch('advertise',array('condition'=>array('website_id'=>$website_id)));
        foreach ($advertises as $ad) {
            $this->db->delete('advertise_history',array('advertise_id'=>$ad));
            $this->db->delete('advertise_targeting_history',array('advertise_id'=>$ad));
            $this->db->delete('advertise_post_history',array('advertise_id'=>$ad));
            $this->db->delete('advertise_photo_history',array('advertise_id'=>$ad));
            $this->db->delete('advertise_tracking',array('advertise_id'=>$ad));
        }
        $this->db->delete('advertise',array('website_id'=>$website_id));
        $this->db->delete('advertise_targeting',array('website_id'=>$website_id));
        $this->db->delete('advertise_post',array('website_id'=>$website_id));
        $this->db->delete('advertise_photo',array('website_id'=>$website_id));   

        $this->db->delete('website',array('website_id'=>$website_id));
        $this->db->delete('website_tracking',array('website_id'=>$website_id));     
    }

    public function getWebsite($website_id,$simple=false) {
        if($simple){
            $sql = "SELECT w.*,pd.name product FROM ".DB_PREFIX."website w LEFT JOIN ".DB_PREFIX."product_description pd ON w.product_id = pd.product_id WHERE w.website_id = '".$website_id."' AND pd.language_id = '".$this->config->get('config_language_id')."'";
        }else{
            $sql = "SELECT w.* FROM `" . DB_PREFIX . "website` w WHERE w.website_id = '" . (int)$website_id . "' ";
        }
        $query = $this->db->query($sql);
        if ($query->num_rows) {
            return $query->row;
        } 
        return false;
    }

    public function getWebsites($data = array()) {
        $sql = "SELECT w.*, (SELECT COUNT(a.advertise_id) ads FROM ".DB_PREFIX."advertise a WHERE a.website_id = w.website_id ) AS ads
        FROM `" . DB_PREFIX . "website` w  WHERE 1 ";
        if(!$this->user->isSupervisor()){
            $sql .= " AND w.in_charge = '".$this->user->getId()."'";
        }
        if (!empty($data['filter_website_id'])) {
            $sql .= " AND w.website_id = '" . (int)$data['filter_website_id'] . "'";
        }
        if (!empty($data['filter_website_sn'])) {
            $sql .= " AND w.website_sn = '%" . $this->db->escape($data['filter_website_sn']) . "%'";
        }
        if (!empty($data['filter_product'])) {
            $sql .= " AND w.product_id = '" . (int)$data['filter_product'] . "'";
        }
        if (!empty($data['filter_domain'])) {
            $sql .= " AND w.domain = '" . $this->db->escape($data['filter_domain']) . "'";
        }
        if (!empty($data['filter_status'])) {
            $sql .= " AND w.status = '" . $this->db->escape($data['filter_status']) . "'";
        }
        if (!empty($data['filter_in_charge'])) {
            $sql .= " AND w.in_charge = '" . (int)$data['filter_in_charge'] . "'";
        }

        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND w.customer_id = '" . (int)$data['filter_customer_id'] . "'";
        }
        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(w.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }
        if (!empty($data['filter_date_modified'])) {
            $sql .= " AND DATE(w.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        if (!empty($data['filter_modified_start'])) {
            $sql .= " AND DATE(w.date_modified) >= DATE('" . $this->db->escape($data['filter_modified_start']) . "')";
        }

        if (!empty($data['filter_modified_end'])) {
            $sql .= " AND DATE(w.date_modified) <= DATE('" . $this->db->escape($data['filter_modified_end']) . "')";
        }

        if(isset($data['filter_message'])){
            $query = $this->db->query("SELECT website_id FROM ".DB_PREFIX."website_tracking WHERE `read` = '0' AND `from` = 'member' ");
            $ids = array();
            if($query->num_rows){
                foreach ($query->rows as $item) {
                    if($item['website_id'])
                        $ids[] = $item['website_id'];
                }
                if(count($ids)){
                    $sql .= " AND w.website_id IN (".implode(",", $ids).")";
                }else{
                    return array();
                }
            }else{
                return array();
            }
        }

        $sort_data = array(
            'w.website_id',
            'w.website_sn',
            'w.domain',
            'w.in_charge',
            'w.status',
            'w.customer_id',
            'w.date_added',
            'w.date_modified',
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY w.date_modified";
        }

        if (isset($data['website']) && ($data['website'] == 'ASC')) {
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

    public function getTotalWebsites($data = array()) {
        $sql = "SELECT COUNT(w.website_id) AS total FROM `" . DB_PREFIX . "website` w WHERE 1 ";
        if(!$this->user->isSupervisor()){
            $sql .= " AND w.in_charge = '".$this->user->getId()."'";
        }
        if (!empty($data['filter_website_id'])) {
            $sql .= " AND w.website_id = '" . (int)$data['filter_website_id'] . "'";
        }
        if (!empty($data['filter_website_sn'])) {
            $sql .= " AND w.website_sn LIKE '%" . $this->db->escape($data['filter_website_sn']) . "%'";
        }
        if (!empty($data['filter_product'])) {
            $sql .= " AND w.product_id = '" . (int)$data['filter_product'] . "'";
        }
        if (!empty($data['filter_domain'])) {
            $sql .= " AND w.domain = '" . $this->db->escape($data['filter_domain']) . "'";
        }
        if (!empty($data['filter_status'])) {
            $sql .= " AND w.status = '" . $this->db->escape($data['filter_status']) . "'";
        }
        if (!empty($data['filter_in_charge'])) {
            $sql .= " AND w.in_charge = '" . (int)$data['filter_in_charge'] . "'";
        }
        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND w.customer_id = '" . (int)$data['filter_customer_id'] . "'";
        }
        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(w.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }
        if (!empty($data['filter_date_modified'])) {
            $sql .= " AND DATE(w.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        if (!empty($data['filter_modified_start'])) {
            $sql .= " AND DATE(w.date_modified) >= DATE('" . $this->db->escape($data['filter_modified_start']) . "')";
        }

        if (!empty($data['filter_modified_end'])) {
            $sql .= " AND DATE(w.date_modified) <= DATE('" . $this->db->escape($data['filter_modified_end']) . "')";
        }

        if(isset($data['filter_message'])){
            $query = $this->db->query("SELECT DISTINCT website_id FROM ".DB_PREFIX."website_tracking WHERE `read` = '0' AND `from` = 'member' ");
            $ids = array();
            if($query->num_rows){
                foreach ($query->rows as $item) {
                    if($item['website_id'])
                        $ids[] = $item['website_id'];
                }
                if(count($ids)){
                    $sql .= " AND w.website_id IN (".implode(",", $ids).")";
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    function readMessage($website_id){
        $this->db->update('website_tracking',array('website_id'=>$website_id),array('read'=>1));
    }

    function getUnreadMessage($website_id=false){
        $filter = array(
            'one'   => true,
            'field' => 'COUNT(tracking_id) total',
            'condition' => array(
                'from'  => 'member',
                'read'  => 0
            )
        );
        if($website_id){
            $filter['condition']['website_id'] = $website_id;
        }

        $result = $this->db->fetch('website_tracking',$filter);
        return isset($result['total']) ? $result['total'] : 0;
    }

    function addWebsiteTracking($website_id,$data){
        $fields = array(
            'website_id'  => $website_id,
            'text'          => $data['text'],
            'attach'        => htmlspecialchars_decode($data['attach']),
            'from'          => 'backend',
            'user_id'       => $this->user->getId(),
            'read'          => 0,
            'date_added'    => date('Y-m-d H:i:s'),
        );

        return $this->db->insert('website_tracking',$fields);
    }

    function getWebsiteTrackings($website_id){

        $filter = array(
            'alias'=> 'at',
            'field'=> "at.*,CONCAT(c.firstname,' ',c.lastname) customer,c.company,CONCAT(u.lastname,' ',u.firstname) charger",
            'join' => array(
                array(
                    'table' =>  'website',
                    'alias' => 'a',
                    'on'    => 'w.website_id = at.website_id'
                ),
                array(
                    'table' =>  'customer',
                    'alias' => 'c',
                    'on'    => 'c.customer_id = w.customer_id'
                ),
                array(
                    'table' => 'user',
                    'alias' => 'u',
                    'on'    => 'u.user_id = at.user_id'
                ),
            ),
            'condition'=> array(
                'website_id' => $website_id
            ),
            'sort'  => 'at.date_added DESC'
        );

        return $this->db->fetch('website_tracking',$filter);
    }

    public function addWebsiteHistory($website_id,$data){
        $ws_info = $this->getWebsite($website_id,true);
        if($ws_info){
            $fields = array(
                'status'       => (int)$data['status'],
                'note'          => isset($data['note']) ? strip_tags($data['note']) : '',
                'date_modified' => date('Y-m-d H:i:s')
            );
            $this->db->update('website',array('website_id'=>$website_id),$fields);
            $history = array(
                'website_id'  => $website_id,
                'status'       => (int)$data['status'],
                'from'          => 'member',
                'note'          => isset($data['note']) ? strip_tags($data['note']) : '',
                'in_charge'   => $this->user->getId(),
                'date_added'    => date('Y-m-d H:i:s')
            );
            return $this->db->insert('website_history',$history);
        }
    }
    public function getWebsiteHistories($website_id,$start=0,$limit=10){
        $filter = array(
            'field' => 'wh.*',
            'alias' => 'wh',
            'condition' => array(
                'website_id'=> $website_id
            )
        );
        $sort = '';
        $sort_data = array(
            'wh.website_id',
            'wh.website_sn',
            'wh.domain',
            'wh.in_charge',
            'wh.status',
            'wh.customer_id',
            'wh.date_added',
            'wh.date_modified',
        );
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sort .= $data['sort'];
        } else {
            $sort .= "date_added";
        }

        if (isset($data['order']) && ($data['order'] == 'ASC')) {
            $sort .= " ASC";
        } else {
            $sort .= " DESC";
        }
        $filter['sort'] = $sort;

        if ($start < 0) {
            $filter['start'] = 0;
        }else{
            $filter['start'] = $start;
        }
        if ($limit < 1) {
            $filter['limit'] = 20;
        }else{
            $filter['limit'] = $limit;
        }
        return $this->db->fetch('website_history',$filter);
    }

    public function getTotalWebsiteHistories($website_id){
        $filter = array(
            'one'       => true,
            'field'     => 'COUNT(history_id) total',
            'condition' => array(
                'website_id'=> $website_id
            )
        );
        $result = $this->db->fetch('website_history',$filter);
        return isset($result['total']) ? $result['total'] : 0;
    }
}