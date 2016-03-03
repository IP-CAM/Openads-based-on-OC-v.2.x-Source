<?php 
class ControllerCatalogFaq extends Controller {
	private $error = array(); 
	    
  	public function index() {
		$this->language->load('catalog/faq');

    	$this->document->setTitle($this->language->get('heading_title'));  
	 
      	$data['breadcrumbs'] = array();

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('account/account'),        	
        	'separator' => false
      	);

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/faq'),
        	'separator' => $this->language->get('text_separator')
      	);	
			
    	$data['heading_title'] = $this->language->get('heading_title');

    	$this->load->model('catalog/faq');	
    	
  		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$data['faqs'] = array();
  		
		$faq_total = $this->model_catalog_faq->getTotalFaq();

		$results = $this->model_catalog_faq->getFaq(($page - 1) * 20, 20);

	  	foreach ($results as $result) {
	        $data['faqs'][] = array(
                'faq_id'    =>  $result['faq_id'],
	        	'is_top'	=>  $result['is_top'],
				'text'       => html_entity_decode($result['text'], ENT_QUOTES, 'UTF-8'),
				'title'		 => $result['title'],
	        	'date_added' => date('Y-m-d', strtotime($result['date_added']))
	        );
	    }
		
        $pagination = new Pagination();
        $pagination->total = $faq_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('catalog/faq', 'page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($faq_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($faq_total - 10)) ? $faq_total : ((($page - 1) * 10) + 10), $faq_total, ceil($faq_total / 10));

		$data['text_empty'] = $this->language->get('text_empty');
		$data['pagination'] = $pagination->render();

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
				
 		$this->response->setOutput($this->load->view('default/template/catalog/faq.tpl', $data));
  	}

}