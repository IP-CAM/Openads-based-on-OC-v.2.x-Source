<?php
class ModelToolNflCron extends Model {


	//前台判断内容相似度
	public function FrontSimilarText($contribute_table,$log_table,$content_log_table,$similar_config_percent,$reject_status,$robot_review_status,$review_status){

		$this->cron_log("Start to check Content ".$contribute_table." Table In Front.");
		$result=$this->FrontGetPendingText($contribute_table,$robot_review_status);

		if($result){
				
			foreach ($result as $newContent){
				$this->cron_log("Start to check Contribute ID: ".$newContent['contribute_id']." in ".$contribute_table." Table.");
				$Aresult=$this->FrontGetSystemApprovedText($content_log_table,$newContent['contribute_id']);

				if($Aresult){
					$percent=0;
					$resulpercent=100;
					$resultOldContentID=0;
					foreach ($Aresult as $oldContent){
						similar_text($newContent['content'], $oldContent['post_content'], $percent);
						$resultOldContentID=$oldContent['post_id'];
						//如果相似度大于设置的值，就被拒绝；反之就通过。有通过的，向content history更新记录或插入记录，没通过的不插入。
						if((int)$percent > (int)$similar_config_percent){
							$msg=$this->getContributeNote($contribute_table,$newContent['contribute_id']);
							//被拒绝的稿子，然后检查应contribute id是否已经在content history里存在，如果存在，就只更新，不插入；如果不存在就插入一条新的记录(其实不存在也可以不插入一条新记录）。接着在contribute表里，把Status状态置为reject。最后在contribute history中添加操作记录。
							$ContributeResult=$this->db->query( "SELECT * FROM ".DB_PREFIX.$content_log_table." WHERE post_id ='".$newContent['contribute_id']."' " );
							if($ContributeResult->num_rows){								
								$this->db->query("UPDATE ".DB_PREFIX.$content_log_table." SET post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() WHERE post_id = '".$newContent['contribute_id']."'");								
							}else{								
								$this->db->query("INSERT INTO ".DB_PREFIX.$content_log_table." SET post_id = '".$newContent['contribute_id']."',post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() ");									
							}
							$this->db->query("UPDATE ".DB_PREFIX.$contribute_table." SET status = '".$reject_status."',note='".$this->db->escape($msg)."',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
							$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'edit',value = '".$reject_status."', user_id = '-1',date_added = NOW() ");
							$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'post',value = '".$this->config->get("initial_publish")."', user_id = '-1',date_added = NOW() ");
							$resulpercent=$percent;
							break;
						}else{
							$resulpercent=$percent;
							continue;
						}

					}
					$this->cron_log("Finally Percent: ".(int)$resulpercent." AND Config Percent :".(int)$similar_config_percent." :Between Contribute ID: ".$newContent['contribute_id']." AND Contribute ID:".$resultOldContentID);
					if((int)$resulpercent < (int)$similar_config_percent){
						//通过的稿子，然后检查应contribute id是否已经在content history里存在，如果存在，就只更新，不插入；如果不存在就插入一条新的记录。接着在contribute表里，把Status状态置为post review。最后在contribute history中添加操作记录。
						$ContributeResult=$this->db->query( "SELECT * FROM ".DB_PREFIX.$content_log_table." WHERE post_id ='".$newContent['contribute_id']."' " );
						if($ContributeResult->num_rows){
							$this->db->query("UPDATE ".DB_PREFIX.$content_log_table." SET post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() WHERE post_id = '".$newContent['contribute_id']."'");							
						}else{
							$this->db->query("INSERT INTO ".DB_PREFIX.$content_log_table." SET post_id = '".$newContent['contribute_id']."',post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() ");	
						}
						$this->db->query("UPDATE ".DB_PREFIX.$contribute_table." SET status = '{$review_status}',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
						$this->db->query("INSERT INTO ".DB_PREFIX.$log_table." SET contribute_id = '".$newContent['contribute_id']."',type = 'edit',value = '1', user_id = '-1',date_added = NOW() ");
						$this->db->query("INSERT INTO ".DB_PREFIX.$log_table." SET contribute_id = '".$newContent['contribute_id']."',type = 'post',value = '".$this->config->get("initial_publish")."', user_id = '-1',date_added = NOW() ");							
					}
				}else{
					//content_history表为空，初始值
					$this->cron_log("This is the First Contribute In this Table. Contribute ID: ".$newContent['contribute_id']);
					$this->db->query("INSERT INTO ".DB_PREFIX.$content_log_table." SET post_id = '".$newContent['contribute_id']."',post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() ");
					$this->db->query("UPDATE ".DB_PREFIX.$contribute_table." SET status = '{$review_status}',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
					$this->db->query("INSERT INTO ".DB_PREFIX.$log_table." SET contribute_id = '".$newContent['contribute_id']."',type = 'edit',value = '1', user_id = '-1',date_added = NOW() ");
					$this->db->query("INSERT INTO ".DB_PREFIX.$log_table." SET contribute_id = '".$newContent['contribute_id']."',type = 'post',value = '".$this->config->get("initial_publish")."', user_id = '-1',date_added = NOW() ");
						
				}
			}
		}

	}


	public function FrontGetPendingText($contribute_table,$robot_review_status){

		$sql="SELECT contribute_id,content FROM ".DB_PREFIX.$contribute_table." WHERE status='{$robot_review_status}' ORDER BY submited_date ";
		$query = $this->db->query( $sql );
		return $query->rows;

	}
	public function FrontGetSystemApprovedText($content_log_table,$self_contribute_id){
		//前台提交的稿子不与自己比较。

		$sql="SELECT post_id,post_content FROM ".DB_PREFIX.$content_log_table." WHERE  post_id !='".$self_contribute_id."' ";
		$query = $this->db->query( $sql );
		return $query->rows;

	}

	///---------------------------------------------------------------------------------------前台判断内容与标题相似度
	public function FrontSimilarTextAndTitle($base_table,$log_history,$content_history,$configPercent,$titleConfigPercent,$rejectStatus,$pendingStatus){

		$this->cron_log("Start to check Content And Title ".$base_table." Table In Front.");
		$result=$this->FrontGetPendingTextAndTitle($base_table,$pendingStatus);

		if($result){
				
			foreach ($result as $newContent){
				$this->cron_log("Start to check Contribute ID: ".$newContent['contribute_id']." in ".$base_table." Table.");
				$Aresult=$this->FrontGetSystemApprovedTextAndTitle($content_history,$newContent['contribute_id']);

				if($Aresult){
					$percent=0;
					$resulpercent=100;
					$titlePercent=0;
					$resultTitlePercent=100;
					$resultOldContentID=0;
					foreach ($Aresult as $oldContent){
						//对比内容相似度
						similar_text($newContent['content'], $oldContent['post_content'], $percent);
						//对比标题相似度
						similar_text($newContent['title'], $oldContent['post_title'], $titlePercent);
						$resultOldContentID=$oldContent['post_id'];
						//如果相似度大于设置的值，就被拒绝；反之就通过。有通过的，向content history更新记录或插入记录，没通过的不插入。
						if((int)$percent > (int)$configPercent || (int)$titlePercent>(int)$titleConfigPercent){
							if((int)$percent > (int)$configPercent){
								$advice="Your ads Content is simillar to other posts";
							}elseif ((int)$titlePercent>(int)$titleConfigPercent){
								$advice="Your ads Title is simillar to other posts";
							}
							//被拒绝的稿子，然后检查应contribute id是否已经在content history里存在，如果存在，就只更新，不插入；如果不存在就插入一条新的记录(其实不存在也可以不插入一条新记录）。接着在contribute表里，把Status状态置为reject。最后在contribute history中添加操作记录。
							$ContributeResult=$this->db->query( "SELECT * FROM ".DB_PREFIX.$content_history." WHERE post_id ='".$newContent['contribute_id']."' " );
							if($ContributeResult->num_rows){
								$msg=$this->getContributeNoteWithAdvice($base_table,$advice,$newContent['contribute_id']);
								$this->db->query("UPDATE ".DB_PREFIX.$content_history." SET post_title = '".$this->db->escape($newContent['title'])."',post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() WHERE post_id = '".$newContent['contribute_id']."'");
								$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET status = '".$rejectStatus."',note='".$this->db->escape($msg)."',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
								$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'edit',value = '".$rejectStatus."', user_id = '-1',date_added = NOW() ");
								$resulpercent=$percent;
								$resultTitlePercent=$titlePercent;
								break;
							}else{
								$msg=$this->getContributeNoteWithAdvice($base_table,$advice,$newContent['contribute_id']);
								$this->db->query("INSERT INTO ".DB_PREFIX.$content_history." SET post_id = '".$newContent['contribute_id']."',post_title = '".$this->db->escape($newContent['title'])."',post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() ");
								$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET status = '".$rejectStatus."',note='".$this->db->escape($msg)."',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
								$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'edit',value = '".$rejectStatus."', user_id = '-1',date_added = NOW() ");
								$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'post',value = '".$this->config->get("initial_publish")."', user_id = '-1',date_added = NOW() ");
								$resulpercent=$percent;
								$resultTitlePercent=$titlePercent;
								break;
							}
						}else{
							$resulpercent=$percent;
							$resultTitlePercent=$titlePercent;
							continue;
						}

					}
						
					$this->cron_log("Finally Percent: ".(int)$resulpercent." AND Config Percent :".(int)$configPercent."| Title percent ".(int)$resultTitlePercent." And Title Config Percent: ".$titleConfigPercent." :Between Contribute ID: ".$newContent['contribute_id']." AND Contribute ID:".$resultOldContentID);
					if((int)$resulpercent < (int)$configPercent && (int)$resultTitlePercent<(int)$titleConfigPercent){
						//通过的稿子，然后检查应contribute id是否已经在content history里存在，如果存在，就只更新，不插入；如果不存在就插入一条新的记录。接着在contribute表里，把Status状态置为post review。最后在contribute history中添加操作记录。
						$ContributeResult=$this->db->query( "SELECT * FROM ".DB_PREFIX.$content_history." WHERE post_id ='".$newContent['contribute_id']."' " );
						if($ContributeResult->num_rows){

							$this->db->query("UPDATE ".DB_PREFIX.$content_history." SET post_title = '".$this->db->escape($newContent['title'])."',post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() WHERE post_id = '".$newContent['contribute_id']."'");
							$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET status = '1',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
							$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'edit',value = '1', user_id = '-1',date_added = NOW() ");

						}else{

							$this->db->query("INSERT INTO ".DB_PREFIX.$content_history." SET post_id = '".$newContent['contribute_id']."',post_title = '".$this->db->escape($newContent['title'])."',post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() ");
							$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET status = '1',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
							$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'edit',value = '1', user_id = '-1',date_added = NOW() ");
							$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'post',value = '".$this->config->get("initial_publish")."', user_id = '-1',date_added = NOW() ");
								
						}
					}
				}else{
					//content_history表为空，初始值
					$this->cron_log("This is the First Contribute In this Table. Contribute ID: ".$newContent['contribute_id']);
					$this->db->query("INSERT INTO ".DB_PREFIX.$content_history." SET post_id = '".$newContent['contribute_id']."',post_content = '".$this->db->escape($newContent['content'])."',post_title = '".$this->db->escape($newContent['title'])."',date_added = NOW() ");
					$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET status = '1',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
					$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'edit',value = '1', user_id = '-1',date_added = NOW() ");
					$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET contribute_id = '".$newContent['contribute_id']."',type = 'post',value = '".$this->config->get("initial_publish")."', user_id = '-1',date_added = NOW() ");
						
				}
			}
		}

	}


	public function FrontGetPendingTextAndTitle($base_table,$pendingStatus){

		$sql="SELECT contribute_id,content,title FROM ".DB_PREFIX.$base_table." WHERE status='{$pendingStatus}' ORDER BY submited_date ";
		$query = $this->db->query( $sql );
		return $query->rows;

	}
	public function FrontGetSystemApprovedTextAndTitle($content_history,$self_contribute_id){
		//前台提交的稿子不与自己比较。

		$result=$this->db->query( "SELECT * FROM ".DB_PREFIX.$content_history." WHERE post_id ='".$self_contribute_id."'" );

		if($result->num_rows){
			$sql="SELECT post_id,post_content,post_title FROM ".DB_PREFIX.$content_history." WHERE  post_id !='".$self_contribute_id."' ";
			$query = $this->db->query( $sql );
			return $query->rows;
		}else{
			$sql="SELECT post_id,post_content,post_title FROM ".DB_PREFIX.$content_history." WHERE 1 ";
			$query = $this->db->query( $sql );
			return $query->rows;
		}

	}


	//--------------------------------------------------后台判断内容相似度

	public function BackSimilarText($table,$configPercent){
		$this->cron_log("Start to check ".$table." Table In Back.");
		$result=$this->BackGetTestingText($table);
		if($result){
			foreach ($result as $newContent){
				$this->cron_log("Start to check Contribute ID: ".$newContent['contribute_id']." in ".$table." Table.");
				$Aresult=$this->BackGetSystemApprovedText($table);
				if($Aresult){
					$percent=0;
					$resulpercent=100;
					$resultOldContentID=0;
					foreach ($Aresult as $oldContent){
						similar_text($newContent['content'], $oldContent['post_content'], $percent);
						$resultOldContentID=$oldContent['post_id'];
						//如果相似度大于设置的值，就被拒绝,被拒绝的就不向content history插入；反之就通过，有通过的，向content history插入记录。
						if((int)$percent > (int)$configPercent){
								
							//被拒绝的稿子，不用向content history插入一条新记录。在contribute表里，把publish状态置为Updating Text。最后在contribute history中添加操作记录。
							$msg=$this->getContributeNote($table,$newContent['contribute_id']);
							$this->db->query("UPDATE ".DB_PREFIX.$table."contribute SET publish = '".$rejectStatus."',note='".$this->db->escape($msg)."',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
							$this->db->query("INSERT INTO ".DB_PREFIX.$table."contribute_history SET contribute_id = '".$newContent['contribute_id']."',type = 'post',value = '".$rejectStatus."', user_id = '-1',date_added = NOW() ");
							$resulpercent=$percent;
							break ;
						}else{
							$resulpercent=$percent;
							continue;

						}

					}
					$this->cron_log("Finally Percent: ".(int)$resulpercent." :Between Contribute ID: ".$newContent['contribute_id']." AND Contribute ID:".$resultOldContentID);
					if((int)$resulpercent < (int)$configPercent){
						//通过的稿子，向content history插入一条新记录。接着在contribute表里，把publish状态置为Normal。最后在contribute history中添加操作记录。
						$this->db->query("INSERT INTO ".DB_PREFIX.$table."content_history SET post_id = '".$newContent['contribute_id']."',post_content = '".$this->db->escape($newContent['content'])."',date_added = NOW() ");
						$this->db->query("UPDATE ".DB_PREFIX.$table."contribute SET publish = '3',date_modified = NOW() WHERE contribute_id = '".$newContent['contribute_id']."'");
						$this->db->query("INSERT INTO ".DB_PREFIX.$table."contribute_history SET contribute_id = '".$newContent['contribute_id']."',type = 'post',value = '3', user_id = '-1',date_added = NOW() ");

					}
				}
			}
		}

	}

	public function BackGetTestingText($table){

		$sql="SELECT contribute_id,content FROM ".DB_PREFIX.$table."contribute WHERE publish ='2' ORDER BY submited_date ";
		$query = $this->db->query( $sql );
		return $query->rows;

	}
	public function BackGetSystemApprovedText($table){

		$sql="SELECT post_id,post_content FROM ".DB_PREFIX.$table."content_history ";
		$query = $this->db->query( $sql );
		return $query->rows;
	}

	public function similar_text_stop(){
		//value为1表示正在运行，value值为0表示已停止.
		$result=$this->db->query("SELECT value FROM ".DB_PREFIX."setting WHERE `key` ='similar_text_power'" );
		if($result->num_rows){
			if($result->row['value']==1){
				$this->db->query("UPDATE ".DB_PREFIX."setting SET value='0' WHERE `key`='similar_text_power'");
			}
		}
	}

	public function similar_text_start(){
		//value为1表示正在运行，value值为0表示已停止
		$result=$this->db->query("SELECT value FROM ".DB_PREFIX."setting WHERE `key` ='similar_text_power'" );
		if($result->num_rows){
			if($result->row['value']==0){
				$this->db->query("UPDATE ".DB_PREFIX."setting SET value='1' WHERE `key`='similar_text_power'");
			}
		}else{
			$this->db->query("INSERT INTO ".DB_PREFIX."setting SET value='1' , `key`='similar_text_power'");
		}
	}

	public function set_similar_text_interval($value){
		$result=$this->db->query("SELECT value FROM ".DB_PREFIX."setting WHERE `key` ='similar_text_interval'" );
		if($result->num_rows){
			$this->db->query("UPDATE ".DB_PREFIX."setting SET value='".$value."' WHERE `key`='similar_text_interval'");
		}else{
			$this->db->query("INSERT INTO ".DB_PREFIX."setting SET value='".$value."' , `key`='similar_text_interval'");
		}
	}
	public function get_similar_text_interval(){
		$result=$this->db->query("SELECT value FROM ".DB_PREFIX."setting WHERE `key` ='similar_text_interval'" );
		if($result->num_rows){
			return $result->row['value'];
		}else{
			return 30;
		}
	}
	public function get_similar_text_status(){
		$result=$this->db->query("SELECT value FROM ".DB_PREFIX."setting WHERE `key` ='similar_text_power'" );
		if($result->num_rows){
			if($result->row['value']==1){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function getContributeNote($base_table,$contribute_id){

		$msg=array();
		$msg[]=array('mode'=>'user','msg'=>'Your contribute is similar to other Posts,Please modify it.','operator'=>'Post System','time'=>time());

		$query = $this->db->query("SELECT note FROM `" . DB_PREFIX . $base_table."`  WHERE contribute_id = '".(int)$contribute_id."' ");

		if(!empty($query->row['note'])){
			$file_notes = json_decode($query->row['note'],true);
			if(is_array($file_notes)){
				$msg = array_merge($file_notes,$msg);
				$msg = json_encode($msg);
			}
		}else{
			$msg = json_encode($msg);
		}

		return $msg;

	}

	public function getContributeNoteWithAdvice($base_table,$advice,$contribute_id){

		$msg=array();
		$msg[]=array('mode'=>'user','msg'=>$advice.',Please modify it.','operator'=>'Post System','time'=>time());

		$query = $this->db->query("SELECT note FROM `" . DB_PREFIX . $base_table."`  WHERE contribute_id = '".(int)$contribute_id."' ");

		if(!empty($query->row['note'])){
			$file_notes = json_decode($query->row['note'],true);
			if(is_array($file_notes)){
				$msg = array_merge($file_notes,$msg);
				$msg = json_encode($msg);
			}
		}else{
			$msg = json_encode($msg);
		}

		return $msg;

	}

	public function cron_log($msg){
		$this->db->query("INSERT INTO ".DB_PREFIX."cron_log SET `action`='".$this->db->escape($msg)."' , added_date=NOW()");
	}
}