<?php
class ControllerAccountTargeting extends Controller {

	public function index(){
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/targeting', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }        
		$this->language->load('account/targeting');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('account/targeting');

        if (isset($this->request->get['filter_targeting_sn'])) {
            $filter_targeting_sn = $this->request->get['filter_targeting_sn'];
        } else {
            $filter_targeting_sn = null;
        }
        if (isset($this->request->get['filter_target_url'])) {
            $filter_target_url = $this->request->get['filter_target_url'];
        } else {
            $filter_target_url = null;
        }
        if (isset($this->request->get['filter_product_id'])) {
            $filter_product_id = (int)$this->request->get['filter_product_id'];
        } else {
            $filter_product_id = null;
        }
        if (isset($this->request->get['filter_location'])) {
            $filter_location = $this->request->get['filter_location'];
        } else {
            $filter_location = null;
        }
        if (isset($this->request->get['filter_gender'])) {
            $filter_gender = (int)$this->request->get['filter_gender'];
        } else {
            $filter_gender = null;
        }
        if (isset($this->request->get['filter_age_min'])) {
            $filter_age_min = (int)$this->request->get['filter_age_min'];
        } else {
            $filter_age_min = null;
        }
        if (isset($this->request->get['filter_age_max'])) {
            $filter_age_max = (int)$this->request->get['filter_age_max'];
        } else {
            $filter_age_max = null;
        }

        if (isset($this->request->get['filter_interest'])) {
            $filter_interest = (int)$this->request->get['filter_interest'];
        } else {
            $filter_interest = null;
        }

        if (isset($this->request->get['filter_publish'])) {
            $filter_publish = (int)$this->request->get['filter_publish'];
        } else {
            $filter_publish = null;
        }

        if (isset($this->request->get['filter_language'])) {
            $filter_language = (int)$this->request->get['filter_language'];
        } else {
            $filter_language = null;
        }
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'at.targeting_sn';
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
        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }
        if (isset($this->request->get['filter_location'])) {
            $url .= '&filter_location=' . $this->request->get['filter_location'];
        }
        if (isset($this->request->get['filter_gender'])) {
            $url .= '&filter_gender=' . $this->request->get['filter_gender'];
        }
        if (isset($this->request->get['filter_interest'])) {
            $url .= '&filter_interest=' . $this->request->get['filter_interest'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
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
            'href' => $this->url->link('account/account')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('account/targeting', '' , 'SSL')
        );
        $limit = 100;
        $data['records'] = array();

        $filter_data = array(         
            'filter_product_id'	=> $filter_product_id,
            'filter_targeting_sn'	=> $filter_targeting_sn,
            'filter_interest'   => $filter_interest,
            'filter_publish'    => $filter_publish,
            'filter_language'   => $filter_language,
            'filter_gender'     => $filter_gender,
            'filter_location'   => $filter_location,
            'filter_target_url' => $filter_target_url,
            'sort'              => $sort,
            'order'             => $order,
            //'start'             => ($page - 1) * $limit,
            //'limit'             => $limit
        );

        $results  = $this->model_account_targeting->getAdTargetings($filter_data);

        $limit = $total = $this->model_account_targeting->getTotalAdTargetings($filter_data);
        if(!$limit){
        	$limit=1;
        }
        $this->load->model('catalog/product');
        $this->load->model('localisation/advertise_publish');
        $this->load->model('account/customer');
        $n = 0;
        foreach ($results as $result) {
            $customer = $this->model_account_customer->getCustomer($result['customer_id']);
            $product = $this->model_catalog_product->getProduct($result['product_id']);
            $publish = $this->model_localisation_advertise_publish->getAdvertisePublish($result['publish']);
            $gender = $this->model_catalog_product->getTargeting($result['gender']);
            $location = array();
            $countries = explode(",", $result['location']);
            if(is_array($countries)){
                foreach ($countries as $country_id) {
                    $targeting = $this->model_catalog_product->getTargeting($country_id);
                    if(!empty($targeting['value'])){
                        $location[] = $targeting['name'];
                    }
                }
            }
            $language = array();
            $languages = explode(",", $result['language']);
            if(is_array($languages)){
                foreach ($languages as $language_id) {
                    $targeting = $this->model_catalog_product->getTargeting($language_id);
                    if(!empty($targeting['value'])){
                        $language[] = $targeting['name'];
                    }
                }
            }
            $data['records'][] = array(
                'id'            => ++$n,
                'targeting_id'  => $result['targeting_id'],
                'targeting_sn'  => $result['targeting_sn'],
                'target_url'    => $result['target_url'],
                'publish'       => empty($publish['name']) ? '' : $publish['name'],
                'product'       => empty($product['name']) ? '' : $product['name'],
                'customer'      => empty($customer['nickname']) ? '' : $customer['nickname'],
                'gender'        => empty($gender['name']) ? '' : $gender['name'],
                'location'      => implode("<br>", $location),
                'language'      => implode("<br>", $language),
                'interest'      => $result['interest'],
                'audience'      => $result['audience'],
                'age'           => $result['age_max'] < 100 ? $result['age_min'].' - '.$result['age_max'] : $result['age_min']." - 65+" ,
                'account'       => $result['ad_account']
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
        $data['text_list'] = $this->language->get('text_list');
        $data['text_dblclick'] = $this->language->get('text_dblclick');
        $data['text_waiting'] = $this->language->get('text_waiting');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_confirm_save'] = $this->language->get('text_confirm_save');

        $data['column_target_url'] = $this->language->get('column_target_url');
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
        $data['button_reset'] = $this->language->get('button_reset');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_export'] = $this->language->get('button_export');

        $data['reset'] = $this->url->link('account/targeting', '','SSL');
        $data['cancel'] = $this->url->link('common/dashboard', '','SSL');

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
        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }
        if (isset($this->request->get['filter_location'])) {
            $url .= '&filter_location=' . $this->request->get['filter_location'];
        }
        if (isset($this->request->get['filter_gender'])) {
            $url .= '&filter_gender=' . $this->request->get['filter_gender'];
        }
        if (isset($this->request->get['filter_interest'])) {
            $url .= '&filter_interest=' . $this->request->get['filter_interest'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
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
        $data['sort_targeting_sn'] = $this->url->link('account/targeting', 'sort=att.targeting_sn' . $url, 'SSL');
        $data['sort_publish'] = $this->url->link('account/targeting', 'sort=a.publish' . $url, 'SSL');
        $data['sort_language'] = $this->url->link('account/targeting', 'sort=at.language' . $url, 'SSL');
        $data['sort_gender'] = $this->url->link('account/targeting', 'sort=at.gender' . $url, 'SSL');
        $data['sort_location'] = $this->url->link('account/targeting', 'sort=at.location' . $url, 'SSL');
        $data['sort_age'] = $this->url->link('account/targeting', 'sort=at.age_min' . $url, 'SSL');
        $data['sort_product'] = $this->url->link('account/targeting', 'sort=at.product_id' . $url, 'SSL');
        $data['sort_target_url'] = $this->url->link('account/targeting', 'sort=a.target_url' . $url, 'SSL');
        $data['sort_audience'] = $this->url->link('account/targeting', 'sort=at.audience' . $url, 'SSL');
        $data['sort_interest'] = $this->url->link('account/targeting', 'sort=at.interest' . $url, 'SSL');
        $data['sort_account'] = $this->url->link('account/targeting', 'sort=at.account' . $url, 'SSL');
        $url = '';
        if (isset($this->request->get['filter_targeting_sn'])) {
            $url .= '&filter_targeting_sn=' . $this->request->get['filter_targeting_sn'];
        }
        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }
        if (isset($this->request->get['filter_location'])) {
            $url .= '&filter_location=' . $this->request->get['filter_location'];
        }
        if (isset($this->request->get['filter_gender'])) {
            $url .= '&filter_gender=' . $this->request->get['filter_gender'];
        }
        if (isset($this->request->get['filter_interest'])) {
            $url .= '&filter_interest=' . $this->request->get['filter_interest'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
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
        $pagination->url = $this->url->link('account/targeting', $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

        $data['filter_targeting_sn']= $filter_targeting_sn;
        $data['filter_product_id']= $filter_product_id;
        $data['filter_interest']= $filter_interest;
        $data['filter_publish']= $filter_publish;
        $data['filter_language']= $filter_language;
        $data['filter_gender']= $filter_gender;
        $data['filter_location']= $filter_location;
        $data['filter_target_url']= $filter_target_url;
        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['products'] = $this->model_catalog_product->getProducts();

        $this->load->model('localisation/advertise_publish');
        $data['post_publishes'] = $this->model_localisation_advertise_publish->getAdvertisePublishes();

        $data['countries'] = $this->model_catalog_product->getTargetingsByCategory('location');
        $data['languages'] = $this->model_catalog_product->getTargetingsByCategory('language');

        $data['header'] = $this->load->controller('common/header');
        $data['footer'] = $this->load->controller('common/footer');
        $data['column_left'] = $this->load->controller('common/column_left');

        $this->response->setOutput($this->load->view('default/template/account/targeting.tpl', $data));
    }  

    public function export(){
        
        
        $data = isset($this->request->post['data']) ? htmlspecialchars_decode($this->request->post['data']) : false;
        $this->language->load('account/targeting');
        if($data){
            $basePath = DIR_DOWNLOAD;
            if(!file_exists($basePath)){
                @mkdir($basePath);
            }            
            $fileName=date('YmdHi',time()).'-Targeting.xls';
            $targetFile = rtrim($basePath,'/') . '/'. $fileName;
            $headline = array(
                'A1' => $this->language->get('column_id'),
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
                        $items[] = array(
                            "A".$offset => $row['id'],
                            "B".$offset => $row['targeting_sn'],
                            "C".$offset => $row['product'],
                            "D".$offset => str_ireplace("<br>", ",", $row['location']),
                            "E".$offset => $row['gender'],
                            "F".$offset => $row['age'],
                            "G".$offset => str_ireplace("<br>", ",", $row['language']),
                            "H".$offset => $row['interest'],
                            "I".$offset => $row['audience'],
                            "J".$offset => $row['publish'],
                            "K".$offset => $row['customer'],
                            "L".$offset => $row['target_url'],
                            "M".$offset => $row['account']
                        );
                    }
                    $offset++;
                }
            }
            $tmp = array(
                'headline'  => $headline,
                'items'     => $items,
                'setting'   => array(
                    'creator'   => $this->customer->getNickName(),
                    'modified'  => $this->customer->getNickName(),
                    'title'     => 'AD Targeting',
                    'subject'   => 'AD Targeting'
                )
            );

            if(writeExcel($targetFile,$tmp)){
                $status = 1;
                $path = '/asset/download/'.$fileName;
                $msg = sprintf($this->language->get('text_export_success'),$fileName.sprintf($this->language->get('download_link'),$this->url->download(array('path'=>$path))));
            }else{
                $status = 0;
                $msg = $this->language->get('text_exception');
            }
            die(json_encode(array('status'=>$status,'msg'=>$msg )));            
        }
    }
}