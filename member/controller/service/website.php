<?php
class ControllerServiceWebsite extends Controller {
    private $error = array();

    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('service/website', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }

        $this->load->language('service/website');
        $this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/moment.js');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');
        $this->document->addStyle(TPL_JS.'formvalidation/dist/css/formValidation.css');
        $this->document->addScript(TPL_JS.'formvalidation/dist/js/formValidation.js');
        $this->document->addScript(TPL_JS.'formvalidation/dist/js/framework/bootstrap.min.js');
        $this->document->addStyle('member/view/theme/default/stylesheet/bsswitch.css');
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('account/account')
        );

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('service/website', $url, 'SSL')
        );

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_empty'] = $this->language->get('text_empty');
        $data['text_more_note'] = $this->language->get('text_more_note');
        $data['text_view_ads'] = $this->language->get('text_view_ads');
        $data['text_confirm_toggle'] = $this->language->get('text_confirm_toggle');
        $data['text_confirm_active'] = $this->language->get('text_confirm_active');
        $data['text_confirm_stop'] = $this->language->get('text_confirm_stop');
        $data['text_status_on'] = $this->language->get('text_status_on');
        $data['text_status_off'] = $this->language->get('text_status_off');

        $data['column_status'] = $this->language->get('column_status');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_date_modified'] = $this->language->get('column_date_modified');
        $data['column_product'] = $this->language->get('column_product');
        $data['column_domain'] = $this->language->get('column_domain');
        $data['column_website'] = $this->language->get('column_website');
        $data['column_ads'] = $this->language->get('column_ads');

        $data['entry_domain'] = $this->language->get('entry_domain');
        $data['entry_customer'] = $this->language->get('entry_customer');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_domain'] = $this->language->get('entry_domain');
        $data['entry_note'] = $this->language->get('entry_note');
        $data['entry_toggle_note'] = $this->language->get('entry_toggle_note');
        $data['entry_modified_start'] = $this->language->get('entry_modified_start');
        $data['entry_modified_end'] = $this->language->get('entry_modified_end');

        $data['text_confirm']   = $this->language->get('text_confirm');
        $data['text_loading']   = $this->language->get('text_loading');
        $data['error_product']  = $this->language->get('error_product');
        $data['error_domain'] = $this->language->get('error_domain');
        $data['error_domain_invalid'] = $this->language->get('error_domain_invalid');
        $data['error_toggle_note'] = $this->language->get('error_toggle_note');

        $data['title_new'] = $this->language->get('title_new');
        $data['title_status'] = $this->language->get('title_status');
        $data['title_history'] = $this->language->get('title_history');
        $data['button_stop'] = $this->language->get('button_stop');
        $data['button_active'] = $this->language->get('button_active');
        $data['button_hide'] = $this->language->get('button_hide');
        $data['button_view'] = $this->language->get('button_view');
        $data['button_new_ad'] = $this->language->get('button_new_ad');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_close'] = $this->language->get('button_close');
        $data['button_create'] = $this->language->get('button_create');
        if (isset($this->request->get['filter_alias'])) {
            $filter_alias = $this->request->get['filter_alias'];
        } else {
            $filter_alias = null;
        }
        if (isset($this->request->get['filter_domain'])) {
            $filter_domain = $this->request->get['filter_domain'];
        } else {
            $filter_domain = null;
        }
        if (isset($this->request->get['filter_product'])) {
            $filter_product = $this->request->get['filter_product'];
        } else {
            $filter_product = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
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
            $sort = 'w.website_id';
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
        if (isset($this->request->get['hide'])) {
            $hide = $this->request->get['hide'];
        } else {
            $hide = 0;
        }

        $data['websites'] = array();

        $this->load->model('service/website');

        $filter_data = array(
            'filter_alias'          => $filter_alias,
            'filter_domain'     => $filter_domain,
            'filter_product'        => $filter_product,
            'filter_status'        => $filter_status,
            'filter_modified_start' => $filter_modified_start,
            'filter_modified_end'   => $filter_modified_end,
            'hide'                  => $hide,
            'sort'                  => $sort,
            'order'                 => $order,
            'start'                 => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'                 => $this->config->get('config_limit_admin')
        );

        $website_total = $this->model_service_website->getTotalWebsites($filter_data);

        $results = $this->model_service_website->getWebsites($filter_data);

        foreach ($results as $result) {
            $action = array();
            if($result['status']){
                $action[] = array(
                    'text' => $this->language->get('button_new_ad'),
                    'icon' => '',
                    'class'=> '',
                    'link' => $this->url->link('service/new', 'website=' . $result['website_id'], 'SSL'),
                ); 
            }
            $action[] = array(
                'text' => $this->language->get('text_view'),
                'icon' => '',
                'class'=> '',
                'link' => 'javascript:history('.$result['website_id'].')'
            );


            if($result['show']){
                $action[] = array(
                    'text' => $this->language->get('text_hide'),
                    'icon' => '',
                    'class'=> '',
                    'link' => 'javascript:toggle('.$result['website_id'].',0)',
                );
            }else{
                $action[] = array(
                    'text' => $this->language->get('text_show'),
                    'icon' => '',
                    'class'=> '',
                    'link' => 'javascript:toggle('.$result['website_id'].',1)',
                );
            }
            if($result['status']){
                $status = array(
                    'text' => $this->language->get('text_active'),
                    'icon' => '',//'<i class="fa fa-toggle-on"></i>',
                    'class'=> '',
                    'title'=> $this->language->get('text_toggle_stop'),
                    'link' => 'javascript:status('.$result['website_id'].',0)',
                );
            }else{
                $status = array(
                    'text' => $this->language->get('text_stop'),
                    'icon' => '',//'<i class="fa fa-toggle-off"></i>',
                    'class'=> '',
                    'title'=> $this->language->get('text_toggle_active'),
                    'link' => 'javascript:status('.$result['website_id'].',1)',
                );
            }
            $data['websites'][] = array(
                'website_id'    => $result['website_id'],
                'website_sn'    => $result['website_sn'],
                'domain'        => $result['domain'],
                'ads'           => $result['ads'],                
                'view'          => $this->url->link('service/advertise','website='.$result['website_id'],'SSL'),
                'charger'       => $result['lastname'] . ' ' . $result['firstname'],
                'product'       => $result['product'],
                'status'        => $result['status'],
                'status_text'   => $status,
                'date_modified' => date('Y-m-d', strtotime($result['date_modified'])).'<br>'.date('H:i:s', strtotime($result['date_modified'])),
                'action'        => $action
            );
        }

        $url = '';

        if (isset($this->request->get['hide']) && $this->request->get['hide']) {
            $url .= '&hide=1';
        }
        if (isset($this->request->get['filter_alias'])) {
            $url .= '&filter_alias=' . $this->request->get['filter_alias'];
        }
        if (isset($this->request->get['filter_domain'])) {
            $url .= '&filter_domain=' . urlencode(html_entity_decode($this->request->get['filter_domain'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }
        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . $this->request->get['filter_product'];
        }
        if (isset($this->request->get['filter_modified_start'])) {
            $url .= '&filter_modified_start=' . $this->request->get['filter_modified_start'];
        }

        if (isset($this->request->get['filter_modified_end'])) {
            $url .= '&filter_modified_end=' . $this->request->get['filter_modified_end'];
        }

        $pagination = new Pagination();
        $pagination->total = $website_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('service/website', $url.'&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($website_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($website_total - 10)) ? $website_total : ((($page - 1) * 10) + 10), $website_total, ceil($website_total / 10));

        
        $data['ajax_action'] = $this->url->link('service/website/ajax_data', '', 'SSL');

        $this->load->model('catalog/product');
        $data['products'] = $this->model_catalog_product->getProducts();
        $isHasHide = $this->model_service_website->isHasHide();
        if($hide==1){
            $data['toggle'] = $this->url->link('service/website','' ,'SSL');
            $data['text_toggle'] = $this->language->get('text_toggle_show');
        }else{
        	if($isHasHide){
            $data['toggle'] = $this->url->link('service/website','hide=1' ,'SSL');
            $data['text_toggle'] = $this->language->get('text_toggle_hide');
        	}else{
        		$data['toggle'] = $this->url->link('service/website','' ,'SSL');
                $data['text_toggle'] = "";
        	}
        }
        
        $data['filter_alias'] = $filter_alias;
        $data['filter_domain'] = $filter_domain;
        $data['filter_product'] = $filter_product;
        $data['filter_status'] = $filter_status;
        $data['filter_modified_start'] = $filter_modified_start;
        $data['filter_modified_end'] = $filter_modified_end;

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');

        $this->response->setOutput($this->load->view('default/template/service/website.tpl', $data));

    }
    public function ajax_data(){
        $json = array();
        $this->load->model('service/website');
        $this->load->language('service/website');
        if(isset($this->request->get['action'])){
            $action = strtolower(trim($this->request->get['action']));
        }else if(isset($this->request->post['action'])){
            $action = strtolower(trim($this->request->post['action']));
        }else{
            $action = 'get';
        }
        switch ($action) {
            case 'status':
                if($this->model_service_website->addWebsiteHistory($this->request->post['website'],$this->request->post)){
                    $msg = empty($this->request->post['status']) ? $this->language->get('text_stop_success') : $this->language->get('text_active_success');
                    $json = array('status'=>1,'msg'=>$msg);
                    $this->session->data['success'] = $msg;
                }
                break;
            case 'toggle':
                if($this->model_service_website->toggleWebsite($this->request->post['website'],$this->request->post['toggle'])){
                    $msg = empty($this->request->post['toggle']) ? $this->language->get('text_hide_success') : $this->language->get('text_show_success');
                    $json = array('status'=>1,'msg'=>$msg);
                    $this->session->data['success'] = $msg;
                }
                break;
            case 'create':
                if($this->validate()){
                    $website_id = $this->model_service_website->addWebsite($this->request->post);
                    if($website_id){
                        $json = array('status'=>1,'msg'=>$this->language->get('title_success'));
                        $this->session->data['success'] = $this->language->get('title_success');
                    }
                }else{
                    $json = array('status' =>0 ,'error' => $this->error);
                }
                break;
        }

        $this->response->setOutput(json_encode($json));
    }
    public function history() {
        $this->load->language('service/website');
        $this->load->model('service/website');

        $data['text_more_note'] = $this->language->get('text_more_note');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['column_date_added'] = $this->language->get('column_status_added');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_note'] = $this->language->get('column_note');
        $data['column_from'] = $this->language->get('column_from');
        $data['column_operator'] = $this->language->get('column_operator');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['histories'] = array();

        $this->load->model('service/website');

        $results = $this->model_service_website->getWebsiteHistories($this->request->get['website'], ($page - 1) * 10, 10);

        foreach ($results as $result) {

            $operator = '';
            if($result['customer_id']){
                $operator = ' -- ';
            }else if($result['in_charge']){
                $operator = '<span class="label label-default">'.$this->language->get('text_backend').'</span>';
            }
            $data['histories'][] = array(
                'from'       => ucfirst($result['from']),
                'operator'   => $operator,
                'status'     => $result['status'] ? $this->language->get('text_active') : $this->language->get('text_stop'),
                'note'       => nl2br($result['note']),
                'date_added' => date('Y-m-d H:i:s', strtotime($result['date_added']))
            );
        }

        $history_total = $this->model_service_website->getTotalWebsiteHistories($this->request->get['website']);

        $pagination = new Pagination();
        $pagination->total = $history_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('service/website/history', '&website=' . $this->request->get['website'] . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

        $this->response->setOutput($this->load->view('default/template/service/ws_history.tpl', $data));
    }


    private function validate(){
        $this->load->language('service/website');

        if(!isset($this->request->post['product_id'])){
            $this->error['product'] = $this->language->get('error_product');
        }

        if(!isset($this->request->post['domain']) || !isURL(htmlspecialchars_decode($this->request->post['domain']))){
            $this->error['domain'] = $this->language->get('error_domain');
        }
        return !$this->error;
    }

    function tracking(){
        $this->load->language('service/website');
        $this->load->model('service/website');
        $this->load->model('tool/image');
        $advertise_id = isset($this->request->post['website']) ? (int)$this->request->post['website'] : false;
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->post['text'])){
            $this->model_service_website->addWebsiteTracking($advertise_id,$this->request->post);

        }
        $data['advertise_id'] = $advertise_id;

        $data['button_send'] = $this->language->get('button_send');
        $data['title_tracking'] = $this->language->get('title_tracking');
        
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_download'] = $this->language->get('button_download');
        $data['text_member'] = $this->language->get('text_member');
        $data['text_backend'] = $this->language->get('text_backend');
        $trackings = $this->model_service_website->getWebsiteTrackings($advertise_id);
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
                                'image' => $this->model_tool_image->resize($_path, 100, 100,true),
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

}