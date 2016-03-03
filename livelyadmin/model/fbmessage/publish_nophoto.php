<?php
class ModelFbmessagePublishNophoto extends Model {
	private $post_type = 5;
    public function deleteContribute($contribute_id){
		$where = array();
		$where['contribute_id'] = (int)$contribute_id;
		$this->db->delete("fbmessage_nophoto_post",$where);
		$this->db->delete("fbmessage_nophoto_post_history",$where);
		$where['post_type'] = $this->post_type;
		$this->db->delete("sns_balance",$where);
		$this->db->delete("fbmessage_nophoto_text_history",array('post_id' => (int)$contribute_id));
		return true;
    }

    public function getContributes($data) {
        if(!isset($data['filter_mode'])){$data['filter_mode']='';}
        $sql = '';
        switch (strtolower($data['filter_mode']) ){
            case 'links':
                if(!empty($data['filter_url_operator']) && !empty($data['filter_url_number'])){
                    $sql = "SELECT mc.* FROM ".DB_PREFIX."fbmessage_nophoto_post_url mu LEFT JOIN ".DB_PREFIX."fbmessage_nophoto_post mc ON mc.contribute_sn = mu.contribute_sn WHERE mc.publish IN (".$this->config->get("fbmessage_testing_publish").",".$this->config->get("fbmessage_promoting_publish").") GROUP BY mu.contribute_sn HAVING COUNT(mu.contribute_sn) ".$data['filter_url_operator']." '".(int)$data['filter_url_number']."' ";
                }
                break;
            case 'posts':
                $sql = "SELECT mc.* FROM " . DB_PREFIX . "fbmessage_nophoto_post mc ";
                if(isset($data['filter_url_operator']) && $data['filter_url_operator']!== false ){
                    $sql .= " LEFT JOIN ".DB_PREFIX."fbmessage_nophoto_post_url mu ON mc.contribute_sn = mu.contribute_sn ";
                }
                $sql .=" WHERE mc.publish > '".$this->config->get('fbmessage_initial_publish')."' ";
                $implode = array();
                if (!empty($data['filter_products']) && is_array($data['filter_products'])) {
                    $implode[] = "mc.product_id IN (" . implode(" , ", $data['filter_products']) . ")";
                }
                if (!empty($data['filter_user_id'])) {
                    $implode[] = "mc.user_id = '" . (int)$data['filter_user_id'] . "'";
                }
                if (!empty($data['filter_publishes']) && is_array($data['filter_publishes'])) {
                    $implode[] = "mc.publish IN (".implode(" , ", $data['filter_publishes']).") ";
                }
                if (!empty($data['filter_statuses']) && is_array($data['filter_statuses'])) {
                    $implode[] = "mc.status IN (".implode(" , ", $data['filter_statuses']).") ";
                }
                
                if ($implode) {
                    $sql .= " AND " . implode(" AND ", $implode);
                }
                if(isset($data['filter_url_operator']) && $data['filter_url_operator']!== false && !empty($data['filter_url_number'])){
                    $sql .= "GROUP BY mu.contribute_sn HAVING COUNT(mu.contribute_sn) ".$data['filter_url_operator']." '".(int)$data['filter_url_number']."' ";
                }
                $sql .= " ORDER BY mc.contribute_sn ASC";
            break;
            default:
                $sql = "SELECT mc.* FROM " . DB_PREFIX . "fbmessage_nophoto_post mc WHERE mc.publish > '".$this->config->get('fbmessage_initial_publish')."' ";
				$implode = array();
				if(!in_array($this->user->getId(), $this->config->get("sns_group_admin"))){

				}
				if (!empty($data['filter_contribute_sn'])) {
					$implode[] = "mc.contribute_sn LIKE '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
				}
				if (!empty($data['filter_entry'])) {
					$implode[] = "mc.entry_sn LIKE '%" . $this->db->escape($data['filter_entry']) . "%'";
				}

				if (!empty($data['filter_product_id'])) {
					$implode[] = "mc.product_id = '" . (int)$data['filter_product_id'] . "'";
				}

				if (!empty($data['filter_user_id'])) {
					$implode[] = "mc.user_id = '" . (int)$data['filter_user_id'] . "'";
				}	
				if (isset($data['filter_status']) && !is_null($data['filter_status']) && $data['filter_status']!==false) {
					$implode[] = "mc.status = '" . (int)$data['filter_status'] . "'";
				}	
				
				if (isset($data['filter_publish'])) {
					$implode[] = "mc.publish = '".(int)$data['filter_publish']."' ";
				}	
				if (!empty($data['filter_submited_date'])) {
						$implode[] = "DATE(mc.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
				}
				if (!empty($data['filter_date_modified'])) {
		            $implode[] = "DATE(mc.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		        }
				//export target url start
				if (!empty($data['filter_entry_sn'])) {
                    $implode[] = "mc.entry_sn = '" . $this->db->escape($data['filter_entry_sn']) . "'";
                } 	
                //uncopied filter
				if (!empty($data['filter_uncopied_status'])) {
					$implode[] = "mc.copied = '0'";
					$implode[] = "mc.status IN (" . $data['filter_uncopied_status'] . ")";
				}
				if ($implode) {
					$sql .= " AND " . implode(" AND ", $implode);
				}
				$sort_data = array(
					'mc.status',
					'mc.publish',
					'mc.entry_sn',
					'mc.author_id',
					'mc.submited_date',
					'mc.date_modified',
					'mc.contribute_sn',
					'mc.user_id',
				);	
				
				if (isset($data['order']) && ($data['order'] == 'ASC')) {
					$order = " ASC";
				} else {
					$order = " DESC";
				}
				$sql .= " ORDER BY ";
				if(!isset($this->request->get['sort'])){
					if(in_array($this->user->getId(), $this->config->get("sns_group_market"))){
						$sql .= " mc.status IN (".implode(" , ",$this->config->get("fbmessage_auditor_status")).") ".$order.", ";
					}
				}

				if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
					$sql .= $data['sort'].$order." ";	
				} else {
					$sql .= " mc.date_modified".$order."  ";	
				}

				if(!isset($this->request->get['sort'])){
					if(in_array($this->user->getId(), $this->config->get("sns_group_market"))){
						$sql .= ", mc.publish IN (".implode(" , ",$this->config->get("fbmessage_auditor_publish")).") ".$order;
					}
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
				
				break;
        }
        if(!empty($sql)){
            $query = $this->db->query($sql);
            return $query->rows;
        }
        return false;
    }

    public function getTotalContributes($data) {
        $sql = "SELECT COUNT(contribute_id) AS total  FROM " . DB_PREFIX . "fbmessage_nophoto_post mc WHERE mc.publish > '".$this->config->get('fbmessage_initial_publish')."' ";
		$implode = array();
		if(!in_array($this->user->getId(), $this->config->get("sns_group_admin"))){

		}
		if (!empty($data['filter_contribute_sn'])) {
			$implode[] = "mc.contribute_sn LIKE '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
		}
		if (!empty($data['filter_real_contribute_sn'])) {
			$implode[] = "mc.contribute_sn = '" . $this->db->escape($data['filter_real_contribute_sn']) . "'";
		}
		if (!empty($data['filter_entry'])) {
			$implode[] = "mc.entry_sn LIKE '%" . $this->db->escape($data['filter_entry']) . "%'";
		}
		if (!empty($data['filter_product_id'])) {
			$implode[] = "mc.product_id = '" . (int)$data['filter_product_id'] . "'";
		}

		if (!empty($data['filter_user_id'])) {
			$implode[] = "mc.user_id = '" . (int)$data['filter_user_id'] . "'";
		}	
		if (isset($data['filter_publish'])) {
			$implode[] = "mc.publish = '".(int)$data['filter_publish']."' ";
		}
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "mc.status = '" . (int)$data['filter_status'] . "'";
		}	
		if (!empty($data['filter_submited_date'])) {
				$implode[] = "DATE(mc.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
		}
		if (!empty($data['filter_date_modified'])) {
            $implode[] = "DATE(mc.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
		//uncopied filter
		if (!empty($data['filter_uncopied_status'])) {
			$implode[] = "mc.copied = '0'";
			$implode[] = "mc.status IN (" . $data['filter_uncopied_status'] . ")";
		}
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$query = $this->db->query($sql);
		return $query->row['total'];
    }
    public function getContributeBySn($contribute_sn){
        $sql = "SELECT mc.* FROM " . DB_PREFIX . "fbmessage_nophoto_post mc WHERE mc.contribute_sn = '" . $this->db->escape($contribute_sn) . "' AND mc.publish > '".$this->config->get('fbmessage_initial_publish')."' ";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function getContribute($contribute_id) {
        
        $sql = "SELECT * FROM " . DB_PREFIX . "fbmessage_nophoto_post WHERE contribute_id = '" . (int)$contribute_id . "' AND mc.publish > '".$this->config->get('fbmessage_initial_publish')."' ";
		$query = $this->db->query($sql);
		return $query->row;
    }

    public function getContributeLinks($contribute_sn) {

        $sql = "SELECT * FROM " . DB_PREFIX . "fbmessage_nophoto_post_url WHERE contribute_sn = '" . $this->db->escape($contribute_sn) . "'";
		$query = $this->db->query($sql);
		return $query->rows;
    }
    
    public function resetTempLocker($contribute_id=false,$locker=false){
        $where= array();
        if($contribute_id){
            $where['contribute_id'] = (int)$contribute_id;
        }
        if($locker){
            $where['locker'] = (int)$locker;
        }else{
            $where['locker'] = (int)$this->user->getId();
        }
        $this->db->update("fbmessage_nophoto_post",$where,array('locker' => 0));

    }

    public function setTempLocker($contribute_id,$user_id=false){
        $value = $user_id ? (int)$user_id : (int)$this->user->getId();
        $this->db->update("fbmessage_nophoto_post",array('contribute_id' =>(int)$contribute_id),array('locker' =>$value));
    }
    public function editContribute($data,$mode='modified'){      
        if(!isset($data['contribute_id'])){return false;}
        $info = $this->getContribute($data['contribute_id']);
        if(!$info){return false;}
        $log = $fields = $where = array();
        $where['contribute_id'] = $data['contribute_id'];
        $fields['user_id'] = (int)$this->user->getId();
        $fields['date_modified'] = date('Y-m-d H:i:s');
        switch (strtolower($mode)) {
            case 'modified':
                if(isset($data['publish']) && $data['publish'] !==false ){
                    if($data['publish'] > $this->config->get("fbmessage_initial_publish")
                    	&& in_array($info['status'], $this->config->get("fbmessage_level_status"))){
                        $fields[] = " publish = '".(int)$data['publish']."' ";
                        $log['post'] = (int)$data['publish'];
                    }else{
                        return false;
                    }
                }

                if(!empty($data['url_modified']) && !empty($data['target_url'])){
                    $fields['url_modified'] = 1;
                    $fields['target_url'] = $data['target_url'];
                    
                    $this->db->delete("fbmessage_nophoto_post_url",array('contribute_sn' => $info['contribute_sn']));  
                }
                if(!empty($data['content_modified']) && !empty($data['content'])){
                    $fields['content'] = $data['content'];
                }

                if(!empty($data['expired_modified']) && !empty($data['expired'])){
                    $fields['expired'] = $data['expired'];
                }
                if(!empty($data['entry_modified']) && !empty($data['entry_sn'])){
                    $fields['entry_sn'] = $data['entry_sn'];
                }
                if(!empty($data['note'])){
                    $fields['note'] = $data['note'];
                }
                $this->db->update("fbmessage_nophoto_post SET",$where,$fields);
                break;
            case 'init':
                $this->db->update("fbmessage_nophoto_post",$where,array('url_modified' => 0));
                if( $info['publish'] != $this->config->get("fbmessage_testing_publish") ){
                    //$log['post'] = $this->config->get("fbmessage_testing_publish");
                }
                break;
            case 'bulk':
                if(isset($data['publish']) ){
                    if($data['publish'] > $this->config->get("fbmessage_initial_publish")
                    	&& in_array($info['status'], $this->config->get("fbmessage_level_status"))){
                        $fields[] = " publish = '".(int)$data['publish']."' ";
                        if($info['publish'] != $data['publish']){
                            $log['post'] = (int)$data['publish'];   
                        }
                    }else{
                        return false;
                    }
                }
                if(isset($data['status']) ){
                    $fields['status'] = (int)$data['status'];
                    if($info['status'] != $data['status']){
                        $log['edit'] = (int)$data['status'];    
                    }
                    if(!isset($data['publish'])){
                        if(in_array($data['status'], $this->config->get("fbmessage_level_status")) 
                        	&& $info['publish'] != $this->config->get("fbmessage_testing_publish") ){
                            $fields['publish'] = $this->config->get("fbmessage_testing_publish");
                            $log['post'] = $this->config->get("fbmessage_testing_publish");
                        }
                    }
                }
                $this->db->update("fbmessage_nophoto_post SET",$where, $fields);
                if(isset($data['status'])){
                	$where['post_type'] = $this->post_type;
                	$tmp = array(
						'status'    => (int)$data['status'],
		                'amount'    => getContributeAmount($this->post_type,$data['status']),
		                'user_id'   => (int)$this->user->getId(),
		                'date_added'=> date('Y-m-d H:i:s')
                	);
                    $this->db->update("sns_balance",$where,$tmp);
                }
                break;
            case 'expired':
                $condition = array();
                $condition[] = " `contribute_id` = '".(int)$data['contribute_id']."' ";
                $condition[] = " `expired` > 0";
                $query = $this->db->query("SELECT DATEDIFF(NOW() ,expired) is_expired  FROM ".DB_PREFIX."fbmessage_nophoto_post WHERE ".implode(" AND ", $condition));
                
                if(isset($query->row['is_expired']) && (int)$query->row['is_expired'] > 0){
                    $this->db->update("fbmessage_nophoto_post",$where,array('publish' => $this->config->get("fbmessage_expired_publish")));
                    
                    if($info['publish']!=$this->config->get("fbmessage_expired_publish")){
                        $log['post'] = (int)$this->config->get("fbmessage_expired_publish");
                    }
                }   
                break;
        }
        $this->resetTempLocker($data['contribute_id']);
		$history_id = 0;
		if($log){
			foreach ($log as $key => $value) {
				if(in_array(trim($key), array('edit','post'))){
                    $tmp = array(
                        'type' => trim($key), 
                        'value' => (int)$value,
                        'user_id' => (int)$this->user->getId(),
                        'date_added' => date('Y-m-d H:i:s'),
                        'contribute_id' => (int)$data['contribute_id'],
                    );
                    $history_id = $this->db->insert('fbmessage_nophoto_post_history',$tmp); 
                }
			}
		}
		return $history_id ;     
    }

    public function getHistories($contribute_id,$start=0,$limit=20){
        $sql = "SELECT h.*,u.nickname FROM ".DB_PREFIX."fbmessage_nophoto_post_history h LEFT JOIN ".DB_PREFIX."user u ON h.user_id = u.user_id WHERE h.contribute_id = '".(int)$contribute_id."'  ORDER BY h.date_added DESC LIMIT " . (int)$start. "," . (int)$limit;
        $query = $this->db->query($sql);
    
        return $query->rows;
    }

    public function getTotalHistory($contribute_id){
        $query = $this->db->query("SELECT COUNT(history_id) total FROM ".DB_PREFIX."fbmessage_nophoto_post_history h WHERE h.contribute_id = '".(int)$contribute_id."'");
        return $query->row['total'];
    }
    
    public function importUrl($contribute_sn,$shortUrl){
        return $this->db->insert("fbmessage_nophoto_post_url",array('contribute_sn' => $contribute_sn,'short_url'=>$shortUrl));
    }

    public function deleUrl($shortUrl){
        return $this->db->delete("fbmessage_nophoto_post_url",array('short_url' => $shortUrl));
    }

    public function emptyUrlByPost($postSn){
        return $this->db->delete("fbmessage_nophoto_post_url",array('contribute_sn' => $postSn));
    }

    public function resetClickBankTargetURL(){
        $n=$e =0;
        $query = $this->db->query("SELECT c.contribute_id,c.contribute_sn,c.target_url,p.cb_link FROM ".DB_PREFIX."fbmessage_nophoto_post c LEFT JOIN ".DB_PREFIX."fbaccount p ON p.entry_sn = c.entry_sn WHERE c.is_clickbank = 1 AND p.is_clickbank = 1 ");
        if($query->num_rows){
            foreach ($query->rows as $row) {
                if(!empty($row['cb_link'])){
                    $_target_url = $row['cb_link'].$row['contribute_sn'];
                    $this->db->query("UPDATE ".DB_PREFIX."fbmessage_nophoto_post SET target_url = '".$this->db->escape($_target_url)."' WHERE contribute_id = '".(int)$row['contribute_id']."'");
                    $n++;
                }
            }
        }else{
            $e++;
        }
        return array('total'=>$query->num_rows,'success'=>$n,'error'=>$e);
    }
}