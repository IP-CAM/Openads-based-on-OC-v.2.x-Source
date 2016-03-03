<?php
class ControllerFbaccountEntry extends Controller {
	private $error = array();
 
	public function index() {
		$this->language->load('fbaccount/entry');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('fbaccount/entry');
		$this->load->model('user/user');
		$this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
		$this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');
		
		$this->document->addStyle(TPL_JS.'fancybox/jquery.fancybox.css?v=2.1.5');
        $this->document->addScript(TPL_JS.'fancybox/jquery.fancybox.pack.js?v=2.1.5');
		$this->getList();
	} 

	public function add() {
		$this->language->load('fbaccount/entry');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('fbaccount/entry');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('fbaccount/entry/add')) {
			$this->model_fbaccount_entry->addEntry($this->request->post);
			
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
						
			$this->response->redirect($this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('fbaccount/entry');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('fbaccount/entry');
		$this->load->model('catalog/product');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {

			if(isset($this->request->post['selected_ids']) && trim($this->request->post['selected_ids'])){
				
				$selected_ids = explode(",", trim($this->request->post['selected_ids']));
				if(is_array($selected_ids)){
					foreach ($selected_ids as $entry_id) {
						if((int)$entry_id){
							$tmp = array();
							if(!empty($this->request->post['_product_id']) && (int)$this->request->post['_product_id']){
								$tmp['product_id'] = (int)$this->request->post['_product_id'];
								$product_info = $this->model_catalog_product->getProduct($tmp['product_id']);
								if(!empty($product_info['name'])){
									$tmp['type'] = $product_info['name'];
								}
							}
							if(!empty($this->request->post['_user_id']) && $this->request->post['_user_id'] != '*'){
								$tmp['user_id'] = (int)$this->request->post['_user_id'];
							}

						    if(!empty($this->request->post['_artist_id']) && $this->request->post['_artist_id'] != '*'){
								$tmp['artist_id'] = (int)$this->request->post['_artist_id'];
							}
							if(isset($this->request->post['_status']) && $this->request->post['_status'] != '*'){
								$tmp['status'] = (int)$this->request->post['_status'];
							}
							if(isset($this->request->post['_is_clickbank']) && $this->request->post['_is_clickbank'] != '*'){
								$tmp['is_clickbank'] = (int)$this->request->post['_is_clickbank'];
							}
							if($tmp){
								$this->model_fbaccount_entry->editEntry($entry_id, $tmp);
							}else{
								continue;
							}
						}
					}
					die(json_encode(array('status'=>1,'msg'=>'Update Success!')));
				}else{
					die(json_encode(array('status'=>0,'msg'=>'Exception!')));
				}
			}else if($this->validateForm('fbaccount/entry/edit')){
				$this->model_fbaccount_entry->editEntry($this->request->get['entry_id'], $this->request->post);
				$this->session->data['success'] = $this->language->get('text_success');
				$url = '';
			  	if (isset($this->request->get['filter_entry_sn'])) {
					$url .= '&filter_entry_sn=' . $this->request->get['filter_entry_sn'];
				}
				if (isset($this->request->get['filter_entry_name'])) {
					$url .= '&filter_entry_name=' . urlencode(html_entity_decode($this->request->get['filter_entry_name'], ENT_QUOTES, 'UTF-8'));
				}
				if (isset($this->request->get['filter_product_id'])) {
					$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
				}
				if (isset($this->request->get['filter_user_id'])) {
					$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
				}

				if (isset($this->request->get['filter_artist_id'])) {
					$url .= '&filter_artist_id=' . $this->request->get['filter_artist_id'];
				}
				if (isset($this->request->get['filter_status'])) {
					$url .= '&filter_status=' . $this->request->get['filter_status'];
				}
				if (isset($this->request->get['filter_is_clickbank'])) {
					$url .= '&filter_is_clickbank=' . $this->request->get['filter_is_clickbank'];
				}
				if (isset($this->request->get['filter_posts'])) {
					$url .= '&filter_posts=' . (int)$this->request->get['filter_posts'];
				}
				if (isset($this->request->get['filter_s_posts'])) {
					$url .= '&filter_s_posts=' . (int)$this->request->get['filter_s_posts'];
				}
				if (isset($this->request->get['filter_p_posts'])) {
					$url .= '&filter_p_posts=' . (int)$this->request->get['filter_p_posts'];
				}
				$this->response->redirect($this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		}
		$this->getForm();
	}

	public function delete() { 
		$this->language->load('fbaccount/entry');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('fbaccount/entry');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $entry_id) {
				$this->model_fbaccount_entry->deleteEntry($entry_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
		  	if (isset($this->request->get['filter_entry_sn'])) {
				$url .= '&filter_entry_sn=' . (int)$this->request->get['filter_entry_sn'];
			}

			if (isset($this->request->get['filter_entry_name'])) {
				$url .= '&filter_entry_name=' . urlencode(html_entity_decode($this->request->get['filter_entry_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}
			if (isset($this->request->get['filter_user_id'])) {
				$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
			}	
			if (isset($this->request->get['filter_artist_id'])) {
				$url .= '&filter_artist_id=' . $this->request->get['filter_artist_id'];
			}
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			if (isset($this->request->get['filter_is_clickbank'])) {
				$url .= '&filter_is_clickbank=' . $this->request->get['filter_is_clickbank'];
			}
			if (isset($this->request->get['filter_posts'])) {
				$url .= '&filter_posts=' . (int)$this->request->get['filter_posts'];
			}
			if (isset($this->request->get['filter_s_posts'])) {
				$url .= '&filter_s_posts=' . (int)$this->request->get['filter_s_posts'];
			}
			if (isset($this->request->get['filter_p_posts'])) {
				$url .= '&filter_p_posts=' . (int)$this->request->get['filter_p_posts'];
			}
						
			$this->response->redirect($this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		$this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
		$this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
		$this->document->addScript(TPL_JS.'jquery.ajaxupload.js');
		$this->document->addStyle(TPL_JS.'formvalidation/dist/css/formValidation.css');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/formValidation.js');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/framework/bootstrap.min.js');
		$filter_column = false;
	  	if (isset($this->request->get['filter_entry_sn'])) {
			$filter_entry_sn = $this->request->get['filter_entry_sn'];
			$filter_column = true;
		} else {
			$filter_entry_sn = null;
		}
		
		if (isset($this->request->get['filter_entry_name'])) {
			$filter_entry_name = $this->request->get['filter_entry_name'];
			$filter_column = true;
		} else {
			$filter_entry_name = null;
		}

		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = $this->request->get['filter_product_id'];
			$filter_column = true;
		} else {
			$filter_product_id = null;
		}
		if (isset($this->request->get['filter_user_id'])) {
			$filter_user_id = $this->request->get['filter_user_id'];
			$filter_column = true;
		} else {
			$filter_user_id = null;
		}

		if (isset($this->request->get['filter_artist_id'])) {
			$filter_artist_id = $this->request->get['filter_artist_id'];
			$filter_column = true;
		} else {
			$filter_artist_id = null;
		}
		
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
			$filter_column = true;
		} else {
			$filter_status = null;
		}
		if (isset($this->request->get['filter_is_clickbank'])) {
			$filter_is_clickbank = $this->request->get['filter_is_clickbank'];
			$filter_column = true;
		} else {
			$filter_is_clickbank = null;
		}
		if (isset($this->request->get['filter_posts'])) {
			$filter_posts = $this->request->get['filter_posts'];
			$filter_column = true;
		} else {
			$filter_posts = null;
		}
		if (isset($this->request->get['filter_s_posts'])) {
			$filter_s_posts = $this->request->get['filter_s_posts'];
			$filter_column = true;
		} else {
			$filter_s_posts = null;
		}
		if (isset($this->request->get['filter_p_posts'])) {
			$filter_p_posts = $this->request->get['filter_p_posts'];
			$filter_column = true;
		} else {
			$filter_p_posts = null;
		}
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'f.date_added';
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
	  	if (isset($this->request->get['filter_entry_sn'])) {
			$url .= '&filter_entry_sn=' . (int)$this->request->get['filter_entry_sn'];
		}

		if (isset($this->request->get['filter_entry_name'])) {
			$url .= '&filter_entry_name=' . urlencode(html_entity_decode($this->request->get['filter_entry_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		}
		if (isset($this->request->get['filter_artist_id'])) {
			$url .= '&filter_artist_id=' . $this->request->get['filter_artist_id'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if (isset($this->request->get['filter_is_clickbank'])) {
			$url .= '&filter_is_clickbank=' . $this->request->get['filter_is_clickbank'];
		}
		if (isset($this->request->get['filter_posts'])) {
			$url .= '&filter_posts=' . (int)$this->request->get['filter_posts'];
		}
		if (isset($this->request->get['filter_s_posts'])) {
			$url .= '&filter_s_posts=' . (int)$this->request->get['filter_s_posts'];
		}
		if (isset($this->request->get['filter_p_posts'])) {
			$url .= '&filter_p_posts=' . (int)$this->request->get['filter_p_posts'];
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
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
   		);
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] , 'SSL')
   		);
   		$this->load->model('user/user');
   		$this->load->model('catalog/product');
   		$this->load->model('fbaccount/nophoto_status');
   		
		$data['add'] = $this->url->link('fbaccount/entry/add', 'token=' . $this->session->data['token'] , 'SSL');
		$data['delete'] = $this->url->link('fbaccount/entry/delete', 'token=' . $this->session->data['token'] , 'SSL');	
		$limit = $this->config->get('config_limit_admin');
		$data['entries'] = array();
		$filter_data = array(
			'filter_entry_name'		=> $filter_entry_name, 
			'filter_user_id' 	    => $filter_user_id, 
		    'filter_artist_id' 	    => $filter_artist_id, 
			'filter_status'         => $filter_status, 
			'filter_entry_sn'  	 	=> $filter_entry_sn,
			'filter_posts'          => $filter_posts,
			'filter_s_posts'        => $filter_s_posts,
			'filter_p_posts'		=> $filter_p_posts,
		    'filter_product_id'		=> $filter_product_id,
		    'filter_is_clickbank'	=> $filter_is_clickbank,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		
		$total = $this->model_fbaccount_entry->getTotalEntries($filter_data);
	
		$results = $this->model_fbaccount_entry->getEntries($filter_data);
 
    	foreach ($results as $result) {
			$action = array();
			$result['posts'] = (int)$result['s_posts']+(int)$result['p_posts']+(int)$result['m_posts'];
			if((int)$result['s_posts']){
				$result['s_posts'] = '<a target="_blank" href="'. $this->url->link('fbaccount/nophoto', 'token=' . $this->session->data['token'] . '&filter_entry=' .$result['entry_sn'] , 'SSL').'" >'.$result['s_posts'].'</a>';
			}

			if((int)$result['p_posts']){
				$result['p_posts'] = '<a target="_blank" href="'. $this->url->link('fbaccount/photo', 'token=' . $this->session->data['token'] . '&filter_entry=' .$result['entry_sn'] , 'SSL').'" >'.$result['p_posts'].'</a>';
			}
			if((int)$result['m_posts']){
				$result['m_posts'] = '<a target="_blank" href="'. $this->url->link('fbmessage/nophoto', 'token=' . $this->session->data['token'] . '&filter_entry=' .$result['entry_sn'] , 'SSL').'" >'.$result['m_posts'].'</a>';
			}
			if($result['status'] && $this->user->getAuthorId()){
				$action[] = array(
						'text' => $this->language->get('text_post'),
						'icon' => '<i class="fa fa-send"></i>',
						'href' => 'javascript:contribution(' . $result['entry_sn'].');' ,
				);
			}

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'icon' => '<i class="fa fa-pencil"></i>',
				'href' => $this->url->link('fbaccount/entry/edit', 'token=' . $this->session->data['token'] . '&entry_id=' . $result['entry_id'] , 'SSL')
			);
			$product = $this->model_catalog_product->getProduct($result['product_id']);
			$user = $this->model_user_user->getUser($result['user_id']);
			$artist = $this->model_user_user->getUser($result['artist_id']);
			$data['entries'][] = array(
				'entry_id'  		=> $result['entry_id'],
				'entry_sn'			=> $result['entry_sn'],
				'entry_name'     	=> $result['entry_name'],
                'entry_url'     	=> $result['entry_url'],
                'is_clickbank'		=> ($result['is_clickbank'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'product'     		=> empty($product['code']) ? '' : $product['code'].' '.$product['name'],
				'user'				=> empty($user['username']) ? '' : $user['nickname'],
			    'artist'			=> empty($artist['username']) ? '' : $artist['nickname'], 
				'status'     		=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'posts'				=> $result['posts'],
			    's_posts'			=> $result['s_posts'] ? $result['s_posts'] :0,
			    'p_posts'			=> $result['p_posts'] ? $result['p_posts'] :0,
			    'm_posts'			=> $result['m_posts'] ? $result['m_posts'] :0,
				'post_level' 		=> $result['post_level'],
				'selected'   	    => isset($this->request->post['selected']) && in_array($result['entry_id'], $this->request->post['selected']),
				'action'     	    => $action
			);
		}	
	
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['column_entry_sn'] = $this->language->get('column_entry_sn');
		$data['column_entry_name'] = $this->language->get('column_entry_name');
		$data['column_user'] = $this->language->get('column_user');
		$data['column_artist'] = $this->language->get('column_artist');
		$data['column_posts'] = $this->language->get('column_posts');
		$data['column_s_posts'] = $this->language->get('column_s_posts');
		$data['column_p_posts'] = $this->language->get('column_p_posts');
		$data['column_m_posts'] = $this->language->get('column_m_posts');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_product'] = $this->language->get('column_product');		
		$data['column_action'] = $this->language->get('column_action');
		$data['column_is_clickbank'] = $this->language->get('column_is_clickbank');
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_reset'] = $this->language->get('button_reset');
 
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
		if (isset($this->request->get['filter_entry_sn'])) {
			$url .= '&filter_entry_sn=' . (int)$this->request->get['filter_entry_sn'];
		}

		if (isset($this->request->get['filter_entry_name'])) {
			$url .= '&filter_entry_name=' . urlencode(html_entity_decode($this->request->get['filter_entry_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		}
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if (isset($this->request->get['filter_is_clickbank'])) {
			$url .= '&filter_is_clickbank=' . $this->request->get['filter_is_clickbank'];
		}
		if (isset($this->request->get['filter_posts'])) {
			$url .= '&filter_posts=' . (int)$this->request->get['filter_posts'];
		}
	    if (isset($this->request->get['filter_s_posts'])) {
			$url .= '&filter_s_posts=' . (int)$this->request->get['filter_s_posts'];
		}
		if (isset($this->request->get['filter_p_posts'])) {
			$url .= '&filter_p_posts=' . (int)$this->request->get['filter_p_posts'];
		}
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$data['sort_entry_sn'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=f.entry_sn' . $url, 'SSL');
		$data['sort_user'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=f.user_id' . $url, 'SSL');
		$data['sort_artist'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=f.artist_id' . $url, 'SSL');
		$data['sort_product'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=product' . $url, 'SSL');
		$data['sort_entry_name'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=f.entry_name' . $url, 'SSL');
		$data['sort_s_posts'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=s_posts' . $url, 'SSL');
		$data['sort_p_posts'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=p_posts' . $url, 'SSL');
		$data['sort_m_posts'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=m_posts' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=f.status' . $url, 'SSL');
		$data['sort_is_clickbank'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . '&sort=f.is_clickbank' . $url, 'SSL');
		$url = '';
		if (isset($this->request->get['filter_entry_sn'])) {
			$url .= '&filter_entry_sn=' . (int)$this->request->get['filter_entry_sn'];
		}
		if (isset($this->request->get['filter_entry_name'])) {
			$url .= '&filter_entry_name=' . urlencode(html_entity_decode($this->request->get['filter_entry_name'], ENT_QUOTES, 'UTF-8'));
		}		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		}
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if (isset($this->request->get['filter_is_clickbank'])) {
			$url .= '&filter_is_clickbank=' . $this->request->get['filter_is_clickbank'];
		}
		if (isset($this->request->get['filter_posts'])) {
			$url .= '&filter_posts=' . (int)$this->request->get['filter_posts'];
		}
	    if (isset($this->request->get['filter_s_posts'])) {
			$url .= '&filter_s_posts=' . (int)$this->request->get['filter_s_posts'];
		}
		if (isset($this->request->get['filter_p_posts'])) {
			$url .= '&filter_p_posts=' . (int)$this->request->get['filter_p_posts'];
		}
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		
		$pagination->url = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
					
		$data['all_markets'] = $this->model_user_user->getUsers();//market group
        $data['all_artists'] = $this->model_user_user->getAdOperators('photo');//artist group
	
		$data['filter_entry_name'] = $filter_entry_name;
		$data['filter_product_id'] = $filter_product_id;
		$data['filter_user_id'] = $filter_user_id;
		$data['filter_artist_id'] = $filter_artist_id;
		$data['filter_status'] = $filter_status;
		$data['filter_posts'] = $filter_posts;
		$data['filter_s_posts'] = $filter_s_posts;
		$data['filter_p_posts'] = $filter_p_posts;
		$data['filter_entry_sn'] = $filter_entry_sn;
		$data['filter_is_clickbank'] = $filter_is_clickbank;
		$data['filter_column'] = $filter_column ;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['token'] = $this->session->data['token'];

		$this->load->model('catalog/product');
        $data['all_products'] = $this->model_catalog_product->getProducts();
        $this->load->model('sns/option');
        $data['all_gender']=$this->model_sns_option->getOptionsByType('gender');
        $data['all_country']=$this->model_sns_option->getOptionsByType('country');
        $data['entry_posted_state'] = $this->language->get('entry_posted_state');	
		$data['entry_post_gender'] = $this->language->get('entry_post_gender');
		$data['entry_post_country'] = $this->language->get('entry_post_country');
		$data['entry_post_text'] = $this->language->get('entry_post_text');
		$data['entry_target_url'] = $this->language->get('entry_target_url');
		$data['entry_post_img'] = $this->language->get('entry_post_img');
		$data['entry_note'] = $this->language->get('entry_note');
		$data['entry_expired'] = $this->language->get('entry_expired');
		$data['text_img_delete'] = $this->language->get('text_img_delete');

		$data['error_post'] = $this->language->get('error_post');
      	$data['error_post_text'] = $this->language->get('error_post_text');
      	$data['error_target_url'] = $this->language->get('error_target_url');
      	$data['error_post_image'] = $this->language->get('error_post_image');

		$data['button_upload'] = $this->language->get('button_upload');
		$data['post_action'] = $this->url->link('fbaccount/entry/post','token='.$this->session->data['token'],'SSL');
        $data['post_dialog'] = $this->load->view('fbaccount/entry/post.tpl', $data);
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbaccount/entry/list.tpl', $data));
	}

	protected function getForm() {
		$this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
		$this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form'] = $this->language->get('text_edit');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_select'] = $this->language->get('text_select');

		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_user'] = $this->language->get('entry_auditor');
		$data['entry_artist'] = $this->language->get('entry_artist');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_entry_sn'] = $this->language->get('entry_entry_sn');
		$data['entry_entry_name'] = $this->language->get('entry_entry_name');
		$data['entry_entry_url'] = $this->language->get('entry_entry_url');
		$data['entry_cb_link'] = $this->language->get('entry_cb_link');
		$data['entry_is_clickbank'] = $this->language->get('entry_is_clickbank');
		$data['entry_note'] = $this->language->get('entry_note');
		
		$data['entry_post_level'] = $this->language->get('entry_post_level');
		$data['entry_maintain_level'] = $this->language->get('entry_maintain_level');
		$data['tab_posts'] = $this->language->get('tab_posts');
		$data['tab_general'] = $this->language->get('tab_general');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$this->load->model('user/user');			
		$data['all_markets'] = $this->model_user_user->getUsers();//market group
		$data['all_artists'] = $this->model_user_user->getAdOperators('photo');//artist group

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . $url, 'SSL'),
   		);

		$data['entry_id'] = false;						
		if (!isset($this->request->get['entry_id'])) { 
			$data['action'] = $this->url->link('fbaccount/entry/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['entry_id'] = $this->request->get['entry_id'];
			$data['action'] = $this->url->link('fbaccount/entry/edit', 'token=' . $this->session->data['token'] . '&entry_id=' . $this->request->get['entry_id'] . $url, 'SSL');
		}
		
		$data['cancel'] = $this->url->link('fbaccount/entry', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['entry_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$fbaccount_info = $this->model_fbaccount_entry->getEntry($this->request->get['entry_id']);
		}
		
		$data['token'] = $this->session->data['token'];
			
		if (isset($this->error['entry_sn'])) {
			$data['error_entry_sn'] = $this->error['entry_sn'];
		} else {
			$data['error_entry_sn'] = '';
		}
			
		if (isset($this->error['entry_name'])) {
			$data['error_entry_name'] = $this->error['entry_name'];
		} else {
			$data['error_entry_name'] = '';
		}
		
	   if (isset($this->error['entry_url'])) {
			$data['error_entry_url'] = $this->error['entry_url'];
		} else {
			$data['error_entry_url'] = '';
		}
		if (isset($this->error['user'])) {
			$data['error_user'] = $this->error['user'];
		} else {
			$data['error_user'] = '';
		}

		if (isset($this->error['cb_link'])) {
			$data['error_cb_link'] = $this->error['cb_link'];
		} else {
			$data['error_cb_link'] = '';
		}	
		if (isset($this->request->post['entry_sn'])) {
			$data['entry_sn'] = $this->request->post['entry_sn'];
		} elseif (!empty($fbaccount_info['entry_sn'])) {
			$data['entry_sn'] = $fbaccount_info['entry_sn'];
		} else {
			$data['entry_sn'] = '';
		}
		
		if (isset($this->request->post['entry_name'])) {
			$data['entry_name'] = $this->request->post['entry_name'];
		} elseif (!empty($fbaccount_info['entry_name'])) {
			$data['entry_name'] = $fbaccount_info['entry_name'];
		} else {
			$data['entry_name'] = '';
		}
		
		if (isset($this->request->post['product_id'])) {
			$data['product_id'] = $this->request->post['product_id'];
		} elseif (!empty($fbaccount_info['product_id'])) {
			$data['product_id'] = $fbaccount_info['product_id'];
		} else {
			$data['product_id'] = '';
		}
	
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (isset($fbaccount_info['status'])) {
			$data['status'] = $fbaccount_info['status'];
		} else {
			$data['status'] = 1;
		}
		
	    if (isset($this->request->post['entry_url'])) {
			$data['entry_url'] = $this->request->post['entry_url'];
		} elseif (!empty($fbaccount_info['entry_url'])) {
			$data['entry_url'] = $fbaccount_info['entry_url'];
		} else {
			$data['entry_url'] = '';
		}
		if (isset($this->request->post['is_clickbank'])) {
			$data['is_clickbank'] = $this->request->post['is_clickbank'];
		} elseif (!empty($fbaccount_info['is_clickbank'])) {
			$data['is_clickbank'] = $fbaccount_info['is_clickbank'];
		} else {
			$data['is_clickbank'] = 0;
		}
	    if (isset($this->request->post['cb_link'])) {
			$data['cb_link'] = $this->request->post['cb_link'];
		} elseif (!empty($fbaccount_info['cb_link'])) {
			$data['cb_link'] = $fbaccount_info['cb_link'];
		} else {
			$data['cb_link'] = '';
		}
		
		if (isset($this->request->post['note'])) {
			$data['note'] = $this->request->post['note'];
		} elseif (!empty($fbaccount_info['note'])) {
			$data['note'] = $fbaccount_info['note'];
		} else {
			$data['note'] = '';
		}

		if (isset($this->request->post['user_id'])) {
			$data['user_id'] = $this->request->post['user_id'];
		} elseif (!empty($fbaccount_info['user_id'])) {
			$data['user_id'] = $fbaccount_info['user_id'];
		} else {
			$data['user_id'] = '';
		}
		if (isset($this->request->post['artist_id'])) {
			$data['artist_id'] = $this->request->post['artist_id'];
		} elseif (!empty($fbaccount_info['artist_id'])) {
			$data['artist_id'] = $fbaccount_info['artist_id'];
		} else {
			$data['artist_id'] = '';
		}

		if (isset($this->request->post['post_level'])) {
			$data['post_level'] = $this->request->post['post_level'];
		} elseif (!empty($fbaccount_info)) {
			$data['post_level'] = $fbaccount_info['post_level'];
		} else {
			$data['post_level'] = 9;
		}
		if (isset($this->request->post['maintain_level'])) {
			$data['maintain_level'] = $this->request->post['maintain_level'];
		} elseif (!empty($fbaccount_info['maintain_level'])) {
			$data['maintain_level'] = $fbaccount_info['maintain_level'];
		} else {
			$data['maintain_level'] = 13;
		}
		$data['token'] = $this->session->data['token'];
		$this->load->model('catalog/product');
  		
        $data['all_products'] = $this->model_catalog_product->getProducts();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbaccount/entry/form.tpl', $data));
	}
	
	protected function validateForm($route) {
		if (!$this->user->hasPermission('modify', $route )) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if(isset($this->request->post['entry_sn']) && (utf8_strlen($this->request->post['entry_sn']) < 1) || (utf8_strlen($this->request->post['entry_sn']) > 12)){
			$this->error['entry_sn'] = $this->language->get('error_entry_sn');
		}
		if(isset($this->request->post['entry_sn'])){
			$users = is_array($this->config->get('sns_group_market')) ? $this->config->get('sns_group_market') : array();
			if(!in_array($this->user->getId(), $users)){
				$this->error['warning'] = $this->language->get('error_permission');
			}
		}
		if(isset($this->request->post['entry_name']) && (utf8_strlen($this->request->post['entry_name']) < 1) || (utf8_strlen($this->request->post['entry_name']) > 512)){
			$this->error['entry_name'] = $this->language->get('error_entry_name');
		}
		
		if(isset($this->request->post['is_clickbank']) && $this->request->post['is_clickbank']==1 && !isValidURL($this->request->post['cb_link'],'clickbank.net')){
			$this->error['cb_link'] = $this->language->get('error_cb_link');
		}
		if(!isset($this->request->post['user_id']) || !(int)$this->request->post['user_id']){
			$this->error['user'] = $this->language->get('error_user');
		}

		return (!$this->error);
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'fbaccount/entry/delete')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return (!$this->error) ;
	}	

	public function autocomplete() {
		$json = array();
		if (isset($this->request->get['filter_name'])) {
			$this->load->model('fbaccount/entry');
			$this->load->model('catalog/product');
			$data = array(
				'filter_entry' => $this->request->get['filter_name'],
				'filter_product_id' => isset($this->request->get['filter_product']) ? $this->request->get['filter_product'] : false,
				'start'       		=> 0,
				'limit'       		=> 20
			);
			$results = $this->model_fbaccount_entry->getEntries($data);
			foreach ($results as $result) {
				$product = $this->model_catalog_product->getProduct($result['product_id']);
				$json[] = array(
					'entry_id' 	=> $result['entry_id'], 
					'name'      => strip_tags(html_entity_decode($result['entry_name'], ENT_QUOTES, 'UTF-8')),
					'product'	=> empty($product['name']) ? '' : $product['name'],
					'value'    	=> $result['entry_sn']
				);	
			}
		}
		$sort_order = array();
		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}
		array_multisort($sort_order, SORT_ASC, $json);
		$this->response->setOutput(json_encode($json));
	}

	public function post(){
  		$mode = isset($this->request->post['mode']) ? strtolower($this->request->post['mode']) : false;
  		$entry_sn = isset($this->request->post['entry_sn']) ? $this->request->post['entry_sn'] : false;
  		$gender_id = isset($this->request->post['gender_id']) ? $this->request->post['gender_id'] : false;
  		$country_id = isset($this->request->post['country_id']) ? $this->request->post['country_id'] : false;
  		$expired = !empty($this->request->post['expired']) ? htmlspecialchars_decode($this->request->post['expired']) : false;
  		$target_url = isset($this->request->post['target_url']) ? htmlspecialchars_decode($this->request->post['target_url']) : false;
  		$content = !empty($this->request->post['content']) ? htmlspecialchars_decode($this->request->post['content']) : false;
  		$file = isset($this->request->post['file']) ? htmlspecialchars_decode($this->request->post['file']) : false;
  		$note = isset($this->request->post['note']) ? $this->request->post['note'] : false;
  		$this->language->load('fbaccount/entry');
  		$json = array();
  		if($entry_sn === false){
  			$json['error'] = array('entry_sn'=>$this->language->get('error_post'));
  		}
  		if($target_url === false || !isURL($target_url)){
			$json['error'] = array('target_url' => $this->language->get('error_target_url'));
  		}
  		if($content === false){
  			$json['error'] = array('content' => $this->language->get('error_post_text'));
  		}
		if($gender_id === false){
			$json['error'] = array('gender' =>$this->language->get('error_gender'));
  		}
 		if($country_id === false){
  			$json['error'] = array('country' => $this->language->get('error_country'));
  		}
  		$this->load->model('fbaccount/entry');
  		$entry = $this->model_fbaccount_entry->getEntryBySN($entry_sn);
  		if(empty($entry['product_id']) || !$entry['user_id']){
			$json['error'] = array('entry' => $this->language->get('error_product'));
  		}
  		$this->load->model('catalog/product');
  		$this->load->model('sns/option');
  		$precode = $this->model_catalog_product->getProductCode($entry['product_id'])
  				.$this->model_sns_option->getOptionValue($gender_id)
  				.$this->model_sns_option->getOptionValue($country_id)
  				.$this->user->getAuthorId();
  		if(strlen($precode)!=9){
  			$json['error'] = array('sn' => $this->language->get('error_sn'));
  		}
  		if(!isset($json['error'])){
	  		if($note){
	  			$note = json_encode(array(array(
	                'mode'		=> 'author',
	                'operator'	=> $this->user->getNickName(),
	                'entry_id'	=> $this->user->getId(),
	                'msg'		=> $note,
	                'time'		=> time()
	            )));
	  		}
	  		$data = array(
	            'entry_sn'		=> $entry_sn,
	            'precode'   	=> $precode,
	            'product_id'	=> $entry['product_id'],
	            'gender_id'		=> $gender_id,
	            'country_id'	=> $country_id,
	            'expired'		=> $expired,
	            'content'		=> $content,
	            'target_url'	=> $target_url,
	            'upload_files'	=> $file,
	            'is_clickbank'	=> $entry['is_clickbank'],
	            'note'			=> $note,
	            'mode'			=> $mode
	        );
	        if($this->model_fbaccount_entry->postContribute($data)){
	  			$this->session->data['success'] = $this->language->get('success_post');
	  			$json['success'] = $this->language->get('success_post');

	  		}
	  	}
	  	$this->response->setOutput(json_encode($json));
	}
}