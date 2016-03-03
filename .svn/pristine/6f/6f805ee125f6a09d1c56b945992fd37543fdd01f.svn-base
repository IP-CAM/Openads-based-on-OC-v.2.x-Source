<?php 
class ControllerCatalogNews extends Controller {
	private $error = array(); 
	    
  	public function index() {
		$this->language->load('catalog/news');

    	$this->document->setTitle($this->language->get('heading_title'));  
	 
      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('account/account'),        	
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/news'),
        	'separator' => $this->language->get('text_separator')
      	);	
			
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->load->model('catalog/news');	
    	
  		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$this->data['newses'] = array();
		
		$news_total = $this->model_catalog_news->getTotalNews();
    
		$results = $this->model_catalog_news->getNews(($page - 1) * 20, 20);
		
  		foreach ($results as $result) {
        	$this->data['newses'][] = array(
        		
				'text'       => html_entity_decode($result['text'], ENT_QUOTES, 'UTF-8'),
				'title'		 => $result['title'],
        		'newses'    	 => sprintf($this->language->get('text_newses'), (int)$news_total),
        		'date_added' => date('Y-m-d', strtotime($result['date_added']))
        	);
      	}
        $pagination = new Pagination();
        $pagination->total = $news_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('catalog/news', 'page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($news_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($news_total - 10)) ? $news_total : ((($page - 1) * 10) + 10), $news_total, ceil($news_total / 10));

        $data['text_no_news'] = $this->language->get('text_no_news');
        $data['pagination'] = $pagination->render();

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
                
        $this->response->setOutput($this->load->view('default/template/catalog/news.tpl', $data));		
  	}
}