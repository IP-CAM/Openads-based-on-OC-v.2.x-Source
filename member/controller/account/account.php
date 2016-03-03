<?php
class ControllerAccountAccount extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/account');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_help'] = $this->language->get('entry_help');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_profile'] = $this->language->get('entry_profile');
		$data['entry_new_ad'] = $this->language->get('entry_new_ad');
		$data['entry_advertise'] = $this->language->get('entry_advertise');
		$data['text_priority'] = $this->language->get('text_priority');
		$data['text_all_ad'] = $this->language->get('text_all_ad');
		$data['text_my_ad'] = $this->language->get('text_my_ad');
		$data['text_queue'] = $this->language->get('text_queue');
		$data['text_queuing'] = $this->language->get('text_queuing');
		$data['text_developing'] = $this->language->get('text_developing');
		$data['text_deliveried'] = $this->language->get('text_deliveried');
		$data['text_terminated'] = $this->language->get('text_terminated');
		$data['text_money'] = $this->language->get('text_money');

		$nickname = $this->customer->getNickName();
		$flname = $this->customer->getFirstName().$this->customer->getLastName();
		$customer_name = $this->customer->getUsername().(!empty($nickname) ? " (".$nickname.") " : "").(!empty($flname) ? " (".$flname.") " : "");
		$data['text_welcome'] = sprintf($this->language->get('text_welcome'),$customer_name,$this->currency->format($this->customer->getBalance()));
		
		$data['publish_designing'] = $this->config->get('ad_publish_designing');
		$data['publish_deliveried'] = $this->config->get('ad_publish_deliveried');
		$data['publish_refunded'] = $this->config->get('ad_publish_refunded');
		$data['email'] = $this->customer->getEmail();
		$data['password'] = $this->url->link('account/password','','SSL');
		$data['profile'] = $this->url->link('account/edit','','SSL');
		$data['advertise'] = $this->url->link('service/advertise','','SSL');
		$data['new_ad'] = $this->url->link('service/new','','SSL');
		$data['help'] = $this->url->link('catalog/faq','','SSL');

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');

		$this->load->model('service/advertise');
		$data['priority'] = $this->model_service_advertise->getPriorityOverview();

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/account.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/account.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/account.tpl', $data));
		}
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}