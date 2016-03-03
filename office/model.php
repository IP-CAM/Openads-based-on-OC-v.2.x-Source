<?php

class Model{
	private $token='30ebc25ed2dkkk256e2222ea76809724b';
	public $db ;
	public $request;
	public $office_id;
	public $office_group_id;
	public $office_nickname;

	public function __construct(){

		if (ini_get('magic_quotes_gpc')) {
			$_GET = $this->clean($_GET);
			$_POST = $this->clean($_POST);
			$_REQUEST = $this->clean($_REQUEST);
				
		}

		if(empty($_REQUEST['token'])|| $this->token!= $_REQUEST['token']||empty($_REQUEST['username'])||empty($_REQUEST['password'])){
			die('403');
		}
		$this->db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		$this->request = $this->getParamsAll();


		//-------------log
		$request_data = array_merge(array('request_from_ip'=>$_SERVER['REMOTE_ADDR']),$_REQUEST);
		$this->user_log(array('action'=>'api','url'=>'api','data'=>"<pre>" .$this->db->escape(var_export($request_data,TRUE))."</pre>"));
	   //------------office id, office group id
	   $this->getOfficeIdAndGroupIdByname($this->request['username']);
	}

	/*--------------------------------common--------------------------------------------------*/
	public function login($username, $password) {
		$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "office_user WHERE office_name = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");
		if ($user_query->num_rows) {
			return true;
		} else {
			return false;
		}
	}
	public function get_permission(){
		$json = array();
		if($this->login($this->request['username'], $this->request['password'])){
			
			$json['success']=$this->office_id.",".$this->office_group_id.",".$this->office_nickname;
			return $this->getOfficeIdAndGroupIdByname($this->request['username']);
			
		}else{
			$json['failed']="password is incorrect";
			return $json;
		}
	}
	function getOfficeIdAndGroupIdByname($username){
		$user_query = $this->db->query("SELECT office_id,office_group_id,nickname FROM " . DB_PREFIX . "office_user WHERE office_name = '" . $this->db->escape($username) . "' ");
		if ($user_query->num_rows) {
			$this->office_id=$user_query->row['office_id'];
			$this->office_group_id=$user_query->row['office_group_id'];
			$this->office_nickname=$user_query->row['nickname'];
		}
		return $user_query->rows;
	}

 /*--------------------------------common--------get params------------------------------------------*/
	//鑾峰彇鏁扮粍閲岀殑鍊�
	public function getParams($k){
		if(!empty($this->request[$k]))
		return $this->request[$k];
		return false;
	}

	private function user_log($data){
		$this->db->query("INSERT INTO ".DB_PREFIX."office_user_log ( office_id,action ,url,data,log_time) VALUES ('24','{$data['action']}','{$data['url']}','{$data['data']}','".date('Y-m-d H:i:s')."')");
	}

	//鑾峰彇get鎴栬�卲ost閲屾墍鏈夊弬鏁�
	private function getParamsAll(){
		$params=array();
		$get=$_GET;
		foreach($get as $k=>$v){
			if($k!='token')
			$params[$this->db->escape($k)]=$this->db->escape($v);
		}
		$post=$_POST;
		foreach($post as $k=>$v){
			if($k!='token')
			$params[$this->db->escape($k)]=$this->db->escape($v);
		}

		return $params;
	}

	//杩囨护鍙傛暟
	private function clean($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$data[$this->clean($key)] = $this->clean($value);
			}
		} else {
			$data = stripslashes($data);
		}

		return $data;
	}
	/*---------------------------------Common-------------------------------------------------*/
}
