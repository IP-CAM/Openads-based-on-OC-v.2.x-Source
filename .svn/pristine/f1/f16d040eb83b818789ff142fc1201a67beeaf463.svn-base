<?php
class ControllerFbaccountProfilePhoto extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('fbaccount/profile_photo');
			
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('fbaccount/profile_photo');

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

		if (isset($this->request->get['filter_author_id'])) {
			$filter_author_id = $this->request->get['filter_author_id'];
			$filter_column = true;
		} else {
			$filter_author_id = null;
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

		if (isset($this->request->get['filter_user_id'])) {
			$filter_user_id = (int)$this->request->get['filter_user_id'];
			$filter_column = true;
		} else {
			$filter_user_id = null;
		}
		if (isset($this->request->get['filter_artist_id'])) {
			$filter_artist_id = (int)$this->request->get['filter_artist_id'];
			$filter_column = true;
		} else {
			$filter_artist_id = null;
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
			$sort = 'p.contribute_id';
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
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
		}
		if (isset($this->request->get['filter_artist_id'])) {
			$url .= '&filter_artist_id=' . (int)$this->request->get['filter_artist_id'];
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

		$this->load->model('fbaccount/photo_status');
		$data['post_statuses'] = $this->model_fbaccount_photo_status->getStatuses();

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] , 'SSL')
        );
        $data['delete'] = $this->url->link('fbaccount/profile_photo/delete', 'token=' . $this->session->data['token'].$url , 'SSL');
		$limit = 20;
        $data['contributes'] = array();

        $filter_data = array(
            'filter_entry'          => $filter_entry,           
            'filter_user_id'        => $filter_user_id,
            'filter_artist_id'      => $filter_artist_id,
            'filter_contribute_sn'  => $filter_contribute_sn,
            'filter_product_id'		=> $filter_product_id,
            'filter_author_id'      => $filter_author_id,
            'filter_status'         => $filter_status,
            'filter_date_modified'  => $filter_date_modified,
            'sort'                  => $sort,
            'order'                 => $order,
            'start'                 => ($page - 1) * $limit,
            'limit'                 => $limit
        );

        $total = $this->model_fbaccount_profile_photo->getTotalContributes($filter_data);

        $results = $this->model_fbaccount_profile_photo->getContributes($filter_data);

        foreach ($results as $result) {
        	$action = array();
            $lock = (!empty($result['locker']) && $result['locker']!=$this->user->getId()) ? true :false ;
            if($lock){
                $action[] = array(
                    'text' => $this->language->get('text_readonly'),
                    'href' => $this->url->link('fbaccount/profile_photo/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')
                );
            }else{
        		$action[] = array(
                	'text' => $this->language->get('text_edit'),
                	'href' => $this->url->link('fbaccount/profile_photo/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')
                );
            }

        	$_status = $this->model_fbaccount_photo_status->getStatus($result['status']);
        	if(in_array($result['status'], $this->config->get('fbaccount_photo_auditor_status'))){
        		$status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : '<b style="color:blue">'.$_status['name'].'</b>' ;
        	}else{
        		$status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'];
        	}

            $product = $this->model_catalog_product->getProduct($result['product_id']);
            $entry = $this->model_fbaccount_entry->getEntryBySN($result['entry_sn']);
            $author = $this->model_user_user->getUserByAuthorId($result['author_id']);
            $auditor = $this->model_user_user->getUser($result['user_id']);
            $artist = $this->model_user_user->getUser($result['artist_id']);
        	$data['contributes'][] = array(
                'contribute_id' => $result['contribute_id'],
                'contribute_sn' => $result['contribute_sn'] ,
                'entry_sn'      => $result['entry_sn'],
                'entry_name'    => empty($entry['entry_name']) ? '' : $entry['entry_name'] ,
                'product'       => empty($product['name']) ? '' : $product['name'],
                'status_text'   => $status_text,
                'author'        => empty($author['nickname']) ? '' : $author['nickname'],
                'auditor'       => empty($auditor['nickname']) ? '' : $auditor['nickname'],
                'artist'        => empty($artist['nickname']) ? '' : $artist['nickname'],
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
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['column_product'] = $this->language->get('column_product');
        $data['column_contribute_sn'] = $this->language->get('column_contribute_sn');
        $data['column_entry'] = $this->language->get('column_entry');
        $data['column_auditor'] = $this->language->get('column_auditor');
        $data['column_author'] = $this->language->get('column_author');
        $data['column_artist'] = $this->language->get('column_artist');
        $data['column_submited_date'] = $this->language->get('column_submited_date');
        $data['column_date_modified'] = $this->language->get('column_date_modified');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_artist'] = $this->language->get('button_artist');
        $data['button_delete'] = $this->language->get('button_delete');

        $data['token'] = $this->session->data['token'];

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
        if (isset($this->request->get['filter_author_id'])) {
        	$url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
        	$url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_date_modified'])) {
        	$url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_product_id'])) {
        	$url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }

        if (isset($this->request->get['filter_user_id'])) {
        	$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_artist_id'])) {
        	$url .= '&filter_artist_id=' . (int)$this->request->get['filter_artist_id'];
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
        $data['sort_product'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . '&sort=p.product_id' . $url, 'SSL');
        $data['sort_contribute_sn'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . '&sort=p.contribute_sn' . $url, 'SSL');
        $data['sort_submited_date'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . '&sort=p.submited_date' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . '&sort=p.date_modified' . $url, 'SSL');
        $data['sort_user'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . '&sort=p.user_id' . $url, 'SSL');
        $data['sort_artist'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . '&sort=p.artist_id' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
        $data['sort_entry_sn'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . '&sort=p.entry_sn' . $url, 'SSL');
        $data['sort_author'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . '&sort=p.author_id' . $url, 'SSL');
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
        if (isset($this->request->get['filter_user_id'])) {
        	$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }
        if (isset($this->request->get['filter_artist_id'])) {
        	$url .= '&filter_artist_id=' . (int)$this->request->get['filter_artist_id'];
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
        $pagination->url = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
         
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
        $data['filter_entry'] = $filter_entry;
        $data['filter_author_id'] = $filter_author_id;
        $data['filter_contribute_sn'] = $filter_contribute_sn;
        $data['filter_date_modified'] = $filter_date_modified;
        $data['filter_product_id'] = $filter_product_id;
        $data['filter_user_id'] = $filter_user_id;
        $data['filter_artist_id'] = $filter_artist_id;
        $data['filter_status'] = $filter_status;
        $data['filter_column'] = $filter_column ;
        $data['sort'] = $sort;
        $data['order'] = $order;

        if(in_array($this->user->getId(), $this->config->get("sns_group_artist"))){
        	$data['artist_group'] = true;
        }else{
        	$data['artist_group'] = false;
        }

        $data['level_status'] = $this->config->get("fbaccount_photo_level_status");
        $data['artist_status'] = $this->config->get("fbaccount_photo_artist_status");

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbaccount/profile/photo_list.tpl', $data));
	}

	public function detail(){
		$this->language->load('fbaccount/profile_photo');
		$this->load->model('catalog/product');
		$this->load->model('fbaccount/entry');
		$this->load->model('fbaccount/photo_status');
        $this->load->model('fbaccount/profile_photo');
		$this->load->model('user/user');

		$this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');
        $this->document->addStyle(TPL_JS.'fancybox/jquery.fancybox.css?v=2.1.5');
        $this->document->addScript(TPL_JS.'fancybox/jquery.fancybox.pack.js?v=2.1.5');
        $this->document->addScript(TPL_JS.'jquery.ajaxupload.js');
        $this->document->addScript(TPL_JS.'jquery.json.min.js');

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
		$data['entry_file'] = $this->language->get('entry_file');
        $data['error_text'] = $this->language->get('error_text');
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

		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
		}
		if (isset($this->request->get['filter_artist_id'])) {
			$url .= '&filter_artist_id=' . (int)$this->request->get['filter_artist_id'];
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
            'href' => $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        $data['cancel'] = $this->url->link('fbaccount/profile_photo', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['action'] = $this->url->link('fbaccount/profile_photo/save', 'contribute_id='.$this->request->get['contribute_id'].'&token=' . $this->session->data['token'] , 'SSL');
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

        $_post = $this->model_fbaccount_profile_photo->getContribute($this->request->get['contribute_id']);       
        $data['contribute_id'] = $_post['contribute_id'];
        $data['contribute_sn'] = $_post['contribute_sn'];
        $data['submited_date'] = $_post['submited_date'];   
        $data['submited_times'] = $_post['submited_times'];   
        $data['expired'] = $_post['expired'];   
        $data['content'] = $_post['content'];   
        $data['copied'] = $_post['copied'];   
        $data['locker'] = $_post['locker'];     
        $data['status'] = $_post['status']; 
        $data['product_id'] = $_post['product_id']; 
        $data['entry_sn'] = $_post['entry_sn']; 
        $data['target_url'] = $_post['target_url']; 
        $data['notes'] = !empty($_post['note']) ? json_decode($_post['note'],true) : array();
        $file = array();
		if(!empty($_post['upload_files'])){
			$files = json_decode($_post['upload_files'],true);
			if(is_array($files)){
				$attch = current($files);
				if ($attch['path'] && file_exists($attch['path'])) {
	                $file[] = array (
                        'realpath' => HTTP_CATALOG.substr($attch['path'],strpos($attch['path'],'/')+1),
	                    'name'     => $attch['name'],
	                    'image'    => $this->model_tool_image->resize($attch['path'], 100, 100,true)
                    );
	            }
			}
		}
		$data['file'] = $file;
        //product
        $_product = $this->model_catalog_product->getProduct($_post['product_id']);
        $data['product'] = empty($_product['name']) ? '' : $_product['name'];
        //entry
        $_entry = $this->model_fbaccount_entry->getEntryBySN($_post['entry_sn']);
		$data['entry_name'] = empty($_entry['entry_name']) ? '' : $_entry['entry_name'];
		//author
		$_author = $this->model_user_user->getUserByAuthorId($_post['author_id']);
        $data['author'] = empty($_author['nickname']) ? '' : $_author['nickname'];
        $author_user = empty($_author['user_id']) ? '' : $_author['user_id'];
        //artist
        $_artist = $this->model_user_user->getUser($_post['artist_id']);
        $data['artist'] = empty($_artist['nickname']) ? '' : $_artist['nickname'];
        $artist_user = empty($_artist['user_id']) ? '' : $_artist['user_id'];
        //operator
        $_operator = $this->model_user_user->getUser($_post['user_id']);
        $data['user'] = empty($_operator['nickname']) ? '' : $_operator['nickname'];
        //edit
        $data['is_author'] = $data['is_artist'] = false;
        if(($this->user->getId() == $author_user) 
            && !in_array($_post['status'], array($this->config->get('fbaccount_photo_level_status'))) ){
            $data['edit'] = true;
            $data['is_author'] = true;
        }
        if(($this->user->getId() == $artist_user) 
            && !in_array($_post['status'], array($this->config->get('fbaccount_photo_artist_status'))) ){
            $data['edit'] = true;
            $data['is_artist'] = true;
        }
        //lock 
        $data['locked'] = false;
        $_locker = $this->model_user_user->getUser($_post['locker']);
        $data['lock_user'] = empty($_locker['nickname']) ? '' : $_locker['nickname'];
        if(empty($data['lock_user']) || ((int)$_post['locker'] == $this->user->getId()) ){
            $this->model_fbaccount_profile_photo->setTempLocker((int)$_post['contribute_id']);
        }else {
            $data['locked'] = true;
            $data['edit'] = false;
            $data['text_lock'] = sprintf($this->language->get('text_lock'),$data['lock_user']);
        }
        $this->document->setTitle('Edit '.$_post['contribute_sn']);

        $data['post_statuses'] = $this->model_fbaccount_photo_status->getStatuses();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbaccount/profile/photo_form.tpl', $data));

	}
	public function save(){
        $this->language->load('fbaccount/profile_photo');
        $this->load->model('fbaccount/profile_photo');

        $result= array('status'=>0,'msg'=>$this->language->get('text_exception'));
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$_post = $this->model_fbaccount_profile_photo->getContribute($this->request->post['contribute_id']);
			if($_post['locker'] && $_post['locker']!=(int)$this->user->getId()){
                die(json_encode(array('status'=>0,'msg'=> $this->language->get('error_locker'))));
            }
			
            $entry_sn = isset($this->request->post['entry_sn']) ?  $this->request->post['entry_sn'] : 0;
			$entry_modified = isset($this->request->post['entry_modified']) ?  $this->request->post['entry_modified'] : 0;
			$target_url = isset($this->request->post['target_url']) ? htmlspecialchars_decode($this->request->post['target_url']) : false;
			$content = isset($this->request->post['content']) ? htmlspecialchars_decode($this->request->post['content']) : false;
			$expired_date = isset($this->request->post['expired_date']) ?  $this->request->post['expired_date'] : 0;
			$publish = isset($this->request->post['publish']) ? $this->request->post['publish'] : false;
			$note = !empty($this->request->post['note']) ? strip_tags($this->request->post['note']) : false;
            $files = isset($this->request->post['upload_files']) && utf8_strlen($this->request->post['upload_files']) >  5 ? htmlspecialchars_decode($this->request->post['upload_files']) : false;
			
			if( !isURL($target_url)){
				die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_url'))));
			}
			if( empty($content)){
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
	  			'contribute_id' => $this->request->post['contribute_id'],
	  			'publish' 		=> $publish,
			    'expired'		=> $expired_date,
                'entry_modified'=> $entry_modified,
			    'entry_sn'		=> $entry_sn,
	  			'content' 		=> $content,
	  			'target_url' 	=> $target_url,
	  			'upload_files' 	=> ($files && is_array(json_decode($files,true))) ? $files : '',
	  			'note' 			=> json_encode($_notes)
			);
			if($this->model_fbaccount_profile_photo->editContribute($tmp,'modified')){
                $this->session->data['success'] = sprintf($this->language->get('text_approve_success'),$_post['contribute_sn'].' '.$_post['contribute_id']);
                $result= array('status'=>1,'msg'=> $this->language->get('text_success'));
            }else{
                $result= array('status'=>0,'msg'=> $this->language->get('error_level'));
            }
		}
		$this->response->setOutput(json_encode($result));
	}

	public function history(){
		$this->language->load('fbaccount/profile_photo');
		$this->load->model('fbaccount/photo_status');
		$this->load->model('fbaccount/profile_photo');

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
		$total = $this->model_fbaccount_profile_photo->getTotalHistory($contribute_id);
		$results = $this->model_fbaccount_profile_photo->getHistories($contribute_id,($page - 1) * $limit, $limit);
		foreach ($results as $result) {
			$_status = $this->model_fbaccount_photo_status->getStatus($result['value']);
			if($result['user_id']==0){
				$operator = $this->language->get('text_author');
			}elseif ($result['user_id']==-1){
				$operator = $this->language->get('text_system');
			}else{
				$operator = $result['nickname'];
			}
			$data['histories'][] = array(
				'history_id'  	=> $result['history_id'] ,				
				'type'			=> 'Edit Status',
        		'status_text'   => empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'],
        		'operator'		=> $operator,
        		'date_added' 	=> date('Y-m-d H:i:s', strtotime($result['date_added']))
			);
		}
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		
		$pagination->url = $this->url->link('fbaccount/profile_photo/history', 'token=' . $this->session->data['token'] . '&contribute_id='.$contribute_id . '&page={page}', 'SSL');
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

		$this->response->setOutput($this->load->view('fbaccount/profile/photo_history.tpl', $data));
	}

	public function artist(){
		$this->language->load('fbaccount/profile_photo');
		$mode = isset($this->request->post['mode']) ? strtolower(trim($this->request->post['mode'])):'normal';
		$token = $this->session->data['token'];
		$this->load->model('fbaccount/profile_photo');
		$this->load->model('fbaccount/photo_publish');
		defined('DIR_UPLOAD') || define('DIR_UPLOAD', DOCUMENTROOT.'uploads/');
		switch ($mode) {
			case 'import':
				$filename = isset($this->request->files['filename']['name']) ? trim($this->request->files['filename']['name']) : false;
				$note = !empty($this->request->post['note']) ? strip_tags($this->request->post['note']) : false;
				$path_array = pathinfo($filename);
				$import_file = $this->request->files['filename']['tmp_name'];
				if(!isset($path_array['extension']) || $path_array['extension']!='zip'){
					die(json_encode(array('status'=>0,'msg'=>'Zip File Exception!')));
				}
				$timePath = date('Ymd');
				$targetPath = DIR_UPLOAD.$timePath;
				if(!file_exists($targetPath)){
					mkdir($targetPath);
				}
				$archive = new PHPZip();
				$array     = $archive->GetZipInnerFilesInfo($import_file);
				$filecount = $dircount  = 0;
				$finished = $failfiles = array();
				for($i=0; $i<count($array); $i++) {
					if($array[$i]['folder'] == 0){
						$info = pathinfo($array[$i]['filename']);
						$finished_type = 'edit';
						if(isset($info['dirname']) && strrpos($info['dirname'], "/")){
							$prev_dir = trim(substr($info['dirname'], strrpos($info['dirname'], "/")+1));
							if(strtolower($prev_dir)=='updated'){  $finished_type = 'post';}
						}
						$_post = $this->model_fbaccount_profile_photo->getContributeBySn(trim($info['filename']));
						if(!empty($_post['contribute_id'])){
							//Error Dir Structure
							if($_post['publish'] != $this->config->get("fbaccount_photo_initial_publish") && $finished_type != 'post'){
								continue;
							}
							if(isset($info['extension']) && in_array($info['extension'],array('jpg','jpeg','gif','png'))){
								$stat = $archive->unZip($import_file, $targetPath, $i,true,true);
								if($stat){
									$_notes = array();
                                    if(!empty($_post['note'])){
                                        $_notes = json_decode($_post['note'],true);
                                    }
									if($note){
										$_notes[] = array(
                                            'mode'=>'user',
                                            'operator'=>$this->user->getNickName(),
                                            'entry_id'=>$this->user->getId(),
                                            'msg'=>trim($note),
                                            'time'=>time()
                                        );
									}
									$data = array(
                                        'contribute_id'=>(int)$_post['contribute_id'],
                                        'artist_auditor'=> 1,
                                        'finished_type' => $finished_type,
                                        'upload_files' => htmlspecialchars_decode(json_encode(array(array('name'=>trim(end($stat)),'path'=>'../asset/uploads/'.$timePath.'/'.trim(end($stat)))))),
                                        'note' => $_notes ? json_encode($_notes) : '',
									);
									$this->model_fbaccount_profile_photo->editContribute($data,'modified');
									$finished[$_post['contribute_id']] = $_post['contribute_sn'];
									$filecount++;
								}else{
									$failfiles[] = $array[$i]['filename'];
									continue;
								}
							}else{
								continue;
							}

						}else{
							$failfiles[] = $array[$i]['filename'];
							continue;
						}

					}else{
						$dircount++;
					}
				}
				die(json_encode(array(
                    'status'=>1,
                    'msg'=>'FileCount:'.$filecount.';<br/>Finished:'.($finished ? implode(",", $finished):' Null').'<br/>FailFiles:'.($failfiles ? implode("<br/>", $failfiles) : ' Null'),
				)
				));
				break;
			case 'export':
				$filter_status = isset($this->request->post['filter_status']) ? (int)$this->request->post['filter_status']:false;
				$filter_post_status = isset($this->request->post['filter_post_status']) ? (int)$this->request->post['filter_post_status']:false;
				$filter_date_start = isset($this->request->post['filter_date_start']) ? trim($this->request->post['filter_date_start']):false;
				$filter_date_end = isset($this->request->post['filter_date_end']) ? trim($this->request->post['filter_date_end']):false;
				$filter_artist_id = isset($this->request->post['filter_artist_id']) ? (int)$this->request->post['filter_artist_id']:false;
				$basePath = DIR_DOWNLOAD.'tmp_posts';
				if(!file_exists($basePath)){
					@mkdir($basePath);
				}
				$targetPath = $basePath.'/'.date('Ymd').'_images';
				if(!file_exists($targetPath)){
					@mkdir($targetPath);
				}
				$topPath = $targetPath.'/Post';
				if(!file_exists($topPath)){
					@mkdir($topPath);
				}
				$filter = array(
                    'filter_mode'           => 'images', 
                    'filter_artist_id'      => $filter_artist_id,
                    'filter_status'         => $filter_status=='*' ? null : $filter_status ,
                    'filter_post_status'    => $filter_post_status=='*' ? null : $filter_post_status ,
                    'filter_date_start'     => $filter_date_start,
                    'filter_date_end'       => $filter_date_end,
                    'sort'                  => 'p.contribute_sn',
                    'order'                 => 'ASC'
                );
                $json = $_tmp = array();
                $contributes = $this->model_fbaccount_profile_photo->getContributes($filter);
                if($contributes){
                	foreach ($contributes as $ck => $item){
                		if(!empty($item['contribute_sn'])){
                			$lastPath = $topPath;
                			if(in_array($item['publish'], $this->config->get('photo_artist_publish'))){
                				$_publish = $this->model_fbaccount_photo_publish->getPublish($item['publish']);
                				$publish_text = trim($_publish['name']);
                				$lastPath = $lastPath.'/'.$publish_text;
                				!file_exists($lastPath) && @mkdir($lastPath);
                			}
                			//Photo.jpg|Photo.png|...
                			$attach_files = json_decode($item['upload_files'],true);
                			if(is_array($attach_files)){
                				foreach ($attach_files as $key=>$_file){
                					if(isset($_file['path'])){
                						$image_ext = pathinfo($_file['path']);
                						$post_image = $lastPath.'/'.($ck+1).'_'.trim($item['contribute_sn']).'.'.$image_ext['extension'];
                						file_exists($_file['path']) && @copy($_file['path'], $post_image);
                					}
                				}
                			}
                			$notes = json_decode($item['note'],true);
                			if(is_array($notes)){
                				$msg = '';
                				foreach ($notes as $_note){
                					$msg .=$_note['msg'].' [ '.date('Y-m-d H:i:s',$_note['time']).' '.$_note['operator']." ],". htmlspecialchars_decode(trim($item['target_url']))." \r\n";
                				}
                				if (!empty($msg)) {
                					file_put_contents($lastPath.'/'.($ck+1).'_'.trim($item['contribute_sn']).'.txt',$msg);//note.txt
                				}
                			}
                			$this->model_fbaccount_profile_photo->editContribute($item,'expired');
                		}
                	}
                }else{
                	die(json_encode(array('status'=>0,'msg'=> $this->language->get('text_no_results'))));
                }
                $zip_name = date('YmdHis').'_images_Post.zip';
                $file_path = '/asset/download/'.$zip_name;
                
                $archive = new PclZip(DIR_DOWNLOAD.$zip_name);
                $archive->create($topPath,PCLZIP_OPT_REMOVE_PATH,$targetPath);
                deldir($targetPath);
                die(json_encode(array(
                    'status'=>1,
                    'msg' => sprintf($this->language->get('text_export_success'),basename($file_path).sprintf($this->language->get('download_link'),$this->url->download(array('token'=>$token,'path'=>$file_path))))
                )));
                break;
		}
	}

    function ajax_data(){
        $this->language->load('fbaccount/profile_photo');
        $action = isset($this->request->post['action']) ? strtolower(trim($this->request->post['action'])) : 'get';
        $this->load->model('fbaccount/profile_photo');
        switch ($action) {
            case 'reset':
                $this->model_fbaccount_profile_photo->resetTempLocker($this->request->post['contribute_id'],$this->request->post['locker']);
                if(isset($this->request->get['set']) && $this->request->get['set']){
                    $this->model_fbaccount_profile_photo->setTempLocker($this->request->post['contribute_id']);
                }
                die(json_encode(array('status' =>1 ,'msg'=>'reset success')));
                break;
            case 'get':
                $status = isset($this->request->post['status']) ? strtolower(trim($this->request->post['status'])) : false;
                $clickbank = isset($this->request->post['clickbank']) ? (int)$this->request->post['clickbank'] : false;
                if($status || $clickbank){
                    $total = $this->model_fbaccount_profile_photo->getTotalContributes(array('filter_uncopied_status'=>$status,'filter_clickbank'=>1));
                    die(json_encode(array('status' =>1 ,'total'=>$total)));
                }
                break;
        }
        die(json_encode(array('status' =>0 ,'msg'=>$this->language->get('text_exception'))));
    }
}