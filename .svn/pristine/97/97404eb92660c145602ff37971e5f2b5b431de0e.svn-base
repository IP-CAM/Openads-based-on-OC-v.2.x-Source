<?php
class ControllerDashboardRecent extends Controller {
	public function index() {
		$this->load->language('dashboard/recent');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_ad_id'] = $this->language->get('column_ad_id');
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_publish'] = $this->language->get('column_publish');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_in_charge'] = $this->language->get('column_in_charge');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_view'] = $this->language->get('button_view');

		$data['token'] = $this->session->data['token'];

		// Last 5 Orders
		$data['ads'] = array();

		$filter_data = array(
			'sort'  => 'a.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 5
		);
		$this->load->model('service/advertise');
		$this->load->model('customer/customer');
		$this->load->model('user/user');
		$this->load->model('localisation/advertise_publish');

		$results = $this->model_service_advertise->getAdvertises($filter_data);

		foreach ($results as $result) {
			$customer = $this->model_customer_customer->getCustomer($result['customer_id']);
			$in_charger = $this->model_user_user->getUser($result['in_charge']);
			$publish = $this->model_localisation_advertise_publish->getAdvertisePublish($result['publish']);
			$data['ads'][] = array(
				'advertise_id'   => $result['advertise_id'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'customer'      => empty($customer['username']) ? $this->language->get('text_unknown') : $customer['nickname'],
				'charger'       => empty($in_charger['username']) ? $this->language->get('text_unknown') : $in_charger['nickname'],
				'publish' => empty($publish['publish_id']) ? $this->language->get('text_unknown') : $publish['name'],
				'view'       => $this->url->link('service/advertise/edit', 'token=' . $this->session->data['token'] . '&advertise_id=' . $result['advertise_id'], 'SSL'),
			);
		}

		return $this->load->view('dashboard/recent.tpl', $data);
	}
}
