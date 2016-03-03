<?php
class ControllerServiceNew extends Controller {
	private $error = array();
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('service/new');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
		$this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
		$this->document->addStyle(TPL_JS.'formvalidation/dist/css/formValidation.css');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/formValidation.js');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/framework/bootstrap.min.js');
		$this->document->addScript(TPL_JS.'jquery.ajaxupload.js');
		$this->document->addScript(TPL_JS.'jquery.maxlength.min.js');
		$this->document->addScript(TPL_JS.'jquery.json.min.js');
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('account/account')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_new_ad'),
			'href' => $this->url->link('service/new', '', 'SSL')
		);

		if (isset($this->request->get['website'])) {
			$website_id = $this->request->get['website'];
		} else {
			$website_id = 0;
		}

		$this->load->model('service/website');
		$this->load->model('service/advertise');
		$website_info = $this->model_service_website->getWebsite($website_id);

		if($website_info){
			$data['website'] = $website_id;
		}else{
			$data['website'] = false;
		}
		$data['websites'] = array();
		$websites = $this->model_service_website->getWebsites(array('filter_status'=>1));
		foreach ($websites as $item) {

			if(isset($data['websites'][$item['product_id']])){
				$data['websites'][$item['product_id']]['website'][] = $item;
			}else{
				$data['websites'][$item['product_id']] = array(
					'product'	=> $item['product'],
					'website'	=> array($item)
				);
			}
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['title_general'] = $this->language->get('title_general');
		$data['title_targeting'] = $this->language->get('title_targeting');
		$data['title_photo'] = $this->language->get('title_photo');
		$data['title_post'] = $this->language->get('title_post');

		$data['entry_website'] = $this->language->get('entry_website');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_target_url'] = $this->language->get('entry_target_url');
		$data['entry_note'] = $this->language->get('entry_note');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_template'] = $this->language->get('entry_template');

		$data['button_next'] = $this->language->get('button_next');
		$data['button_create'] = $this->language->get('button_create');

		$data['text_agree']	= $this->language->get('text_agree');
		$data['text_input']	= $this->language->get('text_input');
		$data['text_confirm']	= $this->language->get('text_confirm');
		$data['text_loading']	= $this->language->get('text_loading');
		$data['text_title_template']	= $this->language->get('text_title_template');
		
		$data['error_website']  = $this->language->get('error_website_new');
		$data['error_product']  = $this->language->get('error_product');
		$data['error_form']  = $this->language->get('error_form');
		$data['error_target_url'] = $this->language->get('error_target_url');
		$data['error_target_url_invalid'] = $this->language->get('error_target_url_invalid');
		$data['error_target_url_prefix'] = $this->language->get('error_target_url_prefix');
		$data['error_agree'] = $this->language->get('error_agree');
		$data['error_location'] = $this->language->get('error_location');
		$data['error_gender'] = $this->language->get('error_gender');
		$data['error_language'] = $this->language->get('error_language');
		$data['error_headline'] = $this->language->get('error_headline');
		$data['error_headline_length'] = $this->language->get('error_headline_length');
		$data['error_text'] = $this->language->get('error_text');
		$data['error_text_length'] = $this->language->get('error_text_length');
		$data['error_photo'] = $this->language->get('error_photo');
		$data['error_audience'] = $this->language->get('error_audience');
		$data['error_targeting_sn'] = $this->language->get('error_targeting_sn');
		$data['error_targeting_sn_length'] = $this->language->get('error_targeting_sn_length');

		$data['action'] = $this->url->link('service/new/create', '', 'SSL');
		
		$data['text_agree'] = $data['agree'] = '';

		if ($this->config->get('ad_checkout_id')) {
			$this->load->model('catalog/information');
			$information_info = $this->model_catalog_information->getInformation($this->config->get('ad_checkout_id'));
			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('catalog/information/agree', 'information_id=' . $this->config->get('config_checkout_id'), 'SSL'), $information_info['title'], $information_info['title']);
			} 
		} 
		if (isset($this->session->data['agree'])) {
			$data['agree'] = $this->session->data['agree'];
		}
		$this->load->model('catalog/product');
		$data['products'] = $this->model_catalog_product->getProducts();

		//Targeting
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
		$data['text_collapse'] = $this->language->get('text_collapse');
		//Post
		$data['text_headline'] = $this->language->get('text_headline');
		$data['text_post_text'] = $this->language->get('text_post_text');
		//Photo
		$data['text_post_img'] = $this->language->get('text_post_img');
		$data['text_img_delete'] = $this->language->get('text_img_delete');
		$data['button_template'] = $this->language->get('button_template');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_close'] = $this->language->get('button_close');
		$data['button_save'] = $this->language->get('button_save');

		$data['priority_info'] = $this->model_service_advertise->getAdvertisePriority();
		$data['default_amount'] = $this->currency->format(0.00);
		foreach ($data['priority_info'] as $item){
			if($item['default']){
				$data['default_amount'] = $item['amount'];
			}
		}
		$data['text_priority'] = $this->language->get('text_priority');
		$data['text_queuing'] = $this->language->get('text_queuing');
		$data['text_money'] = $this->language->get('text_money');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_from'] = $this->language->get('text_from');
		$data['text_member'] = $this->language->get('text_member');
		$data['text_backend'] = $this->language->get('text_backend');
		$data['text_note'] = $this->language->get('text_note');
		$data['text_targeting_sn'] = $this->language->get('text_targeting_sn');
		$data['text_audience'] = $this->language->get('text_audience');
		$data['text_length_left'] = $this->language->get('text_length_left');
		$data['text_select_template'] = $this->language->get('text_select_template');
		$data['text_no_template'] = $this->language->get('text_no_template');
		$data['help_template'] = $this->language->get('help_template');
		$data['redirect'] = $this->url->link('service/advertise');
        $this->load->model('catalog/product');
        $data['products'] = $this->model_catalog_product->getProducts();

        $data['tpl_action'] = $this->url->link('service/new/template','','SSL');
		$data['template'] = $this->load->view('default/template/service/template.tpl', $data);

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');

		$this->response->setOutput($this->load->view('default/template/service/new.tpl', $data));
	}

	public function create(){
		$json = array();
		$this->load->model('service/advertise');
		$this->load->language('service/new');

		if($this->validate()){
			$advertise_sn = $this->model_service_advertise->addAdvertise($this->request->post);
			if($advertise_sn){
				$this->session->data['advertise_sn'] = $advertise_sn;
				$json = array('status'=>1,'msg'=>$this->language->get('title_success'));
			}
		}else{
			$json = array('status' =>0 ,'error' => $this->error);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function template(){

		$this->load->model('account/template');
		$this->load->language('service/new');
		$json = array('status'=>0,'msg'=>$this->language->get('text_exception'));
		
		if($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['tpl']) ){
			$tpl_id = $this->model_account_template->addTargetingTemplate($this->request->post['tpl']);
			$json = array('status'=>1,'msg'=>$this->language->get('text_success_template'));
		}else if(!empty($this->request->get['template_id'])){
			$tpl = $this->model_account_template->getTargetingTemplate($this->request->get['template_id']);
			$json = array('status'=>1,'data'=>$tpl);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));		
	}

	public function getTemplates(){
		$this->load->language('service/new');
		$this->load->model('account/template');
		$product_id = isset($this->request->get['product_id']) ? (int)$this->request->get['product_id'] : 0;
        $templates = $this->model_account_template->getTemplates($product_id);

        $json = array('status'=> 0 ,'msg' => $this->language->get('text_no_result'));
        if($templates){
        	$json = array('status'=>1 , 'msg'=>sprintf($this->language->get('text_total_templates'),count($templates)),'data'=> $templates);
        }
        $this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));	
	}

	public function success(){
		$this->load->language('service/new');
		$this->document->setTitle($this->language->get('title_success'));
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_new_ad'),
			'href' => $this->url->link('service/new', '', 'SSL')
		);
		$data['redirect'] = '';
		if (isset($this->session->data['advertise_id'])) {
			$data['redirect'] = $this->url->link('service/advertise/info', 'ad='.$this->session->data['advertise_sn'],'SSL');
			
		}

		$data['heading_title'] = $this->language->get('title_success');
		$data['text_success'] = $this->language->get('text_success');
		$data['text_ad_desc'] = $this->language->get('text_ad_desc');
		$data['button_detail'] = $this->language->get('button_detail');
		$data['button_transfer'] = $this->language->get('button_transfer');
		
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		
		$this->response->setOutput($this->load->view('default/template/service/success.tpl', $data));
	}

	private function validate(){
		$this->load->language('service/new');

		if(!isset($this->request->post['website_id'])){
			$this->error['website'] = $this->language->get('error_website');
		}
		if(!isset($this->request->post['product_id'])){
			$this->error['product'] = $this->language->get('error_product');
		}

		if(!isset($this->request->post['target_url']) || !isURL(htmlspecialchars_decode($this->request->post['target_url']))){
			$this->error['target_url'] = $this->language->get('error_target_url');
		}
/*
		if(!isset($this->request->post['agree']) || !$this->request->post['agree']){
			$this->error['agree'] = $this->language->get('error_agree');	
		}
*/
		return !$this->error;
	}

	public function component(){
		$this->load->model('service/advertise');
		$this->load->language('service/advertise');

		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('service/advertise/info', 'advertise_id=' . $advertise_id, 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		$mode = isset($this->request->get['mode']) ? strtolower(trim($this->request->get['mode'])) : 'targeting';

		$data['advertise_id'] = false;
		
		$data['progress'] = $this->config->get('ad_progress_pending');
		$data['progress_text'] = $this->language->get('text_pending');			
		$data['modify'] = true;
		$data['from'] = 'member';
		
		switch ($mode) {
			case 'targeting':
				$data['targeting_id'] = false;
				$data['location'] = array();
				$data['language'] = array();
				$data['age_min'] = 18;
				$data['age_max'] = 65;
				$data['gender'] = $data['interest'] = $data['behavior'] = $data['more'] = $data['note'] = '';

				$this->load->model('catalog/product');
				$data['locations'] = $this->model_catalog_product->getTargetingsByCategory('location');
				$data['genders'] = $this->model_catalog_product->getTargetingsByCategory('gender');
				$data['languages'] = $this->model_catalog_product->getTargetingsByCategory('language');
				$data['text_location'] = $this->language->get('text_location');
				$data['text_language'] = $this->language->get('text_language');
				$data['text_interest'] = $this->language->get('text_interest');
				$data['text_behavior'] = $this->language->get('text_behavior');
				$data['text_more'] = $this->language->get('text_more');
				$data['text_gender'] = $this->language->get('text_gender');
				$data['text_age'] = $this->language->get('text_age');
				$data['text_age_max'] = $this->language->get('text_age_max');
				$data['text_age_min'] = $this->language->get('text_age_min');
				$data['text_collapse'] = $this->language->get('text_collapse');

				break;
			case 'post':
				$data['post_id'] = false;
				$data['text_headline'] = $this->language->get('text_headline');
				$data['text_post_text'] = $this->language->get('text_post_text');
				$data['headline'] = $data['text'] = $data['note'] = '';

				$data['status'] = $this->config->get('ad_post_pending');

				$this->load->model('localisation/advertise_post');
				$data['post_statuses'] = $this->model_localisation_advertise_post->getAdvertisePosts();
				break;
			case 'photo':
				$data['photo_id'] = false;
				$data['file'] = $data['note'] = '';
				$data['status'] = $this->config->get('ad_photo_pending');
				$data['text_post_img'] = $this->language->get('text_post_img');
				$data['text_img_delete'] = $this->language->get('text_img_delete');
				$data['button_upload'] = $this->language->get('button_upload');
				$this->load->model('localisation/advertise_photo');
				$data['photo_statuses'] = $this->model_localisation_advertise_photo->getAdvertisePhotos();
				break;
		}
		
		$data['progress_status'] = $this->language->get('progress_status');

		$data['tab_history'] = $this->language->get('tab_history');
		$data['text_from'] = $this->language->get('text_from');
		$data['text_member'] = $this->language->get('text_member');
		$data['text_backend'] = $this->language->get('text_backend');
		$data['text_note'] = $this->language->get('text_note');
		$data['text_status'] = $this->language->get('text_status');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_transfer'] = $this->language->get('button_transfer');
		
		$this->load->model('localisation/advertise_status');
		$data['ad_progresses'] = $this->model_localisation_advertise_status->getAdvertiseStatuses();
		$this->response->setOutput($this->load->view('default/template/service/'.$mode.'.tpl', $data));
	}

}