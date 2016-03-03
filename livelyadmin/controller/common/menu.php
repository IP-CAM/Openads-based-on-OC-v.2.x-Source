<?php
class ControllerCommonMenu extends Controller {
	public function index() {

		$data['menu_nodes'] = $this->user->getMenuNodes();
		$data['url_tpl'] = $this->url->link('__PATH__', 'token='.$this->session->data['token'],'SSL');
    	return $this->load->view('common/menu.tpl', $data);
	}


}