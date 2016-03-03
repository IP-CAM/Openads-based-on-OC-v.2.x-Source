<?php 
class ModelFbpageNophotoPublish extends Model {
	public function addPublish($data) {
		foreach ($data['publish'] as $language_id => $value) {
			if (isset($publish_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "fbpage_nophoto_publish SET publish_id = '" . (int)$publish_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "fbpage_nophoto_publish SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
				
				$publish_id = $this->db->getLastId();
			}
		}
		
	}

	public function editPublish($publish_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "fbpage_nophoto_publish WHERE publish_id = '" . (int)$publish_id . "'");

		foreach ($data['contribute_publish'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "fbpage_nophoto_publish SET publish_id = '" . (int)$publish_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
				
	}
	
	public function deletePublish($publish_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "fbpage_nophoto_publish WHERE publish_id = '" . (int)$publish_id . "'");
	
	}
		
	public function getPublish($publish_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbpage_nophoto_publish WHERE publish_id = '" . (int)$publish_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row;
	}
		
	public function getPublishes() {

		$sql = "SELECT * FROM " . DB_PREFIX . "fbpage_nophoto_publish WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY publish_id";	
		
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
	
	public function getPublishDescriptions($publish_id) {
		$status_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fbpage_nophoto_publish WHERE publish_id = '" . (int)$publish_id . "'");
		
		foreach ($query->rows as $result) {
			$status_data[$result['language_id']] = array('name' => $result['name']);
		}
		
		return $status_data;
	}
	
	public function getTotalPublishes() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "fbpage_nophoto_publish WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row['total'];
	}	
	

}