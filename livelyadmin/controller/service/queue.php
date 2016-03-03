<?php
class ControllerServiceQueue extends Controller {
    
    private $error = array();

    public function index() {
        $this->load->language('service/queue');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
        $this->document->addScript(TPL_JS.'form.js');

        $this->load->model('service/queue');


        if (isset($this->request->get['priority_id'])) {
            $priority_id = $this->request->get['priority_id'];
        } else {
            $priority_id = null;
        }


        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'a.date_modified';
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

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('service/queue', 'token=' . $this->session->data['token'] , 'SSL')
        );
        $data['demotion'] = $this->url->link('service/queue/demotion','token='.$this->session->data['token'],'SSL');
        $queue = $this->model_service_queue->getAdvertisesQueue();
        if($queue){
            foreach ($queue as $key => $item) {
                $queue[$key]['link'] = $this->url->link('service/queue','priority_id='.$item['priority_id'].'&token='.$this->session->data['token'],'SSL');
                if(is_null($priority_id) && (int)$queue[$key]['quantity']){
                    $priority_id = (int)$queue[$key]['priority_id'];
                }
            }
        }
        $data['queue'] = $queue;
        $data['publish_indesign'] = $this->config->get('ad_publish_indesign');
        $this->load->model('catalog/product');
        $data['products'] = $this->model_catalog_product->getProducts();

        $data['advertises'] = array();
        $limit = $this->config->get('config_limit_admin');
        $filter_data = array(
            'priority_id'   => $priority_id,
            'sort'          => $sort,
            'order'         => $order,
            'start'         => ($page - 1) * $limit,
            'limit'         => $limit
        );

        $total = $this->model_service_queue->getTotalAdvertises($filter_data);

        $results = $this->model_service_queue->getAdvertises($filter_data);
        foreach ($results as $result) {

            $msg = $this->model_service_queue->getUnreadMessage($result['advertise_id']);
            $demotion = false;
            if($this->model_service_queue->getLevelDown($result['advertise_id'])){
                $demotion = true;
            }
            $data['advertises'][] = array(
                'advertise_id'  => $result['advertise_id'],
                'advertise_sn'  => $result['advertise_sn'],
                'product'       => $this->adstyle->getProductText($result['product_id']),
                'website'       => $result['website'],
                'customer'      => $result['customer'],
                'company'       => $result['company'],
                'in_charge'     => $result['in_charge'],
                'charger'       => $result['charger'],
                'demotion'      => $demotion,
                'msg'           => $msg,
                'date_added'    => date('Y-m-d', strtotime($result['date_added'])).'<br>'.date('H:i:s',strtotime($result['date_added'])),
                'date_modified' => date('Y-m-d', strtotime($result['date_modified'])).'<br>'.date('H:i:s',strtotime($result['date_modified'])),
                'edit'          => $this->url->link('service/advertise/edit','advertise_id='.$result['advertise_id'].'&token='.$this->session->data['token'],'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_missing'] = $this->language->get('text_missing');
        $data['text_push_selected'] = $this->language->get('text_push_selected');
        $data['text_atleast_one'] = $this->language->get('text_atleast_one');
        $data['text_push_design'] = $this->language->get('text_push_design');
        
        $data['entry_from'] = $this->language->get('entry_from');
        $data['entry_to'] = $this->language->get('entry_to');
        $data['entry_notify'] = $this->language->get('entry_notify');
        $data['confirm_cancel_demotion'] = $this->language->get('confirm_cancel_demotion');
        $data['confirm_pass_demotion'] = $this->language->get('confirm_pass_demotion');
        $data['list_demotion'] = $this->language->get('list_demotion');

        $data['column_number'] = $this->language->get('column_number');
        $data['column_ad_sn'] = $this->language->get('column_ad_sn');
        $data['column_product'] = $this->language->get('column_product');
        $data['column_website'] = $this->language->get('column_website');
        $data['column_customer'] = $this->language->get('column_customer');
        $data['column_in_charge'] = $this->language->get('column_in_charge');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_date_modified'] = $this->language->get('column_date_modified');
        $data['column_action'] = $this->language->get('column_action');
        $data['entry_ad_id'] = $this->language->get('entry_ad_id');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_website'] = $this->language->get('entry_website');
        $data['entry_customer'] = $this->language->get('entry_customer');
        $data['entry_in_charge'] = $this->language->get('entry_in_charge');
        $data['entry_date_added'] = $this->language->get('entry_date_added');
        $data['entry_modified_start'] = $this->language->get('entry_modified_start');
        $data['entry_modified_end'] = $this->language->get('entry_modified_end');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_pass'] = $this->language->get('button_pass');
        $data['button_designing'] = $this->language->get('button_designing');
        $data['button_demotion'] = $this->language->get('button_demotion');
        $data['button_filter'] = $this->language->get('button_filter');
        
        $data['token'] = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if (isset($this->request->get['priority_id'])) {
            $url .= '&priority_id=' . $this->request->get['priority_id'];
        }else{
            $url .= '&priority_id=1' ;
        }
        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['sort_ad'] = $this->url->link('service/queue', 'token=' . $this->session->data['token'] . '&sort=a.ad_id' . $url, 'SSL');
        $data['sort_product'] = $this->url->link('service/queue', 'token=' . $this->session->data['token'] . '&sort=a.product_id' . $url, 'SSL');
        $data['sort_website'] = $this->url->link('service/queue', 'token=' . $this->session->data['token'] . '&sort=website' . $url, 'SSL');
        $data['sort_customer'] = $this->url->link('service/queue', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
        $data['sort_in_charge'] = $this->url->link('service/queue', 'token=' . $this->session->data['token'] . '&sort=a.in_charge' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('service/queue', 'token=' . $this->session->data['token'] . '&sort=a.date_added' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('service/queue', 'token=' . $this->session->data['token'] . '&sort=a.date_modified' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['priority_id'])) {
            $url .= '&priority_id=' . $this->request->get['priority_id'];
        }else{
            $url .= '&priority_id=1' ;
        }
        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->url = $this->url->link('service/queue', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

        $data['priority_id'] = $priority_id;
        $data['sort'] = $sort;
        $data['order'] = $order;
        $this->load->model('user/user');
        $data['contributors'] = $this->model_user_user->getUsers(array('filter_status'=>1));

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('service/queue.tpl', $data));
    }

    protected function validate($route) {

        if (!$this->user->hasPermission($route) || !in_array($this->user->getId(), $this->config->get('ad_group_publisher'))) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function demotion() {
        $this->load->language('service/queue');

        $params = array(
            'filter_ad_sn' => 'filter_ad_sn',
            'filter_to' => 'filter_to',
            'filter_from' => 'filter_from',
            'filter_customer' => 'filter_customer',
            'filter_in_charge' => 'filter_in_charge',
            'filter_added_start' => 'filter_added_start',
            'filter_added_end' => 'filter_added_end',
            'sort' => array('default'=>'ald.date_modified'),
            'order' => array('default'=>'DESC'),
            'page' => array('default'=>1),
            'token' => $this->session->data['token']
        );
        $this->document->setTitle($this->language->get('heading_title_demotion'));
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('service/queue', 'token=' . $this->session->data['token'] , 'SSL')
        );

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $this->load->model('user/user');
        $data['managers'] = $this->model_user_user->getAdOperators('manager');

        // Filter Data
        $filter_data = $this->request->getFilter($params);
        $data = array_merge($data,$filter_data);

        $filter_data['start'] = ($filter_data['page'] - 1) * $this->config->get('config_limit_admin');
        $filter_data['limit'] = $this->config->get('config_limit_admin');

        $this->load->model('service/queue');
        $data['advertises'] = array();

        $results = $this->model_service_queue->getAdsLevelDown($filter_data);
        foreach ($results as $result) {
            $data['advertises'][] = array(
                'advertise_id'  => $result['advertise_id'],
                'domain'        => $result['domain'],
                'status'        => $result['website_status'],
                'status_text'   => $result['website_status'] ? $this->language->get('text_active') : $this->language->get('text_stop'),
                'customer'      => $result['customer'],
                'company'       => $result['company'],
                'in_charge'     => $result['in_charge'],
                'charger'       => $result['charger'],
                'from_name'     => $result['from_name'],
                'to_name'       => $result['to_name'],
                'date_added'    => date('Y-m-d', strtotime($result['date_added'])).'<br>'.date('H:i:s',strtotime($result['date_added'])),
            );
        }
        $pagination = new Pagination();
        $pagination->total = $this->model_service_queue->getTotalAdsLevelDown($filter_data);
        $pagination->page = $filter_data['page'];
        $pagination->limit = $filter_data['limit'];
        $pagination->url = $this->url->link('service/queue/demotion', $this->request->setPageUrl($params) . '&page={page}', 'SSL');
        $data['pagination'] = $pagination->render();
        $data['results'] = $pagination->getResults($this->language->get('text_pagination'));

        //Sort Order
        $url = $this->request->setOrderUrl($params);
        $data['sort_website'] = $this->url->link('service/advertise', $url . '&sort=w.domain' , 'SSL');
        $data['sort_ad'] = $this->url->link('service/advertise', $url . '&sort=ald.advertise_id' , 'SSL');
        $data['sort_to'] = $this->url->link('service/advertise', $url . '&sort=ald.to_priority' , 'SSL');
        $data['sort_from'] = $this->url->link('service/advertise', $url . '&sort=ald.from_priority' , 'SSL');
        $data['sort_customer'] = $this->url->link('service/advertise', $url . '&sort=customer' , 'SSL');
        $data['sort_in_charge'] = $this->url->link('service/advertise', $url . '&sort=a.in_charge' , 'SSL');
        $data['sort_date_added'] = $this->url->link('service/advertise', $url . '&sort=ald.date_added' , 'SSL');

        //Page Text
        $this->language->setText($data,array(
            'heading_title' => 'heading_title_demotion',
            'text_list' => 'text_list',
            'text_no_results' => 'text_no_results',
            'text_confirm' => 'text_confirm',
            'column_ad_id' => 'column_ad_id',
            'column_from' => 'column_from',
            'column_to' => 'column_to',
            'column_customer' => 'column_customer',
            'column_website' => 'column_website',
            'column_in_charge' => 'column_in_charge',
            'column_date_added' => 'column_date_added',
            'column_action' => 'column_action',
            'entry_ad_sn' => 'entry_ad_sn',
            'entry_publish' => 'entry_publish',
            'entry_customer' => 'entry_customer',
            'entry_in_charge' => 'entry_in_charge',
            'entry_note' => 'entry_note',
            'entry_notify' => 'entry_notify',
            'entry_date_added' => 'entry_date_added',
            'entry_added_start' => 'entry_added_start',
            'entry_added_end' => 'entry_added_end',
            'entry_from' => 'entry_from',
            'entry_to' => 'entry_to',
            'confirm_cancel_demotion' => 'confirm_cancel_demotion',
            'confirm_pass_demotion' => 'confirm_pass_demotion',

            'button_filter' => 'button_filter',
            'button_cancel' => 'button_cancel',
            'button_close' => 'button_close',
            'button_view' => 'button_view',
            'button_pass' => 'button_pass',
            'button_approve' => 'button_approve',
        ));
        $this->response->setOutput($this->load->view('service/demotion.tpl', $data,true));
    }

    public function ajax_data(){
        $this->load->model('service/queue');
        $this->load->language('service/queue');
        if(isset($this->request->get['action'])){
            $action = strtolower(trim($this->request->get['action']));
        }else if(isset($this->request->post['action'])){
            $action = strtolower(trim($this->request->post['action']));
        }else{
            $action = 'get';
        }
        $json = array();
        switch ($action) {
            case 'get_demotion':
                $advertise_id = isset($this->request->get['advertise_id']) ? (int)$this->request->get['advertise_id'] : false;
                if($advertise_id){
                    $result = $this->model_service_queue->getLevelDown($advertise_id);
                    if($result){
                        $json['status'] = 1;

                        $result['from_list'] = $this->model_service_queue->getAdsQueueList($result['from_priority']);
                        $result['to_list'] = $this->model_service_queue->getAdsQueueList($result['to_priority']);
                        $result['number'] = $this->model_service_queue->getQueueNumber($advertise_id );
                        
                        $json['data']  = $result;
                    }
                }
            break;
            case 'do_demotion':
                $advertise_id = isset($this->request->post['advertise_id']) ? (int)$this->request->post['advertise_id'] : false;
                $approve = isset($this->request->post['approve']) ? (int)$this->request->post['approve'] : false;
                $message = isset($this->request->post['message']) ? htmlspecialchars_decode($this->request->post['message']) : false;
                if($advertise_id){
                    $result = $this->model_service_queue->levelDown($advertise_id,$approve,$message);
                    switch ((int)$result) {
                        case -1:
                            $json = array('status'=>0,'msg'=>$this->language->get('error_advertise'));
                            break;
                        case -2:
                            $json = array('status'=>0,'msg'=>$this->language->get('error_demotion'));
                            break;
                        case 0:
                            $json = array('status'=>1,'msg'=>$this->language->get('text_refuse_demotion'));
                            $this->session->data['success'] = $this->language->get('text_refuse_demotion');
                            break;
                        default:
                            $json = array('status'=>1,'msg'=>$this->language->get('text_success_demotion'));
                            $this->session->data['success'] = $this->language->get('text_success_demotion');
                            break;
                    }
                }
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}