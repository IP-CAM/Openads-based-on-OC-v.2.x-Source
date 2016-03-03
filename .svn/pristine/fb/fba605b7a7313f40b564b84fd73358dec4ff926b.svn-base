<?php
class ModelReportReport extends Model {

    public function do_statistics(){
        $start_time = time();

        $sql = "SELECT `at`.`targeting_id` AS `entry_id`,`at`.`advertise_id` AS `advertise_id`,`at`.`customer_id` AS `customer_id`,`a1`.`product_id` AS `product_id`,'targeting' AS `mode`,`at`.`status` AS `status`,`ats`.`name` AS `status_name`,`ats`.`value` AS `status_score`,`at`.`in_charge` AS `in_charge`,`at`.`user_id` AS `user_id`,`at`.`date_added` AS `date_added`,`at`.`date_modified` AS `date_modified` 
                FROM `".DB_PREFIX."advertise_targeting` `at` 
                LEFT JOIN `".DB_PREFIX."advertise` `a1` ON `a1`.`advertise_id` = `at`.`advertise_id` 
                LEFT JOIN `".DB_PREFIX."advertise_targeting_status` `ats` ON `ats`.`status_id` = `at`.`status` 
                WHERE `at`.user_id > '0' AND `ats`.language_id = '1' 
                UNION ALL 
                SELECT `apt`.`post_id` AS `entry_id`,`apt`.`advertise_id` AS `advertise_id`,`apt`.`customer_id` AS `customer_id`,`a1`.`product_id` AS `product_id`,'post' AS `mode`,`apt`.`status` AS `status`,`apts`.`name` AS `status_name`,`apts`.`value` AS `status_score`,`apt`.`in_charge` AS `in_charge`,`apt`.`user_id` AS `user_id`,`apt`.`date_added` AS `date_added`,`apt`.`date_modified` AS `date_modified` 
                FROM `".DB_PREFIX."advertise_post` `apt` 
                LEFT JOIN `".DB_PREFIX."advertise` `a1` ON `a1`.`advertise_id` = `apt`.`advertise_id` 
                LEFT JOIN `".DB_PREFIX."advertise_post_status` `apts` ON `apts`.`status_id` = `apt`.`status` 
                WHERE `apt`.user_id > '0' AND `apts`.language_id = '1' 
                UNION ALL 
                SELECT `aph`.`photo_id` AS `entry_id`,`aph`.`advertise_id` AS `advertise_id`,`aph`.`customer_id` AS `customer_id`,`a1`.`product_id` AS `product_id`,'photo' AS `mode`,`aph`.`status` AS `status`,`aphs`.`name` AS `status_name`,`aphs`.`value` AS `status_score`,`aph`.`in_charge` AS `in_charge`,`aph`.`user_id` AS `user_id`,`aph`.`date_added` AS `date_added`,`aph`.`date_modified` AS `date_modified` 
                FROM `".DB_PREFIX."advertise_photo` `aph` 
                LEFT JOIN `".DB_PREFIX."advertise` `a1` ON `a1`.`advertise_id` = `aph`.`advertise_id` 
                LEFT JOIN `".DB_PREFIX."advertise_photo_status` `aphs` ON `aphs`.`status_id` = `aph`.`status` 
                WHERE `aph`.user_id > '0' AND `aphs`.language_id = '1'
                ";
        $query = $this->db->query($sql);
        $n = 0;
        if($query->num_rows){
            $this->db->query("TRUNCATE TABLE `".DB_PREFIX."report_statistics`");
            foreach ($query->rows as $row) {
                if(is_array($row) && $this->db->insert('report_statistics',$row)){
                    $n++;
                }
            }

        }
        $sql = "SELECT rs.*, COUNT(rs.entry_id) qty, SUM(rs.status_score) score FROM " . DB_PREFIX . "report_statistics rs LEFT JOIN ".DB_PREFIX."product p ON p.product_id = rs.product_id 
        LEFT JOIN ".DB_PREFIX."customer c ON c.customer_id = rs.customer_id LEFT JOIN ".DB_PREFIX."user u ON u.user_id = rs.user_id WHERE 1 GROUP BY rs.user_id,rs.mode ,rs.status";
        $query = $this->db->query($sql);

        if($query->num_rows){
            $this->db->query("TRUNCATE TABLE `".DB_PREFIX."report`");
            foreach ($query->rows as $row) {
                $fields = array(
                    'mode' => strtolower($row['mode']),
                    'status' => $row['status'],
                    'status_name' => $row['status_name'],
                    'status_score' => $row['status_score'],
                    'qty' => $row['qty'],
                    'score' => $row['score'],
                    'user_id' => $row['user_id'],
                    'date_modified' => $row['date_modified']
                );
                $this->db->insert('report',$fields);
            }
        }
        return 'Total: '.$n.' , In '.date('i:s',time() - $start_time).'s.';
    }

	public function getTotalBalances($data){
		$sql = "SELECT COUNT(rs.entry_id) FROM " . DB_PREFIX . "report_statistics rs WHERE 1";
		$implode = array();
        if (isset($data['filter_mode'])) {
            $implode[] = "rs.mode='" . $this->db->escape($data['filter_mode'])."'";
        }

        if (isset($data['filter_product_id'])) {
            $implode[] = "rs.product_id='" . (int)$data['filter_product_id']."'";
        }

        if (isset($data['filter_customer_id'])) {
            $implode[] = "rs.customer_id='" . (int)$data['filter_customer_id']."'";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "rs.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (isset($data['filter_status'])) {
            $implode[] = "rs.status='" . (int)$data['filter_status']."'";
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(rs.date_modified) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(rs.date_modified) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sql .= " GROUP BY rs.status,rs.mode,rs.user_id,rs.product_id ";

		$query = $this->db->query($sql);
		return $query->num_rows;
	}

	public function getTotalResult($data){
		$sql = "SELECT COUNT(rs.entry_id) AS total ,SUM(rs.status_score) score FROM " . DB_PREFIX . "report_statistics rs WHERE 1";
		$implode = array();

        if (isset($data['filter_mode'])) {
            $implode[] = "rs.mode='" . $this->db->escape($data['filter_mode'])."'";
        }

        if (isset($data['filter_product_id'])) {
            $implode[] = "rs.product_id='" . (int)$data['filter_product_id']."'";
        }

        if (isset($data['filter_customer_id'])) {
            $implode[] = "rs.customer_id='" . (int)$data['filter_customer_id']."'";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "rs.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (isset($data['filter_status'])) {
            $implode[] = "rs.status='" . (int)$data['filter_status']."'";
            
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(rs.date_modified) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(rs.date_modified) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getBalances($data){
		$sql = "SELECT rs.*, p.name product,CONCAT(c.firstname,' ',c.lastname) customer ,CONCAT(u.lastname,u.firstname) operator ,
		COUNT(rs.entry_id) qty, SUM(rs.status_score) score FROM " . DB_PREFIX . "report_statistics rs LEFT JOIN ".DB_PREFIX."product p ON p.product_id = rs.product_id 
		LEFT JOIN ".DB_PREFIX."customer c ON c.customer_id = rs.customer_id LEFT JOIN ".DB_PREFIX."user u ON u.user_id = rs.user_id WHERE 1";
		$implode = array();


        if (isset($data['filter_mode'])) {
            $implode[] = "rs.mode='" . $this->db->escape($data['filter_mode'])."'";
        }

        if (isset($data['filter_product_id'])) {
            $implode[] = "rs.product_id='" . (int)$data['filter_product_id']."'";
        }

        if (isset($data['filter_customer_id'])) {
            $implode[] = "rs.customer_id='" . (int)$data['filter_customer_id']."'";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "rs.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (isset($data['filter_status'])) {
            $implode[] = "rs.status='" . (int)$data['filter_status']."'";
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(rs.date_modified) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(rs.date_modified) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sql .= " GROUP BY rs.user_id,rs.mode ,rs.status";
		
		$sort_data = array(
			'r.mode',
			'operator',
			'r.status',
			'r.date_modified',
			'score',
			'qty'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY rs.user_id,rs.mode ,rs.status";	
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

    public function getAdReport($data){
        $sql = "SELECT r.user_id,CONCAT(u.lastname,u.firstname) operator , SUM(r.score) score,MAX(r.date_modified) max_date,MIN(r.date_modified) min_date,
        (SELECT SUM(r1.score) targeting_score FROM ".DB_PREFIX."report r1 WHERE r1.`mode` = 'targeting' AND r1.user_id = r.user_id) AS targeting_score,
        (SELECT SUM(r2.score) post_score FROM ".DB_PREFIX."report r2 WHERE r2.`mode` = 'post' AND r2.user_id = r.user_id) AS post_score,
        (SELECT SUM(r3.score) photo_score FROM ".DB_PREFIX."report r3 WHERE r3.`mode` = 'photo' AND r3.user_id = r.user_id) AS photo_score 
        FROM " . DB_PREFIX . "report r LEFT JOIN ".DB_PREFIX."user u ON u.user_id = r.user_id WHERE 1";
        $implode = array();


        if (isset($data['filter_mode'])) {
            $implode[] = "r.mode='" . $this->db->escape($data['filter_mode'])."'";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "r.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(.date_modified) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(r.date_modified) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $sql .= " GROUP BY r.user_id ";
        
        $sort_data = array(
            'targeting_score',
            'operator',
            'post_score',
            'photo_score',
            'score',
        );  
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];   
        } else {
            $sql .= " ORDER BY r.score DESC,r.user_id ";  
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

    public function getTotalScore($data){
        $sql = "SELECT SUM(r.score) score FROM " . DB_PREFIX . "report r WHERE 1";
        $implode = array();


        if (isset($data['filter_mode'])) {
            $implode[] = "r.mode='" . $this->db->escape($data['filter_mode'])."'";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "r.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(.date_modified) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(r.date_modified) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        
        $query = $this->db->query($sql);
        return $query->row['score'];
    }

    public function getUserModeReport($user_id,$data=array()){
        if(!isset($data['mode'])){
            $data['mode'] = 'targeting';
        }
        $sql = "SELECT rs.status,rs.status_name,rs.status_score,COUNT(rs.entry_id) qty,SUM(rs.status_score) score FROM ".DB_PREFIX."report_statistics rs WHERE rs.user_id = '".$user_id."' AND `mode` = '".strtolower($data['mode'])."' ";
        if(isset($data['filter_status']) && is_array($data['filter_status'])){
            $sql .= " AND rs.status IN ( ".implode(",", $data['filter_status']).")";
        }

        $sql .= " GROUP BY rs.status ";

        $query = $this->db->query($sql);
        return $query->rows;

    }

}