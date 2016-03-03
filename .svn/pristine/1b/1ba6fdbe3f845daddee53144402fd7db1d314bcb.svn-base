<?php

class MonitorDele extends Model{

	public function __construct(){
		parent::__construct();
	}
	public function submit_monitor_dele(){
		
		$json=array();
		$work_content_a=$this->request['wc1'];
		$work_content_b=$this->request['wc2'];
		$date=$this->request['date'];
		$time_id=$this->request['time_id'];
		
		$namePrice=$this->getNameAndPriceById($time_id);
		$time_name=$namePrice->row['time_name'];
		$price=$namePrice->row['price'];

		$fields = array(
			'work_content_a' 	=> $work_content_a,
			'work_content_b'    => $work_content_b,
			'office_id'		=> $this->office_id,
			'time_id'       => $time_id,
			'time_name'     => $time_name,
			'date'          => DATE('Y-m-d',strtotime($date)),
		    'date_added'    => date('Y-m-d H:i:s'),
		    'price'         => $price,

		);
		$time_q=$this->isSameTimeWork($date,$time_id);
		if($time_q){
			if($time_q->row['confirm']==1){
				$json['failed']="it has been confirm,can not change";
			}else{
				$monitor_id=$time_q->row['monitor_id'];
				$res=$this->db->update("office_monitor",array('monitor_id' =>(int)$monitor_id),$fields);
				if(!$res){
					$json['failed']="it update failed";
				}else{
					$json['success']="it update success";
				}
			}

		}else{
			$result=$this->db->insert("office_monitor",$fields);
			if($result){
				$json['success']="it insert success";
			}else{
				$json['failed']="it insert failed";
			}
		}
		return $json;
	}

	public function getNameAndPriceById($time_id){
		$time_query = $this->db->query("SELECT time_name,price FROM " . DB_PREFIX . "office_time WHERE time_id = '" . $time_id . "' ");
		if ($time_query->num_rows) {
			return $time_query;
		}
	}

	public function isSameTimeWork($date,$time_id){
		$time_query = $this->db->query("SELECT monitor_id,confirm FROM " . DB_PREFIX . "office_monitor WHERE time_id = '" . (int)$time_id . "' AND office_id='".(int)$this->office_id."' AND DATE(date) ='". DATE('Y-m-d',strtotime($date))."' ");
		if ($time_query->num_rows) {
			return $time_query;
		}else{
			return false;
		}
	}
}