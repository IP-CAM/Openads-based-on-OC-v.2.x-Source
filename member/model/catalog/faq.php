<?php
class ModelCatalogFaq extends Model {		
	
	public function getTotalFaq() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "faq WHERE status = '1'");
		
		return $query->row['total'];
	}
	
	public function getFaq($start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}
		
		if ($limit < 1) {
			$limit = 10;
		}		
		$sql = "SELECT * FROM " . DB_PREFIX . "faq WHERE status = '1' ORDER BY is_top DESC ,sort_order ASC,date_added DESC LIMIT " . (int)$start . "," . (int)$limit;
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getItem($faq_id) {
	
		$sql = "SELECT * FROM " . DB_PREFIX . "faq WHERE status = '1' AND faq_id = '".(int)$faq_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getTop5Faq() {
		
		$sql = "SELECT * FROM " . DB_PREFIX . "faq WHERE status = '1' AND is_top = '1' ORDER BY is_top DESC ,sort_order ASC,date_added DESC LIMIT 5";
		$query = $this->db->query($sql);
		return $query->rows;
	}

}