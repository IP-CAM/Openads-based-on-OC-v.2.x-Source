<?php
class ModelFbpageProfileNophoto extends Model {

    private $post_type = 3;
    public function deleteContribute($contribute_id){
        $where = array();
        $where['contribute_id'] = $contribute_id;
        $this->db->delete("fbpage_nophoto_post",$where);
        $this->db->delete("fbpage_nophoto_post_history",$where);
        $where['post_type'] = array('logic'=>'in','value'=>'3,4');
        $this->db->delete("sns_balance",$where);
    }

    public function getContributes($data) {
        $sql = "SELECT p.* FROM " . DB_PREFIX . "fbpage_nophoto_post p WHERE p.author_id = '".$this->db->escape($this->user->getAuthorId())."' ";
        $implode = array();

        if (!empty($data['filter_entry'])) {
            $implode[] = "p.entry_sn LIKE '%" . $this->db->escape($data['filter_entry']) . "%'";
        }

        if (!empty($data['filter_product_id'])) {
            $implode[] = "p.product_id = '" . (int)$data['filter_product_id'] . "'";
        }

        if (!empty($data['filter_user_id'])) {
            $implode[] = "p.user_id = '" . (int)$data['filter_user_id'] . "'";
        }   
     
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "p.status = '" . (int)$data['filter_status'] . "'";
        }   


        if (!empty($data['filter_submited_date'])) {
            $implode[] = "DATE(p.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
        }
        if (!empty($data['filter_date_modified'])) {
            $implode[] = "DATE(p.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $sort_data = array(
            'p.status',
            'p.product_id',
            'p.entry_sn',
            'p.submited_date',   
            'p.date_modified',
            'p.user_id',
        );  
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];   
        } else {
            $sql .= " ORDER BY p.date_modified";   
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
        $sql = "SELECT COUNT(p.contribute_id) AS total  FROM " . DB_PREFIX . "fbpage_nophoto_post p WHERE p.author_id = '".$this->db->escape($this->user->getAuthorId())."'";
        $implode = array();

        if (!empty($data['filter_entry'])) {
            $implode[] = "p.entry_sn LIKE '%" . $this->db->escape($data['filter_entry']) . "%'";
        }

        if (!empty($data['filter_product_id'])) {
            $implode[] = "p.product_id = '" . (int)$data['filter_product_id'] . "'";
        }

        if (!empty($data['filter_user_id'])) {
            $implode[] = "p.user_id = '" . (int)$data['filter_user_id'] . "'";
        }   

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "p.status = '" . (int)$data['filter_status'] . "'";
        }   
        if (!empty($data['filter_submited_date'])) {
            $implode[] = "DATE(p.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
        }
        if (!empty($data['filter_date_modified'])) {
            $implode[] = "DATE(p.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $query = $this->db->query($sql);
        
        return $query->row['total'];
    }

    public function getContribute($contribute_id) {
        $sql = "SELECT * FROM " . DB_PREFIX . "fbpage_nophoto_post WHERE `contribute_id` = '" . (int)$contribute_id . "' AND `author_id` = '".$this->db->escape($this->user->getAuthorId())."' ";
        $query = $this->db->query($sql);
        return $query->row;
    }

    public function resetTempLocker($contribute_id=false,$locker=false){
        $where= array();
        if($contribute_id){
            $where['contribute_id'] = (int)$contribute_id;
        }
        if($locker){
            $where['locker'] = (int)$locker;
        }else{
            $where['locker'] = (int)$this->user->getId();
        }
        $this->db->update("fbpage_nophoto_post",$where,array('locker' => 0));
    }

    public function setTempLocker($contribute_id,$user_id=false){
        $value = $user_id ? (int)$user_id : (int)$this->user->getId();
        $this->db->update("fbpage_nophoto_post",array('contribute_id' =>(int)$contribute_id),array('locker' =>$value));
    }
    
    public function editContribute($data){  

        if(!isset($data['contribute_id'])){return false;}
        $info = $this->getContribute($data['contribute_id']);
        if(!$info){return false;}
        $log = $fields = $where = array();
        $where['contribute_id'] = (int)$data['contribute_id'];
        $fields['date_modified'] = date('Y-m-d H:i:s');
        $fields['user_id'] = $this->user->getId();

        if(isset($data['publish']) && $data['publish'] !==false ){
            $fields['publish'] = (int)$data['publish'];
            $log['post'] = (int)$data['publish'];
        }
        if(!empty($data['target_url'])){
            $fields['target_url'] = $data['target_url'];
        }
        if(!empty($data['content_modified']) && !empty($data['content'])){
            $fields['content'] = $data['content'];
        }
        if(!empty($data['expired_modified']) && !empty($data['expired'])){
            $fields['expired'] = $data['expired'];
        }
        if(!empty($data['entry_modified']) && !empty($data['entry_sn'])){
            $fields['entry_sn'] = $data['entry_sn'];
        }
        if(!empty($data['note'])){
            $fields['note'] = $data['note'];
        }
        $this->db->update("fbpage_nophoto_post",$where, $fields);

        $this->resetTempLocker($data['contribute_id']);
        if($log){
            foreach ($log as $key => $value) {
                if(in_array(trim($key), array('edit','post'))){
                    $tmp = array(
                        'type' => trim($key), 
                        'value' => (int)$value,
                        'user_id' => (int)$this->user->getId(),
                        'date_added' => date('Y-m-d H:i:s'),
                        'contribute_id' => (int)$data['contribute_id'],
                    );
                    $this->db->insert('fbpage_nophoto_post_history',$tmp); 
                }
            }
        }
    }

    public function getHistories($contribute_id,$start=0,$limit=20){
        $sql = "SELECT h.*,u.nickname FROM ".DB_PREFIX."fbpage_nophoto_post_history h LEFT JOIN ".DB_PREFIX."user u ON h.user_id = u.user_id WHERE h.`type` = 'edit' AND h.contribute_id = '".(int)$contribute_id."' ORDER BY h.date_added DESC LIMIT " . (int)$start. "," . (int)$limit;
        $query = $this->db->query($sql);
    
        return $query->rows;
    }

    public function getTotalHistory($contribute_id){
        $query = $this->db->query("SELECT COUNT(history_id) total FROM ".DB_PREFIX."fbpage_nophoto_post_history  WHERE `type` = 'edit' AND `contribute_id` = '".(int)$contribute_id."'");
        return $query->row['total'];
    }
    
}