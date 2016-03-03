<?php
class ModelCatalogNews extends Model {		
		
	public function getNews($start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}
		
		if ($limit < 1) {
			$limit = 20;
		}		
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news WHERE status = '1' ORDER BY sort_order DESC,date_added DESC LIMIT " . (int)$start . "," . (int)$limit);
			
		return $query->rows;
	}

	public function getTotalNews() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news n WHERE n.status = '1'");
		
		return $query->row['total'];
	}
}