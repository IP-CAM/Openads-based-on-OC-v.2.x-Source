<?php
class ControllerAccountTemplate extends Controller {

	public function index(){
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/template', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }        
		$this->language->load('account/template');

		$this->document->setTitle($this->language->get('heading_title'));
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
        $this->document->addStyle(TPL_JS.'formvalidation/dist/css/formValidation.css');
        $this->document->addScript(TPL_JS.'formvalidation/dist/js/formValidation.js');
        $this->document->addScript(TPL_JS.'formvalidation/dist/js/framework/bootstrap.min.js');	
        $this->document->addScript(TPL_JS.'jquery.ajaxupload.js');	
		$this->load->model('account/template');

        if (isset($this->request->get['filter_targeting_sn'])) {
            $filter_targeting_sn = $this->request->get['filter_targeting_sn'];
        } else {
            $filter_targeting_sn = null;
        }

        if (isset($this->request->get['filter_product'])) {
            $filter_product = (int)$this->request->get['filter_product'];
        } else {
            $filter_product = null;
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

        if (isset($this->request->get['filter_status'])) {
            $filter_status = (int)$this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['filter_language'])) {
            $filter_language = (int)$this->request->get['filter_language'];
        } else {
            $filter_language = null;
        }
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'targeting_sn';
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
        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . (int)$this->request->get['filter_product'];
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
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
        }
        if (isset($this->request->get['filter_audience'])) {
            $url .= '&filter_audience=' . (int)$this->request->get['filter_audience'];
        }
        if (isset($this->request->get['filter_language'])) {
            $url .= '&filter_language=' . (int)$this->request->get['filter_language'];
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
            'href' => $this->url->link('account/template', '' , 'SSL')
        );
        $limit = 30;
        $data['records'] = array();

        $data['filter'] = $filter_data = array(         
            'filter_product'	=> $filter_product,
            'filter_interest'   => $filter_interest,
            'filter_status'    => $filter_status,
            'filter_language'   => $filter_language,
            'filter_gender'     => $filter_gender,
            'filter_location'   => $filter_location,
            'sort'              => $sort,
            'order'             => $order,
            'start'             => ($page - 1) * $limit,
            'limit'             => $limit
        );

        $results  = $this->model_account_template->getAdTemplates($filter_data);

        $total = $this->model_account_template->getTotalAdTemplates($filter_data);
        $this->load->model('catalog/product');
        $this->load->model('account/customer');
        $n = ($page - 1) * $limit;
        foreach ($results as $result) {
            $customer = $this->model_account_customer->getCustomer($result['customer_id']);
            $product = $this->model_catalog_product->getProduct($result['product_id']);
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
                'template_id'   => $result['template_id'],
                'targeting_sn'  => $result['targeting_sn'],
                'status'        => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'product'       => empty($product['name']) ? '' : $product['name'],
                'customer'      => empty($customer['nickname']) ? '' : $customer['nickname'],
                'gender'        => empty($gender['name']) ? '' : $gender['name'],
                'location'      => implode("<br>", $location),
                'language'      => implode("<br>", $language),
                'interest'      => $result['interest'],
                'audience'      => $result['audience'],
                'age'           => $result['age_max'] < 100 ? $result['age_min'].' - '.$result['age_max'] : $result['age_min']." - 65+" ,
                'ads'           => $this->model_account_template->getTotalAds($result['template_id']),

            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_exception'] = $this->language->get('text_exception');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_list'] = $this->language->get('text_list');
        $data['text_waiting'] = $this->language->get('text_waiting');
        $data['text_input'] = $this->language->get('text_input');
        $data['text_confirm_delete'] = $this->language->get('text_confirm_delete');
        $data['text_title_new']    = $this->language->get('text_title_new');
        $data['text_title_detail']    = $this->language->get('text_title_detail');
        $data['text_location'] = $this->language->get('text_location');
        $data['text_other_location'] = $this->language->get('text_other_location');
        $data['text_language'] = $this->language->get('text_language');
        $data['text_other_language'] = $this->language->get('text_other_language');
        $data['text_interest'] = $this->language->get('text_interest');
        $data['text_behavior'] = $this->language->get('text_behavior');
        $data['text_more'] = $this->language->get('text_more');
        $data['text_gender'] = $this->language->get('text_gender');
        $data['text_age'] = $this->language->get('text_age');
        $data['text_age_max'] = $this->language->get('text_age_max');
        $data['text_age_min'] = $this->language->get('text_age_min');   
        $data['text_targeting_sn'] = $this->language->get('text_targeting_sn');
        $data['text_audience'] = $this->language->get('text_audience');             

        $data['column_targeting_sn'] = $this->language->get('column_targeting_sn');
        $data['column_language'] = $this->language->get('column_language');
        $data['column_location'] = $this->language->get('column_location');
        $data['column_gender'] = $this->language->get('column_gender');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_audience'] = $this->language->get('column_audience');
        $data['column_age'] = $this->language->get('column_age');
        $data['column_id'] = $this->language->get('column_id');
        $data['column_product'] = $this->language->get('column_product');
        $data['column_interest'] = $this->language->get('column_interest');

        $data['entry_targeting_sn'] = $this->language->get('entry_targeting_sn');
        $data['entry_location'] = $this->language->get('entry_location');
        $data['entry_language'] = $this->language->get('entry_language');
        $data['entry_interest'] = $this->language->get('entry_interest');
        $data['entry_behavior'] = $this->language->get('entry_behavior');
        $data['entry_audience'] = $this->language->get('entry_audience');
        $data['entry_gender'] = $this->language->get('entry_gender');
        $data['entry_age'] = $this->language->get('entry_age');
        $data['entry_age_max'] = $this->language->get('entry_age_max');
        $data['entry_age_min'] = $this->language->get('entry_age_min');
        $data['entry_product'] = $this->language->get('entry_product');

        $data['error_location'] = $this->language->get('error_location');
        $data['error_gender'] = $this->language->get('error_gender');
        $data['error_language'] = $this->language->get('error_language');
        $data['error_headline'] = $this->language->get('error_headline');
        $data['error_headline_length'] = $this->language->get('error_headline_length');
        $data['error_text'] = $this->language->get('error_text');
        $data['error_text_length'] = $this->language->get('error_text_length');
        $data['error_photo'] = $this->language->get('error_photo');
        $data['error_audience'] = $this->language->get('error_audience');
        $data['error_targeting_sn'] = $this->language->get('error_targeting_sn');
        $data['error_targeting_sn_length'] = $this->language->get('error_targeting_sn_length');        

        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_close'] = $this->language->get('button_close');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_export'] = $this->language->get('button_export');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');

        $data['reset'] = $this->url->link('account/template', '','SSL');
        $data['cancel'] = $this->url->link('account/account', '','SSL');

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
        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . (int)$this->request->get['filter_product'];
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
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
        $data['sort_targeting_sn'] = $this->url->link('account/template', 'sort=targeting_sn' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('account/template', 'sort=status' . $url, 'SSL');
        $data['sort_language'] = $this->url->link('account/template', 'sort=language' . $url, 'SSL');
        $data['sort_gender'] = $this->url->link('account/template', 'sort=gender' . $url, 'SSL');
        $data['sort_location'] = $this->url->link('account/template', 'sort=location' . $url, 'SSL');
        $data['sort_age'] = $this->url->link('account/template', 'sort=age_min' . $url, 'SSL');
        $data['sort_product'] = $this->url->link('account/template', 'sort=product_id' . $url, 'SSL');
        $data['sort_audience'] = $this->url->link('account/template', 'sort=audience' . $url, 'SSL');
        $data['sort_interest'] = $this->url->link('account/template', 'sort=interest' . $url, 'SSL');
        $url = '';
        if (isset($this->request->get['filter_targeting_sn'])) {
            $url .= '&filter_targeting_sn=' . $this->request->get['filter_targeting_sn'];
        }
        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . (int)$this->request->get['filter_product'];
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
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
        }
        if (isset($this->request->get['filter_audience'])) {
            $url .= '&filter_audience=' . (int)$this->request->get['filter_audience'];
        }
        if (isset($this->request->get['filter_language'])) {
            $url .= '&filter_language=' . (int)$this->request->get['filter_language'];
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
        $pagination->url = $this->url->link('account/template', $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

        $data['filter_targeting_sn']= $filter_targeting_sn;
        $data['filter_product']= $filter_product;
        $data['filter_interest']= $filter_interest;
        $data['filter_status']= $filter_status;
        $data['filter_language']= $filter_language;
        $data['filter_gender']= $filter_gender;
        $data['filter_location']= $filter_location;
        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['products'] = $this->model_catalog_product->getProducts();
        $data['countries'] = $this->model_catalog_product->getTargetingsByCategory('location');
        $data['languages'] = $this->model_catalog_product->getTargetingsByCategory('language');
        $data['genders'] = $this->model_catalog_product->getTargetingsByCategory('gender');
        $data['edit_action'] = $this->url->link('account/template/save','','SSL');

        $data['header'] = $this->load->controller('common/header');
        $data['footer'] = $this->load->controller('common/footer');
        $data['column_left'] = $this->load->controller('common/column_left');

        $this->response->setOutput($this->load->view('default/template/account/template.tpl', $data));
    }  

    public function detail(){
        $template_id = isset($this->request->get['template']) ? (int)$this->request->get['template'] : false;

        $this->language->load('account/template');
        $this->load->model('account/template');
        
        $json=array('status'=>0 ,'msg'=>$this->language->get('text_no_results'));
        $template = $this->model_account_template->getAdTemplate($template_id);
        if(isset($template['template_id'])){
            $template['ads'] = $this->model_account_template->getTotalAds($template_id);
            $template['text_used'] = sprintf($this->language->get('text_used'),$template['ads']);
            $json = array('status'=>1,'data'=>$template);
        }

        $this->response->setOutput(json_encode($json));
    }

    public function save(){
        $this->load->model('account/template');
        $this->load->language('account/template');
        $json = array('status'=>0,'msg'=>$this->language->get('text_exception'));
        
        if($this->request->server['REQUEST_METHOD'] == 'POST'){
            if(!empty($this->request->post['template'])){
                
                $this->model_account_template->editTargetingTemplate($this->request->post);
            }else{
                $this->model_account_template->addTargetingTemplate($this->request->post);
            }
            $this->session->data['success'] = $this->language->get('text_success');
            $json = array('status'=>1,'msg'=>$this->language->get('text_success'));
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));         
    }

    public function delete(){
        $this->load->model('account/template');
        $this->load->language('account/template');
        $json = array('status'=>0,'msg'=>$this->language->get('text_exception'));
        
        if($this->request->server['REQUEST_METHOD'] == 'POST' && !empty($this->request->post['template'])){

            if($this->model_account_template->deleteTargetingTemplate($this->request->post['template'])){
                $json = array('status'=>1,'msg'=>$this->language->get('text_delete_success'));
            }else{
                $json = array('status'=>0,'msg'=>$this->language->get('error_delete'));
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));                 
    }

    public function export(){
        
        $filter = isset($this->request->post['filter']) ? htmlspecialchars_decode($this->request->post['filter']) : false;
        $this->language->load('account/template');
        $this->model->load('account/template');
        if($filter){
            $tmp = json_decode($filter,true);
            $filter_data = array(         
                'filter_product'    => isset($tmp['filter_product']) ? $tmp['filter_product'] :false,
                'filter_interest'   => isset($tmp['filter_interest']) ? $tmp['filter_interest'] :false,
                'filter_status'     => isset($tmp['filter_status']) ? $tmp['filter_status'] : null,
                'filter_language'   => isset($tmp['filter_language']) ? $tmp['filter_language'] :false,
                'filter_gender'     => isset($tmp['filter_gender']) ? $tmp['filter_gender'] :false,
                'filter_location'   => isset($tmp['filter_location']) ? $tmp['filter_location'] :false,
                'sort'              => isset($tmp['sort']) ? $tmp['sort'] :'targeting_sn',
                'order'             => isset($tmp['order']) ? $tmp['order'] :'ASC'
            );
            $results  = $this->model_account_template->getAdTemplates($filter_data);
            $offset = 2;
            $items = array();
            foreach ($results as $row) {
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
                        "J".$offset => $row['status'],
                    );
                }
                $offset++;
            }

            $file = date('YmdHi',time()).'-'.$this->customer->getUserName().'-Targeting.xls';
            $targetFile = DIR_DOWNLOAD. $file;
           
            $tmp = array(
                'setting'   => array(
                    'creator'   => $this->customer->getNickName(),
                    'modified'  => $this->customer->getNickName(),
                    'title'     => 'AD Template',
                    'subject'   => 'AD Template'
                ),                
                'headline'  => array(
                    'A1' => $this->language->get('column_id'),
                    'B1' => $this->language->get('column_targeting_sn'),
                    'C1' => $this->language->get('column_product'),
                    'D1' => $this->language->get('column_location'),
                    'E1' => $this->language->get('column_gender'),
                    'F1' => $this->language->get('column_age'),
                    'G1' => $this->language->get('column_language'),
                    'H1' => $this->language->get('column_interest'),
                    'I1' => $this->language->get('column_audience'),
                    'J1' => $this->language->get('column_status'),
                ),
                'items'     => $items
            );

            if(writeExcel($targetFile,$tmp)){
                $status = 1;
                $msg = sprintf($this->language->get('text_export_success'),$file.sprintf($this->language->get('download_link'),$this->url->download(array('path'=>'/asset/download/'.$file))));
            }else{
                $status = 0;
                $msg = $this->language->get('text_exception');
            }
            $this->response->setOutput(json_encode(array('status'=>$status,'msg'=>$msg )));            
        }
    }
}