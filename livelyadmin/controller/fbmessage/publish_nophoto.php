<?php
class ControllerFbmessagePublishNophoto extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('fbmessage/publish_nophoto');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('fbmessage/publish_nophoto');

		$this->getList();
	}

	public function bulk() {
		$this->language->load('fbmessage/publish_nophoto');

		$this->load->model('fbmessage/publish_nophoto');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
			$failed = $finished =  array();
			if(isset($this->request->post['selecteds']) && trim($this->request->post['selecteds'])){
				
				$selecteds = explode(",", trim($this->request->post['selecteds']));
				if(is_array($selecteds)){
					foreach ($selecteds as $contribute_id) {
						if((int)$contribute_id){
							$msg_info = $this->model_fbmessage_publish_nophoto->getContribute($contribute_id);

							if(isset($this->request->get['delete']) && $this->request->get['delete']){
								$finished[] = $contribute_id;
							}else{
								$tmp = array();
								if(isset($this->request->post['_status']) && $this->request->post['_status'] != '*'){
									$tmp['status'] = (int)$this->request->post['_status'];
								}
								if(isset($this->request->post['_publish']) && $this->request->post['_publish'] != '*'){
									$tmp['publish'] = (int)$this->request->post['_publish'];
								}
								if(count($tmp)){
									$tmp['contribute_id']   = (int)$contribute_id;
									
									if(!$this->model_fbmessage_publish_nophoto->editContribute($tmp,'bulk')){
										$failed[$contribute_id] = $msg_info['contribute_sn'];
										continue;
									}
								}else{
									$failed[$contribute_id] = $msg_info['contribute_sn'];
									continue;
								}
								$finished[] = $contribute_id;
							}
						}
					}					
				}
			}
			$msg = $failed ? sprintf($this->language->get('text_permission_data'),implode(",", $failed)): '';
			if($finished){
				$this->session->data['success'] = sprintf($this->language->get('text_approve_success'),implode(",", $finished)).$msg;
				die(json_encode(array('status'=>1,'msg'=>'Update Success!')));
			}else{
				die(json_encode(array('status'=>0,'msg'=>$msg)));
			}			
		}
	}
	public function delete() {
		$this->language->load('fbmessage/publish_nophoto');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('fbmessage/publish_nophoto');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $post_id) {
				$this->model_fbmessage_publish_nophoto->deleteContribute($post_id);
			}

			$this->session->data['success'] = sprintf($this->language->get('text_delete_success'),$this->request->post['selected'] );
			$url = '';
			if (isset($this->request->get['filter_entry'])) {
				$url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['filter_contribute_sn'])) {
				$url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
			}
			if (isset($this->request->get['filter_publish'])) {
				$url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
			}
	        if (isset($this->request->get['filter_author_id'])) {
	            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
	        }			
			if (isset($this->request->get['filter_user_id'])) {
				$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
			}
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
			$this->response->redirect($this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'fbmessage/publish_nophoto/delete')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error ;
	}

	protected function getList() {
		$this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
		$this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
		$filter_column = false;

		if (isset($this->request->get['filter_entry'])) {
			$filter_entry = $this->request->get['filter_entry'];
			$filter_column = true;
		} else {
			$filter_entry = null;
		}

		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = (int)$this->request->get['filter_product_id'];
			$filter_column = true;
		} else {
			$filter_product_id = null;
		}

		if (isset($this->request->get['filter_author'])) {
			$filter_author = $this->request->get['filter_author'];
			$filter_column = true;
		} else {
			$filter_author = null;
		}

		if (isset($this->request->get['filter_contribute_sn'])) {
			$filter_contribute_sn = $this->request->get['filter_contribute_sn'];
			$filter_column = true;
		} else {
			$filter_contribute_sn = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$filter_date_modified = $this->request->get['filter_date_modified'];
			$filter_column = true;
		} else {
			$filter_date_modified = null;
		}

		if (isset($this->request->get['filter_publish'])) {
			$filter_publish = (int)$this->request->get['filter_publish'];
			$filter_column = true;
		} else {
			$filter_publish = null;
		}

		if (isset($this->request->get['filter_user_id'])) {
			$filter_user_id = (int)$this->request->get['filter_user_id'];
			$filter_column = true;
		} else {
			$filter_user_id = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = (int)$this->request->get['filter_status'];
			$filter_column = true;
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'mc.contribute_id';
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
		if (isset($this->request->get['filter_entry'])) {
			$url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_contribute_sn'])) {
			$url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_publish'])) {
			$url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
		}
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
		$this->load->model('fbaccount/entry');
		$this->load->model('user/user');
		$data['all_markets'] = $this->model_user_user->getUsers();//market group
		$this->load->model('catalog/product');
		$data['all_products'] = $this->model_catalog_product->getProducts();

		$this->load->model('fbmessage/nophoto_status');
		$data['post_statuses'] = $this->model_fbmessage_nophoto_status->getStatuses();
		$this->load->model('fbmessage/nophoto_publish');
		$data['post_publishes'] = $this->model_fbmessage_nophoto_publish->getPublishes();

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] , 'SSL'),
        );
        $data['delete'] = $this->url->link('fbmessage/publish_nophoto/delete', 'token=' . $this->session->data['token'].$url , 'SSL');
		$limit = 20;
        $data['contributes'] = array();

        $filter_data = array(
            'filter_entry'          => $filter_entry,           
            'filter_user_id'        => $filter_user_id,
            'filter_contribute_sn'  => $filter_contribute_sn,
            'filter_product_id'  	=> $filter_product_id,
            'filter_author'       	=> $filter_author,
            'filter_status'         => $filter_status,
            'filter_publish'        => $filter_publish,
            'filter_date_modified'  => $filter_date_modified,
            'sort'                  => $sort,
            'order'                 => $order,
            'start'                 => ($page - 1) * $limit,
            'limit'                 => $limit
        );

        $total = $this->model_fbmessage_publish_nophoto->getTotalContributes($filter_data);

        $results = $this->model_fbmessage_publish_nophoto->getContributes($filter_data);

        foreach ($results as $result) {
        	$action = array();
        	$lock = (!empty($result['locker']) && $result['locker']!=$this->user->getId()) ? true :false ;
        	if($lock){
        		$action[] = array(
                'text' => $this->language->get('text_readonly'),
                'href' => $this->url->link('fbmessage/publish_nophoto/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')
        		);
        	}else{
        		$action[] = array(
                	'text' => $this->language->get('text_edit'),
                	'href' => $this->url->link('fbmessage/publish_nophoto/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')
        		);
        	}

        	$_status = $this->model_fbmessage_nophoto_status->getStatus($result['status']);
        	if(in_array($result['status'], $this->config->get('fbmessage_auditor_status'))){
        		$status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : '<b style="color:blue">'.$_status['name'].'</b>' ;
        	}else{
        		$status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'];
        	}

        	$_publish = $this->model_fbmessage_nophoto_publish->getPublish($result['publish']);
        	if(in_array($result['publish'], $this->config->get('fbmessage_auditor_publish'))){
        		$publish_text = empty($_publish['name']) ? $this->language->get('text_exception_red') : '<b style="color:blue">'.$_publish['name'].'</b>' ;
        	}else{
        		$publish_text = empty($_publish['name']) ? $this->language->get('text_exception_red') : $_publish['name'];
        	}
        	 
        	$product = $this->model_catalog_product->getProduct($result['product_id']);
        	$entry = $this->model_fbaccount_entry->getEntryBySN($result['entry_sn']);
        	$author = $this->model_user_user->getUserByAuthorId($result['author_id']);
        	$auditor = $this->model_user_user->getUser($result['user_id']);
        	$data['contributes'][] = array(
                'contribute_id' => $result['contribute_id'],
                'contribute_sn' => $result['contribute_sn'] ,
                'entry_sn'      => $result['entry_sn'],
                'entry_name'    => empty($entry['entry_name']) ? '' : $entry['entry_name'] ,
                'product'       => empty($product['name']) ? '' : $product['code'].' '.$product['name'],
                'status_text'   => $status_text,
                'publish_text'  => $publish_text,
                'author'        => empty($author['nickname']) ? '' : $author['nickname'],
                'auditor'       => empty($auditor['nickname']) ? '' : $auditor['nickname'],
                'lock'          => $lock,
                'submited_date' => date('Y-m-d', strtotime($result['submited_date'])).'<br>'.date('H:i:s',strtotime($result['submited_date'])),
                'date_modified' => date('Y-m-d', strtotime($result['date_modified'])).'<br>'.date('H:i:s',strtotime($result['date_modified'])),
                'note'          => !empty($result['note']) ? trim($result['note']) : false,
                'selected'      => isset($this->request->post['selected']) && in_array($result['contribute_id'], $this->request->post['selected']),
                'action'        => $action
        	);
        }
             
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_list'] = $this->language->get('text_list');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['column_product'] = $this->language->get('column_product');
        $data['column_contribute_sn'] = $this->language->get('column_contribute_sn');
        $data['column_entry'] = $this->language->get('column_entry');
        $data['column_auditor'] = $this->language->get('column_auditor');
        $data['column_author'] = $this->language->get('column_author');
        $data['column_submited_date'] = $this->language->get('column_submited_date');
        $data['column_date_modified'] = $this->language->get('column_date_modified');
        $data['column_publish'] = $this->language->get('column_publish');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_export'] = $this->language->get('button_export');
        $data['button_import'] = $this->language->get('button_import');
        $data['button_bulk'] = $this->language->get('button_bulk');
        $data['button_copy'] = $this->language->get('button_copy');

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

        if (isset($this->session->data['warning'])) {
        	$data['error_warning'] = $this->session->data['warning'];

        	unset($this->session->data['warning']);
        } else {
        	$data['error_warning'] = '';
        }

        $url = '';
        if (isset($this->request->get['filter_entry'])) {
        	$url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_author'])) {
        	$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
        	$url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
        	$url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_product_id'])) {
        	$url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }
        if (isset($this->request->get['filter_publish'])) {
        	$url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['filter_user_id'])) {
        	$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_status'])) {
        	$url .= '&filter_status=' . (int)$this->request->get['filter_status'];
        }
        if ($order == 'ASC') {
        	$url .= '&order=DESC';
        } else {
        	$url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
        	$url .= '&page=' . $this->request->get['page'];
        }
        $data['sort_product'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . '&sort=mc.product_id' . $url, 'SSL');
        $data['sort_contribute_sn'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . '&sort=mc.contribute_sn' . $url, 'SSL');
        $data['sort_submited_date'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . '&sort=mc.submited_date' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . '&sort=mc.date_modified' . $url, 'SSL');
        $data['sort_user'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . '&sort=user' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . '&sort=mc.status' . $url, 'SSL');
        $data['sort_publish'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . '&sort=mc.publish' . $url, 'SSL');
        $data['sort_entry_sn'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . '&sort=mc.entry_sn' . $url, 'SSL');
        $data['sort_author'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . '&sort=mc.author_id' . $url, 'SSL');

        $url = '';
        if (isset($this->request->get['filter_entry'])) {
        	$url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_author'])) {
        	$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
        	$url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
        	$url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_product_id'])) {
        	$url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }

        if (isset($this->request->get['filter_publish'])) {
        	$url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['filter_user_id'])) {
        	$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_status'])) {
        	$url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
        $pagination->url = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
         
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
        
        $data['filter_entry'] = $filter_entry;
        $data['filter_author'] = $filter_author;
        $data['filter_contribute_sn'] = $filter_contribute_sn;
        $data['filter_date_modified'] = $filter_date_modified;
        $data['filter_product_id'] = $filter_product_id;
        $data['filter_user_id'] = $filter_user_id;
        $data['filter_status'] = $filter_status;
        $data['filter_publish'] = $filter_publish;
        $data['filter_column'] = $filter_column ;

	    $data['sort'] = $sort;
        $data['order'] = $order;

        if(in_array($this->user->getId(), $this->config->get("sns_group_admin"))){
        	$data['admin_group'] = true;
        }else{
        	$data['admin_group'] = false;
        }

        if(in_array($this->user->getId(), $this->config->get("sns_group_promotion"))){
            $data['promotion_group'] = true;
        }else{
            $data['promotion_group'] = false;
        }
        
	    if(in_array($this->user->getId(), array_merge($this->config->get("sns_group_admin"),$this->config->get("sns_group_market")))){
        	$data['bulk'] = true;
        }else{
        	$data['bulk'] = false;
        }

        $data['level_status'] = $this->config->get("fbmessage_level_status");
        $data['promoting_publish'] = $this->config->get("fbmessage_level_status");

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbmessage/publish/nophoto_list.tpl', $data));
	}

	public function detail(){
		$this->language->load('fbmessage/publish_nophoto');
		$this->load->model('catalog/product');
		$this->load->model('fbmessage/publish_nophoto');
		$this->load->model('fbaccount/entry');
		$this->load->model('fbmessage/publish_nophoto_status');
		$this->load->model('fbmessage/publish_nophoto_publish');
		$this->load->model('user/user');
		$this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');
        $data['heading_title'] = $this->language->get('heading_title'); 
		    
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_post'] = $this->language->get('text_post');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_loading'] = $this->language->get('text_loading');
        $data['text_history'] = $this->language->get('text_history');

		$data['entry_copy'] = $this->language->get('entry_copy');
		$data['error_text'] = $this->language->get('error_text');
        $data['button_update'] = $this->language->get('button_update');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_unlock'] = $this->language->get('button_unlock');
        $data['button_reset'] = $this->language->get('button_reset');
        $data['button_upload'] = $this->language->get('button_upload');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_info'] = $this->language->get('tab_info');
        $data['tab_post'] = $this->language->get('tab_post');
        $data['tab_history'] = $this->language->get('tab_history');
        $data['token'] = $this->session->data['token'];
		$url = '';
		if (isset($this->request->get['filter_entry'])) {
			$url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_author_id'])) {
			$url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_contribute_sn'])) {
			$url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_publish'])) {
			$url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
		}

		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
            'href' => $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        $data['cancel'] = $this->url->link('fbmessage/publish_nophoto', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['action'] = $this->url->link('fbmessage/publish_nophoto/save', '&token=' . $this->session->data['token'] , 'SSL');

        $data['tool_similar_action'] = htmlspecialchars_decode($this->url->link('tool/cron/similar_text','token='.$this->session->data['token'],'SSL'));
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        if (isset($this->session->data['warning'])) {
            $data['error_warning'] = $this->session->data['warning'];

            unset($this->session->data['warning']);
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $_post = $this->model_fbmessage_publish_nophoto->getContribute($this->request->get['contribute_id']);        
        $data['contribute_id'] = $_post['contribute_id'];
        $data['contribute_sn'] = $_post['contribute_sn'];
        $data['submited_date'] = $_post['submited_date'];   
        $data['submited_times'] = $_post['submited_times'];   
        $data['expired'] = $_post['expired'];   
        $data['content'] = $_post['content'];   
        $data['copied'] = $_post['copied'];   
        $data['locker'] = $_post['locker'];   
        $data['publish'] = $_post['publish'];   
        $data['status'] = $_post['status']; 
        $data['product_id'] = $_post['product_id']; 
        $data['entry_sn'] = $_post['entry_sn']; 
        $data['target_url'] = $_post['target_url']; 
        $data['notes'] = utf8_strlen($_post['note'])>5 ? json_decode($_post['note'],true) : false;
        $data['links'] = $this->model_fbmessage_publish_nophoto->getContributeLinks($_post['contribute_sn']);
        //product
        $_product = $this->model_catalog_product->getProduct($_post['product_id']);
        $data['product'] = empty($_product['name']) ? '' : $_product['name'];
        //entry
        $_entry = $this->model_fbaccount_entry->getEntryBySN($_post['entry_sn']);
		$data['entry_name'] = empty($_entry['entry_name']) ? '' : $_entry['entry_name'];
        //operator
        $_operator = $this->model_user_user->getUser($_post['user_id']);
        $data['user'] = empty($_operator['nickname']) ? '' : $_operator['nickname'];
		
		//author
		$_author = $this->model_user_user->getUserByAuthorId($_post['author_id']);
        $data['author'] = empty($_author['nickname']) ? '' : $_author['nickname'];
        $author_user = empty($_author['user_id']) ? 0 : $_author['user_id'];
        
        //modify
        $data['modify'] = in_array($this->user->getId(), $this->config->get('sns_group_promotion')) && !in_array($_post['publish'], $this->config->get('fbmessage_promotion_modify'));

        //lock
        $data['locked'] = $data['relax'] = false;        
        $_locker = $this->model_user_user->getUser($_post['locker']);
        $data['lock_user'] = empty($_locker['nickname']) ? '' : $_locker['nickname'];
        //set the locker is the current user_id
        if(empty($data['lock_user']) || $_post['locker'] == $this->user->getId()){
            $this->model_fbmessage_publish_nophoto->setTempLocker((int)$_post['contribute_id']); 
        }else{
            $data['locked'] = true;
            $data['modify'] = false;
            $data['text_lock'] = sprintf($this->language->get('text_lock'), $data['lock_user']);
            if(in_array($this->user->getId(),$this->config->get('sns_group_promotion'))){
                $data['relax'] = true;
                $data['text_confirm_relax'] = sprintf($this->language->get('text_relax'),$data['lock_user']);
            }
        }

		$this->document->setTitle($_post['contribute_sn']);

        $data['post_statuses'] = $this->model_fbmessage_nophoto_status->getStatuses();
        $data['post_publishes'] = $this->model_fbmessage_nophoto_publish->getPublishes();
        $data['level_statuses'] = $this->config->get('fbmessage_level_status');
        $data['auditor_approves'] = $this->config->get("fbmessage_auditor_approve");
        $data['promotion_modifies'] = $this->config->get("fbmessage_promotion_modify");
        $data['market_group'] = in_array($this->user->getId(), $this->config->get("sns_group_market"));
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbmessage/publish/nophoto_form.tpl', $data));
        
	}

	public function history(){
		$this->language->load('fbmessage/publish_nophoto');
		$this->load->model('fbmessage/publish_nophoto');
		$this->load->model('fbmessage/publish_nophoto_status');
		$this->load->model('fbmessage/publish_nophoto_publish');

		$contribute_id = (int)$this->request->get['contribute_id'];
		$data['token'] = $this->session->data['token'] ;
		$data['text_no_results'] = $this->language->get('text_no_results');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$limit = 20;
		$data['histories'] = array();
		$total = $this->model_fbmessage_publish_nophoto->getTotalHistory($contribute_id);
		$results = $this->model_fbmessage_publish_nophoto->getHistories($contribute_id,($page - 1) * $limit, $limit);
		foreach ($results as $result) {
			if(strtolower($result['type']) == 'edit'){
				$_status = $this->model_fbmessage_nophoto_status->getStatus($result['value']);
				$status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'];
			}else{
				$_publish = $this->model_fbmessage_nophoto_publish->getPublish($result['value']);
				$status_text = empty($_publish['name']) ? $this->language->get('text_exception_red') : $_publish['name'];
			}

            if($result['user_id']==0){
                $operator = $this->language->get('text_author');
            }elseif ($result['user_id']==-1){
                $operator = $this->language->get('text_system');
            }else{
                $operator = $result['nickname'];
            } 
			$data['histories'][] = array(
                'history_id'    => $result['history_id'] ,              
                'type'          => strtolower($result['type']) == 'edit' ? 'Edit Status' : 'Post Status',
                'value'         => (int)$result['value'],
                'status_text'   => $status_text,
                'operator'      => $operator,
                'date_added'    => date('Y-m-d H:i:s', strtotime($result['date_added']))
			);
		}
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		
		$pagination->url = $this->url->link('fbmessage/publish_nophoto/history', 'token=' . $this->session->data['token'] . '&contribute_id='.$contribute_id . '&page={page}', 'SSL');
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
		
		$this->response->setOutput($this->load->view('fbmessage/publish/nophoto_history.tpl', $data));
	}

	public function save(){
        $this->language->load('fbmessage/publish_nophoto');
        $this->load->model('fbmessage/publish_nophoto');
        $this->load->model('fbmessage/nophoto_status');
        $this->load->model('fbmessage/nophoto_publish');
        $this->load->model('user/user');
        $result= array('status'=>0,'msg'=>$this->language->get('text_exception'));
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$_post = $this->model_fbmessage_publish_nophoto->getContribute($this->request->post['contribute_id']);
			if($_post['locker'] && $_post['locker']!=(int)$this->user->getId()){
                die(json_encode(array('status'=>0,'msg'=> $this->language->get('error_locker'))));
            }
			$entry_sn = isset($this->request->post['entry_sn']) ?  $this->request->post['entry_sn'] : false;
			$entry_modified = isset($this->request->post['entry_modified']) ? $this->request->post['entry_modified'] : 0;
			$content = isset($this->request->post['content']) ? htmlspecialchars_decode($this->request->post['content']) : false;
			$content_modified = isset($this->request->post['content_modified']) ? $this->request->post['content_modified'] : 0;
			$url_modified = isset($this->request->post['url_modified']) ?  $this->request->post['url_modified'] : 0;
			$target_url = isset($this->request->post['target_url']) ? htmlspecialchars_decode($this->request->post['target_url']) : false;
			$expired = isset($this->request->post['expired']) ?  $this->request->post['expired'] : 0;
			$expired_modified = isset($this->request->post['expired_modified']) ?  $this->request->post['expired_modified'] : 0;
			$publish = isset($this->request->post['publish']) ? $this->request->post['publish'] : false;
			$note = !empty($this->request->post['note']) ? strip_tags($this->request->post['note']) : false;
			
			if($url_modified && !isURL($target_url)){
				die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_url'))));
			}
			if($content_modified && empty($content)){
				die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_text'))));
			}
			$_notes = array();
            if(!empty($_post['note'])){
                $_notes = json_decode($_post['note'],true);
            }
            if($note){
                $_notes[] = array(
                    'mode'		=> 'user',
                    'operator'	=> $this->user->getNickName(),
                    'entry_id'	=> $this->user->getId(),
                    'msg'		=> trim($note),
                    'time'		=> time()
                );
            }
			$tmp = array(
	  			'contribute_id' 	=> $this->request->post['contribute_id'],
	  			'publish' 			=> $publish,
	  			'url_modified' 		=> $url_modified,
	  			'target_url' 		=> $target_url,	  			
	  			'content_modified' 	=> $content_modified,
			    'expired'			=> $expired,
			    'expired_modified'	=> $expired_modified,
			    'entry_sn'			=> $entry_sn,
			    'entry_modified'	=> $entry_modified,
	  			'content' 			=> $content,
	  			'note' 				=> json_encode($_notes)
			);
			if($this->model_fbmessage_publish_nophoto->editContribute($tmp,'modified')){
                $this->session->data['success'] = sprintf($this->language->get('text_approve_success'),$_post['contribute_sn'].' '.$_post['contribute_id']);
                $result= array('status'=>1,'msg'=> $this->language->get('text_success'));
            }else{
                $result= array('status'=>0,'msg'=> $this->language->get('error_level'));
            }
        }
		$this->response->setOutput(json_encode($result));
	}
	public function import_data(){
		$this->language->load('fbmessage/publish_nophoto');
		$mode = isset($this->request->post['mode']) ? strtolower(trim($this->request->post['mode'])):'normal';
		$filename = isset($this->request->files['filename']['name']) ? trim($this->request->files['filename']['name']) : false;
		$note = !empty($this->request->post['note']) ? strip_tags($this->request->post['note']) : false;
		$token = $this->session->data['token'];
		$this->load->model('fbmessage/publish_nophoto');
		$this->load->model('fbmessage/nophoto_status');
		$path_array = pathinfo($filename);
		$import_file = $this->request->files['filename']['tmp_name'];
		switch ($mode) {
			case 'normal':
				if(!isset($path_array['extension']) || $path_array['extension']!='csv'){
					die(json_encode(array('status'=>0,'msg'=>'Normal File Exception!')));
				}
				$n=0;
				$fp=fopen($import_file,'r');
				while ($data = fgetcsv($fp)) {
					if(!isset($data[0]) || !isset($data[1])){continue;}
					$msg_info = $this->model_fbmessage_publish_nophoto->getContributeBySn(trim($data[0]));
					if(isset($msg_info['contribute_id'])){
						if(is_numeric($data[1])){
							$status = (int)$data[1];
						}else{
							$status_info = $this->model_fbmessage_nophoto_status->getStatusIdByName(trim($data[1]));
							$status = empty($status_info['status_id']) ? 0 : (int)$status_info['status_id'];
							
						}
						$this->model_fbmessage_publish_nophoto->editContribute(array('contribute_id'=>(int)$msg_info['contribute_id'],'publish'=>$status),'modified');
						$n++;
					}
				}
				fclose($fp);
				die(json_encode(array('status'=>1,'msg'=>"You have modified ".$n." contributes.")));
				break;
			case 'dele_links':
				if(!isset($path_array['extension']) || $path_array['extension']!='csv' ){
					die(json_encode(array('status'=>0,'msg'=>'URL File Exception!')));
				}
				$deleNum=0;
				$urls_list = array();
				$fp=fopen($import_file,'r');
				while ($data = fgetcsv($fp)) {
					$urls_list[] = $data;
				}
				if(count($urls_list)){
					$num=count($urls_list);
					for($i=0;$i<$num;$i++){
						$res=$this->model_fbmessage_publish_nophoto->deleUrl($urls_list[$i]['0']);
						if($res){
							$deleNum++;
						}
					}
				}
				fclose($fp);
				die(json_encode(array('status'=>1,'msg'=>"You have deleted ".$deleNum." URL.")));
				break;
			case 'links':
				if(!isset($path_array['extension']) || $path_array['extension']!='csv' ){
					die(json_encode(array('status'=>0,'msg'=>'URL File Exception!')));
				}
				$importNum=$errorNum=0;
				$urls_list = $url_key=array();
				$fp=fopen($import_file,'r');
				while ($data = fgetcsv($fp)) {
					$urls_list[] = $data;
				}
				if(count($urls_list)){
					$num=count($urls_list);
					for($i=0;$i<$num;$i++){
						$url_key[$urls_list[$i]['0']]=$urls_list[$i]['1'];
					}
				}
				if(count($url_key)){
					foreach ($url_key as $key=>$value){
						$this->model_fbmessage_publish_nophoto->emptyUrlByPost($key);
					}
					$num=count($urls_list);
					for($i=0;$i<$num;$i++){
						$requ=$this->model_fbmessage_publish_nophoto->getContributeBySn($urls_list[$i]['0']);
						if($requ){
							if($requ['url_modified']==0){
								$res=$this->model_fbmessage_publish_nophoto->importUrl($urls_list[$i]['0'], $urls_list[$i]['1']);
								if($res){
									$importNum++;
								}
							}
						}else{
							$errorNum++;
						}
					}
				}
				fclose($fp);
				die(json_encode(array('status'=>1,'msg'=>"You have importted ".$importNum." URL.And there are ".$errorNum." error.")));
				break;
		}
	}

	public function advanced_export(){
		$mode = isset($this->request->post['mode']) ? strtolower(trim($this->request->post['mode'])):'posts';
		$link_num = isset($this->request->post['link_num']) ? (int)$this->request->post['link_num']:10;
		$filter_publishes = isset($this->request->post['filter_publishes']) ? (array)$this->request->post['filter_publishes']:false;
		$filter_statuses = isset($this->request->post['filter_statuses']) ? (array)$this->request->post['filter_statuses']:false;
		$filter_products = isset($this->request->post['filter_products']) ? (array)$this->request->post['filter_products']:false;
		$filter_user_id = isset($this->request->post['filter_user_id']) ? (int)$this->request->post['filter_user_id']:false;
		$filter_url_operator = isset($this->request->post['filter_url_operator']) ? html_entity_decode(trim($this->request->post['filter_url_operator'])):false;
		$filter_url_number = isset($this->request->post['filter_url_number']) ? (int)$this->request->post['filter_url_number']:false;
		$token = $this->session->data['token'];
		$this->language->load('fbmessage/publish_nophoto');
		if(!in_array($this->user->getId(), $this->config->get("sns_group_admin"))){
			die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_permission'))));
		}

		if($filter_url_operator){
			if($filter_url_operator=="dy"){
				$filter_url_operator=">";
			}elseif ($filter_url_operator=="xy"){
				$filter_url_operator="<";
			}
		}
		if($mode=='links' && (!$filter_url_operator || !in_array($filter_url_operator, array(">","<","=")))){
			die(json_encode(array('status'=>0,'msg'=>'Error Operator!'.$filter_url_operator)));
		}
		$basePath = DIR_DOWNLOAD.'tmp_posts';
		if(!file_exists($basePath)){
			@mkdir($basePath);
			//@chmod($basePath, 0777);
		}
		$targetPath = $basePath.'/'.date('Ymd').'_'.$mode;
		if(!file_exists($targetPath)){
			@mkdir($targetPath);
		}
		$topPath = $targetPath.'/Post';
		if(!file_exists($topPath)){
			@mkdir($topPath);
		}
		$this->load->model('fbmessage/publish_nophoto');
		$filter = array(
            'filter_mode'           => $mode, 
            'filter_publishes'      => $filter_publishes,
            'filter_statuses'       => $filter_statuses,
            'filter_products'       => $filter_products,
            'filter_user_id'        => $filter_user_id,
            'filter_url_operator'   => $filter_url_operator == '*' ? false : $filter_url_operator,
            'filter_url_number'     => $filter_url_number,
            'sort'                  => 'mc.contribute_sn',
            'order'                 => 'ASC'
        );
        $json = $_tmp = array();
        $contributes = $this->model_fbmessage_publish_nophoto->getContributes($filter);
        if($contributes){
        	foreach ($contributes as $ck => $item){
        		if(!empty($item['contribute_sn'])){
        			if($mode == 'posts') {
        				// Check Expired
        				if((int)$item['expired']){
        					if(time() > strtotime($item['expired'])){
        						$this->model_fbmessage_publish_nophoto->editContribute($item,'expired');
        						continue;
        					}
        				}
        			}

        			//DIR Country Path
        			$countryStr = postCountryDir((int)$item['country_id'],'Message');
        			$countryPath=$topPath.'/'.$countryStr;
        			!file_exists($countryPath) && @mkdir($countryPath);

        			//Target URL
        			$_tmp[$item['country_id']][trim($item['contribute_sn'])] = "Post\\".$countryStr."\\".trim($item['contribute_sn']).",".$link_num.",". htmlspecialchars_decode(trim($item['target_url']))."\r\n";

        			//Mode links Continue
        			if($mode == 'links') continue;

        			//DIR contribute_sn
        			$lastPath = $countryPath.'/'.trim($item['contribute_sn']);
        			!file_exists($lastPath) && @mkdir($lastPath);

        			//File Post.txt
        			file_put_contents($lastPath.'/Post.txt',$item['content']);//Post.txt

        			//FILE bitly.text
        			$_links = $this->model_fbmessage_publish_nophoto->getContributeLinks(trim($item['contribute_sn']));
        			$content = '';
        			if($_links){
        				foreach ($_links as $_link) {
        					if(!empty($_link['short_url']))
        					$content[] = trim($_link['short_url'])."\r\n";
        				}
        			}
        			file_put_contents($lastPath.'/bitly.txt',is_array($content) ? implode("", $content) : "");//bitly.txt

        			// Init URL Modified
        			if($mode == 'posts') {
        				$this->model_fbmessage_publish_nophoto->editContribute($item,'init');
        			}
        		}else{
        			$json['error'][] = $item['contribute_id'].' Contribute SN Exception!';
        			continue;
        		}
        	}

        }else{
        	die(json_encode(array('status'=>0,'msg'=>$this->language->get('text_no_results'))));
        }
        if($_tmp){
        	foreach ($_tmp as $key => $country) {
        		$countryStr = postCountryDir($key,'Message');
        		$url_csv = $topPath.'/'.$countryStr.'/URL.csv';//URL.CSV
        		$handle = @fopen($url_csv, 'w');
        		if(is_array($country)){
        			foreach ($country as $line) {
        				@fwrite($handle, $line);
        			}
        		}
        		@fclose($handle);
        	}
        	$zip_name = date('YmdHis').'_'.$mode.'_Message.zip';
        	$file_path = '/asset/download/'.$zip_name;
        	
        	$archive = new PclZip(DIR_DOWNLOAD.$zip_name);
        	$archive->create($topPath,PCLZIP_OPT_REMOVE_PATH,$targetPath);
        	deldir($targetPath);
        	die(json_encode(array(
            'status'=>1,
            'msg'=>sprintf($this->language->get('text_export_success'),basename($file_path).sprintf($this->language->get('download_link'),$this->url->download(array('token'=>$token,'path'=>$file_path))))
        	)));
        }else{
        	die(json_encode(array('status'=>0,'msg'=>$this->language->get('text_no_results'))));
        }

	}

	function ajax_data(){
		$this->language->load('fbmessage/publish_nophoto');
		$action = isset($this->request->post['action']) ? strtolower(trim($this->request->post['action'])) : 'get';
		$this->load->model('fbmessage/publish_nophoto');
		switch ($action) {
			case 'reset':
				$this->model_fbmessage_publish_nophoto->resetTempLocker($this->request->post['contribute_id'],$this->request->post['locker']);
				if(isset($this->request->get['set']) && $this->request->get['set']){
					$this->model_fbmessage_publish_nophoto->setTempLocker($this->request->post['contribute_id']);
				}
				die(json_encode(array('status' =>1 ,'msg'=>'reset success')));
				break;
		}
		die(json_encode(array('status' =>0 ,'msg'=>$this->language->get('text_exception'))));
	}
}