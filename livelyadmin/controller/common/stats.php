<?php
class ControllerCommonStats extends Controller {
	public function index() {
		$this->load->language('common/stats');

		$data['text_confirmed_publish'] = $this->language->get('text_confirmed_publish');
		$data['text_published_publish'] = $this->language->get('text_published_publish');
		$data['text_paused_publish'] = $this->language->get('text_paused_publish');

		$this->load->model('service/advertise');

		$ads_total = $this->model_service_advertise->getTotalAdvertises();

		$data['confirmed_publish'] = $this->model_service_advertise->getTotalAdvertises(array('filter_publish' => $this->config->get('ad_publish_confirmed')));


		$data['published_publish'] = $this->model_service_advertise->getTotalAdvertises(array('filter_publish' => $this->config->get('ad_publish_published')));


		$data['paused_publish'] = $this->model_service_advertise->getTotalAdvertises(array('filter_publish' => $this->config->get('ad_publish_paused')));


		return $this->load->view('common/stats.tpl', $data);
	}
}