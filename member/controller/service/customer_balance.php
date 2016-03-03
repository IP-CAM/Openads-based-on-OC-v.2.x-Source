<?php
class ControllerServiceCustomerBalance extends Controller {
	private $error = array();

  	public function index() {
		$this->language->load('service/customer_balance');
        $this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
		$this->document->addScript(TPL_JS.'datetimepicker/moment.js');
		$this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');
		
		
		$this->document->setTitle($this->language->get('heading_title'));
       
		$this->load->model('service/customer_balance');

    	$this->getForm();
  	}

	
  		protected function getForm(){
  		    if (isset($this->request->get['filter_type'])) {
	            $filter_type = $this->request->get['filter_type'];
	        } else {
	            $filter_type = null;
	        }
	
	        if (isset($this->request->get['filter_amount'])) {
	            $filter_amount = $this->request->get['filter_amount'];
	        } else {
	            $filter_amount = null;
	        }
  			if (isset($this->request->get['filter_advertise_id'])) {
	            $filter_advertise_id = $this->request->get['filter_advertise_id'];
	        } else {
	            $filter_advertise_id = null;
	        }
  		  	if (isset($this->request->get['filter_advertise_sn'])) {
	            $filter_advertise_sn = $this->request->get['filter_advertise_sn'];
	        } else {
	            $filter_advertise_sn = null;
	        }
  		    if (isset($this->request->get['filter_date_added'])) {
	            $filter_date_added = $this->request->get['filter_date_added'];
	        } else {
	            $filter_date_added = null;
	        }
  		    if (isset($this->request->get['sort'])) {
	            $sort = $this->request->get['sort'];
	        } else {
	            $sort = 'name';
	        }
	
	        if (isset($this->request->get['order'])) {
	            $order = $this->request->get['order'];
	        } else {
	            $order = 'ASC';
	        }
	
	        if (isset($this->request->get['page'])) {
	            $page = $this->request->get['page'];
	        } else {
	            $page = 1;
	        }
        
  		  $url = '';
  		    if (isset($this->request->get['filter_type'])) {
	            $url .= '&filter_type=' . $this->request->get['filter_type'];
	        }
	
	        if (isset($this->request->get['filter_amount'])) {
	            $url .= '&filter_amount=' . $this->request->get['filter_amount'];
	        }
  			if (isset($this->request->get['filter_advertise_id'])) {
	            $url .= '&filter_advertise_id=' . $this->request->get['filter_advertise_id'];
	        }
  		  	if (isset($this->request->get['filter_advertise_sn'])) {
	            $url .= '&filter_advertise_sn=' . $this->request->get['filter_advertise_sn'];
	        }
	        if (isset($this->request->get['filter_date_added'])) {
	            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
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
				'href' => $this->url->link('account/account')
	        );
	
	        $data['breadcrumbs'][] = array(
	            'text' => $this->language->get('heading_title'),
	            'href' => $this->url->link('service/customer_balance', '', 'SSL')
	        );
	        
	       $data['details'] = array();


	       
	       $filter_data = array(

	            'filter_type'              => $filter_type,
	            'filter_amount'            => $filter_amount,
	            'filter_advertise_id'      => $filter_advertise_id,
	            'filter_advertise_sn'      => $filter_advertise_sn,
	            'filter_date_added'        => $filter_date_added,	           
	            'sort'                     => $sort,
	            'order'                    => $order,
	            'start'                    => ($page - 1) * $this->config->get('config_limit_admin'),
	            'limit'                    => $this->config->get('config_limit_admin')
	        );
	
	        $customer_total = $this->model_service_customer_balance->getTotalBalanceDetails($filter_data);
	
	        $results = $this->model_service_customer_balance->getCustomerBalanceDetail($filter_data);
        
  		   foreach ($results as $result) {

	            $data['details'][] = array(
	                'customer_id'         => $result['customer_id'],
	                'type'                => $result['type'],
	                'advertise_id'        => $result['advertise_id'],
	                'advertise_sn'        => $result['advertise_sn'],
	                'priority_id'         => $result['priority_id'],
	                'from_priority'       => $result['from_priority'],
	                'priority_name'       => $result['name'],
	                'from_priority_name'  => $result['fromname'],
	                'amount'              => $this->currency->format($result['amount']),
	                'note'                => $result['note'],
	                'date_added'          => date('Y-m-d H:i:s', strtotime($result['date_added'])),
	                   );
	        }
        
  			$data['heading_title'] = $this->language->get('heading_title');
  			$data['text_form'] = $this->language->get('text_form');
  			$data['text_no_results'] = $this->language->get('text_no_results');
  			
  			$data['column_date_added'] = $this->language->get('column_date_added');
	        $data['column_operator'] = $this->language->get('column_operator');
	        $data['column_type'] = $this->language->get('column_type');
	        $data['column_advertise_id'] = $this->language->get('column_advertise_id');
	        $data['column_priority_id'] = $this->language->get('column_priority_id');
	        $data['column_amount'] = $this->language->get('column_amount');
	        $data['column_note'] = $this->language->get('column_note');
            $data['button_cancel'] = $this->language->get('button_cancel');
            $data['button_edit_balance'] = $this->language->get('button_edit_balance');
            
            $data['button_close'] = $this->language->get('button_close');
            $data['button_create'] = $this->language->get('button_create');
            
          
	        $data['action'] = $this->url->link('service/customer_balance', '', 'SSL');
	        
	        $data['button_filter'] = $this->language->get('button_filter');
	        $data['entry_type'] = $this->language->get('entry_type');
	        $data['entry_amount'] = $this->language->get('entry_amount');
	        $data['entry_advertise_id'] = $this->language->get('entry_advertise_id');
	        $data['entry_date_added'] = $this->language->get('entry_date_added');
	        $data['entry_username'] = $this->language->get('entry_username');
	        $data['entry_customer_name'] = $this->language->get('entry_customer_name');
            $data['entry_email'] = $this->language->get('entry_email');
            $data['entry_balance'] = $this->language->get('entry_balance');
            $data['entry_note'] = $this->language->get('entry_note');
	        $data['lang'] = $this->language->get('code');
	        
	        
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
	
	        if (isset($this->request->get['filter_type'])) {
	            $url .= '&filter_type=' . $this->request->get['filter_type'];
	        }
  	        if (isset($this->request->get['filter_amount'])) {
	            $url .= '&filter_amount=' . $this->request->get['filter_amount'];
	        }
  			if (isset($this->request->get['filter_advertise_id'])) {
	            $url .= '&filter_advertise_id=' . $this->request->get['filter_advertise_id'];
	        }
  		    if (isset($this->request->get['filter_advertise_sn'])) {
	            $url .= '&filter_advertise_sn=' . $this->request->get['filter_advertise_sn'];
	        }
	        if (isset($this->request->get['filter_date_added'])) {
	            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
	        }

 	        if ($order == 'ASC') {
	            $url .= '&order=DESC';
	        } else {
	            $url .= '&order=ASC';
	        }
	
	        if (isset($this->request->get['page'])) {
	            $url .= '&page=' . $this->request->get['page'];
	        } 

	        $data['sort_type'] = $this->url->link('service/customer_balance', '&sort=type' . $url, 'SSL');
	        $data['sort_advertise_sn'] = $this->url->link('service/customer_balance', '&sort=advertise_sn' . $url, 'SSL');
	        $data['sort_priority_id'] = $this->url->link('service/customer_balance', '&sort=priority_id' . $url, 'SSL');
  		    $data['sort_date_added'] = $this->url->link('service/customer_balance', '&sort=date_added' . $url, 'SSL');
  		 
	      $url = '';
	
	        if (isset($this->request->get['filter_type'])) {
	            $url .= '&filter_type=' . $this->request->get['filter_type'];
	        }
  	        if (isset($this->request->get['filter_amount'])) {
	            $url .= '&filter_amount=' . $this->request->get['filter_amount'];
	        }
  			if (isset($this->request->get['filter_advertise_id'])) {
	            $url .= '&filter_advertise_id=' . $this->request->get['filter_advertise_id'];
	        }
  		    if (isset($this->request->get['filter_advertise_sn'])) {
	            $url .= '&filter_advertise_sn=' . $this->request->get['filter_advertise_sn'];
	        }
	        if (isset($this->request->get['filter_date_added'])) {
	            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
	        }	        
	
  	        if (isset($this->request->get['sort'])) {
	            $url .= '&sort=' . $this->request->get['sort'];
	        }
	
	        if (isset($this->request->get['order'])) {
	            $url .= '&order=' . $this->request->get['order'];
	        }

	        $pagination = new Pagination();
	        $pagination->total = $customer_total;
	        $pagination->page = $page;
	        $pagination->limit = $this->config->get('config_limit_admin');
	        $pagination->url = $this->url->link('service/customer_balance', '&page={page}', 'SSL');
	
	        $data['pagination'] = $pagination->render();
	
	        $data['results'] = sprintf($this->language->get('text_pagination'), ($customer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($customer_total - $this->config->get('config_limit_admin'))) ? $customer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_total, ceil($customer_total / $this->config->get('config_limit_admin')));

	        $data['filter_type'] = $filter_type;
	        $data['filter_amount'] = $filter_amount;
	        $data['filter_advertise_id'] = $filter_advertise_id;
	        $data['filter_advertise_sn'] = $filter_advertise_sn;
            $data['filter_date_added'] = $filter_date_added;

            $data['base_infos'] =$this->model_service_customer_balance->getCustomerNameById($this->customer->getId());            
            //$data['current_balance']=$this->model_service_customer_balance->getCustomerBalanceTotal($this->customer->getId(),date('Y-m-d H:i:s'));
            $data['current_balance'] = $this->currency->format($this->customer->getBalance());
            $data['all_money_type']=array(1=>"1",2=>"2",3=>"3",4=>"4");
             $data['sort'] = $sort;
             $data['order'] = $order;
        
	        $data['header'] = $this->load->controller('common/header');
	        $data['column_left'] = $this->load->controller('common/column_left');
	        $data['footer'] = $this->load->controller('common/footer');
	
	        $this->response->setOutput($this->load->view('default/template/service/customer_balance_form.tpl', $data));
	        
  		}
	
}
?>