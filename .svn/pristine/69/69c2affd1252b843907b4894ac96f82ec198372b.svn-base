<?php
class ControllerReportTargeting extends Controller {

	public function index(){
		$this->language->load('report/targeting');

		$this->document->setTitle($this->language->get('heading_title'));
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');		
		$this->load->model('report/targeting');

        $filter_column = false;
        if (isset($this->request->get['filter_advertise_sn'])) {
            $filter_advertise_sn = $this->request->get['filter_advertise_sn'];
            $filter_column = true;
        } else {
            $filter_advertise_sn = null;
        }
        if (isset($this->request->get['filter_targeting_sn'])) {
            $filter_targeting_sn = $this->request->get['filter_targeting_sn'];
            $filter_column = true;
        } else {
            $filter_targeting_sn = null;
        }        
        if (isset($this->request->get['filter_target_url'])) {
            $filter_target_url = $this->request->get['filter_target_url'];
            $filter_column = true;
        } else {
            $filter_target_url = null;
        }
        if (isset($this->request->get['filter_product_id'])) {
            $filter_product_id = (int)$this->request->get['filter_product_id'];
            $filter_column = true;
        } else {
            $filter_product_id = null;
        }
        if (isset($this->request->get['filter_location'])) {
            $filter_location = $this->request->get['filter_location'];
            $filter_column = true;
        } else {
            $filter_location = null;
        }
        if (isset($this->request->get['filter_gender'])) {
            $filter_gender = (int)$this->request->get['filter_gender'];
            $filter_column = true;
        } else {
            $filter_gender = null;
        }
        if (isset($this->request->get['filter_age_min'])) {
            $filter_age_min = (int)$this->request->get['filter_age_min'];
            $filter_column = true;
        } else {
            $filter_age_min = null;
        }
        if (isset($this->request->get['filter_age_max'])) {
            $filter_age_max = (int)$this->request->get['filter_age_max'];
            $filter_column = true;
        } else {
            $filter_age_max = null;
        }
        if (isset($this->request->get['filter_customer_id'])) {
            $filter_customer_id = (int)$this->request->get['filter_customer_id'];
            $filter_column = true;
        } else {
            $filter_customer_id = null;
        }

        if (isset($this->request->get['filter_interest'])) {
            $filter_interest = (int)$this->request->get['filter_interest'];
            $filter_column = true;
        } else {
            $filter_interest = null;
        }

        if (isset($this->request->get['filter_publish'])) {
            $filter_publish = $this->request->get['filter_publish'];
            $filter_column = true;
        } else {
            $filter_publish = null;
        }

        if (isset($this->request->get['filter_language'])) {
            $filter_language = (int)$this->request->get['filter_language'];
            $filter_column = true;
        } else {
            $filter_language = null;
        }
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'att.targeting_sn';
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

        $url = '';
        if (isset($this->request->get['filter_targeting_sn'])) {
            $url .= '&filter_targeting_sn=' . $this->request->get['filter_targeting_sn'];
        }
        if (isset($this->request->get['filter_advertise_sn'])) {
            $url .= '&filter_advertise_sn=' . $this->request->get['filter_advertise_sn'];
        }           
        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }
        if (isset($this->request->get['filter_location'])) {
            $url .= '&filter_location=' . $this->request->get['filter_location'];
        }
        if (isset($this->request->get['filter_customer_id'])) {
            $url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
        }
        if (isset($this->request->get['filter_gender'])) {
            $url .= '&filter_gender=' . $this->request->get['filter_gender'];
        }
        if (isset($this->request->get['filter_interest'])) {
            $url .= '&filter_interest=' . $this->request->get['filter_interest'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' .urlencode(html_entity_decode(trim($this->request->get['filter_publish']), ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_audience'])) {
            $url .= '&filter_audience=' . (int)$this->request->get['filter_audience'];
        }
        if (isset($this->request->get['filter_language'])) {
            $url .= '&filter_language=' . (int)$this->request->get['filter_language'];
        }
        if (isset($this->request->get['filter_target_url'])) {
            $url .= '&filter_target_url=' . urlencode(html_entity_decode(trim($this->request->get['filter_target_url']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('report/targeting', 'token=' . $this->session->data['token'], 'SSL')
        );
        $limit = 100;
        $data['records'] = array();

        $filter_data = array(         
            'filter_product_id'	=> $filter_product_id,
            'filter_customer_id'=> $filter_customer_id,           
            'filter_interest'   => $filter_interest,
            'filter_publish'    => $filter_publish,
            'filter_language'   => $filter_language,
            'filter_gender'     => $filter_gender,
            'filter_location'   => $filter_location,
            'filter_advertise_sn' => $filter_advertise_sn,
            'filter_targeting_sn' => $filter_targeting_sn,
            'filter_target_url' => $filter_target_url,
            'sort'              => $sort,
            'order'             => $order,
            //'start'             => ($page - 1) * $limit,
            //'limit'             => $limit
        );

        $results  = $this->model_report_targeting->getAdTargetings($filter_data);

        $limit = $total = $this->model_report_targeting->getTotalAdTargetings($filter_data);
        $this->load->model('catalog/product');
        $this->load->model('localisation/targeting');
        $this->load->model('localisation/advertise_publish');
        $this->load->model('customer/customer');
        $n = 0;

        foreach ($results as $result) {
            $customer = $this->model_customer_customer->getCustomer($result['customer_id']);
            $product = $this->model_catalog_product->getProduct($result['product_id']);
            $style = $this->getPublishStyle($result['publish']);
            $gender = $this->model_localisation_targeting->getTargeting($result['gender']);
            $location = array();
            $countries = explode(",", $result['location']);
            if(is_array($countries)){
                foreach ($countries as $country_id) {
                    $targeting = $this->model_localisation_targeting->getTargeting($country_id);
                    if(!empty($targeting['value'])){
                        $location[] = $targeting['name'];
                    }
                }
            }
            $language = array();
            $languages = explode(",", $result['language']);
            if(is_array($languages)){
                foreach ($languages as $language_id) {
                    $targeting = $this->model_localisation_targeting->getTargeting($language_id);
                    if(!empty($targeting['value'])){
                        $language[] = $targeting['name'];
                    }
                }
            }
            $data['records'][] = array(
                'id'            => ++$n,
                'advertise_sn'  => $result['advertise_sn'],
                'targeting_id'  => $result['targeting_id'],
                'targeting_sn'  => $result['targeting_sn'],
                'target_url'    => $result['target_url'],
                'product'       => empty($product['name']) ? '' : $product['name'],
                'customer'      => empty($customer['nickname']) ? '' : $customer['nickname'],
                'gender'        => empty($gender['name']) ? '' : $gender['name'],
                'location'      => implode("<br>", $location),
                'language'      => implode("<br>", $language),
                'interest'      => $result['interest'],
                'audience'      => number_format($result['audience']),
                'age'           => $result['age_max'] < 100 ? $result['age_min'].' - '.$result['age_max'] : $result['age_min']." - 65+" ,
                'account'       => $result['ad_account'],
                'publish'       => $style['text'],
                'class'         => $style['class']
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_report_config'] = $this->language->get('text_report_config');
        $data['text_list'] = $this->language->get('text_list');
        $data['text_dblclick'] = $this->language->get('text_dblclick');
        $data['text_waiting'] = $this->language->get('text_waiting');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_confirm_save'] = $this->language->get('text_confirm_save');

        $data['column_target_url'] = $this->language->get('column_target_url');
        $data['column_advertise_sn'] = $this->language->get('column_advertise_sn');
        $data['column_targeting_sn'] = $this->language->get('column_targeting_sn');
        $data['column_customer'] = $this->language->get('column_customer');
        $data['column_language'] = $this->language->get('column_language');
        $data['column_location'] = $this->language->get('column_location');
        $data['column_gender'] = $this->language->get('column_gender');
        $data['column_publish'] = $this->language->get('column_publish');
        $data['column_audience'] = $this->language->get('column_audience');
        $data['column_age'] = $this->language->get('column_age');
        $data['column_id'] = $this->language->get('column_id');
        $data['column_account'] = $this->language->get('column_account');
        $data['column_product'] = $this->language->get('column_product');
        $data['column_interest'] = $this->language->get('column_interest');

        $data['entry_advertise_sn'] = $this->language->get('entry_advertise_sn');
        $data['entry_targeting_sn'] = $this->language->get('entry_targeting_sn');
        $data['entry_location'] = $this->language->get('entry_location');
        $data['entry_language'] = $this->language->get('entry_language');
        $data['entry_interest'] = $this->language->get('entry_interest');
        $data['entry_behavior'] = $this->language->get('entry_behavior');
        $data['entry_gender'] = $this->language->get('entry_gender');
        $data['entry_age'] = $this->language->get('entry_age');
        $data['entry_age_max'] = $this->language->get('entry_age_max');
        $data['entry_age_min'] = $this->language->get('entry_age_min');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_customer'] = $this->language->get('entry_customer');
        $data['entry_publish'] = $this->language->get('entry_publish');
        $data['entry_target_url'] = $this->language->get('entry_target_url');

        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_close'] = $this->language->get('button_close');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_config'] = $this->language->get('button_config');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_export'] = $this->language->get('button_export');

        $data['reset'] = $this->url->link('report/targeting', 'token='.$this->session->data['token'],'SSL');
        $data['cancel'] = $this->url->link('common/dashboard', 'token='.$this->session->data['token'],'SSL');

        $data['token'] = $this->session->data['token'];

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->session->data['warning'])) {
            $data['error_warning'] = $this->session->data['warning'];

            unset($this->session->data['warning']);
        } else {
            $data['error_warning'] = '';
        }

        $url = '';
        if (isset($this->request->get['filter_targeting_sn'])) {
            $url .= '&filter_targeting_sn=' . $this->request->get['filter_targeting_sn'];
        }
        if (isset($this->request->get['filter_advertise_sn'])) {
            $url .= '&filter_advertise_sn=' . $this->request->get['filter_advertise_sn'];
        }           
        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }
        if (isset($this->request->get['filter_location'])) {
            $url .= '&filter_location=' . $this->request->get['filter_location'];
        }
        if (isset($this->request->get['filter_customer_id'])) {
            $url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
        }
        if (isset($this->request->get['filter_gender'])) {
            $url .= '&filter_gender=' . $this->request->get['filter_gender'];
        }
        if (isset($this->request->get['filter_interest'])) {
            $url .= '&filter_interest=' . $this->request->get['filter_interest'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' .urlencode(html_entity_decode(trim($this->request->get['filter_publish']), ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_audience'])) {
            $url .= '&filter_audience=' . (int)$this->request->get['filter_audience'];
        }
        if (isset($this->request->get['filter_language'])) {
            $url .= '&filter_language=' . (int)$this->request->get['filter_language'];
        }
        if (isset($this->request->get['filter_target_url'])) {
            $url .= '&filter_target_url=' . urlencode(html_entity_decode(trim($this->request->get['filter_target_url']), ENT_QUOTES, 'UTF-8'));
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['sort_targeting_sn'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=att.targeting_sn' . $url, 'SSL');
        $data['sort_advertise_sn'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=a.advertise_sn' . $url, 'SSL');
        $data['sort_publish'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=a.publish' . $url, 'SSL');
        $data['sort_language'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=at.language' . $url, 'SSL');
        $data['sort_customer'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=at.customer_id' . $url, 'SSL');
        $data['sort_gender'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=at.gender' . $url, 'SSL');
        $data['sort_location'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=at.location' . $url, 'SSL');
        $data['sort_age'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=at.age_min' . $url, 'SSL');
        $data['sort_product'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=at.product_id' . $url, 'SSL');
        $data['sort_target_url'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=a.target_url' . $url, 'SSL');
        $data['sort_audience'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=at.audience' . $url, 'SSL');
        $data['sort_interest'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=at.interest' . $url, 'SSL');
        $data['sort_account'] = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . '&sort=at.account' . $url, 'SSL');
        $url = '';
        if (isset($this->request->get['filter_targeting_sn'])) {
            $url .= '&filter_targeting_sn=' . $this->request->get['filter_targeting_sn'];
        }
        if (isset($this->request->get['filter_advertise_sn'])) {
            $url .= '&filter_advertise_sn=' . $this->request->get['filter_advertise_sn'];
        }        
        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }
        if (isset($this->request->get['filter_location'])) {
            $url .= '&filter_location=' . $this->request->get['filter_location'];
        }
        if (isset($this->request->get['filter_customer_id'])) {
            $url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
        }
        if (isset($this->request->get['filter_gender'])) {
            $url .= '&filter_gender=' . $this->request->get['filter_gender'];
        }
        if (isset($this->request->get['filter_interest'])) {
            $url .= '&filter_interest=' . $this->request->get['filter_interest'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' .urlencode(html_entity_decode(trim($this->request->get['filter_publish']), ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_audience'])) {
            $url .= '&filter_audience=' . (int)$this->request->get['filter_audience'];
        }
        if (isset($this->request->get['filter_language'])) {
            $url .= '&filter_language=' . (int)$this->request->get['filter_language'];
        }
        if (isset($this->request->get['filter_target_url'])) {
            $url .= '&filter_target_url=' . urlencode(html_entity_decode(trim($this->request->get['filter_target_url']), ENT_QUOTES, 'UTF-8'));
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
        $pagination->url = $this->url->link('report/targeting', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();
        $limit = $limit ? $limit : 1;
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

        $data['filter_targeting_sn']= $filter_targeting_sn;
        $data['filter_advertise_sn']= $filter_advertise_sn;
        $data['filter_product_id']= $filter_product_id;
        $data['filter_customer_id']= $filter_customer_id;
        $data['filter_interest']= $filter_interest;
        $data['filter_publish']= array();
        $filter_publishes = explode(",", $filter_publish);
        if(is_array($filter_publishes)){
            $data['filter_publish'] = $filter_publishes; 
        }
        $data['filter_language']= $filter_language;
        $data['filter_gender']= $filter_gender;
        $data['filter_location']= $filter_location;
        $data['filter_target_url']= $filter_target_url;
        $data['filter_column']= $filter_column ;
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['filter_customer'] = '';
        if($filter_customer_id){
            $customer = $this->model_customer_customer->getCustomer($filter_customer_id);
            $data['filter_customer'] = empty($customer['username']) ? '' : $customer['username'].' '.$customer['nickname'];
        }

		$this->load->model('catalog/product');
        $data['products'] = $this->model_catalog_product->getProducts();
        $data['report_publishes'] = $this->getReportPublishes();
        $this->load->model('localisation/advertise_publish');
        $data['post_publishes'] = $tmp['post_publishes'] = $this->model_localisation_advertise_publish->getAdvertisePublishes();
        $tmp['text_report_indesign'] = $this->language->get('text_report_indesign');
        $tmp['text_report_waiting'] = $this->language->get('text_report_waiting');
        $tmp['text_report_doing'] = $this->language->get('text_report_doing');
        $tmp['text_report_running'] = $this->language->get('text_report_running');
        $tmp['text_report_banned'] = $this->language->get('text_report_banned');        

        $tmp['report_indesign'] = (array)$this->config->get('report_ad_publish_indesign');
        $tmp['report_waiting'] = (array)$this->config->get('report_ad_publish_waiting');
        $tmp['report_doing'] = (array)$this->config->get('report_ad_publish_doing');
        $tmp['report_running'] = (array)$this->config->get('report_ad_publish_running');
        $tmp['report_banned'] = (array)$this->config->get('report_ad_publish_banned');

        $data['config_tpl'] = $this->load->view('report/config.tpl', $tmp);
        $data['countries'] = $this->model_localisation_targeting->getTargetingsByCategory('location');
        $data['languages'] = $this->model_localisation_targeting->getTargetingsByCategory('language');

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('report/targeting.tpl', $data));
    }

    private function getPublishStyle($publish){
        
        switch ((int)$publish) {
            case in_array($publish,(array)$this->config->get('report_ad_publish_waiting')):
                $class = 'waiting';
                $text = $this->language->get('text_report_waiting');
                break;
            case in_array($publish,(array)$this->config->get('report_ad_publish_doing')):
                $class = 'doing';
                $text = $this->language->get('text_report_doing');
                break;
            case in_array($publish,(array)$this->config->get('report_ad_publish_running')):
                $class = 'running';
                $text = $this->language->get('text_report_running');
                break;
            case in_array($publish,(array)$this->config->get('report_ad_publish_banned')):
                $class = 'banned';
                $text = $this->language->get('text_report_banned');
                break;
            default :
                $class = 'indesign';
                $text = $this->language->get('text_report_indesign');
                break;                              
        }
        return array('class'=>$class,'text'=>$text);
    }

    private function getReportPublishes(){
        return array(
            'indesign' => array(
                'text'  => $this->language->get('text_report_indesign'),
                'value' => implode(",", (array)$this->config->get('report_ad_publish_indesign'))
            ),
            'waiting' => array(
                'text'  => $this->language->get('text_report_waiting'),
                'value' => implode(",", (array)$this->config->get('report_ad_publish_waiting'))
            ),
            'doing' => array(
                'text'  => $this->language->get('text_report_doing'),
                'value' => implode(",", (array)$this->config->get('report_ad_publish_doing'))
            ),
            'running' => array(
                'text'  => $this->language->get('text_report_running'),
                'value' => implode(",", (array)$this->config->get('report_ad_publish_running'))
            ),
            'banned' => array(
                'text'  => $this->language->get('text_report_banned'),
                'value' => implode(",", (array)$this->config->get('report_ad_publish_banned'))
            )
        );
    }

    public function edit() {
        $this->load->language('report/targeting');
        $this->load->model('report/targeting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('report/targeting/edit')) {
            if($this->model_report_targeting->editAdTargeting($this->request->post)){
                $this->session->data['success'] = $this->language->get('text_success');
                $json = array('status'=>1,'msg'=>$this->language->get('text_success'));
            }else{
                $json = array('status'=>-1,'msg'=>$this->language->get('error_permission'));
            }
        }else{
            $json = array('status'=>0,'msg'=>implode(' , ', $this->error));
        }
        $this->response->setOutput(json_encode($json));
    }    

    private function getCellStyle($class){
        $data = array();
        switch (strtolower($class)) {
            case 'indesign':
                $data['color'] = array('rgb'=>'000000');
                $data['bold'] = true;
                $data['size'] = 12;
                break;
            case 'waiting':
                $data['color'] = array('rgb'=>'0066cc');
                $data['bold'] = true;
                $data['size'] = 12;
                break;
            case 'doing':
                $data['color'] = array('rgb'=>'ffcc00');
                $data['bold'] = true;
                $data['size'] = 12;
                break;  
            case 'running':
                $data['color'] = array('rgb'=>'008000');
                $data['bold'] = true;
                $data['size'] = 12;
                break;   
            case 'banned':
                $data['color'] = array('rgb'=>'808080');
                $data['bold'] = false;
                $data['strike'] = true;
                $data['size'] = 12;
                break;  
        }
        return $data;
    }

    public function export(){
        
        $token = $this->session->data['token'];
        $data = isset($this->request->post['data']) ? htmlspecialchars_decode($this->request->post['data']) : false;
        $this->language->load('report/targeting');
        if($data){
            $basePath = DIR_DOWNLOAD;
            if(!file_exists($basePath)){
                @mkdir($basePath);
            }            
            $fileName=date('YmdHi',time()).'-Targeting.xls';
            $targetFile = rtrim($basePath,'/') . '/'. $fileName;
            $headline = array(
                'A1' => $this->language->get('column_advertise_sn'),
                'B1' => $this->language->get('column_targeting_sn'),
                'C1' => $this->language->get('column_product'),
                'D1' => $this->language->get('column_location'),
                'E1' => $this->language->get('column_gender'),
                'F1' => $this->language->get('column_age'),
                'G1' => $this->language->get('column_language'),
                'H1' => $this->language->get('column_interest'),
                'I1' => $this->language->get('column_audience'),
                'J1' => $this->language->get('column_publish'),
                'K1' => $this->language->get('column_customer'),
                'L1' => $this->language->get('column_target_url'),
                'M1' => $this->language->get('column_account')
            );
            $items = array();
            $records = json_decode($data,true);
            if(is_array($records)){
                $offset = 2;
                foreach ($records as $row) {
                    if(is_array($row)){
                        $style = $this->getCellStyle($row['class']);
                        $items[] = array(
                            "A".$offset => array(
                                'text'  => $row['advertise_sn'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "B".$offset => array(
                                'text'  => $row['targeting_sn'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),                            
                            "C".$offset => array(
                                'text'  => $row['product'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "D".$offset => array(
                                'text'  => str_ireplace("<br>", ",", $row['location']),
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "E".$offset => array(
                                'text'  => $row['gender'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "F".$offset => array(
                                'text'  => $row['age'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "G".$offset => array(
                                'text'  => str_ireplace("<br>", ",", $row['language']),
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "H".$offset => array(
                                'text'  => $row['interest'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "I".$offset => array(
                                'text'  => $row['audience'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "J".$offset => array(
                                'text'  => $row['publish'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "K".$offset => array(
                                'text'  => $row['customer'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),
                            "L".$offset => array(
                                'text'  => $row['target_url'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'left' ,
                                    )
                                )
                            ),
                            "M".$offset => array(
                                'text'  => $row['account'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center',
                                    )
                                )
                            ),
                        );
                    }
                    $offset++;
                }
            }
            $tmp = array(
                'headline'  => $headline,
                'items'     => $items,
                'setting'   => array(
                    'creator'   => $this->user->getNickName(),
                    'modified'  => $this->user->getNickName(),
                    'title'     => 'AD Targeting',
                    'subject'   => 'AD Targeting'
                )
            );

            if(writeExcel($targetFile,$tmp)){
                $status = 1;
                $msg = sprintf($this->language->get('text_export_success'),$fileName.sprintf($this->language->get('download_link'),$this->url->download(array('token'=>$token,'path'=>'/asset/download/'.$fileName))));
            }else{
                $status = 0;
                $msg = $this->language->get('text_exception');
            }
            die(json_encode(array('status'=>$status,'msg'=>$msg )));            
        }
    }


    public function config(){
        $this->load->language('report/targeting');

        $this->load->model('setting/setting');
        $json = array('status'=> 0,'msg'=>$this->language->get('text_exception'));
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $this->model_setting_setting->editSetting('report', $this->request->post);

            $json = array('status'=> 1,'msg'=>$this->language->get('text_success'));
            
        }
        $this->response->setOutput(json_encode($json));  
    }
}