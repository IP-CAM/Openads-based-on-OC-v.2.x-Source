<?php
class ModelFbaccountEntry extends Model {
	public function addEntry($data) {
		if(is_array($data)){

			$fields = array(
				'entry_sn'	=> $data['entry_sn'],
				'entry_name'=> $data['entry_name'],
				'user_id'	=> $data['user_id'],
				'artist_id'	=> $data['artist_id'],
				'alias'		=> isset($data['alias']) ? $data['alias'] : '',
				'product_id'=> $data['product_id'],
				'status'	=> $data['status'],
				'entry_url' => $data['entry_url'],
				'is_clickbank' => isset($data['is_clickbank']) ? $data['is_clickbank'] : 0,
				'cb_link'	=> htmlspecialchars_decode($data['cb_link']),
				'note'		=> htmlspecialchars_decode($data['note']),
				'date_added'=> date('Y-m-d H:i:s'),
				'post_level'=> $data['post_level'],
				'maintain_level'=> $data['maintain_level']
			);
			
			return $this->db->insert("fbaccount_entry", $fields);
		}
	}

	
	public function editEntry($entry_id, $data) {
		if(is_array($data)){
			$fields = array(
				'entry_sn'	=> $data['entry_sn'],
				'entry_name'	=> $data['entry_name'],
				'user_id'	=> $data['user_id'],
				'artist_id'	=> $data['artist_id'],
				'alias'		=> isset($data['alias']) ? $data['alias'] : '',
				'product_id'=> $data['product_id'],
				'status'	=> $data['status'],
				'entry_url' => $data['entry_url'],
				'is_clickbank' => isset($data['is_clickbank']) ? $data['is_clickbank'] : 0,
				'cb_link'	=> htmlspecialchars_decode($data['cb_link']),
				'note'		=> htmlspecialchars_decode($data['note']),
				'date_added'=> date('Y-m-d H:i:s'),
				'post_level'=> $data['post_level'],
				'maintain_level'=> $data['maintain_level']
			);
			
			$this->db->update("fbaccount_entry",array('entry_id'=> (int)$entry_id), $fields);

			$entry = $this->getEntry($entry_id);
			if(isset($entry['entry_sn']) && (isset($data['user_id']) || isset($data['group_id']))){
				$fields = array();
				if(isset($data['user_id'])){
					$fields['user_id'] = " `user_id` = '".(int)$data['user_id']."'";
				}
				$this->db->update("fbaccount_nophoto_post",array('entry_sn'=>$entry['entry_sn']), $fields);		
				if(isset($data['artist_id'])){
					$fields['artist_id'] = " `artist_id` = '".(int)$data['artist_id']."'";
				}
				$this->db->update("fbaccount_photo_post",array('entry_sn'=>$entry['entry_sn']), $fields);		
			}
		}else{
			return false;
		}
	}
	
	
	public function getEntry($entry_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbaccount_entry  WHERE entry_id = '" . (int)$entry_id . "'");
		return $query->row;
	}

	public function getEntries($data = array()) {
		$sql = "SELECT f.*, (SELECT COUNT(*) FROM " . DB_PREFIX . "fbaccount_photo_post ap WHERE ap.entry_sn = f.entry_sn ) AS p_posts,
		        (SELECT COUNT(*) FROM " . DB_PREFIX . "fbaccount_nophoto_post an WHERE an.entry_sn = f.entry_sn ) AS s_posts,
		        (SELECT COUNT(*) FROM " . DB_PREFIX . "fbmessage_nophoto_post mp WHERE mp.entry_sn = f.entry_sn ) AS m_posts
				 FROM " . DB_PREFIX . "fbaccount_entry f  WHERE 1 " ;																																					  
		$implode = array();
		if(!in_array($this->user->getId(), $this->config->get("sns_group_promotion"))){
			$implode[] = " f.status = '1' ";
		}
		if (!empty($data['filter_entry_sn'])) {
			$implode[] = "f.entry_sn LIKE '" . (int)$data['filter_entry_sn'] . "%'";
		}
		if (!empty($data['filter_entry_name'])) {
			$implode[] = "f.entry_name LIKE '%" . $this->db->escape($data['filter_entry_name']) . "%'";
		}

		if (!empty($data['filter_entry'])) {
			$implode[] = "CONCAT(f.entry_sn,' ',f.entry_name) LIKE '%" . $this->db->escape($data['filter_entry']) . "%'";
		}
		
		if (!empty($data['filter_product_id'])) {
			$implode[] = "f.product_id = '" . (int)$data['filter_product_id'] . "'";
		}		
		if (!empty($data['filter_user_id'])) {
			$implode[] = "f.user_id = '" . (int)$data['filter_user_id'] . "'";
		}	
	
	    if (!empty($data['filter_artist_id'])) {
			$implode[] = "f.artist_id = '" . (int)$data['filter_artist_id'] . "'";
		}
		
		if (isset($data['filter_is_clickbank']) && !is_null($data['filter_is_clickbank'])) {
			$implode[] = "f.is_clickbank = '" . (int)$data['filter_is_clickbank'] . "'";
		}	
				
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "f.status = '" . (int)$data['filter_status'] . "'";
		}	
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sort_data = array(
			'f.status',
			'f.product_id',
			'f.entry_name',
			'f.entry_sn',
			'f.fans',
			'posts',
		    's_posts',
		    'p_posts',
		    'm_posts',
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
		$sql .= " ,f.entry_id DESC ";
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
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "fbaccount_entry f WHERE 1 ";
		$implode = array();
		if(!in_array($this->user->getId(), $this->config->get("sns_group_admin"))){
			/*
			$implode[] = " (f.group_id IN (" . implode(" , ", $this->user->getAuditorGroups(true)) . ") OR f.artist_id = '" . (int)$this->user->getId() . "' )";
			*/
			$implode[] = " f.status = '1' ";
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

		if (!empty($data['filter_artist_id'])) {
			$implode[] = "f.artist_id = '" . (int)$data['filter_artist_id'] . "'";
		}		
		if (isset($data['filter_is_clickbank']) && !is_null($data['filter_is_clickbank'])) {
			$implode[] = "f.is_clickbank = '" . (int)$data['filter_is_clickbank'] . "'";
		}	
				
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "f.status = '" . (int)$data['filter_status'] . "'";
		}	
				
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getEntryBySN($entry_sn){
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbaccount_entry WHERE entry_sn = '" . $this->db->escape($entry_sn) . "'");
	    if($query->num_rows){
			return $query->row;
		}
		return false;
	}
	public function getContributedNum($entry_sn,$mode='nophoto'){
		switch (strtolower($mode)) {
			case 'nophoto':
				$table = 'fbaccount_nophoto_post';
				break;
			case 'photo':
				$table = 'fbaccount_photo_post';
				break;
			case 'message':
				$table = 'fbmessage_nophoto_post';
				break;
		}
		$query = $this->db->query("SELECT COUNT(*) total FROM ".DB_PREFIX.$table." WHERE `entry_sn` = '".$entry_sn."' AND `status` = '1' AND `author_id` = '".(int)$this->user->getAuthorId()."' ");
		return $query->row['total'];
	}

	public function postContribute($data){
		if(!isset($data['mode'])){
			return false;
		}

		$now = date('Y-m-d H:i:s');
		switch (strtolower($data['mode'])) {
			case 'nophoto':
				$table = 'fbaccount_nophoto_post';
				$history_table = 'fbaccount_nophoto_post_history';
				$config_status = $this->config->get("fbaccount_initial_status");
				$config_publish = $this->config->get("fbaccount_initial_publish");
				$post_type = 2;
				$letter = 'S';
				break;
			case 'photo':
				$table = 'fbaccount_photo_post';
				$history_table = 'fbaccount_photo_post_history';
				$config_status = $this->config->get("fbaccount_photo_initial_status");
				$config_publish = $this->config->get("fbaccount_photo_initial_publish");
				$post_type = 1;
				$letter = 'P';
				break;
			case 'message':
				$table = 'fbmessage_nophoto_post';
				$history_table = 'fbmessage_nophoto_post_history';
				$config_status = $this->config->get("fbmessage_initial_status");
				$config_publish = $this->config->get("fbmessage_initial_publish");
				$post_type = 5;
				$letter = 'M';
				break;
		}
		$auto_num = $this->getAutoNum($data['product_id'],$data['gender_id'],$data['country_id'],$data['mode']);
		$contribute_sn = $data['precode'].zeroFull($auto_num,3);	
		$fields = array(
			'entry_sn'		=> $data['entry_sn'],
            'precode'   	=> $data['precode'].$letter,
            'product_id'	=> $data['product_id'],
            'gender_id'		=> $data['gender_id'],
            'country_id'	=> $data['country_id'],
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
            'date_modified'	=> $now,
            'auto_num'		=> $auto_num,
            'contribute_sn'	=> $contribute_sn,
		);
		if($data['mode']=='photo'){
			$fields['upload_files']	= $data['upload_files'];
		}
	  	$contribute_id = $this->db->insert($table, $fields);
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
  		$this->db->insert($history_table,$edit_history);
  		$post_history = array(
	  		'contribute_id' => $contribute_id,
	  		'type' 			=> 'post',
	  		'value' 		=> $config_publish, 
	  		'user_id' 		=> $this->user->getId(),
	  		'date_added' 	=> date('Y-m-d H:i:s')
	  	);
  		$this->db->insert($history_table,$post_history);
  		return $contribute_id;
	}

	public function getAutoNum($product_id,$gender_id,$country_id,$mode='nophoto'){
		if(!isset($product_id) || !isset($gender_id) || !isset($country_id)){ return false;}
		switch (strtolower($mode)) {
			case 'nophoto':
				$table = 'fbaccount_nophoto_post';
				break;
			case 'photo':
				$table = 'fbaccount_photo_post';
				break;
			case 'message':
				$table = 'fbmessage_nophoto_post';
				break;
		}
		$where = array(
			" `product_id` = '".(int)$product_id."' ",
			" `gender_id` = '".(int)$gender_id."' ",
			" `country_id` = '".(int)$country_id."' ",
			" `author_id` = '".(int)$this->user->getAuthorId()."' "
		);

		$query=$this->db->query("SELECT MAX(auto_num) as max FROM ".DB_PREFIX.$table." WHERE ".implode(" AND ", $where));
		$newValue = (int)($query->row['max']+1);
		return $newValue;
	}
	
}