<?php
class ModelToolCronLog extends Model {

	public function truncate(){
		return $this->db->query('TRUNCATE '.DB_PREFIX.'cron_log');
	}

	public function deleteLog($log_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "cron_log` WHERE id = '" . (int)$log_id . "'");
	}


	public function getLogs($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "cron_log` WHERE 1 ";


		if (!empty($data['filter_log_time_start'])) {
			$sql .= " AND added_date >= '" . $this->db->escape($data['filter_log_time_start']) . "'";
		}

		if (!empty($data['filter_contribute_id'])) {
			$sql .= " AND contribute_id >= '" . (int)$data['filter_contribute_id'] . "'";
		}

		if (!empty($data['filter_log_time_end'])) {
			$sql .= " AND added_date <= '" . $this->db->escape($data['filter_log_time_end']) . "'";
		}
		if (!empty($data['filter_action'])) {
			$sql .= " AND action LIKE '" . $this->db->escape($data['filter_action']) . "%'";
		}
			
		$sort_data = array(
			'id',
			'action',
			'contribute_id',
			'added_date'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY id";
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

	public function getTotalLogs($data= array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "cron_log` WHERE 1 ";


		if (!empty($data['filter_log_time_start'])) {
			$sql .= " AND added_date >= '" . $this->db->escape($data['filter_log_time_start']) . "'";
		}

		if (!empty($data['filter_contribute_id'])) {
			$sql .= " AND contribute_id >= '" . (int)$data['filter_contribute_id'] . "'";
		}
		if (!empty($data['filter_log_time_end'])) {
			$sql .= " AND added_date <= '" . $this->db->escape($data['filter_log_time_end']) . "'";
		}
		if (!empty($data['filter_action'])) {
			$sql .= " AND action LIKE '" . $this->db->escape($data['filter_action']) . "%'";
		}


		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function copyTargetingTemplate(){
		$query = $this->db->query("SELECT at.*,w.product_id as product_id FROM ".DB_PREFIX."advertise_targeting at LEFT JOIN ".DB_PREFIX."website w ON w.website_id = at.website_id WHERE 1");
		if ($query->num_rows){
			$templateId="";
			foreach ($query->rows as $data){
				$tmp = array(
					'targeting_sn'	=> isset($data['targeting_sn']) ? trim($data['targeting_sn']) : '',
					'targeting_name'=> isset($data['targeting_name']) ? trim($data['targeting_name']) : '',
					'product_id' 	=> $data['product_id'],
					'customer_id' 	=> $data['customer_id'],
					'location'		=> isset($data['location']) ? $this->db->escape($data['location']) : '',
					'other_location'=> isset($data['other_location']) ? $this->db->escape($data['other_location']) : '',
					'gender'		=> isset($data['gender']) ? (int)$data['gender'] : '',
					'age_min'		=> isset($data['age_min']) ? (int)$data['age_min'] : 18,
					'age_max'		=> isset($data['age_max']) ? (int)$data['age_max'] : 65,
					'language'		=> isset($data['language']) ? $this->db->escape($data['language']) :'',
					'other_language'=> isset($data['other_language']) ? $this->db->escape($data['other_language']) :'',
					'interest'		=> isset($data['interest']) ? $this->db->escape($data['interest']) :'',
					'behavior'		=> isset($data['behavior']) ? $this->db->escape($data['behavior']) :'',
					'more'			=> isset($data['more']) ? $this->db->escape($data['more']) :'',
					'note'			=> isset($data['note']) ? $this->db->escape($data['note']) : '',
				    'audience'	   	=> isset($data['audience']) ? (int)($data['audience']) : '', 
				    'user_id'   	=> 0,
				    'date_added'	=> date('Y-m-d H:i:s')
						);
				$templateId= $this->db->insert('advertise_targeting_template',$tmp);
				$component = array(
					'template_id'=>$templateId,			
				);
				$this->db->update('advertise_targeting',array('targeting_id'=>$data['targeting_id']),$component);
			}
		}
		
	}

}