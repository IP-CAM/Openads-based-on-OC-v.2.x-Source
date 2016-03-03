<?php
class ModelNflStatus extends Model {
	public function addStatus($data) {
		foreach ($data['status'] as $language_id => $value) {
			if (isset($status_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "nfl_status SET status_id = '" . (int)$status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "nfl_status SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$status_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('nfl_status');
	}

	public function editStatus($status_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "nfl_status WHERE status_id = '" . (int)$status_id . "'");

		foreach ($data['status'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "nfl_status SET status_id = '" . (int)$status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('nfl_status');
	}

	public function deleteStatus($status_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "nfl_status WHERE status_id = '" . (int)$status_id . "'");

		$this->cache->delete('nfl_status');
	}

	public function getStatus($status_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nfl_status WHERE status_id = '" . (int)$status_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getStatuses($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "nfl_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

			$sql .= " ORDER BY status_id";

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
		} else {
			$nfl_status_data = $this->cache->get('nfl_status.' . (int)$this->config->get('config_language_id'));

			if (!$nfl_status_data) {
				$query = $this->db->query("SELECT status_id, name FROM " . DB_PREFIX . "nfl_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY status_id");

				$nfl_status_data = $query->rows;

				$this->cache->set('nfl_status.' . (int)$this->config->get('config_language_id'), $nfl_status_data);
			}

			return $nfl_status_data;
		}
	}

	public function getStatusDescriptions($status_id) {
		$nfl_status_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nfl_status WHERE status_id = '" . (int)$status_id . "'");

		foreach ($query->rows as $result) {
			$nfl_status_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $nfl_status_data;
	}

	public function getTotalStatuses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "nfl_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}