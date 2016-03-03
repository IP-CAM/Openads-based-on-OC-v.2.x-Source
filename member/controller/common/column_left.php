<?php
class ControllerCommonColumnLeft extends Controller {
	public function index() {

		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'common/home';
		}

		$this->load->language('common/column_left');
		$data['column_left'] = array();
		
		$data['text_overview'] = $this->language->get('text_overview');
		$data['text_change_password'] = $this->language->get('text_change_password');
		$data['text_profile'] = $this->language->get('text_profile');
		$data['text_ad_report'] = $this->language->get('text_ad_report');
		$data['text_ad_template'] = $this->language->get('text_ad_template');
		$data['text_balance'] = $this->language->get('text_balance');
		$data['text_create_ads'] = $this->language->get('text_create_ads');
		$data['text_ads_history'] = $this->language->get('text_ads_history');
		$data['text_balance_history'] = $this->language->get('text_balance_history');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_website'] = $this->language->get('text_website');

		$data['home'] = $this->url->link('common/home');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['profile'] = $this->url->link('account/edit', '', 'SSL');
		$data['ad_report'] = $this->url->link('account/targeting', '', 'SSL');
		$data['ad_template'] = $this->url->link('account/template', '', 'SSL');
		$data['change_password'] = $this->url->link('account/password', '', 'SSL');
		$data['create_ads'] = $this->url->link('service/new', '', 'SSL');
		$data['ads_history'] = $this->url->link('service/advertise', '', 'SSL');
		$data['balance_history'] = $this->url->link('service/customer_balance', '', 'SSL');
		$data['website'] = $this->url->link('service/website', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
		$company = $this->customer->getCompany();
		$nickname = $this->customer->getNickName();//(!empty($nickname) ? '&nbsp;'.$nickname : '' )
		//$data['text_account'] = sprintf($this->language->get('text_account'),empty($company) ? $this->customer->getUsername() : $company);
		$data['amount'] = $this->currency->format($this->customer->getBalance());
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/column_left.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/column_left.tpl', $data);
		} else {
			return $this->load->view('default/template/common/column_left.tpl', $data);
		}
	}
}