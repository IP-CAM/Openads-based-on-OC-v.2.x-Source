<?php
class ModelToolCron extends Model {



///---------------------------------------------------------------------------------------前台判断广告词的内容与标题相似度
	public function FrontSimilarTextAndTitle($base_table,$log_history,$content_history,$configPercent,$titleConfigPercent,$rejectStatus,$robot_review_status){

        $this->cron_log("Start to check Content And Title ".$base_table." Table In Front.");
		$result=$this->FrontGetPendingTextAndTitle($base_table,$robot_review_status);
		
		if($result){
			
			foreach ($result as $newContent){
				$this->cron_log("Start to check Post ID: ".$newContent['post_id']." in ".$base_table." Table.",$newContent['post_id']);
				$Aresult=$this->FrontGetSystemApprovedTextAndTitle($content_history,$newContent['post_id']);

				if($Aresult){
					$percent=0;					
					$resulpercent=100;
					$titlePercent=0;
					$resultTitlePercent=100;
					$resultOldContentID=0;
					foreach ($Aresult as $oldContent){
						//对比内容相似度
						similar_text($newContent['text'], $oldContent['text'], $percent);
						//对比标题相似度
						similar_text($newContent['headline'], $oldContent['headline'], $titlePercent);
						 $resultOldContentID=$oldContent['post_id'];
						//如果相似度大于设置的值，就被拒绝；反之就通过。有通过的，向content history更新记录或插入记录，没通过的不插入。
						if((int)$percent > (int)$configPercent || (int)$titlePercent>(int)$titleConfigPercent){
							if((int)$percent > (int)$configPercent){
								$advice="Your ads Text is simillar to other posts,please modify it.";
							}elseif ((int)$titlePercent>(int)$titleConfigPercent){
								$advice="Your ads Headline is simillar to other posts,please modify it.";
							}
							//被拒绝的稿子，然后检查应contribute id是否已经在content history里存在，如果存在，就只更新，不插入；如果不存在就插入一条新的记录(其实不存在也可以不插入一条新记录）。接着在contribute表里，把Status状态置为reject。最后在contribute history中添加操作记录。
							$ContributeResult=$this->db->query( "SELECT * FROM ".DB_PREFIX.$content_history." WHERE post_id ='".$newContent['contribute_id']."' " );
							
							if($ContributeResult->num_rows){
                                //$msg=$this->getContributeNoteWithAdvice($base_table,$advice,$newContent['post_id']);
								$this->db->query("UPDATE ".DB_PREFIX.$content_history." SET `headline` = '".$this->db->escape($newContent['headline'])."',`text` = '".$this->db->escape($newContent['text'])."',date_added = NOW() WHERE `post_id` = '".$newContent['post_id']."'");
								$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET status = '".$rejectStatus."',`note`='".$this->db->escape($advice)."',date_modified = NOW() WHERE `post_id` = '".$newContent['post_id']."'");
								$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET `advertise_id` = '".$newContent['advertise_id']."',`post_id` = '".$newContent['post_id']."',`from` = 'backend',`status` = '".$rejectStatus."', `user_id` = '0',date_added = NOW() ");
					            $resulpercent=$percent;
					            $resultTitlePercent=$titlePercent;
								break;
							}else{
                                  //$msg=$this->getContributeNoteWithAdvice($base_table,$advice,$newContent['post_id']);
								$this->db->query("INSERT INTO ".DB_PREFIX.$content_history." SET `post_id` = '".$newContent['post_id']."',`headline` = '".$this->db->escape($newContent['headline'])."',`text` = '".$this->db->escape($newContent['text'])."',date_added = NOW() ");
								$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET `status` = '".$rejectStatus."',`note`='".$this->db->escape($advice)."',date_modified = NOW() WHERE `post_id` = '".$newContent['post_id']."'");
								$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET `advertise_id` = '".$newContent['advertise_id']."',`post_id` = '".$newContent['post_id']."',`from` = 'backend',`status` = '".$rejectStatus."', `user_id` = '0',date_added = NOW() ");
								
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
					
					$this->cron_log("Finally Percent: ".(int)$resulpercent." AND Config Percent :".(int)$configPercent."| Title percent ".(int)$resultTitlePercent." And Title Config Percent: ".$titleConfigPercent." :Between Post ID: ".$newContent['post_id']." AND Post ID:".$resultOldContentID,$newContent['post_id']);
					if((int)$resulpercent < (int)$configPercent && (int)$resultTitlePercent<(int)$titleConfigPercent){
						//通过的稿子，然后检查应post id是否已经在content history里存在，如果存在，就只更新，不插入；如果不存在就插入一条新的记录。接着在contribute表里，把Status状态置为post review。最后在contribute history中添加操作记录。
						$ContributeResult=$this->db->query( "SELECT * FROM ".DB_PREFIX.$content_history." WHERE post_id ='".$newContent['post_id']."' " );
						if($ContributeResult->num_rows){

							$this->db->query("UPDATE ".DB_PREFIX.$content_history." SET `headline` = '".$this->db->escape($newContent['headline'])."',`text` = '".$this->db->escape($newContent['text'])."',date_added = NOW() WHERE `post_id` = '".$newContent['post_id']."'");
							$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET `status` = '4',`note`='',date_modified = NOW() WHERE `post_id` = '".$newContent['post_id']."'");
							$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET `advertise_id` = '".$newContent['advertise_id']."',`post_id` = '".$newContent['post_id']."',`from` = 'backend',`status` = '4', `user_id` = '0',date_added = NOW() ");
							 
						}else{

							$this->db->query("INSERT INTO ".DB_PREFIX.$content_history." SET `post_id` = '".$newContent['post_id']."',`headline` = '".$this->db->escape($newContent['headline'])."',`text` = '".$this->db->escape($newContent['text'])."',date_added = NOW() ");
							$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET `status` = '4',`note`='',date_modified = NOW() WHERE `post_id` = '".$newContent['post_id']."'");
							$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET `advertise_id` = '".$newContent['advertise_id']."',`post_id` = '".$newContent['post_id']."',`from` = 'backend',`status` = '4', `user_id` = '0',date_added = NOW() ");
							
						}
					}
				}else{
					//content_history表为空，初始值
					$this->cron_log("This is First Post In this Table. Post ID: ".$newContent['post_id']);
					$sql_in="INSERT INTO ".DB_PREFIX.$content_history." SET `post_id` = '".$newContent['post_id']."',`text` = '".$this->db->escape($newContent['text'])."',`headline` = '".$this->db->escape($newContent['headline'])."',date_added = NOW() ";
					
					$this->db->query($sql_in);
					$this->db->query("UPDATE ".DB_PREFIX.$base_table." SET status = '4',date_modified = NOW() WHERE post_id = '".$newContent['post_id']."'");
					$this->db->query("INSERT INTO ".DB_PREFIX.$log_history." SET `advertise_id` = '".$newContent['advertise_id']."',`post_id` = '".$newContent['post_id']."',`from` = 'backend',`status` = '4', `user_id` = '0',date_added = NOW() ");
						
				}
			}
		}

	}


	public function FrontGetPendingTextAndTitle($base_table,$robot_review_status){

			$sql="SELECT post_id,advertise_id,text,headline FROM ".DB_PREFIX.$base_table." WHERE status='{$robot_review_status}' ORDER BY date_added ";
			$query = $this->db->query( $sql );
			return $query->rows;

	}
	public function FrontGetSystemApprovedTextAndTitle($content_history,$self_post_id){
		//前台提交的稿子不与自己比较。

		$result=$this->db->query( "SELECT * FROM ".DB_PREFIX.$content_history." WHERE post_id ='".$self_post_id."'" );

		if($result->num_rows){
			$sql="SELECT post_id,text,headline FROM ".DB_PREFIX.$content_history." WHERE  post_id !='".$self_post_id."' ";
			$query = $this->db->query( $sql );
			return $query->rows;
		}else{
			$sql="SELECT post_id,text,headline FROM ".DB_PREFIX.$content_history." WHERE 1 ";
			$query = $this->db->query( $sql );
			return $query->rows;
		}

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

	public function getContributeNoteWithAdvice($base_table,$advice,$post_id){

		$msg=array();
		$msg[]=array('mode'=>'user','msg'=>$advice.',Please modify it.','operator'=>'Post System','time'=>time());
		
		$query = $this->db->query("SELECT note FROM `" . DB_PREFIX . $base_table."`  WHERE `post_id` = '".(int)$post_id."' ");

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
	
	public function cron_log($msg,$contribute_id){
		$this->db->query("INSERT INTO ".DB_PREFIX."cron_log SET `contribute_id`='".$contribute_id."',`action`='".$this->db->escape($msg)."' , added_date=NOW()");
	}
}