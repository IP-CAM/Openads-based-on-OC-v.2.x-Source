<?php
class ControllerFbpageEntry extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('fbpage/entry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('fbpage/entry');

		$this->getList();
	}

	public function add() {
		$this->language->load('fbpage/entry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('fbpage/entry');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('fbpage/entry/add')) {
			$this->model_fbpage_entry->addEntry($this->request->post);

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

			$this->response->redirect($this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('fbpage/entry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('fbpage/entry');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {

			
			if(isset($this->request->post['selected_ids']) && trim($this->request->post['selected_ids'])){
				
				$selected_ids = explode(",", trim($this->request->post['selected_ids']));

				if(is_array($selected_ids)){
					foreach ($selected_ids as $entry_id) {
						if((int)$entry_id){
							$tmp = array();
							if(!empty($this->request->post['_config_id']) && $this->request->post['_config_id'] != '*'){
								$tmp['product_id'] = (int)$this->request->post['_config_id'];
							}
							if(!empty($this->request->post['_user_id']) && $this->request->post['_user_id'] != '*'){
								$tmp['user_id'] = (int)$this->request->post['_user_id'];
							}
							if(isset($this->request->post['_status']) && $this->request->post['_status'] != '*'){
								$tmp['status'] = (int)$this->request->post['_status'];
							}

							if(isset($this->request->post['_page_status']) && $this->request->post['_page_status'] != '*'){
								$tmp['page_status'] = (int)$this->request->post['_page_status'];
							}

							if(isset($this->request->post['_is_clickbank']) && $this->request->post['_is_clickbank'] != '*'){
								$tmp['is_clickbank'] = (int)$this->request->post['_is_clickbank'];
							}
							if(count($tmp)){
								$this->model_fbpage_entry->editEntry($entry_id, $tmp);
							}else{
								continue;
							}
						}
					}
					echo json_encode(array('status'=>1,'msg'=>'Update Success!','location'=>$location_url));
				}else{
					echo json_encode(array('status'=>0,'msg'=>'Exception!'));
				}
				exit;
			}else if($this->validateForm('fbpage/entry/edit')){
				$this->model_fbpage_entry->editEntry($this->request->get['entry_id'], $this->request->post);

				$this->session->data['success'] = $this->language->get('text_success');
					
				$this->response->redirect($this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('fbpage/entry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('fbpage/entry');

		if (isset($this->request->post['selected']) && $this->validateDelete('fbpage/entry/delete')) {
			foreach ($this->request->post['selected'] as $entry_id) {
				$this->model_fbpage_entry->deleteEntry($entry_id);
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
			if (isset($this->request->get['filter_page_status'])) {
				$url .= '&filter_page_status=' . $this->request->get['filter_page_status'];
			}
			if (isset($this->request->get['filter_is_clickbank'])) {
				$url .= '&filter_is_clickbank=' . $this->request->get['filter_is_clickbank'];
			}
			if (isset($this->request->get['filter_fans'])) {
				$url .= '&filter_fans=' . (int)$this->request->get['filter_fans'];
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

			$this->response->redirect($this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		$this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
		$this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
		$this->document->addScript(TPL_JS.'form.js');
		$this->document->addStyle(TPL_JS.'formvalidation/dist/css/formValidation.css');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/formValidation.js');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/framework/bootstrap.min.js');
		$filter_column = false;
		if (isset($this->request->get['filter_entry_sn'])) {
			$filter_entry_sn = $this->request->get['filter_entry_sn'];
			$filter_column = true ;
		} else {
			$filter_entry_sn = null;
		}

		if (isset($this->request->get['filter_entry_name'])) {
			$filter_entry_name = $this->request->get['filter_entry_name'];
			$filter_column = true ;
		} else {
			$filter_entry_name = null;
		}
		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = $this->request->get['filter_product_id'];
			$filter_column = true ;
		} else {
			$filter_product_id = null;
		}
		if (isset($this->request->get['filter_user_id'])) {
			$filter_user_id = $this->request->get['filter_user_id'];
			$filter_column = true ;
		} else {
			$filter_user_id = null;
		}
		if (isset($this->request->get['filter_artist_id'])) {
			$filter_artist_id = $this->request->get['filter_artist_id'];
			$filter_column = true ;
		} else {
			$filter_artist_id = null;
		}
		if (isset($this->request->get['filter_page_status'])) {
			$filter_page_status = $this->request->get['filter_page_status'];
			$filter_column = true ;
		} else {
			$filter_page_status = null;
		}
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
			$filter_column = true ;
		} else {
			$filter_status = null;
		}
		if (isset($this->request->get['filter_is_clickbank'])) {
			$filter_is_clickbank = $this->request->get['filter_is_clickbank'];
			$filter_column = true ;
		} else {
			$filter_is_clickbank = null;
		}
		if (isset($this->request->get['filter_fans'])) {
			$filter_fans = $this->request->get['filter_fans'];
			$filter_column = true ;
		} else {
			$filter_fans = null;
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
		if (isset($this->request->get['filter_page_status'])) {
			$url .= '&filter_page_status=' . $this->request->get['filter_page_status'];
		}
		if (isset($this->request->get['filter_is_clickbank'])) {
			$url .= '&filter_is_clickbank=' . $this->request->get['filter_is_clickbank'];
		}
		if (isset($this->request->get['filter_fans'])) {
			$url .= '&filter_fans=' . (int)$this->request->get['filter_fans'];
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
		);

		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] , 'SSL'),
      	);
  		$data['variation'] = $this->url->link('fbpage/entry/variation', 'token=' . $this->session->data['token'],'SSL');
  		$data['add'] = $this->url->link('fbpage/entry/add', 'token=' . $this->session->data['token'] , 'SSL');
  		$data['delete'] = $this->url->link('fbpage/entry/delete', 'token=' . $this->session->data['token'] , 'SSL');
  		$limit = 20;
  		$this->load->model('user/user');
  		$this->load->model('catalog/product');
  		$this->load->model('fbpage/nophoto_status');
  		$data['entries'] = array();
  		$filter_data = array(
			'filter_entry_name' => $filter_entry_name, 
			'filter_product_id'	=> $filter_product_id, 
			'filter_user_id' 	=> $filter_user_id, 
			'filter_status'     => $filter_status, 
		    'filter_page_status'=> $filter_page_status, 
			'filter_entry_sn'  	=> $filter_entry_sn,
			'filter_fans'       => $filter_fans,
		    'filter_is_clickbank'	=> $filter_is_clickbank,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
      	);

  		$total = $this->model_fbpage_entry->getTotalEntries($filter_data);
  		$results = $this->model_fbpage_entry->getEntries($filter_data);

  		foreach ($results as $result) {
  			$action = array();
  			
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
				'href' => $this->url->link('fbpage/entry/edit', 'token=' . $this->session->data['token'] . '&entry_id=' . $result['entry_id'] , 'SSL')
  			);
			if((int)$result['nposts']){
				$result['nposts'] = '<a target="_blank" href="'. $this->url->link('fbpage/photo', 'token=' . $this->session->data['token'] . '&filter_entry=' .$result['entry_sn'] , 'SSL').'" >'.$result['nposts'].'</a>';
			}
			$product = $this->model_catalog_product->getProduct($result['product_id']);
			$user = $this->model_user_user->getUser($result['user_id']);
			$artist = $this->model_user_user->getUser($result['artist_id']);
  			$data['entries'][] = array(
				'entry_id'  	=> $result['entry_id'],
				'entry_sn'		=> $result['entry_sn'],
				'entry_name'  	=> $result['entry_name'],
				'product'     	=> empty($product['code']) ? '' : $product['code'].' '.$product['name'],
				'fans'      	=> $result['fans'],
				'is_clickbank'	=> ($result['is_clickbank'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'user'			=> empty($user['username']) ? '' : $user['nickname'],
			    'artist'		=> empty($artist['username']) ? '' : $artist['nickname'],
				'status'     	=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
			    'page_status'   => $result['page_status'],//$this->model_fbpage_entry->getPageStatusNameByID($result['page_status']),
				'posts'			=> $result['posts'] ,
			    'nposts'		=> $result['nposts'],
				'post_level' 	=> $result['post_level'],
				'selected'   	=> isset($this->request->post['selected']) && in_array($result['entry_id'], $this->request->post['selected']),
				'action'     	=> $action
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
  		$data['column_is_clickbank'] = $this->language->get('column_is_clickbank');
  		$data['column_user'] = $this->language->get('column_user');
  		$data['column_artist'] = $this->language->get('column_artist');
  		$data['column_fans'] = $this->language->get('column_fans');
  		$data['column_posts'] = $this->language->get('column_posts');
  		$data['column_nposts'] = $this->language->get('column_nposts');
  		$data['column_status'] = $this->language->get('column_status');
  		$data['column_page_status'] = $this->language->get('column_page_status');
  		$data['column_product'] = $this->language->get('column_product');
  		$data['column_action'] = $this->language->get('column_action');
  		
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
  		if (isset($this->request->get['filter_artist_id'])) {
  			$url .= '&filter_artist_id=' . $this->request->get['filter_artist_id'];
  		}
  		if (isset($this->request->get['filter_status'])) {
  			$url .= '&filter_status=' . $this->request->get['filter_status'];
  		}
  		if (isset($this->request->get['filter_is_clickbank'])) {
  			$url .= '&filter_is_clickbank=' . $this->request->get['filter_is_clickbank'];
  		}
  		if (isset($this->request->get['filter_page_status'])) {
  			$url .= '&filter_page_status=' . $this->request->get['filter_page_status'];
  		}
  		if (isset($this->request->get['filter_fans'])) {
  			$url .= '&filter_fans=' . (int)$this->request->get['filter_fans'];
  		}

  		if ($order == 'ASC') {
  			$url .= '&order=DESC';
  		} else {
  			$url .= '&order=ASC';
  		}

  		if (isset($this->request->get['page'])) {
  			$url .= '&page=' . $this->request->get['page'];
  		}
  		$data['sort_artist'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=f.artist_id' . $url, 'SSL');
  		$data['sort_entry_sn'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=f.entry_sn' . $url, 'SSL');
  		$data['sort_user'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=f.user_id' . $url, 'SSL');
  		$data['sort_product'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=f.type' . $url, 'SSL');
  		$data['sort_entry_name'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=f.entry_name' . $url, 'SSL');
  		$data['sort_fans'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=f.fans' . $url, 'SSL');
  		$data['sort_posts'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=posts' . $url, 'SSL');
  		$data['sort_nposts'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=pposts' . $url, 'SSL');
  		$data['sort_status'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=f.status' . $url, 'SSL');
  		$data['sort_page_status'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=f.page_status' . $url, 'SSL');

  		$data['sort_is_clickbank'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . '&sort=f.is_clickbank' . $url, 'SSL');
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
  		if (isset($this->request->get['filter_page_status'])) {
  			$url .= '&filter_page_status=' . $this->request->get['filter_page_status'];
  		}
  		if (isset($this->request->get['filter_is_clickbank'])) {
  			$url .= '&filter_is_clickbank=' . $this->request->get['filter_is_clickbank'];
  		}
  		if (isset($this->request->get['filter_fans'])) {
  			$url .= '&filter_fans=' . (int)$this->request->get['filter_fans'];
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
  		$pagination->text = $this->language->get('text_pagination');
  		$pagination->url = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
  		 
  		$data['pagination'] = $pagination->render();
  		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

  		$this->load->model('user/user');
  		$data['all_markets'] = $this->model_user_user->getUsers();//market group
        $data['all_artists'] = $this->model_user_user->getAdOperators('photo');//artist group
        $data['all_page_status']=array();//$this->model_fbpage_entry->get_all_page_status();

        $data['filter_entry_name'] = $filter_entry_name;
        $data['filter_product_id'] = $filter_product_id;
        $data['filter_is_clickbank'] = $filter_is_clickbank;
        $data['filter_user_id'] = $filter_user_id;
        $data['filter_artist_id'] = $filter_artist_id;
        $data['filter_status'] = $filter_status;
        $data['filter_page_status'] = $filter_page_status;
        $data['filter_fans'] = $filter_fans;
        $data['filter_entry_sn'] = $filter_entry_sn;
        $data['filter_column'] = $filter_column ;
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['token'] = $this->session->data['token'];

        if(in_array($this->user->getId(), array_merge($this->config->get("sns_group_admin"),$this->config->get("sns_group_promotion")))){
        	$data['promotion'] = true;
        }else{
        	$data['promotion'] = false;
        }
        
        $data['all_products'] = $this->model_catalog_product->getProducts();
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
		$data['post_action'] = $this->url->link('fbpage/entry/post','token='.$this->session->data['token'],'SSL');
        $data['post_dialog'] = $this->load->view('fbpage/entry/post.tpl', $data);
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbpage/entry/list.tpl', $data));
	}

	protected function getForm() {
		$this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
		$this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = $this->language->get('text_form');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_select'] = $this->language->get('text_select');

		$data['entry_user'] = $this->language->get('entry_auditor');
		$data['entry_artist'] = $this->language->get('entry_artist');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_alias'] = $this->language->get('entry_alias');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_entry_sn'] = $this->language->get('entry_entry_sn');
		$data['entry_entry_name'] = $this->language->get('entry_entry_name');
		$data['entry_fans'] = $this->language->get('entry_fans');
		$data['entry_page_status'] = $this->language->get('entry_page_status');
		$data['entry_page_url'] = $this->language->get('entry_page_url');
		$data['entry_entry_url'] = $this->language->get('entry_entry_url');
		$data['entry_note'] = $this->language->get('entry_note');
		$data['entry_create_date'] = $this->language->get('entry_create_date');
		$data['entry_update_date'] = $this->language->get('entry_update_date');

		$data['entry_post_level'] = $this->language->get('entry_post_level');
		$data['entry_maintain_level'] = $this->language->get('entry_maintain_level');
		$data['entry_is_clickbank'] = $this->language->get('entry_is_clickbank');
		$data['tab_posts'] = $this->language->get('tab_posts');
		$data['tab_fans_chart'] = $this->language->get('tab_fans_chart');
		$data['tab_general'] = $this->language->get('tab_general');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['ago7days'] = date('Y-m-d',strtotime('-7 days'));

		$this->load->model('user/user');
		$this->load->model('catalog/product');
		$data['all_markets'] = $this->model_user_user->getUsers();//market group
		$data['all_artists'] = $this->model_user_user->getAdOperators('photo');//artist group
		$data['all_products'] = $this->model_catalog_product->getProducts();
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
			'href'      => $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . $url, 'SSL')
  		);

  		if (!isset($this->request->get['entry_id'])) {
  			$data['action'] = $this->url->link('fbpage/entry/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
  		} else {
  			$data['action'] = $this->url->link('fbpage/entry/edit', 'token=' . $this->session->data['token'] . '&entry_id=' . $this->request->get['entry_id'] . $url, 'SSL');
  		}

  		$data['cancel'] = $this->url->link('fbpage/entry', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['entry_id'] = false;
  		if (isset($this->request->get['entry_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
  			$data['entry_id'] = $this->request->get['entry_id'];
  			$fbpage_info = $this->model_fbpage_entry->getEntry($this->request->get['entry_id']);
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

  		if (isset($this->error['page_url'])) {
  			$data['error_page_url'] = $this->error['page_url'];
  		} else {
  			$data['error_page_url'] = '';
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
  		 
  		if (isset($this->request->post['entry_sn'])) {
  			$data['entry_sn'] = $this->request->post['entry_sn'];
  		} elseif (!empty($fbpage_info['entry_sn'])) {
  			$data['entry_sn'] = $fbpage_info['entry_sn'];
  		} else {
  			$data['entry_sn'] = '';
  		}

  		if (isset($this->request->post['entry_name'])) {
  			$data['entry_name'] = $this->request->post['entry_name'];
  		} elseif (!empty($fbpage_info['entry_name'])) {
  			$data['entry_name'] = $fbpage_info['entry_name'];
  		} else {
  			$data['entry_name'] = '';
  		}

  		if (isset($this->request->post['product_id'])) {
  			$data['product_id'] = $this->request->post['product_id'];
  		} elseif (!empty($fbpage_info['product_id'])) {
  			$data['product_id'] = $fbpage_info['product_id'];
  		} else {
  			$data['product_id'] = '';
  		}

  		if (isset($this->request->post['status'])) {
  			$data['status'] = $this->request->post['status'];
  		} elseif (isset($fbpage_info['status'])) {
  			$data['status'] = $fbpage_info['status'];
  		} else {
  			$data['status'] = 1;
  		}
  		if (isset($this->request->post['page_status'])) {
  			$data['page_status'] = $this->request->post['page_status'];
  		} elseif (isset($fbpage_info['page_status'])) {
  			$data['page_status'] = $fbpage_info['page_status'];
  		} else {
  			$data['page_status'] = 1;
  		}

  		if (isset($this->request->post['is_clickbank'])) {
  			$data['is_clickbank'] = $this->request->post['is_clickbank'];
  		} elseif (isset($fbaccount_info['is_clickbank'])) {
  			$data['is_clickbank'] = $fbaccount_info['is_clickbank'];
  		} else {
  			$data['is_clickbank'] = 0;
  		}
  		if (isset($this->request->post['fans'])) {
  			$data['fans'] = $this->request->post['fans'];
  		} elseif (!empty($fbpage_info['fans'])) {
  			$data['fans'] = $fbpage_info['fans'];
  		} else {
  			$data['fans'] = '';
  		}

  		if (isset($this->request->post['page_url'])) {
  			$data['page_url'] = $this->request->post['page_url'];
  		} elseif (!empty($fbpage_info['page_url'])) {
  			$data['page_url'] = $fbpage_info['page_url'];
  		} else {
  			$data['page_url'] = '';
  		}

  		if (isset($this->request->post['entry_url'])) {
  			$data['entry_url'] = $this->request->post['entry_url'];
  		} elseif (!empty($fbpage_info['entry_url'])) {
  			$data['entry_url'] = $fbpage_info['entry_url'];
  		} else {
  			$data['entry_url'] = '';
  		}

  		if (isset($this->request->post['note'])) {
  			$data['note'] = $this->request->post['note'];
  		} elseif (!empty($fbpage_info['note'])) {
  			$data['note'] = $fbpage_info['note'];
  		} else {
  			$data['note'] = '';
  		}

  		if (isset($this->request->post['artist_id'])) {
  			$data['artist_id'] = $this->request->post['artist_id'];
  		} elseif (!empty($fbaccount_info['artist_id'])) {
  			$data['artist_id'] = $fbaccount_info['artist_id'];
  		} else {
  			$data['artist_id'] = '';
  		}
  		if (isset($this->request->post['user_id'])) {
  			$data['user_id'] = $this->request->post['user_id'];
  		} elseif (!empty($fbpage_info['user_id'])) {
  			$data['user_id'] = $fbpage_info['user_id'];
  		} else {
  			$data['user_id'] = '';
  		}
  		if (isset($this->request->post['create_date'])) {
  			$data['create_date'] = $this->request->post['create_date'];
  		} elseif (!empty($fbpage_info['create_date'])) {
  			$data['create_date'] = $fbpage_info['create_date'];
  		} else {
  			$data['create_date'] = date('Y-m-d');
  		}
  		if (isset($this->request->post['update_date'])) {
  			$data['update_date'] = $this->request->post['update_date'];
  		} elseif (!empty($fbpage_info['update_date'])) {
  			$data['update_date'] = $fbpage_info['update_date'];
  		} else {
  			$data['update_date'] = date('Y-m-d');
  		}

  		if (isset($this->request->post['post_level'])) {
  			$data['post_level'] = $this->request->post['post_level'];
  		} elseif (!empty($fbpage_info['post_level'])) {
  			$data['post_level'] = $fbpage_info['post_level'];
  		} else {
  			$data['post_level'] = 9;
  		}
  		if (isset($this->request->post['maintain_level'])) {
  			$data['maintain_level'] = $this->request->post['maintain_level'];
  		} elseif (!empty($fbpage_info['maintain_level'])) {
  			$data['maintain_level'] = $fbpage_info['maintain_level'];
  		} else {
  			$data['maintain_level'] = 13;
  		}
  		$data['all_page_status']= array();//$this->model_fbpage_entry->get_all_page_status();

      	$data['token'] = $this->session->data['token'];
      		
      	$data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbpage/entry/form.tpl', $data));
	}

	public function fans_chart(){
		$this->load->model('fbpage/entry');
		$entry_sn = $entry_name = '';
		$fbpage_info = $this->model_fbpage_entry->getEntry($this->request->get['entry_id']);
		if($fbpage_info){
			$entry_sn = $fbpage_info['entry_sn'];
			$entry_name = $fbpage_info['entry_name'];
		}
		$data['token'] = $this->session->data['token'];
		$data['entry_sn'] = $entry_sn ;
		$data['entry_name'] = $entry_name ;

		$filter['dateStart'] = !empty($this->request->get['dateStart']) ? $this->request->get['dateStart'] : date('Y-m-d',strtotime("-7 days"));
		$filter['dateEnd'] = !empty($this->request->get['dateEnd']) ? $this->request->get['dateEnd'] : '';

		$fans_history = $this->model_fbpage_entry->getPageFansHistory($entry_sn,$filter);

		$data['fans_history']=json_encode($fans_history);
		$data['dateStart']=$filter['dateStart'];
		$data['dateEnd']	=$filter['dateEnd'];

		$this->response->setOutput($this->load->view('fbpage/entry/fans.tpl', $data));
	}

	public function update_page_fans(){
		$this->language->load('fbpage/entry');
		$data = array('status'=>0,'msg'=>$this->language->get('text_exception'));
		if(!_is_curl_installed()){
			$data['msg'] = $this->language->get('text_curl_error');
			die(json_encode($data));
		}
		$this->load->model('fbpage/entry');
		$result = $this->model_fbpage_entry->do_page_fans();

		if($result!==false){
			$data = $result;
			$errors = array();
			foreach ($result['error'] as $item) {
				$errors[] = $item['entry_sn'].' : '.$item['page_url'].' : '.$item['api_url'];
			}
			$data['msg'] = sprintf($this->language->get('text_update_likes'),$result['success'],count($result['error']),implode('<br>', $errors));
		}
		die(json_encode($data));
	}

	public function send(){
		$this->language->load('sale/contact');
		$json = array();
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$error = '';

			if (!$this->request->post['email']) {
				$error .= $this->language->get('error_email');
			}
			if (!$this->request->post['subject']) {
				$error .= $this->language->get('error_subject');
			}

			if (!$this->request->post['message']) {
				$error .= $this->language->get('error_message');
			}
			if($error){
				$json['error']	= $error;
			}
			$email = trim($this->request->post['email']);
			if (!$json) {
				$store_name = $this->language->get('store_name');
				if($email){
					$message  = '<html dir="ltr" lang="en">' . "\n";
					$message .= '  <head>' . "\n";
					$message .= '    <title>' . $this->request->post['subject'] . '</title>' . "\n";
					$message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
					$message .= '  </head>' . "\n";
					$message .= '  <body>' . html_entity_decode($this->request->post['message'], ENT_QUOTES, 'UTF-8') . '</body>' . "\n";
					$message .= '</html>' . "\n";
					$mail = new Mail();
					$mail->protocol = $this->config->get('config_mail_protocol');
					$mail->parameter = $this->config->get('config_mail_parameter');
					$mail->hostname = $this->config->get('config_smtp_host');
					$mail->username = $this->config->get('config_smtp_username');
					$mail->password = $this->config->get('config_smtp_password');
					$mail->port = $this->config->get('config_smtp_port');
					$mail->timeout = $this->config->get('config_smtp_timeout');
					$mail->setTo($email);
					$mail->setFrom($this->config->get('config_email'));
					$mail->setSender($store_name);
					$mail->setSubject(html_entity_decode($this->request->post['subject'], ENT_QUOTES, 'UTF-8'));
					$mail->setHtml($message);
					$mail->send();
					$json['success'] = $this->language->get('text_success');
				}
			}
			$this->response->setOutput(json_encode($json));
		}
	}

	public function variation(){
		$this->load->model('fbpage/entry');
		$entry_sn = !empty($this->request->get['entry_sn']) ? $this->request->get['entry_sn'] : false;
		$dateStart = !empty($this->request->get['dateStart']) ? $this->request->get['dateStart'] : false;
		$dateEnd = !empty($this->request->get['dateEnd']) ? $this->request->get['dateEnd'] : date('Y-m-d');
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.submited_date';
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
		
		$limit = 20 ;
		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit,
			'filter_entry_sn' 	=> $entry_sn
		);
		$data['variation'] = array();
		$total = $this->model_fbpage_entry->getTotalEntries($data);
		$results = $this->model_fbpage_entry->getEntries($data);
		if($results){
			foreach ($results as $result) {
				$tmp = array();
				$tmp['entry_sn'] = '['.$result['entry_sn'].'] '.$result['entry_name'];
				if(!empty($result['entry_sn'])){
					if(($startValue = $this->model_fbpage_entry->getDayFans($result['entry_sn'],$dateStart))!==false){
						$tmp['startValue'] = $startValue['fans_quantity'];
					}else{
						$tmp['startValue'] = '--';
					}
					if(($endValue = $this->model_fbpage_entry->getDayFans($result['entry_sn'],$dateEnd))!==false){
						$tmp['endValue'] = $endValue['fans_quantity'];
					}else{
						$tmp['endValue'] = '--';
					}
					if(is_numeric($startValue['fans_quantity']) && is_numeric($endValue['fans_quantity'])){
						$tmp['d-value'] = $endValue['fans_quantity'] - $startValue['fans_quantity'];
					}else{
						$tmp['d-value'] = '--';
					}
				}
				$data['variation'][] = $tmp;
			}
		}
		$url = '';
		if (isset($this->request->get['entry_sn'])) {
			$url .= '&entry_sn=' . (int)$this->request->get['entry_sn'];
		}
		if (isset($this->request->get['dateStart'])) {
			$url .= '&dateStart=' . $this->request->get['dateStart'];
		}
		if (isset($this->request->get['dateEnd'])) {
			$url .= '&dateEnd=' . $this->request->get['dateEnd'];
		}
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$data['sort_entry_sn'] = $this->url->link('fbpage/entry/variation', 'token=' . $this->session->data['token'] . '&sort=f.entry_sn' . $url, 'SSL');

		$data['dateStart'] = $dateStart;
		$data['dateEnd'] = $dateEnd;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['token'] = $this->session->data['token'];

		$url = '';
		if (isset($this->request->get['entry_sn'])) {
			$url .= '&entry_sn=' . (int)$this->request->get['entry_sn'];
		}
		if (isset($this->request->get['dateStart'])) {
			$url .= '&dateStart=' . $this->request->get['dateStart'];
		}
		if (isset($this->request->get['dateEnd'])) {
			$url .= '&dateEnd=' . $this->request->get['dateEnd'];
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
		$pagination->url = $this->url->link('fbpage/entry/variation', 'token=' . $this->session->data['token'] .$url. '&page={page}', 'SSL');
			
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

		$data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbpage/entry/variation.tpl', $data));
	}

	protected function validateForm($route) {
		if (!$this->user->hasPermission('modify', $route )) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if(isset($this->request->post['entry_sn']) && (utf8_strlen($this->request->post['entry_sn']) < 1) || (utf8_strlen($this->request->post['entry_sn']) > 12)){
			$this->error['entry_sn'] = $this->language->get('error_entry_sn');
		}
		if(isset($this->request->post['entry_sn'])){
			$users =$users = is_array($this->config->get('group_market')) ? $this->config->get('group_market') : array();
			if(!in_array($this->user->getId(), $users)){
				$this->error['warning'] = $this->language->get('error_permission');
			}
		}
		if(isset($this->request->post['entry_name']) && (utf8_strlen($this->request->post['entry_name']) < 1) || (utf8_strlen($this->request->post['entry_name']) > 512)){
			$this->error['entry_name'] = $this->language->get('error_entry_name');
		}
		
		if(isset($this->request->post['page_url']) && !isURL($this->request->post['page_url'])){
			$this->error['page_url']  = $this->language->get('error_page_url');
		}

		if(!isset($this->request->post['user_id']) || !(int)$this->request->post['user_id']){
			$this->error['user'] = $this->language->get('error_user');
		}
		return (!$this->error) ;
	}

	protected function validateDelete($route) {
		if (!$this->user->hasPermission('modify', $route)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function export(){
		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {

			$json = $tmp = $pages = array();
			$tmp[0]="Page ID,Page Name,Product Type Name,Page Status,Page URL"."\r\n";
			$this->load->model('fbpage/entry');
			$pages = $this->model_fbpage_entry->getEntries();

			$operator = '';
			if($pages){
				foreach ($pages as $ck => $item){
					if(!empty($item['entry_sn'])){
						$page_status_name = $this->model_fbpage_entry->getPageStatusNameByID($item['page_status']);
						$tmp[trim($item['entry_sn'])] = trim($item['entry_sn']).",".trim($item['entry_name']).",".trim($item['product']).",".$page_status_name.",".htmlspecialchars_decode(trim($item['page_url']))."\r\n";
					}else{
						$json['error'][] = $item['entry_id'].' Exception!';
						continue;
					}
				}
				if($tmp){
					$this->response->addheader('Pragma: public');
					$this->response->addheader('Expires: 0');
					$this->response->addheader('Content-Description: File Transfer');
					$this->response->addheader("Content-Type: application/force-download");
					$this->response->addheader("Content-Type: application/octet-stream");
					$this->response->addheader("Content-Type: application/download");
					$this->response->addheader('Content-Disposition: attachment; filename=' . date('YmdHis').'_Pages.csv');
					$this->response->addheader('Content-Transfer-Encoding: binary');
					$this->response->setOutput(implode("", $tmp));
				}
			}
		}
	}
	public function import_page(){
		$filename = isset($this->request->files['filename']['name']) ? trim($this->request->files['filename']['name']) : false;
		$token = $this->session->data['token'];
		$path_array = pathinfo($filename);
		$import_file = $this->request->files['filename']['tmp_name'];
		if(!isset($path_array['extension'])	|| $path_array['extension']!='csv'){
			die(json_encode(array('status'=>0,'msg'=>'Normal File Exception!')));
		}
		$this->load->model('fbpage/entry');

		$n=0;
		$page_list = array();
		$fp=fopen($import_file,'r');
		while ($data = fgetcsv($fp)) {
			$page_list[]=$data;
		}
		
		//$key1="entry_sn" ; $key2="entry_name"; $key3="page_url"; $key4="user_id"; $key5="product_id";
		array_shift($page_list);

		if(count($page_list)){
			$num=count($page_list);
            for($i=0;$i<$num;$i++){
            	
            	//$username=mb_convert_encoding($page_list[$i]['3'],"UTF-8","auto"); 
            	//$username=iconv("UTF-8","UTF-8//IGNORE",$page_list[$i]['3']) ;
            	
            	$user_id = $this->model_fbpage_entry->getUserIdByName($page_list[$i]['3']);
            	$product_id = $this->model_fbpage_entry->getProductConfigIdByProductName($page_list[$i]['4']);
            	$this->model_fbpage_entry->addPage($page_list[$i]['0'],$page_list[$i]['1'],$page_list[$i]['2'],$user_id,$product_id);
            	$n++;
            }
		}

		fclose($fp);
		die(json_encode(array('status'=>1,'msg'=>"You have import ".$n." pages.")));
	}

	public function post(){
  		$entry_sn = isset($this->request->post['entry_sn']) ? $this->request->post['entry_sn'] : false;
  		$expired = !empty($this->request->post['expired']) ? htmlspecialchars_decode($this->request->post['expired']) : false;
  		$target_url = isset($this->request->post['target_url']) ? htmlspecialchars_decode($this->request->post['target_url']) : false;
  		$content = !empty($this->request->post['content']) ? htmlspecialchars_decode($this->request->post['content']) : false;
  		$note = isset($this->request->post['note']) ? $this->request->post['note'] : false;
  		$this->language->load('fbpage/entry');
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
  		$this->load->model('fbpage/entry');
  		$entry = $this->model_fbpage_entry->getEntryBySN($entry_sn);
  		if(empty($entry['product_id']) || !$entry['user_id']){
			$json['error'] = array('entry' => $this->language->get('error_product'));
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
	            'product_id'	=> $entry['product_id'],
	            'is_clickbank'	=> $entry['is_clickbank'],
	            'expired'		=> $expired,
	            'content'		=> $content,
	            'target_url'	=> $target_url,
	            'note'			=> $note,
	        );
	        if($this->model_fbpage_entry->postContribute($data)){
	  			$this->session->data['success'] = $this->language->get('success_post');
	  			$json['success'] = $this->language->get('success_post');
	  			
	  		}
	  	}
	  	$this->response->setOutput(json_encode($json));
	}
}