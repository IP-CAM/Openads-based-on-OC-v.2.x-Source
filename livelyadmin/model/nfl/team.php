<?php
class ModelNflTeam extends Model {
	public function addTeam($data) {
		$fields = array(
			'team_sn' 	=> $data['team_sn'],
			'name_en' 	=> $data['name_en'],
			'name_cn' 	=> $data['name_cn'],
			
			'flag' 		=> isset($data['flag']) ? htmlspecialchars_decode($data['flag']): '',
			'short'		=> $data['short'],
			'nickname'	=> $data['nickname'],
			'partition' => $data['partition'],
			'trainer' 	=> $data['trainer'],
			'status' 	=> (int)$data['status'],
			'sort' 		=> (int)$data['sort'],
		);
		$team_id = $this->db->insert("nfl_team",$fields);
		
		$this->cache->delete('nfl_team');
		
		return $team_id;
	}

	public function editTeam($team_id, $data) {
		
		$fields = array(
			'team_sn' 	=> $data['team_sn'],
			'name_en' 	=> $data['name_en'],
			'name_cn' 	=> $data['name_cn'],
			
			'flag' 		=> isset($data['flag']) ? htmlspecialchars_decode($data['flag']): '',
			'desc' 		=> $data['desc'],
			'short'		=> $data['short'],
			'nickname'	=> $data['nickname'],
			'partition' => $data['partition'],
			'trainer' 	=> $data['trainer'],
			'status' 	=> (int)$data['status'],
			'sort' 		=> (int)$data['sort'],
		);	
		$this->db->update("nfl_team",array('team_id'=>$team_id),$fields);	
		$this->cache->delete('nfl_team');
	}
	
	public function deleteTeam($team_id) {
		$this->db->delete("nfl_team",array('team_id' => (int)$team_id));
		
		$this->cache->delete('nfl_team');		
	}
	
	public function getTeam($team_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "nfl_team WHERE team_id = '" . (int)$team_id . "'");

		return $query->row;
	}

	public function getTeams($data = array()) {

		$sql = "SELECT nt.* FROM " . DB_PREFIX . "nfl_team nt WHERE 1 ";

		if(isset($data['filter_keyword'])){
			$sql .= " AND CONCAT(team_sn,' ',name_en,' ',name_cn) LIKE '%".$this->db->escape($data['filter_keyword'])."%' ";
		}
		if(isset($data['filter_status'])){
			$sql .= " AND status = '".(int)$data['filter_status']."' ";
		}
		$sort_data = array(
			'nt.name_en',
			'nt.team_sn',
			'nt.sort',
			'nt.partition',
			'nt.nickname',
			'nt.short',
			'nt.status',
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY sort,team_sn";	
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

	public function getTotalTeams() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "nfl_team");
		
		return $query->row['total'];
	}

	public function getTeamIdByName($name){
		$query = $this->db->query("SELECT team_id FROM " . DB_PREFIX . "nfl_team WHERE LOWER(name_en) LIKE '%".strtolower(trim($name))."%' ");
		
		return $query->row['team_id'];
	}
}