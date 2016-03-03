<?php
class ControllerServiceAdvertise extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('service/advertise', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('service/advertise');
		$this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
		$this->document->addScript(TPL_JS.'datetimepicker/moment.js');
		$this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('account/account')
        );

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('service/advertise', $url, 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_toggle'] = $this->language->get('text_toggle');
		$data['text_queue'] = $this->language->get('text_queue');
		$data['text_queuing'] = $this->language->get('text_queuing');
		$data['text_money'] = $this->language->get('text_money');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_update_priority'] = $this->language->get('text_update_priority');
		$data['text_confirm_change'] = $this->language->get('text_confirm_change');

		$data['column_ad_id'] = $this->language->get('column_ad_id');
		$data['column_ad_sn'] = $this->language->get('column_ad_sn');
		$data['column_website'] = $this->language->get('column_website');
		$data['column_publish'] = $this->language->get('column_publish');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_date_modified'] = $this->language->get('column_date_modified');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_target_url'] = $this->language->get('column_target_url');
		$data['column_priority'] = $this->language->get('column_priority');

		$data['entry_website'] = $this->language->get('entry_website');
		$data['entry_target_url'] = $this->language->get('entry_target_url');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_publish'] = $this->language->get('entry_publish');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_modified_start'] = $this->language->get('entry_modified_start');
		$data['entry_modified_end'] = $this->language->get('entry_modified_end');

		$data['button_view'] = $this->language->get('button_view');
		$data['button_filter'] = $this->language->get('button_filter');
		if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
		if (isset($this->request->get['website'])) {
			$website = $this->request->get['website'];
		} else {
			$website = null;
		}
		if (isset($this->request->get['filter_domain'])) {
			$filter_domain = $this->request->get['filter_domain'];
		} else {
			$filter_domain = null;
		}
		if (isset($this->request->get['filter_target_url'])) {
			$filter_target_url = $this->request->get['filter_target_url'];
		} else {
			$filter_target_url = null;
		}
		if (isset($this->request->get['filter_product'])) {
			$filter_product = $this->request->get['filter_product'];
		} else {
			$filter_product = null;
		}

		if (isset($this->request->get['filter_publish'])) {
			$filter_publish = $this->request->get['filter_publish'];
		} else {
			$filter_publish = null;
		}

		if (isset($this->request->get['filter_priority'])) {
			$filter_priority = $this->request->get['filter_priority'];
		} else {
			$filter_priority = null;
		}

		if (isset($this->request->get['filter_modified_start'])) {
			$filter_modified_start = $this->request->get['filter_modified_start'];
		} else {
			$filter_modified_start = null;
		}

		if (isset($this->request->get['filter_modified_end'])) {
			$filter_modified_end = $this->request->get['filter_modified_end'];
		} else {
			$filter_modified_end = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'a.publish';
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

		$data['ads'] = array();

		$this->load->model('service/advertise');

		$filter_data = array(
			'website'      			=> $website,
			'filter_domain'	   		=> $filter_domain,
			'filter_target_url'	   	=> $filter_target_url,
			'filter_product'     	=> $filter_product,
			'filter_publish'  		=> $filter_publish,
			'filter_priority'  		=> $filter_priority,
			'filter_modified_start' => $filter_modified_start,
			'filter_modified_end' 	=> $filter_modified_end,
			'sort'                 	=> $sort,
			'order'                	=> $order,
			'start'                	=> ($page - 1) * 20,
			'limit'                	=> 20
		);

		$ads_total = $this->model_service_advertise->getTotalAdvertises($filter_data);

		$results = $this->model_service_advertise->getAdvertises($filter_data);

		foreach ($results as $result) {
			$publish_text = $result['publish'] == 1 ? $this->language->get('text_queue') : $result['publish_text'] ; 
			$demotion = false;
			if($this->model_service_advertise->getLevelDown($result['advertise_id'])){
				$demotion = true;
			}
			$queue_number = $this->model_service_advertise->getQueueNumber($result['advertise_id']);

			$data['ads'][] = array(
				'advertise_id'  => $result['advertise_id'],
			    'advertise_sn'  => $result['advertise_sn'],
				'domain'		=> $result['domain'],
				'website_status'=> $result['website_status'] ? $this->language->get('text_website_active') : $this->language->get('text_website_stop'),
				'target_url'	=> $result['target_url'],
				'charger'       => $result['nickname'] ,
				'product'     	=> $result['product'],
				'money'     	=> $result['money'],
				'amount'     	=> $this->currency->format($result['money']),
				'priority'   	=> $result['priority'],
				'number'		=> $queue_number,
				'demotion'	=> $demotion ? $this->language->get('list_demotion') : '',
				'priority_id'   => $result['priority_id'],
				'publish'     	=> $result['publish'],
				'publish_text'  => sprintf(getBSTagStyle($result['publish'],'publish'),$publish_text),
				'date_modified' => date('Y-m-d H:i:s', strtotime($result['date_modified'])),
				'href'       => $this->url->link('service/advertise/info', 'ad=' . $result['advertise_sn'], 'SSL'),
			);
		}

		$url = '';

		if (isset($this->request->get['website'])) {
			$url .= '&website=' . $this->request->get['website'];
		}
		if (isset($this->request->get['filter_domain'])) {
			$url .= '&filter_domain=' . urlencode(html_entity_decode($this->request->get['filter_domain'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_target_url'])) {
			$url .= '&filter_target_url=' . urlencode(html_entity_decode($this->request->get['filter_target_url'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_publish'])) {
			$url .= '&filter_publish=' . $this->request->get['filter_publish'];
		}
		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . $this->request->get['filter_product'];
		}
		if (isset($this->request->get['filter_priority'])) {
			$url .= '&filter_priority=' . $this->request->get['filter_priority'];
		}
		if (isset($this->request->get['filter_modified_start'])) {
			$url .= '&filter_modified_start=' . $this->request->get['filter_modified_start'];
		}

		if (isset($this->request->get['filter_modified_end'])) {
			$url .= '&filter_modified_end=' . $this->request->get['filter_modified_end'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_publish'] = $this->url->link('service/advertise','&sort=a.publish' . $url, 'SSL');
		$data['sort_sn'] = $this->url->link('service/advertise', '&sort=a.advertise_sn' . $url, 'SSL');
		$data['sort_date_modified'] = $this->url->link('service/advertise', '&sort=a.date_modified' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['website'])) {
			$url .= '&website=' . $this->request->get['website'];
		}
		if (isset($this->request->get['filter_domain'])) {
			$url .= '&filter_domain=' . urlencode(html_entity_decode($this->request->get['filter_domain'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_target_url'])) {
			$url .= '&filter_target_url=' . urlencode(html_entity_decode($this->request->get['filter_target_url'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_publish'])) {
			$url .= '&filter_publish=' . $this->request->get['filter_publish'];
		}
		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . $this->request->get['filter_product'];
		}
		if (isset($this->request->get['filter_priority'])) {
			$url .= '&filter_priority=' . $this->request->get['filter_priority'];
		}
		if (isset($this->request->get['filter_modified_start'])) {
			$url .= '&filter_modified_start=' . $this->request->get['filter_modified_start'];
		}

		if (isset($this->request->get['filter_modified_end'])) {
			$url .= '&filter_modified_end=' . $this->request->get['filter_modified_end'];
		}

		$pagination = new Pagination();
		$pagination->total = $ads_total;
		$pagination->page = $page;
		$pagination->limit = 20;
		$pagination->url = $this->url->link('service/advertise', $url.'&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($ads_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($ads_total - 10)) ? $ads_total : ((($page - 1) * 10) + 10), $ads_total, ceil($ads_total / 10));

		$data['continue'] = $this->url->link('account/account', '', 'SSL');

		$this->load->model('catalog/product');
		$data['products'] = $this->model_catalog_product->getProducts();


		$this->load->model('localisation/advertise_publish');
		$data['ad_publishes'] = $this->model_localisation_advertise_publish->getAdvertisePublishes();

		$this->load->model('localisation/priority');
		$data['ad_priorities'] = $this->model_localisation_priority->getPriorities();

		$data['website'] = $website;
		
		$data['filter_domain'] = $filter_domain;
		$data['filter_target_url'] = $filter_target_url;
		$data['filter_product'] = $filter_product;
		$data['filter_priority'] = $filter_priority;
		$data['filter_publish'] = $filter_publish;
		$data['filter_modified_start'] = $filter_modified_start;
		$data['filter_modified_end'] = $filter_modified_end;
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['priority_info'] = $this->model_service_advertise->getAdvertisePriority();
		$data['default_amount'] = $this->currency->format(0.00);
		foreach ($data['priority_info'] as $item){
			if($item['default']){
				$data['default_amount'] = $item['amount'];
			}
		}

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');


		$this->response->setOutput($this->load->view('default/template/service/ad_list.tpl', $data));

	}

	public function info() {
		$this->load->language('service/advertise');
		if (isset($this->request->get['ad'])) {
			$advertise_sn = $this->request->get['ad'];
		} else {
			$advertise_sn = 0;
		}

		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('service/advertise/info', 'ad=' . $advertise_sn, 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->model('service/advertise');
        $advertise_id = $this->model_service_advertise->getIdBySn($advertise_sn);
		$ad_info = $this->model_service_advertise->getAdvertise($advertise_id);

		if ($ad_info) {
			$this->document->setTitle($this->language->get('text_ad'));
			$this->document->addScript(TPL_JS.'jquery.maxlength.min.js');
			$this->document->addScript(TPL_JS.'jquery.json.min.js');
			$this->document->addScript(TPL_JS.'jquery.ajaxupload.js');
			$this->document->addScript(TPL_JS.'progressStep.min.js');
			$this->document->addScript(TPL_JS.'raphael.js');
			$this->document->addScript(TPL_JS.'form.js');
			$this->document->addStyle(TPL_JS.'fancybox/jquery.fancybox.css?v=2.1.5');
        	$this->document->addScript(TPL_JS.'fancybox/jquery.fancybox.pack.js?v=2.1.5');
        	$this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        	$this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
        	$this->document->addStyle(TPL_JS.'formvalidation/dist/css/formValidation.css');
			$this->document->addScript(TPL_JS.'formvalidation/dist/js/formValidation.js');
			$this->document->addScript(TPL_JS.'formvalidation/dist/js/framework/bootstrap.min.js');
			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('account/account', '', 'SSL')
			);

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('service/advertise', $url, 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_ad')."#".$ad_info['advertise_sn'],
				'href' => $this->url->link('service/advertise/info', 'ad=' . $this->request->get['ad'] . $url, 'SSL')
			);

			$data['heading_title'] = $this->language->get('text_ad');

			$data['text_ad_detail'] = $this->language->get('text_ad_detail');
			$data['text_ad_status'] = $this->language->get('text_ad_status');
			$data['text_ad_id'] = $this->language->get('text_ad_id');
			$data['text_website'] = $this->language->get('text_website');
			$data['text_priority'] = $this->language->get('text_priority');
			$data['text_date_added'] = $this->language->get('text_date_added');
			$data['text_target_url'] = $this->language->get('text_target_url');
			$data['text_note'] = $this->language->get('text_note');
			$data['text_product'] = $this->language->get('text_product');
			$data['text_targeting'] = $this->language->get('text_targeting');
			$data['text_post'] = $this->language->get('text_post');
			$data['text_photo'] = $this->language->get('text_photo');
			$data['text_history'] = $this->language->get('text_history');
			$data['text_publish'] = $this->language->get('text_publish');
			$data['text_publish_history'] = $this->language->get('text_publish_history');
			$data['text_balance_history'] = $this->language->get('text_balance_history');
			$data['text_loading'] = $this->language->get('text_loading');
			$data['text_edit'] = $this->language->get('text_edit');

			$data['tab_general'] = $this->language->get('tab_general');
			$data['tab_history'] = $this->language->get('tab_history');
			$data['tab_tracking'] = $this->language->get('tab_tracking');
			$data['text_no_result'] = $this->language->get('text_no_result');
			
			$data['column_total'] = $this->language->get('column_total');
			$data['column_action'] = $this->language->get('column_action');
			$data['column_date_added'] = $this->language->get('column_date_added');
			$data['column_publish'] = $this->language->get('column_publish');
			$data['column_note'] = $this->language->get('column_note');

			$data['button_priority'] = $this->language->get('button_priority');
			$data['button_return'] = $this->language->get('button_return');
			$data['button_cancel'] = $this->language->get('button_cancel');
			$data['button_save'] = $this->language->get('button_save');

			$data['button_history_add'] = $this->language->get('button_history_add');

			if (isset($this->session->data['error'])) {
				$data['error_warning'] = $this->session->data['error'];

				unset($this->session->data['error']);
			} else {
				$data['error_warning'] = '';
			}

			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];

				unset($this->session->data['success']);
			} else {
				$data['success'] = '';
			}

			$data['advertise_id'] = $ad_info['advertise_id'];
			$data['advertise_sn'] = $ad_info['advertise_sn'];
			$data['product_id'] = $ad_info['product_id'];
			$data['domain'] = $ad_info['domain'];
			$data['target_url'] = $ad_info['target_url'];
			$data['publish'] = $ad_info['publish'];
			$data['priority'] = $ad_info['priority'];
			$data['priority_id'] = $ad_info['priority_id'];
			$data['money'] = $ad_info['money'];
			$data['amount'] = $this->currency->format($ad_info['money']);
			$data['note'] = $ad_info['note'];
			$data['date_added'] = $ad_info['date_added'];
			$data['publish_text'] = sprintf(getBSTagStyle($ad_info['publish'],'publish'),$ad_info['publish_text']);

			$this->load->model('catalog/product');

			$data['products'] = $this->model_catalog_product->getProducts();

			$data['note'] = nl2br($ad_info['note']);

			$this->load->model('localisation/advertise_publish');
			$data['ad_publishes'] = $this->model_localisation_advertise_publish->getAdvertisePublishes();

			// Targeting
			$targeting = $this->model_service_advertise->getAdvertiseComponent($advertise_id,'targeting');
			$location = $language = array();
			if(isset($targeting['location'])){
				$location = explode(",", $targeting['location']);
			}
			if(isset($targeting['language'])){
				$language = explode(",", $targeting['language']);
			}
			$targeting['location'] = is_array($location) ? $location : array();
			$targeting['language'] = is_array($language) ? $language : array();
			$targeting['gender'] = isset($targeting['gender']) ? $targeting['gender'] : '';
			$targeting['age_min'] = isset($targeting['age_min']) ? $targeting['age_min'] : '';
			$targeting['age_max'] = isset($targeting['age_max']) ? $targeting['age_max'] : '';
			$targeting['interest'] = isset($targeting['interest']) ? $targeting['interest'] : '';
			$targeting['behavior'] = isset($targeting['behavior']) ? $targeting['behavior'] : '';
			$targeting['other_location'] = isset($targeting['other_location']) ? $targeting['other_location'] : '';
			$targeting['other_language'] = isset($targeting['other_language']) ? $targeting['other_language'] : '';
			$targeting['more'] = isset($targeting['more']) ? $targeting['more'] : '';
			$targeting['note'] = isset($targeting['note']) ? $targeting['note'] : '';
			if(!isset($targeting['status'])){
				$targeting['status'] = 0;
			}
			$this->load->model('localisation/advertise_targeting');
			$status = $this->model_localisation_advertise_targeting->getAdvertiseTargeting($targeting['status']);
			$progress = empty($status['name']) ? $this->language->get('text_pending') : $status['name'];
			$targeting['progress'] = sprintf(getBSTagStyle($targeting['status'],'status'),$progress);
			$targeting['editable'] = strtolower($targeting['from']) == 'member' && in_array($targeting['status'], array($this->config->get('ad_targeting_rejected')));
			$data['targeting'] = $targeting;

			$this->load->model('catalog/product');
			$data['locations'] = $this->model_catalog_product->getTargetingsByCategory('location');
			$data['genders'] = $this->model_catalog_product->getTargetingsByCategory('gender');
			$data['languages'] = $this->model_catalog_product->getTargetingsByCategory('language');
			$data['text_location'] = $this->language->get('text_location');
			$data['text_other_location'] = $this->language->get('text_other_location');
			$data['text_language'] = $this->language->get('text_language');
			$data['text_other_language'] = $this->language->get('text_other_language');
			$data['text_interest'] = $this->language->get('text_interest');
			$data['text_behavior'] = $this->language->get('text_behavior');
			$data['text_more'] = $this->language->get('text_more');
			$data['text_gender'] = $this->language->get('text_gender');
			$data['text_age'] = $this->language->get('text_age');
			$data['text_age_max'] = $this->language->get('text_age_max');
			$data['text_age_min'] = $this->language->get('text_age_min');

			// Post
			$post = $this->model_service_advertise->getAdvertiseComponent($advertise_id,'post');
			
			$post['headline'] = isset($post['headline']) ? $post['headline'] : '';
			$post['text'] = isset($post['text']) ? $post['text'] : '';
			$post['note'] = isset($post['note']) ? $post['note'] : '';
			if(!isset($post['status'])){
				$post['status'] = 0;
			}
			$this->load->model('localisation/advertise_post');
			$status = $this->model_localisation_advertise_post->getAdvertisePost($post['status']);
			$progress = empty($status['name']) ? $this->language->get('text_pending') : $status['name'];
			$post['progress'] = sprintf(getBSTagStyle($post['status'],'status'),$progress);
			$post['editable'] = strtolower($post['from']) == 'member' && in_array($post['status'], array($this->config->get('ad_post_rejected')));
			$data['post'] = $post;
			$data['text_headline'] = $this->language->get('text_headline');
			$data['text_post_text'] = $this->language->get('text_post_text');
			$data['progress_status'] = $this->language->get('progress_status');

			//Photo
			$photo = $this->model_service_advertise->getAdvertiseComponent($advertise_id,'photo');
			if(!empty($photo['file'])){
				$files = json_decode($photo['file'],true);
				if(is_array($files)){
					$file = array();
					$this->load->model('tool/image');
					foreach ($files as $item) {
						$_path = substr($item['path'],strpos($item['path'],'/')+1);
						$file[] = array(
							'realpath' => HTTP_SERVER.$_path,
							'name' => $item['name'],
							'path' => $_path,
							'image'	=> $this->model_tool_image->resize($_path, 100, 100,true)
						);
					}
					$photo['file'] = $file;
				}
			}
			$photo['file'] = isset($photo['file']) ? $photo['file'] : '';
			$photo['note'] = isset($photo['note']) ? $photo['note'] : '';
			if(!isset($post['status'])){
				$post['status'] = 0;
			}
			$this->load->model('localisation/advertise_photo');
			$status = $this->model_localisation_advertise_photo->getAdvertisePhoto($photo['status']);
			$progress = empty($status['name']) ? $this->language->get('text_pending') : $status['name'];
			$photo['progress'] = sprintf(getBSTagStyle($photo['status'],'status'),$progress);
			$photo['editable'] = strtolower($photo['from']) == 'member' && in_array($photo['status'], array($this->config->get('ad_photo_rejected')));
			$data['photo'] = $photo;
			$data['text_post_img'] = $this->language->get('text_post_img');
			$data['text_img_delete'] = $this->language->get('text_img_delete');
			$data['text_from'] = $this->language->get('text_from');
			$data['text_member'] = $this->language->get('text_member');
			$data['text_backend'] = $this->language->get('text_backend');
			$data['text_note'] = $this->language->get('text_note');

			$data['return'] = $this->url->link('service/advertise', '', 'SSL');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');;

			$this->response->setOutput($this->load->view('default/template/service/ad_info.tpl', $data));
		} else {
			$this->document->setTitle($this->language->get('text_ad'));

			$data['heading_title'] = $this->language->get('text_ad');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/home')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_account'),
				'href' => $this->url->link('account/account', '', 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('service/advertise', '', 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_ad'),
				'href' => $this->url->link('service/advertise/info', 'ad=' . $advertise_sn, 'SSL')
			);

			$data['continue'] = $this->url->link('service/advertise', '', 'SSL');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
		}
	}


	public function history() {
		$this->load->language('service/advertise');
		$this->load->model('service/advertise');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
			if($this->validatePublishState($this->request->get['ad'],$this->request->post)){
				$this->model_service_advertise->addAdvertiseHistory($this->request->get['ad'],$this->request->post);			
				$this->response->addHeader('Content-Type: application/json');
				$json = array('success'=>$this->language->get('text_success'));
			}else{
				$json = array('error'=>$this->language->get('error_history'));
			}
			$this->response->setOutput(json_encode($json));
		}else{
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['column_date_added'] = $this->language->get('column_date_added');
			$data['column_publish'] = $this->language->get('column_publish');
			$data['column_notify'] = $this->language->get('column_notify');
			$data['column_note'] = $this->language->get('column_note');
			$data['column_from'] = $this->language->get('column_from');
			$data['column_operator'] = $this->language->get('column_operator');

			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}

			$data['histories'] = array();

			$this->load->model('service/advertise');

			$results = $this->model_service_advertise->getAdvertiseHistories($this->request->get['ad'], ($page - 1) * 10, 10);

			foreach ($results as $result) {

				$operator = '';
				if($result['customer_id']){
					$operator = ' -- ';
				}else if($result['in_charge']){
					$operator = '<span class="label label-default">'.$this->language->get('text_backend').'</span>';
				}
				$publish_text = $result['publish']==1 ? $this->language->get('text_queue') : $result['publish_text'];
				$data['histories'][] = array(
					'notify'     => $result['notify'] ? $this->language->get('text_yes') : $this->language->get('text_no'),
					'from'     	 => ucfirst($result['from']),
					'operator'   => $operator,
					'publish'    => sprintf(getBSTagStyle($result['publish']),$publish_text),
					'note'    	 => nl2br($result['note']),
					'date_added' => date('Y-m-d H:i:s', strtotime($result['date_added']))
				);
			}

			$history_total = $this->model_service_advertise->getTotalAdvertiseHistories($this->request->get['ad']);

			$pagination = new Pagination();
			$pagination->total = $history_total;
			$pagination->page = $page;
			$pagination->limit = 10;
			$pagination->url = $this->url->link('service/advertise/history', '&ad=' . $this->request->get['ad'] . '&page={page}', 'SSL');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

			$this->response->setOutput($this->load->view('default/template/service/ad_history.tpl', $data));
		}
	}

	public function component(){
		$this->load->model('service/advertise');
		$this->load->language('service/advertise');
		if (isset($this->request->get['ad'])) {
			$advertise_id = $this->request->get['ad'];
		} else {
			$advertise_id = 0;
		}

		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('service/advertise/info', 'advertise_id=' . $advertise_id, 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		$mode = isset($this->request->get['mode']) ? strtolower(trim($this->request->get['mode'])) : 'targeting';
		$ad_info = $this->model_service_advertise->getAdvertise($advertise_id,true);
		if($ad_info){
			$data['advertise_id'] = $advertise_id;
			$component = $this->model_service_advertise->getAdvertiseComponent($advertise_id,$mode);
			$data['from'] = isset($component['from']) ? strtolower($component['from']) : 'member';
			$data['modify'] = false;
			$data['modify_action'] = $this->url->link('service/advertise/updateAdComponent', '');
			switch ($mode) {
				case 'targeting':
					$data['targeting_id'] = isset($component['targeting_id']) ? $component['targeting_id'] : false;
					$data['target_url'] = isset($component['target_url']) ? $component['target_url'] : '';
					$location = $language = array();
					if(isset($component['location'])){
						$location = explode(",", $component['location']);
					}
					if(isset($component['language'])){
						$language = explode(",", $component['language']);
					}
					$data['location'] = is_array($location) ? $location : array();
					$data['language'] = is_array($language) ? $language : array();
					if(isset($component['gender'])){
						$data['gender'] = (int)$component['gender'];
					}
					if(isset($component['age_min'])){
						$data['age_min'] = (int)$component['age_min'];
					}else{
						$data['age_min'] = 18;
					}
					if(isset($component['age_max'])){
						$data['age_max'] = (int)$component['age_max'];
					}else{
						$data['age_max'] = 65;
					}
					$data['domain'] = $data['other_location'] = $data['other_language'] = $data['interest'] = $data['behavior'] = $data['more'] = $data['note'] = '';
					if(isset($component['interest'])){
						$data['interest'] = $component['interest'];
					}
					if(isset($component['behavior'])){
						$data['behavior'] = $component['behavior'];
					}
					if(isset($component['more'])){
						$data['more'] = $component['more'];
					}
					if(isset($component['other_location'])){
						$data['other_location'] = $component['other_location'];
					}
					if(isset($component['other_language'])){
						$data['other_language'] = $component['other_language'];
					}
					if(isset($component['note'])){
						$data['note'] = $component['note'];
					}
					if(isset($component['domain'])){
						$data['domain'] = $component['domain'];
						if(empty($data['target_url'])){
							$data['target_url'] = $component['domain'];
						}
					}
					$data['product_id'] = $ad_info['product_id'];
					$this->load->model('catalog/product');
					$data['locations'] = $this->model_catalog_product->getTargetingsByCategory('location');
					$data['genders'] = $this->model_catalog_product->getTargetingsByCategory('gender');
					$data['languages'] = $this->model_catalog_product->getTargetingsByCategory('language');
					$data['text_location'] = $this->language->get('text_location');
					$data['text_language'] = $this->language->get('text_language');
					$data['text_other_location'] = $this->language->get('text_other_location');
					$data['text_other_language'] = $this->language->get('text_other_language');
					$data['text_interest'] = $this->language->get('text_interest');
					$data['text_behavior'] = $this->language->get('text_behavior');
					$data['text_more'] = $this->language->get('text_more');
					$data['text_gender'] = $this->language->get('text_gender');
					$data['text_age'] = $this->language->get('text_age');
					$data['text_age_max'] = $this->language->get('text_age_max');
					$data['text_age_min'] = $this->language->get('text_age_min');
					$data['text_target_url'] = $this->language->get('text_target_url');
					$data['entry_template'] = $this->language->get('entry_template');
					$data['text_audience'] = $this->language->get('text_audience');
					$data['text_targeting_confirm'] = $this->language->get('text_targeting_confirm');
					$data['error_target_url'] = $this->language->get('error_target_url');
					$data['error_target_url_invalid'] = $this->language->get('error_target_url_invalid');
					$data['error_target_url_prefix'] = $this->language->get('error_target_url_prefix');
					$data['error_location'] = $this->language->get('error_location');
					$data['error_gender'] = $this->language->get('error_gender');
					$data['error_language'] = $this->language->get('error_language');
					$this->load->model('localisation/advertise_targeting');
					$status = $this->model_localisation_advertise_targeting->getAdvertiseTargeting($component['status']);
					$progress = empty($status['name']) ? $this->language->get('text_pending') : $status['name'];
					$data['progress'] = sprintf(getBSTagStyle($component['status'],'status'),$progress);
					$data['modify'] = $data['from'] == 'member' && in_array($component['status'], array($this->config->get('ad_targeting_rejected')));
					break;
				case 'post':
					$data['post_id'] = isset($component['post_id']) ? $component['post_id'] : false;
					$data['text_headline'] = $this->language->get('text_headline');
					$data['text_post_text'] = $this->language->get('text_post_text');
					$data['headline'] = $data['text'] = $data['note'] = '';
					if(isset($component['headline'])){
						$data['headline'] = $component['headline'];
					}
					if(isset($component['text'])){
						$data['text'] = $component['text'];
					}

					if(isset($component['note'])){
						$data['note'] = $component['note'];
					}
					$data['status'] = $this->config->get('ad_post_pending');
					if(isset($component['status'])){
						$data['status'] = $component['status'];
					}
					$data['text_post_confirm'] = $this->language->get('text_post_confirm');
					$data['text_length_left'] = $this->language->get('text_length_left');
					$data['error_headline'] = $this->language->get('error_headline');
					$data['error_headline_length'] = $this->language->get('error_headline_length');
					$data['error_text'] = $this->language->get('error_text');
					$data['error_text_length'] = $this->language->get('error_text_length');
					$this->load->model('localisation/advertise_post');
					$status = $this->model_localisation_advertise_post->getAdvertisePost($component['status']);
					$progress = empty($status['name']) ? $this->language->get('text_pending') : $status['name'];
					$data['progress'] = sprintf(getBSTagStyle($component['status'],'status'),$progress);
					$data['modify'] = $data['from'] == 'member' && in_array($component['status'], array($this->config->get('ad_post_rejected')));
					break;
				case 'photo':
					$data['photo_id'] = isset($component['photo_id']) ? $component['photo_id'] : false;
					$data['file'] = $data['note'] = '';
					if(!empty($component['file'])){
						$files = json_decode($component['file'],true);
						if(is_array($files)){
							$file = array();
							$this->load->model('tool/image');
							foreach ($files as $item) {
								$_path = substr($item['path'],strpos($item['path'],'/')+1);
								$file[] = array(
									'realpath' => HTTP_SERVER.$_path,
									'name' => $item['name'],
									'path' => $_path,
									'image'	=> $this->model_tool_image->resize($_path, 100, 100,true)
								);
							}
							$data['file'] = $file;
						}
					}

					if(isset($component['note'])){
						$data['note'] = $component['note'];
					}
					$data['status'] = $this->config->get('ad_photo_pending');
					if(isset($component['status'])){
						$data['status'] = $component['status'];
					}
					$data['text_post_img'] = $this->language->get('text_post_img');
					$data['text_img_delete'] = $this->language->get('text_img_delete');
					$data['button_upload'] = $this->language->get('button_upload');
					$data['text_photo_confirm'] = $this->language->get('text_photo_confirm');
					$data['error_photo'] = $this->language->get('error_photo');
					$this->load->model('localisation/advertise_photo');
					$status = $this->model_localisation_advertise_photo->getAdvertisePhoto($component['status']);
					$progress = empty($status['name']) ? $this->language->get('text_pending') : $status['name'];
					$data['progress'] = sprintf(getBSTagStyle($component['status'],'status'),$progress);
					$data['modify'] = $data['from'] == 'member' && in_array($component['status'], array($this->config->get('ad_photo_rejected')));
					break;
				case 'status':
					$data['ad_publish'] = $ad_info['publish'];
					$data['ad_priority'] = $ad_info['priority_id'];
					$data['text_queue'] = $this->language->get('text_queue');
					$data['text_ad_confirm'] = $this->language->get('text_ad_confirm');
					$data['text_queuing'] = $this->language->get('text_queuing');
					$data['text_money'] = $this->language->get('text_money');
					$data['text_amount'] = $this->language->get('text_amount');
					$data['text_update_priority'] = $this->language->get('text_update_priority');
					$data['text_toggle_queue'] = $this->language->get('text_toggle_queue');

					$data['publish_designing'] = $this->config->get("ad_publish_designing");
					$data['publish_waiting'] = $this->config->get("ad_publish_waiting");
					$data['publish_confirmed'] = $this->config->get("ad_publish_confirmed");
					$data['publish_opening'] = $this->config->get("ad_publish_opening");
					$data['publish_success'] = $this->config->get("ad_publish_success");
					$data['publish_deliveried'] = $this->config->get("ad_publish_deliveried");
					$data['publish_failed'] = $this->config->get("ad_publish_failed");
					$data['publish_refunded'] = $this->config->get("ad_publish_refunded");
					$data['publish_closed'] = $this->config->get("ad_publish_closed");	
					$data['button_priority'] = $this->language->get('button_priority');
					$data['confirm_revoke_apply'] = $this->language->get('confirm_revoke_apply');
					$level_info = $this->model_service_advertise->getLevelDown($advertise_id);
					$data['demotion'] = '';
					if ($level_info) {
						$data['demotion'] = sprintf($this->language->get('detail_demotion'),$level_info['date_added'],$level_info['priority']) ;
					}
				break;				
			}
			
			$data['progress_status'] = $this->language->get('progress_status');
            $data['ad_publish_status'] = $this->language->get('ad_publish_status');
			$data['tab_history'] = $this->language->get('tab_history');
			$data['text_from'] = $this->language->get('text_from');
			$data['text_member'] = $this->language->get('text_member');
			$data['text_backend'] = $this->language->get('text_backend');
			$data['text_note'] = $this->language->get('text_note');
			$data['text_status'] = $this->language->get('text_status');
			$data['button_save'] = $this->language->get('button_save');
			$data['button_close'] = $this->language->get('button_close');
			
			$data['text_publish_queue'] = '';
			$number = false;
			if($ad_info['publish'] == 1){
				$number = $this->model_service_advertise->getQueueNumber($advertise_id);
				$data['text_publish_queue'] = sprintf($this->language->get('text_publish_queue'),$ad_info['priority'],$number);
			}
			$data['text_publish_designing'] = $this->language->get('text_publish_designing');
			$data['text_publish_waiting'] = $this->language->get('text_publish_waiting');
			$data['text_publish_confirmed'] = $this->language->get('text_publish_confirmed');
			$data['text_publish_opening'] = $this->language->get('text_publish_opening');
			$data['text_publish_success'] = $this->language->get('text_publish_success');
			$data['text_publish_deliveried'] = $this->language->get('text_publish_deliveried');
			$data['text_publish_failed'] = $this->language->get('text_publish_failed');
			$data['text_publish_refunded'] = $this->language->get('text_publish_refunded');
			$data['text_publish_closed'] = $this->language->get('text_publish_closed');
			$data['ad_button_confirm'] = $this->language->get('ad_button_confirm');
			$data['text_input']	= $this->language->get('text_input');
			$data['text_loading']	= $this->language->get('text_loading');
			$this->load->model('localisation/advertise_publish');
			$data['ad_publisheds'] = $this->model_localisation_advertise_publish->getAdvertisePublishes();
			$this->response->setOutput($this->load->view('default/template/service/'.$mode.'.tpl', $data));
		}else{
			$this->document->setTitle($this->language->get('text_ad'));

			$data['heading_title'] = $this->language->get('text_ad');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/home')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_account'),
				'href' => $this->url->link('account/account', '', 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('service/advertise', '', 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_ad'),
				'href' => $this->url->link('service/advertise/info', 'advertise_id=' . $advertise_id, 'SSL')
			);

			$data['continue'] = $this->url->link('service/advertise', '', 'SSL');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
		}
	}

	function tracking(){
		$this->load->language('service/advertise');
		$this->load->model('service/advertise');
		$this->load->model('tool/image');
		$advertise_id = isset($this->request->post['ad']) ? (int)$this->request->post['ad'] : false;
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->post['text'])){
			$this->model_service_advertise->addAdvertiseTracking($advertise_id,$this->request->post);

		}
		$data['advertise_id'] = $advertise_id;

		$data['button_send'] = $this->language->get('button_send');
		$data['title_tracking'] = $this->language->get('title_tracking');
		
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_download'] = $this->language->get('button_download');
		$data['text_member'] = $this->language->get('text_member');
		$data['text_backend'] = $this->language->get('text_backend');
		$trackings = $this->model_service_advertise->getAdvertiseTrackings($advertise_id);
		if(is_array($trackings)){
			foreach ($trackings as $key => $item) {
				$trackings[$key]['date'] = date('Y-m-d',strtotime($item['date_added']));
				$trackings[$key]['time'] = date('H:i:s',strtotime($item['date_added']));
				$file = array();
				if(!empty($item['attach'])){
					$attaches = json_decode($item['attach'],true);
					if(is_array($attaches)){
						foreach ($attaches as $attach) {
							if(!isset($attach['path'])){
								continue;
							}
							$_path = substr($attach['path'],strpos($attach['path'],'/')+1);
							if(!file_exists($_path)){
								continue;
							}
							$file[] = array(
								'realpath' => HTTP_SERVER.$_path,
								'name' => $attach['name'],
								'path' => $_path,
								'image'	=> $this->model_tool_image->resize($_path, 100, 100,true),
							);
						}
					}
					
				}
				$trackings[$key]['attach'] = $file;
			}
		}
		$data['trackings'] = $trackings;

		$this->response->setOutput($this->load->view('default/template/service/tracking.tpl', $data));
	}

	public function balance() {
		$this->load->language('service/advertise');
		$this->load->model('service/advertise');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['column_date_priority'] = $this->language->get('column_date_priority');
		$data['column_type'] = $this->language->get('column_type');
		$data['column_priority'] = $this->language->get('column_priority');
		$data['column_note'] = $this->language->get('column_note');
		$data['column_amount'] = $this->language->get('column_amount');
		$data['column_operator'] = $this->language->get('column_operator');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['balances'] = array();

		$this->load->model('service/advertise');

		$results = $this->model_service_advertise->getAdvertiseBalances($this->request->get['ad'], ($page - 1) * 10, 10);

		foreach ($results as $result) {

			$data['balances'][] = array(
				'type'		=> GetLevelTypeName($result['type'],$this->config->get('config_language')),
				'amount'     => $this->currency->format($result['amount']),
				'priority_id'=> $result['priority_id'],
				'priority'	 => $result['priority'],
				'note'    	 => nl2br($result['note']),
				'date_added' => date('Y-m-d H:i:s', strtotime($result['date_added']))
			);
		}

		$history_total = $this->model_service_advertise->getTotalAdvertiseBalances($this->request->get['ad']);

		$pagination = new Pagination();
		$pagination->total = $history_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('service/advertise/balance', '&ad=' . $this->request->get['ad'] . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

		$this->response->setOutput($this->load->view('default/template/service/ad_balance.tpl', $data));
	
	}

	public function queue(){
		$this->load->language('service/advertise');
		$this->load->model('service/advertise');
		$data['text_queuing'] = $this->language->get('text_queuing');
		$data['text_money'] = $this->language->get('text_money');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_update_priority'] = $this->language->get('text_update_priority');
		$data['text_confirm_change'] = $this->language->get('text_confirm_change');
		$data['text_demotion'] = $this->language->get('text_demotion');
		$data['confirm_demotion'] = $this->language->get('confirm_demotion');
		$data['success_demotion'] = $this->language->get('success_demotion');
		
		$data['button_priority'] = $this->language->get('button_priority');
		$data['priority_id'] = isset($this->request->post['priority_id']) ? (int)$this->request->post['priority_id'] : 0;
		$data['advertise_id'] = isset($this->request->post['ad']) ? (int)$this->request->post['ad'] : 0;
		$data['list'] = isset($this->request->post['list']) ? (int)$this->request->post['list'] : false;
		
		$data['priority_info'] = $this->model_service_advertise->getAdvertisePriority($data['advertise_id']);
		$data['default_money'] = 0.00;
		$data['default_amount'] = $this->currency->format(0.00);
		$this->response->setOutput($this->load->view('default/template/service/ad_queue.tpl', $data));
	}

	public function priority(){
		$this->load->language('service/advertise');
		$this->load->model('service/advertise');
		$advertise_id = isset($this->request->post['ad']) ? (int)$this->request->post['ad'] : false;
		$priority_id = isset($this->request->post['priority_id']) ? (int)$this->request->post['priority_id'] : false;

		$result = $this->model_service_advertise->updatePriority($advertise_id,$priority_id);
		switch ($result) {
			case 0:
				$json = array('status'=>0,'msg'=>$this->language->get('text_error_publish'));
				break;
			case -1:
				$json = array('status'=>0,'msg'=>$this->language->get('text_error_priority'));
				break;
			case -2:
				$json = array('status'=>0,'msg'=>$this->language->get('text_error_balance'));
				break;
			case 2:
				$json = array('status'=>1,'msg'=>$this->language->get('success_demotion'));
				break;
			default:
				$json = array('status'=>1,'msg'=>$this->language->get('text_success_priority'));
				break;
		}


		$this->response->setOutput(json_encode($json));
	}
	public function valideteBalance(){
		$this->load->language('service/advertise');
		$this->load->model('service/advertise');
		$balance  = $this->customer->getBalance();

		$advertise_id = isset($this->request->post['ad']) ? $this->request->post['ad'] : 0;
		$priority_id = isset($this->request->post['priority_id']) ? $this->request->post['priority_id'] : 0;
		$ad_info = $this->model_service_advertise->getAdvertise($advertise_id);
		$priority = $this->model_service_advertise->getPriority($priority_id);
		$amount = empty($ad_info['money']) ? 0.00 : $ad_info['money'];
		$json = array('status'=>0,'msg'=>$this->language->get('text_error_balance'));
		if(!isset($priority['money'])){
			$json = array('status'=>0,'msg'=>$this->language->get('text_exception'));
		}else{
			if($amount*1000 > $priority['money']*1000){
				$json = array('status'=>1);
			}else{
				$diff_balance = (float)($priority['money'] - $amount);
				if($balance*1000 >= $diff_balance*1000){
					$json = array('status'=>1);
				}
			}
		}		
		
		$this->response->setOutput(json_encode($json));
	}

	public function waiting_to_confirm(){
		$this->load->language('service/advertise');
		$advertise_id = isset($this->request->post['ad']) ? (int)$this->request->post['ad'] : false;
		$this->load->model('service/advertise');
		
		$data=array('publish'=>$this->config->get('ad_publish_confirmed'),'note'=>'');
		if($advertise_id){		
			$this->model_service_advertise->addAdvertiseHistory($advertise_id,$data);
			
			$json['status'] = 1;
			$json['msg']	= $this->language->get('text_success');
		}else{
			$json['status'] = 0;
		    $json['msg']	= $this->language->get('error_confirm');
		}
		
		$this->response->setOutput(json_encode($json));
	}

	public function revoke(){
		$this->load->language('service/advertise');
		$advertise_id = isset($this->request->post['ad']) ? (int)$this->request->post['ad'] : false;
		$this->load->model('service/advertise');
		
		if($advertise_id){		
			$this->model_service_advertise->revokeLevelDown($advertise_id);
			
			$json['status'] = 1;
			$json['msg']	= $this->language->get('text_revoke_success');
		}else{
			$json['status'] = 0;
		    $json['msg']	= $this->language->get('text_exception');
		}
		
		$this->response->setOutput(json_encode($json));
	}
	public function updateAdComponent(){
		$this->load->model('service/advertise');
		$this->load->language('service/advertise');
		$mode = isset($this->request->post['mode']) ? strtolower($this->request->post['mode']) : 'post';
		$entry = isset($this->request->post['entry']) ? strtolower($this->request->post['entry']) : 'member';
		$result = $this->model_service_advertise->{"editAdvertise".ucfirst($mode)}($entry,$this->request->post);
		$json['status'] = 0;
		$json['msg']	= $this->language->get('text_exception');
		if($result){
			$json = array('status'=>1,'msg'=>$this->language->get('text_save_success'));
		}
		$this->response->setOutput(json_encode($json));
	}

	private function validtePostForm(){

	}

	private function valideteTargetingForm(){

	}

	private function validtePhotoForm(){

	}

}