<?php
class ModelNflReport extends Model {

    public function do_statistics(){
        $sql = "SELECT nc.contribute_id, nc.contribute_sn, nc.team_id, nc.player_id, nc.author_id, nc.user_id, nc.status, pb.amount, nc.submited_date FROM `".DB_PREFIX."nfl_contribute`  nc 
        		LEFT JOIN `".DB_PREFIX."sns_balance` pb ON ( pb.`contribute_id` = nc.`contribute_id` AND pb.`post_type` =8 ) ";
        $query = $this->db->query($sql);
        $n = 0;
        if($query->num_rows){
            $this->db->query("TRUNCATE TABLE `".DB_PREFIX."nfl_temp_posts`");
            foreach ($query->rows as $row) {
                if($this->db->insert("nfl_temp_posts",$row)){
                    $n++;
                }
            }

        }

        return $n;
    }

	public function getTotalBalances($data){
		$sql = "SELECT COUNT(tp.contribute_id) FROM " . DB_PREFIX . "nfl_temp_posts tp WHERE 1";
		$implode = array();
        if (isset($data['filter_teams']) && is_array($data['filter_teams'])) {
            $implode[] = "tp.team_id IN (" . implode(",", $data['filter_teams']).")";
        }

        if (isset($data['filter_players']) && is_array($data['filter_players'])) {
            $implode[] = "tp.player_id IN (" . implode(",", $data['filter_players']).")";
        }

        if (isset($data['filter_authors'])  && is_array($data['filter_authors'])) {
            $implode[] = "tp.author_id IN (" . implode(",", $data['filter_authors']).")";
        }


        if (isset($data['filter_user_id'])) {
            $implode[] = "tp.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (isset($data['filter_statuses']) && is_array($data['filter_statuses'])) {
            $implode[] = "tp.status IN (" . implode(",", $data['filter_statuses']).")";
            
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(tp.submited_date) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(tp.submited_date) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sql .= " GROUP BY tp.team_id,tp.player_id,tp.status,tp.author_id ";

		$query = $this->db->query($sql);
		return $query->num_rows;
	}

	public function getTotalResult($data){
		$sql = "SELECT COUNT(tp.contribute_id) AS total ,SUM(tp.amount) amount FROM " . DB_PREFIX . "nfl_temp_posts tp WHERE 1";
		$implode = array();
        if (isset($data['filter_teams']) && is_array($data['filter_teams'])) {
            $implode[] = "tp.team_id IN (" . implode(",", $data['filter_teams']).")";
        }

        if (isset($data['filter_players']) && is_array($data['filter_players'])) {
            $implode[] = "tp.player_id IN (" . implode(",", $data['filter_players']).")";
        }

        if (isset($data['filter_authors'])  && is_array($data['filter_authors'])) {
            $implode[] = "tp.author_id IN (" . implode(",", $data['filter_authors']).")";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "tp.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (isset($data['filter_statuses']) && is_array($data['filter_statuses'])) {
            $implode[] = "tp.status IN (" . implode(",", $data['filter_statuses']).")";
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(tp.submited_date) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(tp.submited_date) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getBalances($data){
		$sql = "SELECT  tp.*,COUNT(tp.contribute_id) posts, SUM(tp.amount) amount FROM " . DB_PREFIX . "nfl_temp_posts tp WHERE 1";
        $implode = array();
        if (isset($data['filter_teams']) && is_array($data['filter_teams'])) {
            $implode[] = "tp.team_id IN (" . implode(",", $data['filter_teams']).")";
        }

        if (isset($data['filter_players']) && is_array($data['filter_players'])) {
            $implode[] = "tp.player_id IN (" . implode(",", $data['filter_players']).")";
        }

        if (isset($data['filter_authors'])  && is_array($data['filter_authors'])) {
            $implode[] = "tp.author_id IN (" . implode(",", $data['filter_authors']).")";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "tp.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (isset($data['filter_statuses']) && is_array($data['filter_statuses'])) {
            $implode[] = "tp.status IN (" . implode(",", $data['filter_statuses']).")";
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(tp.submited_date) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(tp.submited_date) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sql .= " GROUP BY tp.team_id,tp.player_id,tp.status,tp.author_id";
		
		$sort_data = array(
			'tp.team_id',
			'tp.player_id',
			'tp.author_id',
			'tp.user_id',
			'tp.status',
			'tp.submited_date',
			'amount',
			'posts'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY tp.submited_date";	
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

}