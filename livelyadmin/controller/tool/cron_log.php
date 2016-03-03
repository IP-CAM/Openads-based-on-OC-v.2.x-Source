<?php
class ControllerToolCronLog extends Controller {
	private $error = array();
 
	public function index() {
		$this->language->load('tool/cron_log');
 
		$this->document->setTitle($this->language->get('heading_title'));
 		
		$this->load->model('tool/cron_log');
		
		$this->getList();
	}
	

	public function delete() { 
		$this->language->load('tool/cron_log');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/cron_log');
		
		if (isset($this->request->post['selected']) && $this->validateDelete('tool/cron_log/delete')) {
      		foreach ($this->request->post['selected'] as $user_log_id) {
				$this->model_tool_cron_log->deleteLog($user_log_id);	
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
						
			$this->redirect($this->url->link('tool/cron_log', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	public function copy_template(){
		$this->load->model('tool/cron_log');
		$this->model_tool_cron_log->copyTargetingTemplate();
		
	}
	protected function getList() {
				


		if (isset($this->request->get['filter_action'])) {
			$filter_action = $this->request->get['filter_action'];
		} else {
			$filter_action = null;
		}

		
		if (isset($this->request->get['filter_log_time_start'])) {
			$filter_log_time_start = $this->request->get['filter_log_time_start'];
		} else {
			$filter_log_time_start = null;
		}
				
	if (isset($this->request->get['filter_contribute_id'])) {
			$filter_contribute_id = $this->request->get['filter_contribute_id'];
		} else {
			$filter_contribute_id = null;
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
		

			
		if (isset($this->request->get['filter_action'])) {
			$url .= '&filter_action=' . $this->request->get['filter_action'];
		}

	if (isset($this->request->get['filter_contribute_id'])) {
			$url .= '&filter_contribute_id=' . (int)$this->request->get['filter_contribute_id'];
		}
					
		if (isset($this->request->get['filter_log_time_start'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_start'];
		}
		if (isset($this->request->get['filter_log_time_end'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_end'];
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
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tool/cron_log', 'token=' . $this->session->data['token'] , 'SSL'),
      		'separator' => ' :: '
   		);
			
		$data['delete'] = $this->url->link('tool/cron_log/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['copy_template'] = $this->url->link('tool/cron_log/copy_template', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		
		$data['cron_logs'] = array();

		$filter_data = array(
			
			'filter_action'  => $filter_action,
			'filter_contribute_id'  => $filter_contribute_id,
			'filter_log_time_start' => $filter_log_time_start,
			'filter_log_time_end'	=> $filter_log_time_end,	
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
		
		$user_log_total = $this->model_tool_cron_log->getTotalLogs($filter_data);
		
		$results = $this->model_tool_cron_log->getLogs($filter_data);

		foreach ($results as $result) {

			$data['cron_logs'][] = array(
				'id' => $result['id'],
				
				'action'      => $result['action'],
				'contribute_id'      => $result['contribute_id'],
				'log_time'    => $result['added_date'],
				'selected'      => isset($this->request->post['selected']) && in_array($result['id'], $this->request->post['selected']),
				
			);
		}	
	
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_user_name'] = $this->language->get('column_user_name');
		$data['column_id'] = $this->language->get('column_id');
		$data['column_log_action'] = $this->language->get('column_log_action');
		$data['column_log_url'] = $this->language->get('column_log_url');
		$data['column_log_time'] = $this->language->get('column_log_time');
		$data['column_log_data'] = $this->language->get('column_data');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_delete'] = $this->language->get('button_delete');
 		$data['button_truncate'] = $this->language->get('button_truncate');
 		
 		$data['text_all_users'] = $this->language->get('text_all_users');

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
		
		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . $this->request->get['filter_id'];
		}
			
	if (isset($this->request->get['filter_contribute_id'])) {
			$url .= '&filter_contribute_id=' . (int)$this->request->get['filter_contribute_id'];
		}
		if (isset($this->request->get['filter_action'])) {
			$url .= '&filter_action=' . $this->request->get['filter_action'];
		}

					
		if (isset($this->request->get['filter_log_time_start'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_start'];
		}
		if (isset($this->request->get['filter_log_time_end'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_end'];
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
		$data['sort_id'] = $this->url->link('tool/cron_log', 'token=' . $this->session->data['token'] . '&sort=id' . $url, 'SSL');
		$data['sort_action'] = $this->url->link('tool/cron_log', 'token=' . $this->session->data['token'] . '&sort=action' . $url, 'SSL');
		$data['sort_contribute_id'] = $this->url->link('tool/cron_log', 'token=' . $this->session->data['token'] . '&sort=contribute_id' . $url, 'SSL');
		$data['sort_log_time'] = $this->url->link('tool/cron_log', 'token=' . $this->session->data['token'] . '&sort=log_time' . $url, 'SSL');
		
			
		$url = '';
		
		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . $this->request->get['filter_id'];
		}
			
	if (isset($this->request->get['filter_contribute_id'])) {
			$url .= '&filter_contribute_id=' . (int)$this->request->get['filter_contribute_id'];
		}
		if (isset($this->request->get['filter_action'])) {
			$url .= '&filter_action=' . $this->request->get['filter_action'];
		}

					
		if (isset($this->request->get['filter_log_time_start'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_start'];
		}
		if (isset($this->request->get['filter_log_time_end'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_end'];
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
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('tool/cron_log', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		
		$data['pagination'] = $pagination->render();				
        $data['results'] = sprintf($this->language->get('text_pagination'), ($user_log_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($user_log_total - $this->config->get('config_limit_admin'))) ? $user_log_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $user_log_total, ceil($user_log_total / $this->config->get('config_limit_admin')));
		

		$data['filter_log_time_start'] = $filter_log_time_start;
		$data['filter_log_time_end'] = $filter_log_time_end;
		$data['filter_contribute_id'] = $filter_contribute_id;
		
		$data['sort'] = $sort; 
		$data['order'] = $order;
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('tool/cron_log_list.tpl', $data));


 	}


	protected function validateDelete($route) {
		
		if (!$this->user->hasPermission('modify', $route)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	public function truncate(){
		$this->language->load('tool/cron_log');
		$json = array();
		if (!$this->user->hasPermission('modify', 'tool/cron_log/truncate')) {
			$json['warning'] = $this->language->get('error_permission');
		}
		if(!$json){
			$this->load->model('tool/cron_log');
			$this->model_tool_cron_log->truncate();
			$json['success'] = $this->language->get('text_success');
		}
		echo json_encode($json);
		exit;
	}
	

}