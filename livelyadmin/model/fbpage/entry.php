<?php
class ModelFbpageEntry extends Model {
	public function addEntry($data) {
		if(is_array($data)){
			if(isset($data['product_config'])){
				unset($data['product_config']);
			}
			$data['date_added'] = date('Y-m-d H:i:s');
			$this->db->insert("fbpage_entry",$data);
			$this->addPageFansHistory(array('entry_sn'=>$data['entry_sn'],'fans'=>(int)$data['fans'],'date_time'=>date('Y-m-d')));
		}
	}
	
	public function addPageFansHistory($data,$delete=false){
		if($delete){
			$this->db->query("DELETE FROM " . DB_PREFIX . "fbpage_entry_fans WHERE entry_sn = '".$this->db->escape($data['entry_sn'])."' AND DATE(count_date) = DATE('".$data['date_time']."')");	
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "fbpage_entry_fans SET entry_sn = '".$this->db->escape($data['entry_sn'])."',fans_quantity = '" . (int)$data['fans'] . "',count_date = '".$data['date_time']."'");
	}
	
    public function UpdateFans($data) {
		$this->db->query("UPDATE  " . DB_PREFIX . "fbpage_entry SET fans = '" . (int)$data['fans'] . "' WHERE entry_sn = '".$this->db->escape($data['entry_sn'])."'");
	}
	
	public function editEntry($entry_id, $data) {
		if(is_array($data)){
			if(isset($data['product_config'])){
				unset($data['product_config']);
			}
			$fields = array();
			foreach ($data as $key => $value) {
				$fields[] = " `".trim($key)."` = '".$this->db->escape(trim($value))."'";
			}
			$this->db->update("fbpage_entry",array('entry_id'=>(int)$entry_id), $data);
			
			$entry = $this->getEntry($entry_id);
			if(isset($entry['entry_sn']) && isset($data['user_id']) ){
				$this->db->query("UPDATE  " . DB_PREFIX . "fbpage_contribute SET user_id = '".(int)$data['user_id']."' WHERE entry_sn = '".$entry['entry_sn']."'");				
			}
		}else{
			return false;
		}
	}
	
	public function deleteEntry($entry_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "fbpage_entry WHERE entry_id = '" . (int)$entry_id . "'");
	}
	
	public function getEntry($entry_id) {
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbpage_entry  WHERE  entry_id = '" . (int)$entry_id . "'");
		return $query->row;
	}

	public function getEntries($data = array()) {
		$sql = "SELECT f.*,
		        (SELECT COUNT(*) FROM " . DB_PREFIX . "fbpage_nophoto_post mc WHERE mc.entry_sn = f.entry_sn AND DATE(mc.submited_date) = DATE(NOW()) GROUP BY mc.entry_sn) AS nposts,
				(SELECT COUNT(*) FROM " . DB_PREFIX . "fbpage_nophoto_post mc WHERE mc.entry_sn = f.entry_sn  GROUP BY mc.entry_sn) AS posts
		FROM " . DB_PREFIX . "fbpage_entry  f  WHERE 1 " ;																																					  
		$implode = array();
		if(!in_array($this->user->getId(), array_merge($this->config->get("sns_group_admin"),$this->config->get("sns_group_promotion")))){
			//$implode[] = "f.user_id = '" . (int)$this->user->getId() . "' ";
		}
		if (!empty($data['filter_entry_sn'])) {
			$implode[] = "f.entry_sn Like '" . (int)$data['filter_entry_sn'] . "%'";
		}
		if (!empty($data['filter_entry_name'])) {
			$implode[] = "f.entry_name LIKE '%" . $this->db->escape($data['filter_entry_name']) . "%'";
		}
		if (!empty($data['filter_product_id'])) {
			$implode[] = "f.product_id = '" . (int)$data['filter_product_id'] . "'";
		}		
		if (!empty($data['filter_user_id'])) {
			$implode[] = "f.user_id = '" . (int)$data['filter_user_id'] . "'";
		}	

		if (!empty($data['filter_is_clickbank'])) {
			$implode[] = "f.is_clickbank = '" . (int)$data['filter_is_clickbank'] . "'";
		}

	    if (isset($data['filter_page_status']) && !is_null($data['filter_page_status'])) {
			$implode[] = "f.page_status = '" . (int)$data['filter_page_status'] . "'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "f.status = '" . (int)$data['filter_status'] . "'";
		}	
        if (isset($data['filter_fans']) ) {
            $implode[] = "f.fans = '" . (int)$data['filter_fans'] . "'";
        }
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sort_data = array(
			'f.status',
			'f.entry_name',
			'f.entry_sn',
			'f.fans',
			'posts',
		    'nposts',
			'f.post_level',
			'f.is_clickbank'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY f.date_added";	
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
	
	public function getTotalEntries($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "fbpage_entry f WHERE 1 ";
		$implode = array();
		if(!in_array($this->user->getId(), array_merge($this->config->get("sns_group_admin"),$this->config->get("sns_group_promotion")))){
			//$implode[] = "f.user_id = '" . (int)$this->user->getId() . "' OR f.artist_id = '" . (int)$this->user->getId() . "' ";
		}
		if (!empty($data['filter_entry_sn'])) {
			$implode[] = "f.entry_sn Like '" . (int)$data['filter_entry_sn'] . "%'";
		}
		if (!empty($data['filter_entry_name'])) {
			$implode[] = "f.entry_name LIKE '%" . $this->db->escape($data['filter_entry_name']) . "%'";
		}

		if (!empty($data['filter_product_id'])) {
			$implode[] = "f.product_id = '" . (int)$data['filter_product_id'] . "'";
		}		
		if (!empty($data['filter_user_id'])) {
			$implode[] = "f.user_id = '" . (int)$data['filter_user_id'] . "'";
		}	

		if (!empty($data['filter_is_clickbank'])) {
			$implode[] = "f.is_clickbank = '" . (int)$data['filter_is_clickbank'] . "'";
		}
		if (isset($data['filter_page_status']) && !is_null($data['filter_page_status'])) {
			$implode[] = "f.page_status = '" . (int)$data['filter_page_status'] . "'";
		}		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "f.status = '" . (int)$data['filter_status'] . "'";
		}
        if (isset($data['filter_fans']) ) {
            $implode[] = "f.fans = '" . (int)$data['filter_fans'] . "'";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getPageFansHistory($entry_sn,$data= array()){
		if(empty($entry_sn)){
			return false;
		}
		$result = array();
		$where = '';
		if(!empty($data['dateStart'])){
			$where.=" AND DATE(count_date) >= DATE('".$this->db->escape($data['dateStart'])."') ";
		}
		if(!empty($data['dateEnd'])){
			$where.=" AND DATE(count_date) <= DATE('".$this->db->escape($data['dateEnd'])."') ";
		}
		$sql="SELECT * FROM ".DB_PREFIX."fbpage_entry_fans WHERE entry_sn = '".$this->db->escape($entry_sn)."' ".$where." ORDER BY count_date";
		$query=$this->db->query($sql);

		if($query->num_rows){
			foreach ($query->rows as $row) {
				$result[] = array('fans'=>$row['fans_quantity'],'date'=>date('Y-m-d',strtotime($row['count_date'])));
			}
		}
		return $result;
	}

	public function getDayFans($entry_sn,$date_day=''){
		$where = !empty($date_day) ? "AND DATE(count_date) = DATE('".$this->db->escape($date_day)."')" : "";
		$query = $this->db->query("SELECT * FROM ".DB_PREFIX."fbpage_entry_fans WHERE entry_sn = '".$this->db->escape($entry_sn)."' ".$where." ORDER BY count_date DESC");
		if($query->num_rows){
			return $query->row;
		}
		return false;
	}

	public function getEntryBySN($entry_sn){
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbpage_entry  WHERE entry_sn = '" . $this->db->escape($entry_sn) . "'");
		
	    if($query->num_rows){
			return $query->row;
		}
		return false;
	}
	public function get_all_page_status(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbpage_entry  WHERE 1 ");
		return $query->rows;
	
	}
	public function getPageStatusNameByID($id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbpage_status  WHERE status_id='{$id}' ");
		return $query->row['name'];
	}

	public function do_page_fans(){
        $_request_ = $error = array();
        $query = $this->db->query("SELECT entry_sn,page_url FROM ".DB_PREFIX."fbpage_entry WHERE page_status = '1' ");
        if($query->num_rows){
            foreach ($query->rows as $row) {
                if(!empty($row['page_url'])){
                    $api_url = 'http://api.facebook.com/restserver.php?method=links.getStats&urls='.urlencode($row['page_url']).'&format=json&_='.time();
                    $result = page_curl($api_url);
                    if($result){
                        $data = json_decode($result,true);
                        if(is_array($data)){
                            $_request_[] = array(
                                'fans' => isset($data[0]['total_count']) ? (int)$data[0]['total_count'] : 0,
                                'entry_sn' => $row['entry_sn']
                            );
                        }else{
                            $error[] = array(
                                'entry_sn' => $row['entry_sn'],
                                'page_url' => $row['page_url'],
                                'api_url' => $api_url
                            );
                        }
                    }else{
                        $error[] = array(
                            'entry_sn' => $row['entry_sn'],
                            'page_url' => $row['page_url'],
                            'api_url' => $api_url
                        );
                    }
                }
            }
            $n = 0;
            if($_request_){
                
                foreach ($_request_ as $item) {
                    if(isset($item['entry_sn'])){
                    	$today = date('Y-m-d');
                		$this->db->query("DELETE FROM ".DB_PREFIX."fbpage_entry_fans WHERE count_date = '".$this->db->escape($today)."' AND entry_sn = '".$this->db->escape($item['entry_sn'])."'");
                        $page_field = $log_field = array();
                        $page_field[] = " `fans` = '".$item['fans']."'";
                        //$page_field[] = " `_page_id` = '".$item['page_id']."'";
                        $this->db->query("UPDATE ".DB_PREFIX."fbpage SET ".implode(" , ", $page_field)." WHERE entry_sn='".$this->db->escape($item['entry_sn'])."'");
                        $log_field[] = " `fans_quantity` = '".$item['fans']."'";
                        $log_field[] = " `entry_sn` = '".$item['entry_sn']."'";
                        $log_field[] = " `count_date` = '".$this->db->escape($today)."'";
                        $this->db->query("INSERT INTO ".DB_PREFIX."fbpage_entry_fans SET ".implode(" , ", $log_field));
                        $n++;
                    }
                }
            }
            return array('status'=>1,'success'=>$n,'error'=>$error);
        }
        return false;
    }

    public function getUserIdByName($name){
    	$sql="SELECT user_id FROM ".DB_PREFIX."user WHERE username='".$this->db->escape(trim($name))."'";
    	$result=$this->db->query($sql);
    	return $result->row['user_id'];
    	
    }
    
    public function addPage($entry_sn,$entry_name,$page_url,$user_id,$product_id){
    	$sql="INSERT INTO ".DB_PREFIX."fbpage_entry SET entry_sn='".$entry_sn."' ,entry_name='".$this->db->escape($entry_name)."' ,page_url='".$this->db->escape($page_url)."' ,user_id='".$user_id."' ,product_id='".$product_id."'";
    	$this->db->query($sql);
    }

    public function postContribute($data){
    	$now = date('Y-m-d H:i:s');
    	$post_type = 3;
    	$config_status = $this->config->get("fbpage_initial_status");
    	$config_publish = $this->config->get("fbpage_initial_publish");
		$fields = array(
			'entry_sn'		=> $data['entry_sn'],
            'product_id'	=> $data['product_id'],
            'expired'		=> $data['expired'],
            'content'		=> $data['content'],
            'target_url'	=> $data['target_url'],
            'is_clickbank'	=> $data['is_clickbank'],
            'note'			=> $data['note'],
            'status'		=> $config_status,
            'publish'		=> $config_publish,
            'author_id'		=> $this->user->getAuthorId(),
            'submited_times'=> 1,
            'submited_date'	=> $now,
            'date_modified'	=> $now
		);
		$contribute_id = $this->db->insert("fbpage_nophoto_post", $fields);
		$balance_history = array(
	  		'contribute_id' => $contribute_id,
	  		'post_type' 	=> $post_type,
	  		'user_id' 		=> $this->user->getId(), 
	  		'date_added' 	=> date('Y-m-d H:i:s')
	  	);
  		$this->db->insert("sns_balance",$balance_history);
  		$edit_history = array(
	  		'contribute_id' => $contribute_id,
	  		'type' 			=> 'edit',
	  		'value' 		=> $config_status, 
	  		'user_id' 		=> $this->user->getId(),
	  		'date_added' 	=> date('Y-m-d H:i:s')
	  	);
  		$this->db->insert("fbpage_nophoto_post_history",$edit_history);
  		$post_history = array(
	  		'contribute_id' => $contribute_id,
	  		'type' 			=> 'post',
	  		'value' 		=> $config_publish, 
	  		'user_id' 		=> $this->user->getId(),
	  		'date_added' 	=> date('Y-m-d H:i:s')
	  	);
  		$this->db->insert("fbpage_nophoto_post_history",$post_history);
  		return $contribute_id;

	}
}