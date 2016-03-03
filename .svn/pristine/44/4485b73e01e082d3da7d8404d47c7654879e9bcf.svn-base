<?php
class ModelCatalogFaq extends Model {
	public function addFaq($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "faq SET title = '".$this->db->escape($data['title'])."',text = '".$this->db->escape($data['text'])."', sort_order = '" . (int)$data['sort_order'] . "', is_top = '" . (isset($data['is_top']) ? (int)$data['is_top'] : 0) . "', status = '" . (int)$data['status'] . "',date_added = '".$this->db->escape($data['date_added'])."',user_id = '".$this->user->getId()."'");

		$faq_id = $this->db->getLastId();

		return $faq_id;
	}

	public function editFaq($faq_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "faq SET title = '".$this->db->escape($data['title'])."',text = '".$this->db->escape($data['text'])."', sort_order = '" . (int)$data['sort_order'] . "', is_top = '" . (isset($data['is_top']) ? (int)$data['is_top'] : 0) . "', status = '" . (int)$data['status'] . "',date_added = '".$this->db->escape($data['date_added'])."',user_id = '".$this->user->getId()."' WHERE faq_id = '".$faq_id."'");
	}

	public function deleteFaq($faq_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq WHERE faq_id = '" . (int)$faq_id . "'");
	}

	public function getFaq($faq_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "faq f WHERE f.faq_id = '" . (int)$faq_id . "'");

		return $query->row;
	}

	public function getFaqs($data = array()) {
		$sql = "SELECT f.*,CONCAT(u.lastname,u.firstname) replier FROM " . DB_PREFIX . "faq f LEFT JOIN ".DB_PREFIX."user u ON u.user_id = f.user_id ";

		$sort_data = array(
			'f.title',
			'f.is_top',
			'f.sort_order',
			'f.date_added'
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

	public function getTotalFaqs() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "faq");

		return $query->row['total'];
	}

}