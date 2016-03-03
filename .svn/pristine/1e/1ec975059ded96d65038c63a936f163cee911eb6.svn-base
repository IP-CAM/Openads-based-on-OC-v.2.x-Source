<?php
class ModelReportStatistics extends Model {

    public function do_statistics(){
        $start_time = time();

        $sql = "SELECT `pfac`.`contribute_id` AS `contribute_id`,`pfac`.`contribute_sn` AS `contribute_sn`,if((`pfac`.`is_clickbank` = 0),1,2) AS `product_type`,1 AS `post_type`,`fa1`.`entry_sn` AS `entry_sn`,`fa1`.`entry_name` AS `entry_name`,`pfac`.`product_config_id` AS `product_config_id`,`pfac`.`customer_id` AS `customer_id`,`pfac`.`user_id` AS `user_id`,`pfac`.`status` AS `status`,`pcs`.`name` AS `status_text`,if((`mb1`.`amount` > 0),`mb1`.`amount`,0.00) AS `amount`,`pfac`.`submited_date` AS `submited_date` 
                FROM (((`lv_photo_fbaccount_contribute` `pfac` 
                LEFT JOIN `lv_fbaccount` `fa1` ON((`fa1`.`entry_sn` = `pfac`.`entry_sn`))) 
                LEFT JOIN `lv_photo_contribute_status` `pcs` ON((`pcs`.`status_id` = `pfac`.`status`))) 
                LEFT JOIN `lv_manage_balance` `mb1` ON(((`mb1`.`contribute_id` = `pfac`.`contribute_id`) AND (`mb1`.`post_type` = 1)))) 
                UNION ALL 
                SELECT `fac`.`contribute_id` AS `contribute_id`,`fac`.`contribute_sn` AS `contribute_sn`,if((`fac`.`is_clickbank` = 0),1,2) AS `product_type`,2 AS `post_type`,`fa2`.`entry_sn` AS `entry_sn`,`fa2`.`entry_name` AS `entry_name`,`fac`.`product_config_id` AS `product_config_id`,`fac`.`customer_id` AS `customer_id`,`fac`.`user_id` AS `user_id`,`fac`.`status` AS `status`,`cs1`.`name` AS `status_text`,if((`mb2`.`amount` > 0),`mb2`.`amount`,0.00) AS `amount`,`fac`.`submited_date` AS `submited_date` 
                FROM (((`lv_fbaccount_contribute` `fac` 
                LEFT JOIN `lv_fbaccount` `fa2` ON((`fa2`.`entry_sn` = `fac`.`entry_sn`))) 
                LEFT JOIN `lv_contribute_status` `cs1` ON((`cs1`.`status_id` = `fac`.`status`))) 
                LEFT JOIN `lv_manage_balance` `mb2` ON(((`mb2`.`contribute_id` = `fac`.`contribute_id`) AND (`mb2`.`post_type` = 2)))) 
                UNION ALL 
                SELECT `fpc`.`contribute_id` AS `contribute_id`,'' AS `contribute_sn`,if((`fpc`.`is_clickbank` = 0),1,2) AS `product_type`,2 AS `post_type`,`fp`.`entry_sn` AS `entry_sn`,`fp`.`entry_name` AS `entry_name`,`fpc`.`product_config_id` AS `product_config_id`,`fpc`.`customer_id` AS `customer_id`,`fpc`.`user_id` AS `user_id`,`fpc`.`status` AS `status`,`cs2`.`name` AS `status_text`,if((`mb3`.`amount` > 0),`mb3`.`amount`,0.00) AS `amount`,`fpc`.`submited_date` AS `submited_date` 
                FROM (((`lv_fbpage_contribute` `fpc` 
                LEFT JOIN `lv_fbpage` `fp` ON((`fp`.`entry_sn` = `fpc`.`entry_sn`))) 
                LEFT JOIN `lv_contribute_status` `cs2` ON((`cs2`.`status_id` = `fpc`.`status`))) 
                LEFT JOIN `lv_manage_balance` `mb3` ON(((`mb3`.`contribute_id` = `fpc`.`contribute_id`) AND (`mb3`.`post_type` = 3))))
                UNION ALL 
                SELECT `fm`.`contribute_id` AS `contribute_id`,`fm`.`contribute_sn` AS `contribute_sn`,if((`fm`.`is_clickbank` = 0),1,2) AS `product_type`,3 AS `post_type`,`fa3`.`entry_sn` AS `entry_sn`,`fa3`.`entry_name` AS `entry_name`,`fm`.`product_config_id` AS `product_config_id`,`fm`.`customer_id` AS `customer_id`,`fm`.`user_id` AS `user_id`,`fm`.`status` AS `status`,`ms`.`name` AS `status_text`,if((`mb4`.`amount` > 0),`mb4`.`amount`,0.00) AS `amount`,`fm`.`submited_date` AS `submited_date` 
                FROM (((`lv_message` `fm` 
                LEFT JOIN `lv_fbaccount` `fa3` ON((`fa3`.`entry_sn` = `fm`.`entry_sn`))) 
                LEFT JOIN `lv_message_status` `ms` ON((`ms`.`status_id` = `fm`.`status`))) 
                LEFT JOIN `lv_manage_balance` `mb4` ON(((`mb4`.`contribute_id` = `fm`.`contribute_id`) AND (`mb4`.`post_type` = 5)))) 
                UNION ALL 
                SELECT `ac`.`contribute_id` AS `contribute_id`,`ac`.`contribute_sn` AS `contribute_sn`, 1 AS `product_type`, 4 AS `post_type`,'' AS `entry_sn`,'' AS `entry_name`,`ac`.`product_config_id` AS `product_config_id`,`ac`.`customer_id` AS `customer_id`,`ac`.`user_id` AS `user_id`,`ac`.`status` AS `status`,`as`.`name` AS `status_text`,if((`mb5`.`amount` > 0),`mb5`.`amount`,0.00) AS `amount`,`ac`.`submited_date` AS `submited_date` 
                FROM (((`lv_ads_contribute` `ac` 
                LEFT JOIN `lv_ads` `a` ON((`a`.`product_config_id` = `ac`.`product_config_id`))) 
                LEFT JOIN `lv_ads_status` `as` ON((`as`.`status_id` = `ac`.`status`))) 
                LEFT JOIN `lv_manage_balance` `mb5` ON(((`mb5`.`contribute_id` = `ac`.`contribute_id`) AND (`mb5`.`post_type` = 6)))) ";
        $query = $this->db->query($sql);
        $n = 0;
        if($query->num_rows){
            $this->db->query("TRUNCATE TABLE `".DB_PREFIX."temp_posts`");
            foreach ($query->rows as $row) {
                $tmp = array();
                if(is_array($row)){
                    foreach ($row as $key => $value) {
                        $tmp[trim($key)] = " `".trim($key)."` = '".$this->db->escape($value)."'";
                    }
                }
                if($tmp){
                    $sql = "INSERT INTO ".DB_PREFIX."temp_posts SET ".implode(" , ", $tmp);
                    $this->db->query($sql);
                    $n++;
                }
            }

        }

        return 'Total: '.$n.' , In '.date('i:s',time() - $start_time).'s.';
    }

	public function getTotalBalances($data){
		$sql = "SELECT COUNT(vp.contribute_id) FROM " . DB_PREFIX . "temp_posts vp WHERE 1";
		$implode = array();
        if (isset($data['filter_product_type'])) {
            $implode[] = "vp.product_type='" . (int)$data['filter_product_type']."'";
        }

        if (isset($data['filter_post_type'])) {
            $implode[] = "vp.post_type='" . (int)$data['filter_post_type']."'";
        }

        if (isset($data['filter_product_config_id'])) {
            $implode[] = "vp.product_config_id='" . (int)$data['filter_product_config_id']."'";
        }

        if (!empty($data['filter_entry'])) {
            $implode[] = "CONCAT(vp.entry_sn,' ',vp.entry_name) LIKE '%" . $this->db->escape($data['filter_entry'])."%'";
        }

        if (isset($data['filter_customer_id'])) {
            $implode[] = "vp.customer_id='" . (int)$data['filter_customer_id']."'";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "vp.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (isset($data['filter_status'])) {
            $implode[] = "vp.status='" . (int)$data['filter_status']."'";
            
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(vp.submited_date) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(vp.submited_date) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sql .= " GROUP BY vp.status,vp.post_type,vp.customer_id,vp.product_type,vp.product_config_id,vp.entry_sn ";

		$query = $this->db->query($sql);
		return $query->num_rows;
	}

	public function getTotalResult($data){
		$sql = "SELECT COUNT(vp.contribute_id) AS total ,SUM(vp.amount) amount FROM " . DB_PREFIX . "temp_posts vp WHERE 1";
		$implode = array();
        if (isset($data['filter_product_type'])) {
            $implode[] = "vp.product_type='" . (int)$data['filter_product_type']."'";
        }

        if (isset($data['filter_post_type'])) {
            $implode[] = "vp.post_type='" . (int)$data['filter_post_type']."'";
        }

        if (isset($data['filter_product_config_id'])) {
            $implode[] = "vp.product_config_id='" . (int)$data['filter_product_config_id']."'";
        }

        if (!empty($data['filter_entry'])) {
            $implode[] = "CONCAT(vp.entry_sn,' ',vp.entry_name) LIKE '%" . $this->db->escape($data['filter_entry'])."%'";
        }

        if (isset($data['filter_customer_id'])) {
            $implode[] = "vp.customer_id='" . (int)$data['filter_customer_id']."'";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "vp.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (isset($data['filter_status'])) {
            $implode[] = "vp.status='" . (int)$data['filter_status']."'";
            
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(vp.submited_date) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(vp.submited_date) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getBalances($data){
		$sql = "SELECT vp.product_type,vp.post_type,vp.entry_sn,vp.entry_name,vp.status_text,
        cc.name product,
        CONCAT(c.firstname,' ',c.lastname) author ,CONCAT(u.lastname,u.firstname) auditor ,
		COUNT(vp.contribute_id) posts,
        SUM(vp.amount) amount
		FROM " . DB_PREFIX . "temp_posts vp LEFT JOIN ".DB_PREFIX."user u ON u.user_id = vp.user_id 
		LEFT JOIN ".DB_PREFIX."contribute_config cc ON cc.contribute_config_id = vp.product_config_id 
		LEFT JOIN ".DB_PREFIX."customer c ON c.customer_id = vp.customer_id WHERE 1";
		$implode = array();
        if (isset($data['filter_product_type'])) {
            $implode[] = "vp.product_type='" . (int)$data['filter_product_type']."'";
        }

        if (isset($data['filter_post_type'])) {
            $implode[] = "vp.post_type='" . (int)$data['filter_post_type']."'";
        }

        if (isset($data['filter_product_config_id'])) {
            $implode[] = "vp.product_config_id='" . (int)$data['filter_product_config_id']."'";
        }

        if (!empty($data['filter_entry'])) {
            $implode[] = "CONCAT(vp.entry_sn,' ',vp.entry_name) LIKE '%" . $this->db->escape($data['filter_entry'])."%'";
        }

        if (isset($data['filter_customer_id'])) {
            $implode[] = "vp.customer_id='" . (int)$data['filter_customer_id']."'";
        }

        if (isset($data['filter_user_id'])) {
            $implode[] = "vp.user_id='" . (int)$data['filter_user_id']."'";
        }

        if (isset($data['filter_status'])) {
            $implode[] = "vp.status='" . (int)$data['filter_status']."'";
        }

        if (!empty($data['filter_date_start'])) {
            $implode[] = "DATE(vp.submited_date) >= DATE('" . $this->db->escape($data['filter_date_start'])."')";
        }

        if (!empty($data['filter_date_end'])) {
            $implode[] = "DATE(vp.submited_date) <= DATE('" . $this->db->escape($data['filter_date_end'])."')";
        }
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sql .= " GROUP BY vp.status,vp.post_type,vp.customer_id,vp.product_type,vp.product_config_id,vp.entry_sn ";
		
		$sort_data = array(
			'vp.product_type',
			'vp.post_type',
			'product',
			'vp.entry_sn',
			'author',
			'auditor',
			'vp.status',
			'vp.submited_date',
			'amount',
			'posts'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY vp.submited_date";	
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

	public function postStatistics($action='status'){
		$sql = '';
		switch (strtolower($action)) {
			case 'status_fbaccount_photo':
				$sql = "SELECT pcs.status_id,pcs.name,( SELECT COUNT(fc.contribute_id) total FROM ".DB_PREFIX."photo_fbaccount_contribute fc WHERE fc.status = pcs.status_id ) AS posts FROM ".DB_PREFIX."photo_contribute_status pcs";
				break;
			case 'status_fbaccount':
				$sql ="SELECT cs.status_id,cs.name,( SELECT COUNT(fc.contribute_id) total FROM ".DB_PREFIX."fbaccount_contribute fc WHERE fc.status = cs.status_id ) AS posts FROM ".DB_PREFIX."contribute_status cs";
				break;
			case 'status_fbpage':
				$sql ="SELECT cs.status_id,cs.name,( SELECT COUNT(fc.contribute_id) total FROM ".DB_PREFIX."fbpage_contribute fc WHERE fc.status = cs.status_id ) AS posts FROM ".DB_PREFIX."contribute_status cs";
				break;
			case 'publish_fbaccount_photo':
				$sql ="SELECT pcs.publish_id,pcs.name,( SELECT COUNT(fc.contribute_id) total FROM ".DB_PREFIX."photo_fbaccount_contribute fc WHERE fc.publish = pcs.publish_id ) AS posts FROM ".DB_PREFIX."photo_contribute_publish pcs";
				break;
			case 'publish_fbaccount':
				$sql ="SELECT cp.publish_id,cp.name,( SELECT COUNT(fc.contribute_id) total FROM ".DB_PREFIX."fbaccount_contribute fc WHERE fc.publish = cp.publish_id ) AS posts FROM ".DB_PREFIX."contribute_publish cp";
				break;
			case 'publish_fbpage':
				$sql ="SELECT cp.publish_id,cp.name,( SELECT COUNT(fc.contribute_id) total FROM ".DB_PREFIX."fbpage_contribute fc WHERE fc.publish = cp.publish_id ) AS posts FROM ".DB_PREFIX."contribute_publish cp";
				break;
			case 'product':
				$sql = "SELECT ccp.contribute_config_id,ccp.name,
				( SELECT COUNT(pfc.contribute_id) FROM ".DB_PREFIX."photo_fbaccount_contribute pfc WHERE pfc.product_config_id = ccp.contribute_config_id ) AS posts1 ,
				( SELECT COUNT(fc.contribute_id) FROM ".DB_PREFIX."fbaccount_contribute fc WHERE fc.product_config_id = ccp.contribute_config_id ) AS posts2,
				( SELECT COUNT(fc.contribute_id) FROM ".DB_PREFIX."fbpage_contribute fc WHERE fc.product_config_id = ccp.contribute_config_id ) AS posts3
				FROM ".DB_PREFIX."contribute_config ccp WHERE ccp.parent_id = 1 ORDER BY ccp.contribute_config_id DESC";
				break;

			case 'auditor':
				$sql = "SELECT u.user_id,u.lastname,u.firstname,
				( SELECT COUNT(pfc.contribute_id) FROM ".DB_PREFIX."photo_fbaccount_contribute pfc WHERE pfc.user_id = u.user_id ) AS posts1,
				( SELECT COUNT(fc.contribute_id) FROM ".DB_PREFIX."fbaccount_contribute fc WHERE fc.user_id = u.user_id ) AS posts2,
				( SELECT COUNT(fc.contribute_id) FROM ".DB_PREFIX."fbpage_contribute fc WHERE fc.user_id = u.user_id ) AS posts3
				 FROM ".DB_PREFIX."user u WHERE u.user_id IN (".implode(" , ",$this->config->get('group_market')).")";
				break;
			case 'author':
				$sql = "SELECT c.customer_id,c.lastname,c.firstname,
				( SELECT COUNT(pfc.contribute_id) FROM ".DB_PREFIX."photo_fbaccount_contribute pfc WHERE pfc.customer_id = c.customer_id ) AS posts1 ,
				( SELECT COUNT(fc.contribute_id) FROM ".DB_PREFIX."fbaccount_contribute fc WHERE fc.customer_id = c.customer_id ) AS posts2,
				( SELECT COUNT(fc.contribute_id) FROM ".DB_PREFIX."fbpage_contribute fc WHERE fc.customer_id = c.customer_id ) AS posts3
				FROM ".DB_PREFIX."customer c ORDER BY c.customer_id ";
				break;
		}
		if(!empty($sql)){
			$query = $this->db->query($sql);

			return $query->rows;
		}
	}

    public function do_similar($mode='photo_fbaccount',$data=array()){
        $start_time = time();
        $base_table = $table = '';
        $fields = $where = $base_texts = $base_titles =array();
        $select_fields = '`contribute_id`,`content`';
        switch (strtolower($mode)) {
            case 'ads':
                $base_table = 'ads_contribute';
                $table = 'ads_content_similar';
                $select_fields = '`contribute_id`,`title`,`content`';
                break;
            case 'message':
                $base_table = 'message';
                $table = 'message_content_similar';
                break;
            case 'fbpage':
                $base_table = 'fbpage_contribute';
                $table = 'fbpage_content_similar';
                break;
            case 'fbaccount':
                $base_table = 'fbaccount_contribute';
                $table = 'fbaccount_content_similar';
                break;
            default:
                $base_table = 'photo_fbaccount_contribute';
                $table = 'photo_fbaccount_content_similar';
                break;
        }
        $this->db->query("TRUNCATE TABLE ".DB_PREFIX.$table);
        $sql = "SELECT ".$select_fields." FROM ".DB_PREFIX.$base_table." WHERE 1 ".implode(" ", $where);
        $query = $this->db->query($sql);
        if($query->num_rows){
            foreach ($query->rows as $row) {
                if(!empty($row['content'])){
                    $base_texts[$row['contribute_id']] = $row['content'];
                }
                if(isset($row['title']) && !empty($row['title'])){
                    $base_titles[$row['contribute_id']] = $row['title'];
                }
            }
            if($base_texts){
                foreach ($base_texts as $_bpid => $_bptext) {
                    foreach ($base_texts as $_opid => $_optext) {
                        if($_bpid != $_opid){
                            $_fields = array();
                            $percent = 0;
                            if(!empty($_optext)){
                                similar_text($_bptext, $_optext,$percent);
                            }
                            if($percent > 50){
                                $_fields[] = " `base_post_id` = '".(int)$_bpid."'";
                                $_fields[] = " `other_post_id` = '".(int)$_opid."'";
                                $_fields[] = " `value` = '".$percent."'";
                                if(strtolower($mode)=='ads'){
                                    $_fields[] = " `mode` = 'text'";
                                }
                                $sql = "INSERT INTO ".DB_PREFIX.$table." SET ".implode(" , ", $_fields);
                                $this->db->query($sql);
                            }
                            
                        }
                    }
                    unset($base_texts[$_bpid]);
                }
            }
            if($base_titles){
                foreach ($base_titles as $_btid => $_bttitle) {
                    foreach ($base_titles as $_otid => $_optitle) {
                        if($_btid != $_otid){
                            $_fields = array();
                            $percent = 0;
                            if(!empty($_optitle)){
                                similar_text($_bttitle, $_optitle,$percent);
                            }
                            if($percent > 50){
                                $_fields[] = " `base_post_id` = '".(int)$_btid."'";
                                $_fields[] = " `other_post_id` = '".(int)$_otid."'";
                                $_fields[] = " `value` = '".$percent."'";
                                if(strtolower($mode)=='ads'){
                                    $_fields[] = " `mode` = 'title'";
                                }
                                $sql = "INSERT INTO ".DB_PREFIX.$table." SET ".implode(" , ", $_fields);
                                $this->db->query($sql);
                            }
                            
                        }
                    }
                    unset($base_titles[$_btid]);
                }
            }
        }
        return time() - $start_time;
    }

    public function getTotalSimilarRecord($data){
        $table = $base_table = $publish_table = '' ;
        if(!isset($data['tab'])){ $data['tab'] = ''; }
        switch (strtolower($data['tab'])) {
            case 'ads':
                $base_table = 'ads_contribute';
                $table = 'ads_content_similar';
                $publish_table = 'ads_publish';
                break;
            case 'message':
                $base_table = 'message';
                $table = 'message_content_similar';
                $publish_table = 'message_publish';
                break;
            case 'fbpage':
                $base_table = 'fbpage_contribute';
                $table = 'fbpage_content_similar';
                $publish_table = 'contribute_publish';
                break;
            case 'fbaccount':
                $base_table = 'fbaccount_contribute';
                $table = 'fbaccount_content_similar';
                $publish_table = 'contribute_publish';
                break;
            default:
                $base_table = 'photo_fbaccount_contribute';
                $table = 'photo_fbaccount_content_similar';
                $publish_table = 'photo_contribute_publish';
                break;
        }
        $sql ="SELECT COUNT(sp.base_post_id) total FROM ".DB_PREFIX.$table." sp 
        LEFT JOIN ".DB_PREFIX.$base_table." bp ON bp.contribute_id = sp.base_post_id LEFT JOIN ".DB_PREFIX."customer c1 ON c1.customer_id = bp.customer_id 
        LEFT JOIN ".DB_PREFIX.$base_table." op ON op.contribute_id = sp.other_post_id LEFT JOIN ".DB_PREFIX."customer c2 ON c2.customer_id = op.customer_id 
        LEFT JOIN ".DB_PREFIX."contribute_config cc1 ON cc1.contribute_config_id = bp.product_config_id LEFT JOIN ".DB_PREFIX."contribute_config cc2 ON cc2.contribute_config_id = op.product_config_id 
        LEFT JOIN ".DB_PREFIX.$publish_table." pt1 ON pt1.publish_id = bp.publish LEFT JOIN ".DB_PREFIX.$publish_table." pt2 ON pt2.publish_id = op.publish  WHERE 1 ";

        $implode = array();
        if(!in_array($this->user->getId(), array_merge($this->config->get('group_admin'),$this->config->get('group_promotion')))){
            if($data['tab']=='fbpage'){
                $implode[] = " bp.user_id = '" . (int)$this->user->getId() . "'";
            }else if(count($this->user->getAuditorGroups(true))){
                $implode[] = " ( bp.group_id IN (" . implode(" , ", $this->user->getAuditorGroups(true) ) . ") OR op.group_id IN ( '" .  implode(" , ", $this->user->getAuditorGroups(true) ) . "' ) )";
            }else{
                return 0;
            }
        }
        if (!empty($data['filter_sn'])) {
            $implode[] = " ( bp.contribute_sn Like '%" . $this->db->escape($data['filter_sn']) . "%' OR op.contribute_sn LIKE '%" . $this->db->escape($data['filter_sn']) . "%')";
        }
        if (!empty($data['filter_customer_id'])) {
            $implode[] = " ( bp.customer_id = '" . (int)$data['filter_customer_id'] . "' OR op.customer_id = '" . (int)$data['filter_customer_id'] . "' )";
        } 
        if (!empty($data['filter_product_config_id'])) {
            $implode[] = " ( bp.product_config_id = '" . (int)$data['filter_product_config_id'] . "' OR op.product_config_id = '" . (int)$data['filter_product_config_id'] . "' )";
        } 
        if (!empty($data['filter_publish'])) {
            $implode[] = " ( bp.publish = '" . (int)$data['filter_publish'] . "' OR op.publish = '" . (int)$data['filter_publish'] . "' )";
        } 
        if (isset($data['filter_start_value']) && $data['filter_start_value'] !==false) {
            $implode[] = "sp.value >= '" . (int)$data['filter_start_value'] . "'";
        }  
        if (isset($data['filter_end_value']) && $data['filter_end_value'] !==false) {
            $implode[] = "sp.value <= '" . (int)$data['filter_end_value'] . "'";
        }

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getSimilarRecords($data){
        $table = $base_table = '';
        if(!isset($data['tab'])){ $data['tab'] = '' ;}
        $fields = array();
        $fields[] = "sp.*";
        $fields[] = "c1.firstname AS bfirstname";
        $fields[] = "c1.lastname AS blastname";
        $fields[] = "c2.firstname AS ofirstname";
        $fields[] = "c2.lastname AS olastname";
        $fields[] = "pt1.name AS base_publish";
        $fields[] = "pt2.name AS other_publish";
        $fields[] = "cc1.name AS base_product";
        $fields[] = "cc2.name AS other_product";
        switch (strtolower($data['tab'])) {
            case 'ads':
                $base_table = 'ads_contribute';
                $table = 'ads_content_similar';
                $publish_table = 'ads_publish';
                $fields[] = "bp.contribute_sn AS base_sn";
                $fields[] = "op.contribute_sn AS other_sn";
                break;
            case 'message':
                $base_table = 'message';
                $table = 'message_content_similar';
                $publish_table = 'message_publish';
                $fields[] = "bp.contribute_sn AS base_sn";
                $fields[] = "op.contribute_sn AS other_sn";
                break;
            case 'fbpage':
                $base_table = 'fbpage_contribute';
                $table = 'fbpage_content_similar';
                $publish_table = 'contribute_publish';
                break;
            case 'fbaccount':
                $base_table = 'fbaccount_contribute';
                $table = 'fbaccount_content_similar';
                $publish_table = 'contribute_publish';
                $fields[] = "bp.contribute_sn AS base_sn";
                $fields[] = "op.contribute_sn AS other_sn";
                break;
            default:
                $base_table = 'photo_fbaccount_contribute';
                $table = 'photo_fbaccount_content_similar';
                $publish_table = 'photo_contribute_publish';
                $fields[] = "bp.contribute_sn AS base_sn";
                $fields[] = "op.contribute_sn AS other_sn";
                break;
        }
        $sql ="SELECT ".implode(" , ", $fields)." FROM ".DB_PREFIX.$table." sp 
        LEFT JOIN ".DB_PREFIX.$base_table." bp ON bp.contribute_id = sp.base_post_id LEFT JOIN ".DB_PREFIX."customer c1 ON c1.customer_id = bp.customer_id 
        LEFT JOIN ".DB_PREFIX.$base_table." op ON op.contribute_id = sp.other_post_id LEFT JOIN ".DB_PREFIX."customer c2 ON c2.customer_id = op.customer_id 
        LEFT JOIN ".DB_PREFIX."contribute_config cc1 ON cc1.contribute_config_id = bp.product_config_id LEFT JOIN ".DB_PREFIX."contribute_config cc2 ON cc2.contribute_config_id = op.product_config_id 
        LEFT JOIN ".DB_PREFIX.$publish_table." pt1 ON pt1.publish_id = bp.publish LEFT JOIN ".DB_PREFIX.$publish_table." pt2 ON pt2.publish_id = op.publish  WHERE 1 ";

        $implode = array();
        if(!in_array($this->user->getId(), array_merge($this->config->get('group_admin'),$this->config->get('group_promotion')))){
            if($data['tab']=='fbpage'){
                $implode[] = " bp.user_id = '" . (int)$this->user->getId() . "'";
            }else if(count($this->user->getAuditorGroups(true))){
                $implode[] = " ( bp.group_id IN (" . implode(" , ", $this->user->getAuditorGroups(true) ) . ") OR op.group_id IN ( '" .  implode(" , ", $this->user->getAuditorGroups(true) ) . "' ) )";
            }else{
                return array();
            }
        }
        if (!empty($data['filter_sn'])) {
            $implode[] = " ( bp.contribute_sn Like '%" . $this->db->escape($data['filter_sn']) . "%' OR op.contribute_sn LIKE '%" . $this->db->escape($data['filter_sn']) . "%')";
        }
        if (!empty($data['filter_customer_id'])) {
            $implode[] = " ( bp.customer_id = '" . (int)$data['filter_customer_id'] . "' OR op.customer_id = '" . (int)$data['filter_customer_id'] . "' )";
        } 
        if (!empty($data['filter_product_config_id'])) {
            $implode[] = " ( bp.product_config_id = '" . (int)$data['filter_product_config_id'] . "' OR op.product_config_id = '" . (int)$data['filter_product_config_id'] . "' )";
        } 
        if (!empty($data['filter_publish'])) {
            $implode[] = " ( bp.publish = '" . (int)$data['filter_publish'] . "' OR op.publish = '" . (int)$data['filter_publish'] . "' )";
        } 
        if (isset($data['filter_start_value']) && $data['filter_start_value'] !==false) {
            $implode[] = "sp.value >= '" . (int)$data['filter_start_value'] . "'";
        }  
        if (isset($data['filter_end_value']) && $data['filter_end_value'] !==false) {
            $implode[] = "sp.value <= '" . (int)$data['filter_end_value'] . "'";
        }

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }

        $sort_data = array(
            'bfirstname',
            'ofirstname',
            'base_publish',
            'other_publish',
            'base_product',
            'other_product',
            'sp.value'
        );
        if(strtolower($data['tab'])!='fbpage'){
            $sort_data[] = 'bp.contribute_sn';
            $sort_data[] = 'sp.contribute_sn';
        }
            
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];   
        } else {
            $sql .= " ORDER BY sp.value";   
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

    public function getPostText($data){
        if(!isset($data['contribute_id'])){ return false;}
        if(!isset($data['mode'])){ $data['mode'] = '' ;}
        if(!isset($data['type'])){ $data['type'] = 'text' ;}
        $table = '';
        $select_fields = '`content`';
        switch (strtolower($data['mode'])) {
            case 'ads':
                $table = 'ads_contribute';
                $select_fields = '`title`,`content`';
                break;
            case 'message':
                $table = 'message';
                break;
            case 'fbpage':
                $table = 'fbpage_contribute';
                break;
            case 'fbaccount':
                $table = 'fbaccount_contribute';
                break;
            default:
                $table = 'photo_fbaccount_contribute';
                break;
        }

        $sql = "SELECT ".$select_fields." FROM ".DB_PREFIX.$table." WHERE contribute_id = '" .(int)$data['contribute_id'] . "'";
        $query = $this->db->query($sql);
        if(strtolower($data['type'])=='title'){
            return isset($query->row['title']) ? $query->row['title'] : false;
        }
        return isset($query->row['content']) ? $query->row['content'] : false;
    }
}