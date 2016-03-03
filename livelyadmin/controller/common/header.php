<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();
		if ($this->request->server['HTTPS']) {
			$data['base'] = $this->config->get('config_ssl');
		} else {
			$data['base'] = $this->config->get('config_url');
		}

		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$this->load->language('common/header');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_approval'] = $this->language->get('text_approval');
		$data['text_front'] = $this->language->get('text_front');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_language'] = $this->language->get('text_language');
		$data['text_homepage'] = $this->language->get('text_homepage');
		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
		$data['text_logout'] = $this->language->get('text_logout');

		$data['text_ads'] = $this->language->get('text_ads');
		$data['text_confirmed_publish'] = $this->language->get('text_confirmed_publish');
		$data['text_published_opening'] = $this->language->get('text_published_opening');
		$data['text_failed_publish'] = $this->language->get('text_failed_publish');
		$data['text_message'] = $this->language->get('text_message');
		$data['text_demotion'] = $this->language->get('text_demotion');
		$data['text_approval'] = $this->language->get('text_approval');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_balance'] = $this->language->get('text_balance');
		$data['text_profile'] = $this->language->get('text_profile');
		$data['lang_action'] = $this->url->link('common/header', '','SSL');
		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		if(($this->request->server['REQUEST_METHOD'] == 'POST')){

			if (isset($this->request->post['code'])) {
				
				$code = strtolower(trim($this->request->post['code']));
				
				if (!isset($this->request->cookie['language']) || $this->request->cookie['language'] != $code) {
					setcookie('language', $code, time() + 3600 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
				}
				$this->session->data['language'] = $code;
				if(isset($languages[$code]['language_id'])){
					$this->config->set('config_language', $languages[$code]['code']);
					$this->config->set('config_language_id', $languages[$code]['language_id']);
				}
			}

			if (isset($this->request->post['redirect'])) {
				$this->response->redirect($this->request->post['redirect']);
			} else {
				$this->response->redirect($this->url->link('common/dashboard','token='.$this->session->data['token'],'SSL'));
			}
		}
		
		$data['code'] = $this->session->data['language'];

		$data['languages'] = array();
		foreach ($languages as $result) {
			if ($result['status']) {
				$data['languages'][] = array(
					'name'  => $result['name'],
					'code'  => $result['code'],
					'image' => $result['image']
				);
			}
		}

		if (!isset($this->request->get['token']) || !isset($this->session->data['token']) && ($this->request->get['token'] != $this->session->data['token'])) {
			$data['logged'] = '';

			$data['redirect'] = HTTP_SERVER;
			$data['home'] = $this->url->link('common/dashboard', '', 'SSL');
		} else {
			$data['lang_action'] = $this->url->link('common/header', 'token='.$this->session->data['token'],'SSL');
			$data['logged'] = true;

			$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
			$data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');
			$data['dashboard'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
			$data['profile'] = $this->url->link('common/private', 'token=' . $this->session->data['token'], 'SSL');
			$data['balance'] = $this->url->link('finance/customer_balance', 'token=' . $this->session->data['token'], 'SSL');

			$this->load->model('service/advertise');

			$data['confirmeds'] = $this->model_service_advertise->getTotalAdvertises(array('filter_publish' => $this->config->get('ad_publish_confirmed')));
			$data['confirmed_publish'] = $this->url->link('service/advertise', 'token=' . $this->session->data['token'] . '&filter_publish='.$this->config->get('ad_publish_confirmed') , 'SSL');

			$data['openings'] = $this->model_service_advertise->getTotalAdvertises(array('filter_publish' => $this->config->get('ad_publish_opening')));
			$data['opening_publish'] = $this->url->link('service/advertise', 'token=' . $this->session->data['token'] . '&filter_publish='.$this->config->get('ad_publish_opening') , 'SSL');

			$data['faileds'] = $this->model_service_advertise->getTotalAdvertises(array('filter_publish' => $this->config->get('ad_publish_failed')));
			$data['failed_publish'] = $this->url->link('service/advertise', 'token=' . $this->session->data['token'] . '&filter_publish='.$this->config->get('ad_publish_failed') , 'SSL');
			$message_total = 0;

			$data['demotion_total'] = $this->model_service_advertise->getTotalLevelDown();
			$data['demotion'] = $this->url->link('service/queue/demotion', 'token=' . $this->session->data['token'] . '', 'SSL');

			$data['message_total'] = $this->model_service_advertise->getUnreadMessage();
			$data['customer_message'] = $this->url->link('service/advertise', 'filter_message=1&token=' . $this->session->data['token'] . '', 'SSL');
			
			$data['alerts'] = $data['confirmeds'] + $data['faileds'] + $data['message_total'] + $data['demotion_total'];
			$data['front'] = HTTP_CATALOG;

			//redirect
			$url_data = $this->request->get;

			$route = $url_data['route'];

			unset($url_data['route']);

			$url = '';

			if ($url_data) {
				$url = '&' . urldecode(http_build_query($url_data, '', '&'));
			}

			$data['redirect'] = $this->url->link($route, $url, $this->request->server['HTTPS']);
		}

		return $this->load->view('common/header.tpl', $data);
	}

}