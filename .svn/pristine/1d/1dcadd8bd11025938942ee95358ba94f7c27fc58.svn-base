<?php
class ControllerFinanceCustomerBalance extends Controller {
	private $error = array();

  	public function index() {
		$this->language->load('finance/customer_balance');
		
		$this->document->setTitle($this->language->get('heading_title'));
       
		$this->load->model('finance/customer_balance');

    	$this->getList();
  	}

  	protected function getList() {

  	    if (isset($this->request->get['filter_username'])) {
            $filter_username = $this->request->get['filter_username'];
        } else {
            $filter_username = null;
        }

  	    if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }

        if (isset($this->request->get['filter_email'])) {
            $filter_email = $this->request->get['filter_email'];
        } else {
            $filter_email = null;
        }
        
	
		if (isset($this->request->get['filter_date_due'])) {
			$filter_date_due = $this->request->get['filter_date_due'];
		} else {
			$filter_date_due = date('Y-m-d H:i:s');
		}
	
  	    if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'username';
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
				
  	    if (isset($this->request->get['filter_username'])) {
            $url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

		
		if (isset($this->request->get['filter_date_due'])) {
			$url .= '&filter_date_due=' . $this->request->get['filter_date_due'];
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
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'] . $url, 'SSL'),
   		);

		$data['balances'] = array();

		$filter_data = array(
			'filter_username'       => $filter_username,
            'filter_name'              => $filter_name,
            'filter_email'             => $filter_email,
		    'filter_date_due'   	 => $filter_date_due,
			'sort'                   => $sort,
			'order'                  => $order,
			'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                  => $this->config->get('config_admin_limit')
		);

		$balance_total = $this->model_finance_customer_balance->getTotalCustomers($filter_data);

		$results = $this->model_finance_customer_balance->getCustomersInfo($filter_data);

    	foreach ($results as $result) {

        	$data['balances'][] = array(
        	    'customer_id'      	=> $result['customer_id'],
        	    'username'      	=> $result['username'],
				'customer'      	=> $result['name'],
				'balances'   => $this->currency->format($this->model_finance_customer_balance->getCustomerBalanceTotal($result['customer_id'],$filter_date_due)),
                'date_added'     => $this->model_finance_customer_balance->getLatestDealTime($result['customer_id']),
				'date_due'     => date('Y-m-d H:i:s', strtotime($filter_date_due)),
				'customer_email'    =>$result['email'],
        	    'edit'           => $this->url->link('finance/customer_balance/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, 'SSL'),
        	    
			);
		}
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_missing'] = $this->language->get('text_missing');
		$data['text_customer_balance'] = $this->language->get('text_customer_balance');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_username'] = $this->language->get('entry_username');
		$data['entry_date_due'] = $this->language->get('entry_date_due');
		
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_username'] = $this->language->get('column_username');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_email'] = $this->language->get('column_email');
    	$data['column_customer_id'] = $this->language->get('column_customer_id');
    	$data['column_date_due'] = $this->language->get('column_date_due');
    	$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_balance'] = $this->language->get('column_balance');
		$data['column_action'] = $this->language->get('column_action');
		$data['button_advanced'] = $this->language->get('button_advanced');
		$data['button_edit'] = $this->language->get('button_edit');


		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

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
  	    if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }
		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . $this->request->get['filter_customer_id'];
		}

		if (isset($this->request->get['filter_username'])) {
			$url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
		}
		
  	    if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
  	    if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_date_due'])) {
			$url .= '&filter_date_due=' . $this->request->get['filter_date_due'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		
		$data['sort_username'] = $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'] . '&sort=username' . $url, 'SSL');
		$data['sort_email'] = $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'] . '&sort=email' . $url, 'SSL');
		$data['sort_balance'] = $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'] . '&sort=amount' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'] . '&sort=date_added' . $url, 'SSL');
       
        $url = '';

  	    if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . $this->request->get['filter_customer_id'];
		}

		if (isset($this->request->get['filter_username'])) {
			$url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
		}
		
  	    if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
  	    if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_date_due'])) {
			$url .= '&filter_date_due=' . $this->request->get['filter_date_due'];
		}
		

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
        $pagination->total = $balance_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($balance_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($balance_total - $this->config->get('config_limit_admin'))) ? $balance_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $balance_total, ceil($balance_total / $this->config->get('config_limit_admin')));
		
        
		$data['filter_username'] = $filter_username;
        $data['filter_name'] = $filter_name;
        $data['filter_email'] = $filter_email;

		$data['filter_date_due'] = $filter_date_due;
		$data['sort'] = $sort;
		$data['order'] = $order;
		
		$data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('finance/customer_balance.tpl', $data));
  	}
  	
	    function edit(){
	       $this->load->language('finance/customer_balance');

           $this->document->setTitle($this->language->get('heading_title'));
           $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
           $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
          $this->load->model('finance/customer_balance');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
            $this->model_finance_customer_balance->editBalance($this->request->get['customer_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_user_id'])) {
                $url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
            }

           $this->response->redirect($this->url->link('finance/customer_balance/edit', 'token=' . $this->session->data['token'] . '&customer_id='.$this->request->get['customer_id'].$url, 'SSL'));
        }

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
	            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
	        );
	
	        $data['breadcrumbs'][] = array(
	            'text' => $this->language->get('heading_title'),
	            'href' => $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'] . $url, 'SSL')
	        );
	        
	       $data['details'] = array();

	       $con_customer_id=$this->request->get['customer_id'];
	       
	       $filter_data = array(
	            'customer_id'              => $con_customer_id,
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
	
	        $customer_total = $this->model_finance_customer_balance->getTotalBalanceDetails($filter_data);
	
	        $results = $this->model_finance_customer_balance->getCustomerBalanceDetail($filter_data);
        
  		   foreach ($results as $result) {
  		   	    
  		   	    $this->load->model('user/user');
                if($result['user_id']){
	                $username=$this->model_user_user->getUser($result['user_id']);
                }else{
                	$username['username']="Customer";
                }
	            $data['details'][] = array(
	                'customer_id'     => $result['customer_id'],
	                'user_id'         => $result['user_id'],
	                'username'        => $username['username'],
	                'type'            => $result['type'],
	                'advertise_id'    => $result['advertise_id'],
	                'advertise_sn'    => $result['advertise_sn'],
	                'from_priority'     => $result['from_priority'],
	                'priority_id'     => $result['priority_id'],
	                'priority_name'       => $result['name'],
	                'from_priority_name'  => $result['fromname'],
	                'amount'          => $this->currency->format($result['amount']),
	                'note'            => $result['note'],
	                'date_added'      => date('Y-m-d H:i:s', strtotime($result['date_added'])),
	                   );
	        }
        
  			$data['heading_title'] = $this->language->get('heading_title');
  			$data['text_form'] = $this->language->get('text_form');
  			$data['text_no_results'] = $this->language->get('text_no_results');
  			
  			$data['column_date_added'] = $this->language->get('column_date_added');
	        $data['column_operator'] = $this->language->get('column_operator');
	        $data['column_type'] = $this->language->get('column_type');
	        $data['column_advertise_id'] = $this->language->get('column_advertise_id');
	        $data['column_advertise_sn'] = $this->language->get('column_advertise_sn');
	        $data['column_priority_id'] = $this->language->get('column_priority_id');
	        $data['column_amount'] = $this->language->get('column_amount');
	        $data['column_note'] = $this->language->get('column_note');
            $data['button_cancel'] = $this->language->get('button_cancel');
            $data['button_edit_balance'] = $this->language->get('button_edit_balance');
            
            $data['button_close'] = $this->language->get('button_close');
            $data['button_create'] = $this->language->get('button_create');
            
            $data['cancel'] = $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'] . $url, 'SSL');
	        $data['action'] = $this->url->link('finance/customer_balance/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $con_customer_id.$url, 'SSL');
	        
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
	        
	        $data['token'] = $this->session->data['token'];
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

	        $data['sort_type'] = $this->url->link('finance/customer_balance/edit', 'token=' . $this->session->data['token'] .'&customer_id='.$con_customer_id. '&sort=type' . $url, 'SSL');
	        $data['sort_advertise_sn'] = $this->url->link('finance/customer_balance/edit', 'token=' . $this->session->data['token'] . '&customer_id='.$con_customer_id.'&sort=advertise_sn' . $url, 'SSL');
	        $data['sort_priority_id'] = $this->url->link('finance/customer_balance/edit', 'token=' . $this->session->data['token'] .'&customer_id='.$con_customer_id. '&sort=priority_id' . $url, 'SSL');
  		    $data['sort_date_added'] = $this->url->link('finance/customer_balance/edit', 'token=' . $this->session->data['token'] . '&customer_id='.$con_customer_id.'&sort=date_added' . $url, 'SSL');
  		 
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
	        $pagination->url = $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
	
	        $data['pagination'] = $pagination->render();
	
	        $data['results'] = sprintf($this->language->get('text_pagination'), ($customer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($customer_total - $this->config->get('config_limit_admin'))) ? $customer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_total, ceil($customer_total / $this->config->get('config_limit_admin')));

	        $data['filter_type'] = $filter_type;
	        $data['filter_amount'] = $filter_amount;
	        $data['filter_advertise_id'] = $filter_advertise_id;
	        $data['filter_advertise_sn'] = $filter_advertise_sn;
            $data['filter_date_added'] = $filter_date_added;

            $data['base_infos'] =$this->model_finance_customer_balance->getCustomerNameById($con_customer_id);            
            $data['current_balance']=$this->currency->format($this->model_finance_customer_balance->getCustomerBalanceTotal($con_customer_id,date('Y-m-d H:i:s')));
            $data['all_money_type']=array(1=>"1",2=>"2",3=>"3",4=>"4");
             $data['sort'] = $sort;
             $data['order'] = $order;
        
	        $data['header'] = $this->load->controller('common/header');
	        $data['column_left'] = $this->load->controller('common/column_left');
	        $data['footer'] = $this->load->controller('common/footer');
	
	        $this->response->setOutput($this->load->view('finance/customer_balance_form.tpl', $data));
	        
  		}
	
}
?>