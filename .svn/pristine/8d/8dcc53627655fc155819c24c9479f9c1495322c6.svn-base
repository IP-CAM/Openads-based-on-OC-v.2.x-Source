<?php 
class ModelFbpageNophotoStatus extends Model {
	public function addStatus($data) {
		foreach ($data['status'] as $language_id => $value) {
			if (isset($status_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "fbpage_nophoto_status SET status_id = '" . (int)$status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "fbpage_nophoto_status SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
				
				$status_id = $this->db->getLastId();
			}
		}
		
	}

	public function editStatus($status_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "fbpage_nophoto_status WHERE status_id = '" . (int)$status_id . "'");
		foreach ($data['status'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "fbpage_nophoto_status SET  language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', status_id = '" . (int)$status_id . "' ");
		}
				
	}
	
	public function deleteStatus($status_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "fbpage_nophoto_status WHERE status_id = '" . (int)$status_id . "'");
	
	}
	public function getStatusIdByName($name){
		$query = $this->db->query("SELECT status_id FROM " . DB_PREFIX . "fbpage_nophoto_status WHERE  language_id = '" . (int)$this->config->get('config_language_id') . "' AND LOWER(name) = '".$this->db->escape(strtolower($name))."'");
		
		return $query->row['status_id'];
	}		
	public function getStatus($status_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbpage_nophoto_status WHERE status_id = '" . (int)$status_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row;
	}
		
	public function getStatuses() {
		$sql = "SELECT * FROM " . DB_PREFIX . "fbpage_nophoto_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY status_id";	
		
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
	
	public function getStatusDescriptions($status_id) {
		$status_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbpage_nophoto_status WHERE status_id = '" . (int)$status_id . "'");
		
		foreach ($query->rows as $result) {
			$status_data[$result['language_id']] = array('name' => $result['name']);
		}
		
		return $status_data;
	}
	
	public function getTotalStatuses() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "fbpage_nophoto_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row['total'];
	}	
	

}