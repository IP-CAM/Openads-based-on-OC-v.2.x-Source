<?php
class ControllerUserUserLog extends Controller {
	private $error = array();
 
	public function index() {
		$this->language->load('user/user_log');
 
		$this->document->setTitle($this->language->get('heading_title'));
 		
		$this->load->model('user/user_log');
		
		$this->getList();
	}
	
	public function view() {
		
		$this->language->load('user/user_log');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('user/user_log');

		$this->getForm();
	}

	public function delete() { 
		$this->language->load('user/user_log');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('user/user_log');
		
		if (isset($this->request->post['selected']) && $this->validateDelete('user/user_log/delete')) {
      		foreach ($this->request->post['selected'] as $user_log_id) {
				$this->model_user_user_log->deleteLog($user_log_id);	
			}
						
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->redirect($this->url->link('user/user_log', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
				
		if (isset($this->request->get['filter_user_id'])) {
			$filter_user_id = $this->request->get['filter_user_id'];
		} else {
			if(!$this->user->isSupervisor()){
				$filter_user_id = $this->user->getId();
			}else{
				$filter_user_id = null;
			}
		}

		if (isset($this->request->get['filter_action'])) {
			$filter_action = $this->request->get['filter_action'];
		} else {
			$filter_action = null;
		}
		
		if (isset($this->request->get['filter_url'])) {
			$filter_url = $this->request->get['filter_url'];
		} else {
			$filter_url = null;
		}
		
		if (isset($this->request->get['filter_log_time_start'])) {
			$filter_log_time_start = $this->request->get['filter_log_time_start'];
		} else {
			$filter_log_time_start = null;
		}
				
		if (isset($this->request->get['filter_log_time_end'])) {
			$filter_log_time_end = $this->request->get['filter_log_time_end'];
		} else {
			$filter_log_time_end = null;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'log_time';
		}
		 
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		}
			
		if (isset($this->request->get['filter_action'])) {
			$url .= '&filter_action=' . $this->request->get['filter_action'];
		}
		
		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . $this->request->get['filter_url'];
		}	
					
		if (isset($this->request->get['filter_log_time_start'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_start'];
		}
		if (isset($this->request->get['filter_log_time_end'])) {
			$url .= '&filter_log_time_end=' . $this->request->get['filter_log_time_end'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}	
	
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('user/user_log', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		$data['export'] = $this->url->link('user/user_log/export_logs', 'token=' . $this->session->data['token'] . $url, 'SSL');		
		$data['delete'] = $this->url->link('user/user_log/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['users'] = $this->model_user_user_log->getUsers();
		$data['user_logs'] = array();

		$filter_data = array(
			'filter_user_id' => $filter_user_id,
			'filter_action'  => $filter_action,
			'filter_url'	 => $filter_url,
			'filter_log_time_start' => $filter_log_time_start,
			'filter_log_time_end'	=> $filter_log_time_end,	
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$user_log_total = $this->model_user_user_log->getTotalLogs($filter_data);
		
		$results = $this->model_user_user_log->getLogs($filter_data);

		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('user/user_log/view', 'token=' . $this->session->data['token'] . '&user_log_id=' . $result['user_log_id'] . $url, 'SSL')
			);		
		
			$data['user_logs'][] = array(
				'user_log_id' => $result['user_log_id'],
				'username'    => $result['username'],
				'logaction'      => $result['action'],
				'url'         => $result['url'],
				'data'        => $result['data'],
				'log_time'    => $result['log_time'],
				'selected'      => isset($this->request->post['selected']) && in_array($result['user_log_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}	
	
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_user_name'] = $this->language->get('column_user_name');
		$data['column_log_action'] = $this->language->get('column_log_action');
		$data['column_log_url'] = $this->language->get('column_log_url');
		$data['column_log_time'] = $this->language->get('column_log_time');
		$data['column_log_data'] = $this->language->get('column_data');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_user'] = $this->language->get('entry_user');
		$data['entry_action'] = $this->language->get('entry_action');
		$data['entry_url'] = $this->language->get('entry_url');
		$data['entry_log_time_start'] = $this->language->get('entry_log_time_start');
		$data['entry_log_time_end'] = $this->language->get('entry_log_time_end');
		
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_delete'] = $this->language->get('button_delete');
 		$data['button_truncate'] = $this->language->get('button_truncate');
 		$data['button_reset'] = $this->language->get('button_reset');
 		$data['button_export'] = $this->language->get('button_export');
 		
 		$data['text_all_users'] = $this->language->get('text_all_users');
 		$this->load->model('user/user');			
		$data['all_users'] = $this->model_user_user->getUsers();
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
			
		$url = '';
		
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		}
			
		if (isset($this->request->get['filter_action'])) {
			$url .= '&filter_action=' . $this->request->get['filter_action'];
		}
		
		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . $this->request->get['filter_url'];
		}	
					
		if (isset($this->request->get['filter_log_time_start'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_start'];
		}
		if (isset($this->request->get['filter_log_time_end'])) {
			$url .= '&filter_log_time_end=' . $this->request->get['filter_log_time_end'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}	
	
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$data['token'] = $this->session->data['token'];
		$data['sort_username'] = $this->url->link('user/user_log', 'token=' . $this->session->data['token'] . '&sort=username' . $url, 'SSL');
		$data['sort_action'] = $this->url->link('user/user_log', 'token=' . $this->session->data['token'] . '&sort=action' . $url, 'SSL');
		$data['sort_url'] = $this->url->link('user/user_log', 'token=' . $this->session->data['token'] . '&sort=url' . $url, 'SSL');
		$data['sort_log_time'] = $this->url->link('user/user_log', 'token=' . $this->session->data['token'] . '&sort=log_time' . $url, 'SSL');
		
			
		$url = '';
		
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		}
			
		if (isset($this->request->get['filter_action'])) {
			$url .= '&filter_action=' . $this->request->get['filter_action'];
		}
		
		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . $this->request->get['filter_url'];
		}	
					
		if (isset($this->request->get['filter_log_time_start'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_start'];
		}
		if (isset($this->request->get['filter_log_time_end'])) {
			$url .= '&filter_log_time_end=' . $this->request->get['filter_log_time_end'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}	
				
		$pagination = new Pagination();
		$pagination->total = $user_log_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->url = $this->url->link('user/user_log', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		
		$data['pagination'] = $pagination->render();	

		$data['results'] = sprintf($this->language->get('text_pagination'), ($user_log_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($user_log_total - $this->config->get('config_limit_admin'))) ? $user_log_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $user_log_total, ceil($user_log_total / $this->config->get('config_limit_admin')));			

		$data['filter_user_id'] = $filter_user_id;
		$data['filter_action'] = $filter_action;
		$data['filter_url'] = $filter_url;
		$data['filter_log_time_start'] = $filter_log_time_start;
		$data['filter_log_time_end'] = $filter_log_time_end;
		$data['sort'] = $sort; 
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('user/user_log_list.tpl', $data));
 	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form'] = !isset($this->request->get['user_log_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
				
		$data['entry_user'] = $this->language->get('entry_user');
		$data['entry_action'] = $this->language->get('entry_action');
		$data['entry_url'] = $this->language->get('entry_url');
		$data['entry_data'] = $this->language->get('entry_data');
		$data['entry_log_time'] = $this->language->get('entry_log_time');
		
		$data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
			
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('user/user_log', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
			
		  
    	$data['cancel'] = $this->url->link('user/user_log', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['user_log_id']) && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$user_log_info = $this->model_user_user_log->getLog($this->request->get['user_log_id']);
			$last_log_info = $this->model_user_user_log->getLastLogInfo($user_log_info);
		}

		if (!empty($user_log_info)) {
			$data['username'] = $user_log_info['username'];
		} else {
			$data['username'] = '';
		}

		if (isset($user_log_info['url'])) {
			$data['url'] = $user_log_info['url'];
		} else { 
			$data['url'] = '';
		}

		if (isset($user_log_info['action'])) {
			$data['action'] = $user_log_info['action'];
		} else { 
			$data['action'] = '';
		}
		if (isset($user_log_info['data'])) {
			$data['data'] = $user_log_info['data'];
		} else { 
			$data['data'] = '';
		}
		
		if (isset($user_log_info['log_time'])) {
			$data['log_time'] = $user_log_info['log_time'];
		} else { 
			$data['log_time'] = '';
		}
		
		if (!empty($last_log_info['username'])) {
			$data['last_username'] = $last_log_info['username'];
		} else {
			$data['last_username'] = '';
		}

		if (!empty($last_log_info['action'])) {
			$data['last_action'] = $last_log_info['action'];
		} else {
			$data['last_action'] = '';
		}
		
		if (!empty($last_log_info['url'])) {
			$data['last_url'] = $last_log_info['url'];
		} else {
			$data['last_url'] = '';
		}
		
		if (!empty($last_log_info['data'])) {
			$data['last_data'] = $last_log_info['data'];
		} else {
			$data['last_data'] = '';
		}
		
		if (!empty($last_log_info['log_time'])) {
			$data['last_log_time'] = $last_log_info['log_time'];
		} else {
			$data['last_log_time'] = '';
		}
	
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
				
		$this->response->setOutput($this->load->view('user/user_log_form.tpl', $data));
	}

	protected function validateDelete($route) {
		
		if (!$this->user->hasPermission( $route)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	public function truncate(){
		$this->language->load('user/user_log');
		$json = array();
		if (!$this->user->hasPermission( 'user/user_log/truncate')) {
			$json['warning'] = $this->language->get('error_permission');
		}
		if(!$json){
			$this->load->model('user/user_log');
			$this->model_user_user_log->truncate();
			$json['success'] = $this->language->get('text_success');
		}
		echo json_encode($json);
		exit;
	}
	
	public function export_logs(){
		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
			$operator = !empty($this->request->post['operator']) ? (int)$this->request->post['operator'] : 0;
			$start_date = !empty($this->request->post['date_start']) ? date('Y-m-d H:i',strtotime($this->request->post['date_start'])) : '';
			$end_date = !empty($this->request->post['date_end']) ? date('Y-m-d H:i',strtotime($this->request->post['date_end'])) : '';
			$filter['start'] = 0;
			$filter['filter_all'] = true;
			if($operator){
				$filter['filter_user_id'] = $operator;
			}
			if(!empty($start_date)){
				$filter['filter_log_time_start'] = $start_date;
			}
			if(!empty($end_date)){
				$filter['filter_log_time_end'] = $end_date;
			}
		
			$this->load->model('user/user_log');
			$total_logs = $this->model_user_user_log->getTotalLogs($filter);
			if($total_logs){
				$fileName=date('YmdHis').'_User_Logs.xls';
				$n = 0;
				$tmp = array();
				$tmp[] = "Log ID\tLog Time\tOperator\tAction\tURL\tData\r\n";;
				$logs = $this->model_user_user_log->getLogs($filter);
				foreach ($logs as $k => $log){
					if(is_array($log)){
						$tmp[] = implode("\t", array(
									$log['user_log_id'],
									$log['log_time'],
									$log['lastname'].$log['firstname']." [".$log['username']."]",
									$log['action'],
									$log['url'],
									preg_replace("/\s+/","",strip_tags($log['data']))."\r\n"
								));
						$n++;
					}
				}
				if($tmp){
                    $this->response->addheader('Pragma: public');
                    $this->response->addheader('Expires: 0');
                    $this->response->addheader('Content-Description: File Transfer');
                    $this->response->addheader("Content-Type: application/force-download"); 
                    $this->response->addheader("Content-Type: application/octet-stream"); 
                    $this->response->addheader("Content-Type: application/download"); 
                    $this->response->addheader("Content-Type: application/vnd.ms-excel"); 
                    $this->response->addheader('Content-Disposition: attachment; filename=' .$fileName);
                    $this->response->addheader('Content-Transfer-Encoding: binary');
                    $this->response->setOutput(implode("", $tmp));
                }
			}
		}
	}
}