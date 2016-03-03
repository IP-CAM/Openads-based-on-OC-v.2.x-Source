<?php
class User {
	private $user_id;
	private $author_id;
	private $office_id;
	private $username;
	private $nickname;
	private $worker = array();
	private $roles = array();
	private $permission = array();
	private $menu_nodes = false;
	private $adroles = array();
	private $ignore = array(
			'common/home',
			'common/menu',
			'common/login',
			'common/reset',
			'common/footer',
			'common/header',
			'common/logout',			
			'common/private',
			'common/startup',
			'common/forgotten',
			'common/dashboard',
			'common/column_left',
			'common/filemanager',
			'error/not_found',
			'error/permission',
			'tool/common',
			'tool/cron',
			'user/user_log'
		);
	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->config = $registry->get('config');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['user_id'])) {
			$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");

			if ($user_query->num_rows) {
				$this->user_id = $user_query->row['user_id'];
				$this->author_id = $user_query->row['author_id'];
				$this->office_id = $user_query->row['office_id'];
				$this->username = $user_query->row['username'];
				$this->nickname = $user_query->row['nickname'];
				$this->worker = $user_query->row['worker'];
				$this->roles = $user_query->row['roles'];

				$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");

				$this->getAdRoles();
				$this->user_menu = $this->initUserMenu();
			} else {
				$this->logout();
			}
		}
	}

	public function login($username, $password) {
		$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");

		if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];

			$this->user_id = $user_query->row['user_id'];
			$this->author_id = $user_query->row['author_id'];
			$this->username = $user_query->row['username'];
			$this->nickname = $user_query->row['nickname'];
			$this->worker = $user_query->row['worker'];
			$this->roles = $user_query->row['roles'];
			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		unset($this->session->data['user_id']);

		$this->user_id = '';
		$this->author_id = '';
		$this->username = '';
		$this->nickname = '';
		$this->permission = array();
		$this->menu_nodes = false;
		$this->worker = null;
		$this->unlock();
	}

	public function unlock(){
		$this->db->update('advertise',array('locker'=>$this->getId()),array('locker'=>0));
        $this->db->update('advertise_targeting',array('locker'=>$this->getId()),array('locker'=>0));
        $this->db->update('advertise_post',array('locker'=>$this->getId()),array('locker'=>0));
        $this->db->update('advertise_photo',array('locker'=>$this->getId()),array('locker'=>0));
		$this->db->update('website',array('locker'=>$this->getId()),array('locker'=>0));
	}


	// discard
	public function hasPermission($value,$key='modify',$log=TRUE) {
		return true;
	}
	// discard

	public function isAllowed($route){
		if($this->getId() == 1) return true;
		$node = $this->db->fetch("menu",array('one'=>true,'condition'=>array('path'=>strtolower(trim($route)))));
		if(!empty($node['role'])){
			$_roles = explode(",",$node['role']);
			$pass = array();
			foreach($_roles as $_role){
				$pass[$_role] = $this->isRole($_role);
			}

			return in_array(true,$pass,true);
		}
		return true;
	}

	private function initUserMenu($node_id = null){
		$node = array();
		if($this->menu_nodes===false){
			$sql = "SELECT * FROM ".DB_PREFIX."menu ";
			if( $node_id !== null ) {           
				$sql .= ' WHERE parent_id='.(int)$node_id;
			}
			$sql .= ' ORDER BY `parent_id` ,`sort` ';
			$query = $this->db->query( $sql ); 
			if($query->num_rows){
				foreach($query->rows as $child ){
					$this->menu_nodes[$child['parent_id']][] = $child;  
				}
			}
		}
		
		if(isset($this->menu_nodes[(int)$node_id])){
			$data = $this->menu_nodes[(int)$node_id];
			
			foreach( $data as $menu ){
				if(!$menu['status']) continue;

				if($this->getId() != 1 && !empty($menu['path']) && $menu['auth']==1){
					$_roles = explode(",",$menu['role']);
					$pass = array();
					foreach($_roles as $_role){
						$pass[$_role] = $this->isRole($_role);
					}

					if( !in_array(true,$pass,true)){ continue;}
				}

				$title = $menu['title'];
				$languages = json_decode($menu['title'],true);
				if (is_array($languages) && !empty($languages[$this->config->get('config_language')])) {
					$title = $languages[$this->config->get('config_language')];
				}
				$tmp = array(
					'id'    => $menu['node_id'],
					'p_id'  => $menu['parent_id'],
					'key'   => $menu['key'],    
					'path'  => !empty($menu['path']) ? trim($menu['path']) : '',
					'name'  => $title,
					'status'=> $menu['status'],
					'auth'  => $menu['auth'],
					'sort'  => isset($menu['sort']) ? (int)$menu['sort'] : 0,
					'note'	=> $menu['note']
				);
				if(isset($this->menu_nodes[$menu['node_id']])){
					$tmp['children'] = $this->initUserMenu($menu['node_id']);
				} 
				$node[] = ($tmp); 
			}
			
			return $node;
		}       
		return;
	}

	public function getMenuNodes(){
		return $this->user_menu;
	}

	public function getIgnoreRoutes() {
		return $this->ignore;
	}

	public function isLogged() {
		return $this->user_id;
	}

	public function getId() {
		return $this->user_id;
	}
	public function getOfficeId() {
		return $this->office_id;
	}
	
	public function getUserName() {
		return $this->username;
	}

	public function getNickName() {
		return $this->nickname;
	}

	public function getAuthorId() {
		return $this->author_id;
	}	
	public function getWorkers(){
		$data = array();
		if(!empty($this->worker)){
			$workers = explode(",", $this->worker);
			if(is_array($workers)){
				foreach ($workers as $value) {
					if($value){
						$data[] = $value;
					}
				}
			}
		}
		return $data;
	}
	public function getCustomers(){
		$condition = array();
		if(!in_array($this->getId(), $this->config->get('ad_group_manager'))){
			$condition = array('in_charge'=>$this->getId());
		}
		return $this->db->fetch('customer',array('condition' => $condition));
	}

	public function getAdRoles(){

		return $this->adroles = array(
			'supervisor' 	=> in_array($this->getId(),$this->config->get('ad_group_supervisor')),
			'manager' 		=> in_array($this->getId(),$this->config->get('ad_group_manager')),
			'targeting' 	=> in_array($this->getId(),$this->config->get('ad_group_targeting')),
			'post' 			=> in_array($this->getId(),$this->config->get('ad_group_post')),
			'photo' 		=> in_array($this->getId(),$this->config->get('ad_group_photo')),
			'publisher' 	=> in_array($this->getId(),$this->config->get('ad_group_publisher')),
			'promoter' 		=> in_array($this->getId(),$this->config->get('ad_group_promoter')),
		);
	}
	public function isSupervisor(){
		return $this->isRole('supervisor');
	}
	public function isManager(){
		return $this->isRole('manager');
	}
	public function isTargeting(){
		return $this->isRole('targeting');
	}
	public function isPost(){
		return $this->isRole('post');
	}
	public function isPhoto(){
		return $this->isRole('photo');
	}
	public function isPublisher(){
		return $this->isRole('publisher');
	}
	public function isPromoter(){
		return $this->isRole('promoter');
	}
	public function isRole($key){
		return isset($this->adroles[strtolower($key)]) ? $this->adroles[strtolower($key)] : false;
	}
}