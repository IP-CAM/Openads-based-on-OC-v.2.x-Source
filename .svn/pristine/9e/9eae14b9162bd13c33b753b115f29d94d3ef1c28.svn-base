<?php
class ControllerServiceTemplate extends Controller {

	public function index(){
		$this->language->load('service/template');

		$this->document->setTitle($this->language->get('heading_title'));
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');		
		$this->load->model('service/template');

        $filter_column = false;

        if (isset($this->request->get['filter_targeting_sn'])) {
            $filter_targeting_sn = $this->request->get['filter_targeting_sn'];
            $filter_column = true;
        } else {
            $filter_targeting_sn = null;
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
            $filter_interest = $this->request->get['filter_interest'];
            $filter_column = true;
        } else {
            $filter_interest = null;
        }

        if (isset($this->request->get['filter_language'])) {
            $filter_language = (int)$this->request->get['filter_language'];
            $filter_column = true;
        } else {
            $filter_language = null;
        }
        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
            $filter_column = true;
        } else {
            $filter_status = null;
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
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' .$this->request->get['filter_status'];
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
            'href' => $this->url->link('service/template', 'token=' . $this->session->data['token'], 'SSL')
        );
        $limit = $this->config->get('config_limit_admin');
        $data['records'] = array();

        $filter_data = array(         
            'filter_product_id'	=> $filter_product_id,
            'filter_customer_id'=> $filter_customer_id,           
            'filter_interest'   => $filter_interest,
            'filter_language'   => $filter_language,
            'filter_gender'     => $filter_gender,
            'filter_location'   => $filter_location,
            'filter_targeting_sn' => $filter_targeting_sn,
            'filter_status'     => $filter_status,
            'sort'              => $sort,
            'order'             => $order,
            'start'             => ($page - 1) * $limit,
            'limit'             => $limit
        );

        $results  = $this->model_service_template->getTemplates($filter_data);

        $total = $this->model_service_template->getTotalTemplates($filter_data);
        $this->load->model('catalog/product');
        $this->load->model('localisation/targeting');
        $this->load->model('customer/customer');

        foreach ($results as $result) {
            $customer = $this->model_customer_customer->getCustomer($result['customer_id']);
            $product = $this->model_catalog_product->getProduct($result['product_id']);
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
                
                'template_id'   => $result['template_id'],
                'targeting_sn'  => $result['targeting_sn'],
                'product'       => empty($product['name']) ? '' : $product['name'],
                'customer'      => empty($customer['nickname']) ? '' : $customer['nickname'],
                'gender'        => empty($gender['name']) ? '' : $gender['name'],
                'location'      => implode("<br>", $location),
                'language'      => implode("<br>", $language),
                'interest'      => $result['interest'],
                'status'        => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'audience'      => number_format($result['audience']),
                'age'           => $result['age_max'] < 100 ? $result['age_min'].' - '.$result['age_max'] : $result['age_min']." - 65+" ,
                'class'         => $result['status'] ? 'running' : 'banned'
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

        $data['column_targeting_sn'] = $this->language->get('column_targeting_sn');
        $data['column_customer'] = $this->language->get('column_customer');
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
        $data['entry_gender'] = $this->language->get('entry_gender');
        $data['entry_age'] = $this->language->get('entry_age');
        $data['entry_age_max'] = $this->language->get('entry_age_max');
        $data['entry_age_min'] = $this->language->get('entry_age_min');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_customer'] = $this->language->get('entry_customer');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_close'] = $this->language->get('button_close');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_export'] = $this->language->get('button_export');

        $data['reset'] = $this->url->link('service/template', 'token='.$this->session->data['token'],'SSL');
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
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' .$this->request->get['filter_status'];
        }
        if (isset($this->request->get['filter_audience'])) {
            $url .= '&filter_audience=' . (int)$this->request->get['filter_audience'];
        }
        if (isset($this->request->get['filter_language'])) {
            $url .= '&filter_language=' . (int)$this->request->get['filter_language'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['sort_targeting_sn'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=targeting_sn' . $url, 'SSL');
        $data['sort_language'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=language' . $url, 'SSL');
        $data['sort_customer'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=customer_id' . $url, 'SSL');
        $data['sort_gender'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=gender' . $url, 'SSL');
        $data['sort_location'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=location' . $url, 'SSL');
        $data['sort_age'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=age_min' . $url, 'SSL');
        $data['sort_product'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=product_id' . $url, 'SSL');
        $data['sort_audience'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=audience' . $url, 'SSL');
        $data['sort_interest'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=interest' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('service/template', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
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
        if (isset($this->request->get['filter_customer_id'])) {
            $url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
        }
        if (isset($this->request->get['filter_gender'])) {
            $url .= '&filter_gender=' . $this->request->get['filter_gender'];
        }
        if (isset($this->request->get['filter_interest'])) {
            $url .= '&filter_interest=' . $this->request->get['filter_interest'];
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' .$this->request->get['filter_status'];
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
        $pagination->url = $this->url->link('service/template', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

        $data['filter_targeting_sn']= $filter_targeting_sn;
        $data['filter_product_id']= $filter_product_id;
        $data['filter_customer_id']= $filter_customer_id;
        $data['filter_interest']= $filter_interest;
        $data['filter_language']= $filter_language;
        $data['filter_gender']= $filter_gender;
        $data['filter_location']= $filter_location;
        $data['filter_status']= $filter_status;
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

        $data['countries'] = $this->model_localisation_targeting->getTargetingsByCategory('location');
        $data['languages'] = $this->model_localisation_targeting->getTargetingsByCategory('language');

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('service/template.tpl', $data));
    }

    public function edit() {
        $this->load->language('service/template');
        $this->load->model('service/template');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('service/template/edit')) {
            if($this->model_service_template->editTemplate($this->request->post)){
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
        $this->language->load('service/template');
        if($data){
            $basePath = DIR_DOWNLOAD;
            if(!file_exists($basePath)){
                @mkdir($basePath);
            }            
            $fileName=date('YmdHi',time()).'-Template.xls';
            $targetFile = rtrim($basePath,'/') . '/'. $fileName;
            $headline = array(
                'A1' => $this->language->get('column_targeting_sn'),
                'B1' => $this->language->get('column_customer'),
                'C1' => $this->language->get('column_product'),
                'D1' => $this->language->get('column_location'),
                'E1' => $this->language->get('column_gender'),
                'F1' => $this->language->get('column_age'),
                'G1' => $this->language->get('column_language'),
                'H1' => $this->language->get('column_interest'),
                'I1' => $this->language->get('column_audience'),
                'J1' => $this->language->get('column_status'),
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
                                'text'  => $row['targeting_sn'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            ),     
                            "B".$offset => array(
                                'text'  => $row['customer'],
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
                                'text'  => $row['status'],
                                'style' => array(
                                    'font'  =>  $style,
                                    'alignment' => array(
                                        'horizontal' => 'center' ,
                                    )
                                )
                            )
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
                    'title'     => 'AD Template',
                    'subject'   => 'AD Template'
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

}