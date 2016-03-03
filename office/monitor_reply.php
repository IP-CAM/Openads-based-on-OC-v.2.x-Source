<?php
class MonitorReply extends Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_monitor_reply(){
		$sql = "SELECT * FROM " . DB_PREFIX . "office_reply WHERE office_id='".(int)$this->office_id."'";
		$query = $this->db->query($sql);

        return $query->rows;
	}
	
	public function add_monitor_reply(){
		$json=array();
		$date=$this->request['date'];
		$time=$this->request['time'];
		$content=$this->request['content'];
		$note=$this->request['note'];
		
		$fields = array(			
				'office_id'		    => $this->office_id,
				'date'              => DATE('Y-m-d',strtotime($date)),
				'time'              => $time,
				'work_content'      => $content,
				'note'              => $note,
				'date_added'        => date('Y-m-d H:i:s'),
		);
		$last_reply_id=$this->db->insert("office_reply",$fields);
		if($last_reply_id){
			$json['reply_id']=$last_reply_id;
		}
		return $json;
	}
	
	public function edit_monitor_reply(){
		$json=array();
		
		$reply_id=$this->request['reply_id'];
		$date=$this->request['date'];
		$time=$this->request['time'];
		$content=$this->request['content'];
		$note=$this->request['note'];
		
		$fields = array(
				
				'work_content'  => $content,
				'note'          => $note,
				'date_added'    => date('Y-m-d H:i:s'),
		);
		$res=$this->db->update("office_reply",array('reply_id' =>(int)$reply_id),$fields);
		if(!$res){
			$json['failed']="it update failed";
		}else{
			$json['success']="it update success";
		}
		return $json;
	}
}