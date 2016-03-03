<?php
class ModelReportLink extends Model {
    public function getContributes($data) {
        if(!empty($data['tab'])){
            if(strtolower(trim($data['tab']))=='message'){
                $table = DB_PREFIX.'message';
            }else{
                $table = DB_PREFIX.strtolower(trim($data['tab'])).'_contribute';
            }
        }else{
            return array();
        }
        if(strtolower(trim($data['tab']))=='ads'){
            $sql = "SELECT mc.*,CONCAT(c.firstname ,' ', c.lastname) customer,CONCAT(u.lastname,u.firstname) user ,cc.name product
            FROM " . $table . " mc LEFT JOIN ".DB_PREFIX."ads a ON a.product_config_id = mc.product_config_id LEFT JOIN ".DB_PREFIX."contribute_config cc ON cc.contribute_config_id = mc.product_config_id 
            LEFT JOIN ".DB_PREFIX."customer c ON mc.customer_id = c.customer_id LEFT JOIN ".DB_PREFIX."user u ON mc.user_id = u.user_id WHERE 1";
        }else{
            $sql = "SELECT mc.*,pf.entry_sn,pf.entry_name ,CONCAT(c.firstname ,' ', c.lastname) customer,CONCAT(u.lastname,u.firstname) user ,cc.name product
            FROM " . $table . " mc LEFT JOIN ".DB_PREFIX."fbaccount pf ON pf.entry_sn = mc.entry_sn LEFT JOIN ".DB_PREFIX."contribute_config cc ON cc.contribute_config_id = mc.product_config_id 
            LEFT JOIN ".DB_PREFIX."customer c ON mc.customer_id = c.customer_id LEFT JOIN ".DB_PREFIX."user u ON mc.user_id = u.user_id WHERE 1 ";
        }
        $implode = array();
        if(strtolower(trim($data['tab']))!='ads' && !in_array($this->user->getId(), array_merge($this->config->get("group_admin"),$this->config->get("group_promotion")))){
            $psn = array();
            $user_id = (int)$this->user->getId();

            $psn_sql = "SELECT DISTINCT a.entry_sn FROM ".DB_PREFIX."fbaccount a WHERE a.user_id = '".$user_id."' ";
            $psn_query = $this->db->query($psn_sql);
            if($psn_query->num_rows){
                foreach ($psn_query->rows as $row) {
                    $psn[] = "'".$row['entry_sn']."'";
                }
            }
            if(!$psn){
                return array();
            }
            $implode[] = "mc.entry_sn IN (".implode(",", array_unique($psn)).") ";
            
        }

        if (!empty($data['filter_entry'])) {
            $implode[] = "CONCAT(pf.entry_sn,' - ',pf.entry_name) Like '%" . $this->db->escape($data['filter_entry']) . "%'";
        }
        if (!empty($data['filter_entry_name'])) {
            $implode[] = "pf.entry_name LIKE '%" . $this->db->escape($data['filter_entry_name']) . "%'";
        }
        if (!empty($data['filter_entry_sn'])) {
            $implode[] = "pf.entry_sn = '" . $this->db->escape($data['filter_entry_sn']) . "'";
        }
        if (!empty($data['filter_user_id'])) {
            $implode[] = "mc.user_id = '" . (int)$data['filter_user_id'] . "'";
        }   
        if (isset($data['filter_publish']) && $data['filter_publish'] !==false) {
            $implode[] = "mc.publish = '" . (int)$data['filter_publish'] . "'";
        }  
        if (!empty($data['filter_customer_id'])) {
            $implode[] = "mc.customer_id = '" . (int)$data['filter_customer_id'] . "'";
        }
        if (!empty($data['filter_customer'])) {
            $implode[] = "CONCAT(c.firstname ,' ', c.lastname) LIKE '%". $this->db->escape($data['filter_customer']) . "%'";
        }   
        if (!empty($data['filter_contribute_sn'])) {
            $implode[] = "mc.contribute_sn LIKE '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
        }

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $sort_data = array(
            'mc.status',
            'mc.publish',
            'product',
            'entry_name',
            'mc.contribute_sn',
            'mc.target_url',
            'user',
        );  
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];   
        } else {
            $sql .= " ORDER BY mc.submited_date";   
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

    public function getTotalContributes($data) {
        if(!empty($data['tab'])){
            if(strtolower(trim($data['tab']))=='message'){
                $table = DB_PREFIX.'message';
            }else{
                $table = DB_PREFIX.strtolower(trim($data['tab'])).'_contribute';
            }
        }else{
            return array();
        }
        if(strtolower(trim($data['tab']))=='ads'){
            $sql = "SELECT COUNT(mc.contribute_id) AS total  FROM " . $table." mc LEFT JOIN ".DB_PREFIX."ads a ON a.product_config_id = mc.product_config_id  
            LEFT JOIN ".DB_PREFIX."customer c ON mc.customer_id = c.customer_id WHERE 1";
        }else{
            $sql = "SELECT COUNT(mc.contribute_id) AS total  FROM " . $table." mc LEFT JOIN ".DB_PREFIX."fbaccount pf ON pf.entry_sn = mc.entry_sn  
            LEFT JOIN ".DB_PREFIX."customer c ON mc.customer_id = c.customer_id WHERE 1";
        }
        $implode = array();
        if(strtolower(trim($data['tab']))!='ads' && !in_array($this->user->getId(), array_merge($this->config->get("group_admin"),$this->config->get("group_promotion")))){
            $psn = array();
            $user_id = (int)$this->user->getId();

            $psn_sql = "SELECT DISTINCT entry_sn FROM ".DB_PREFIX."fbaccount WHERE user_id = '".$user_id."' ";
            $psn_query = $this->db->query($psn_sql);
            if($psn_query->num_rows){
                foreach ($psn_query->rows as $row) {
                    $psn[] = "'".$row['entry_sn']."'";
                }
            }
            if(!$psn){
                return 0;
            }
            $implode[] = "mc.entry_sn IN (".implode(",", array_unique($psn)).") ";
            
        }
        if (!empty($data['filter_entry'])) {
            $implode[] = "CONCAT(pf.entry_sn,' - ',pf.entry_name) Like '%" . $this->db->escape($data['filter_entry']) . "%'";
        }
        if (!empty($data['filter_entry_sn'])) {
            $implode[] = "pf.entry_sn = '" . $this->db->escape($data['filter_entry_sn']) . "'";
        }
        if (!empty($data['filter_entry_name'])) {
            $implode[] = "pf.entry_name LIKE '%" . $this->db->escape($data['filter_entry_name']) . "%'";
        }
        if (!empty($data['filter_contribute_sn'])) {
            $implode[] = "mc.contribute_sn LIKE '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
        }
        if (!empty($data['filter_user_id'])) {
            $implode[] = "mc.user_id = '" . (int)$data['filter_user_id'] . "'";
        }   
        if (!empty($data['filter_publish'])) {
            $implode[] = "mc.publish = '" . (int)$data['filter_publish'] . "'";
        }
        if (!empty($data['filter_customer_id'])) {
            $implode[] = "mc.customer_id = '" . (int)$data['filter_customer_id'] . "'";
        }
        if (!empty($data['filter_customer'])) {
            $implode[] = "CONCAT(c.firstname ,' ', c.lastname) LIKE '%". $this->db->escape($data['filter_customer']) . "%'";
        }   

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $query = $this->db->query($sql);
        
        return $query->row['total'];
    }

    public function getPostText($data){
        if(empty($data['filter_type']) || empty($data['filter_sn'])){
            return false;
        }
        $table = '';
        if($data['filter_type']=='p'){
            $table = 'photo_fbaccount_contribute';
        }
        if($data['filter_type']=='s'){
            $table = 'fbaccount_contribute';
        }
        if($data['filter_type']=='m'){
            $table = 'message';
        }
        if($data['filter_type']=='a'){
            $table = 'ads_contribute';
        }

        $sql = "SELECT contribute_sn,content FROM ".DB_PREFIX.$table." WHERE contribute_sn LIKE '%" . $this->db->escape($data['filter_sn']) . "'";

        $sql .= " ORDER BY contribute_sn"; 
            
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
    
}