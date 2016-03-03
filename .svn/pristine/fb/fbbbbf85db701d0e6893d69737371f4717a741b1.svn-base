<?php
class ModelCatalogNews extends Model {
	public function addNews($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "news SET title = '".$this->db->escape($data['title'])."',text = '".$this->db->escape($data['text'])."', sort_order = '" . (int)$data['sort_order'] . "', is_top = '" . (isset($data['is_top']) ? (int)$data['is_top'] : 0) . "', status = '" . (int)$data['status'] . "',date_added = '".$this->db->escape($data['date_added'])."',user_id = '".$this->user->getId()."'");

		$news_id = $this->db->getLastId();

		return $news_id;
	}

	public function editNews($news_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "news SET title = '".$this->db->escape($data['title'])."',text = '".$this->db->escape($data['text'])."',sort_order = '" . (int)$data['sort_order'] . "', is_top = '" . (isset($data['is_top']) ? (int)$data['is_top'] : 0) . "', status = '" . (int)$data['status'] . "',date_added = '".$this->db->escape($data['date_added'])."',user_id = '".$this->user->getId()."'");
	}

	public function deleteNews($news_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "news WHERE news_id = '" . (int)$news_id . "'");
	}

	public function getNews($news_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "news n WHERE n.news_id = '" . (int)$news_id . "'");

		return $query->row;
	}

	public function getNewses($data = array()) {
		$sql = "SELECT n.*,CONCAT(u.lastname,u.firstname) replier FROM " . DB_PREFIX . "news n LEFT JOIN ".DB_PREFIX."user u ON u.user_id = n.user_id ";

		$sort_data = array(
			'n.title',
			'n.is_top',
			'n.sort_order',
			'n.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY n.date_added";
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

	public function getTotalNewses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news");

		return $query->row['total'];
	}

}