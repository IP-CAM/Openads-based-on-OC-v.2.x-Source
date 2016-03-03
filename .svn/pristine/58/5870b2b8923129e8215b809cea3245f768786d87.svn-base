<?php
class ModelSnsGroup extends Model {
	public function addGroup($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "sns_group SET name = '".$this->db->escape($data['name'])."', status = '".(int)$data['status']."',`users` = '" . $this->db->escape(serialize($data['users'])) . "', user_id = '" . (int)$this->user->getId() . "',date_added = NOW()");
		
	}
	
	public function editGroup($group_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "sns_group SET  `name` = '" . $this->db->escape($data['name']) . "', status = '".(int)$data['status']."',`users` = '" . $this->db->escape(serialize($data['users'])) . "',user_id = '" . (int)$this->user->getId() . "',date_added = NOW() WHERE group_id = '".(int)$group_id."'");
	}
	
	public function getGroup($group_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sns_group  WHERE  group_id = '" . (int)$group_id . "'");
		if(isset($query->row['users'])){
			$query->row['users'] = unserialize($query->row['users']);
		}
		return $query->row;
	}

	public function getGroups($data = array()) {
		$sql = "SELECT sg.*,u.username,u.nickname FROM " . DB_PREFIX . "sns_group sg LEFT JOIN ".DB_PREFIX."user u ON sg.user_id = u.user_id WHERE 1 " ;																																					  
		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "sg.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (isset($data['filter_status'])) {
			$implode[] = "sg.status = '" . (int)$data['filter_status'] . "'";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sort_data = array(
			'sg.name',
			'sg.user_id',
			'sg.date_added',
			'sg.status'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY sg.group_id";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
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
	
	public function getTotalGroups($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sns_group sg WHERE 1 ";
		$implode = array();
		if (!empty($data['filter_name'])) {
			$implode[] = "sg.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (isset($data['filter_status'])) {
			$implode[] = "sg.status = '" . (int)$data['filter_status'] . "'";
		}
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	
}