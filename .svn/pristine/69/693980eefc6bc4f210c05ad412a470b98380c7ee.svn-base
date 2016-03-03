<?php
class ControllerSnsLink extends Controller {
    private $error = array();

    public function index() {
        $this->language->load('report/link');
            
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('report/link');

        $this->getList();
    }

    public function update() {
        $this->language->load('report/link');
        $this->load->model('product/fbaccount');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {

            $tab = isset($this->request->post['tab']) ? strtolower(trim($this->request->post['tab'])) : 'photo_fbaccount';

            if(!empty($this->request->post['clickbank'])){
                $info=array();
                if($tab=='message'){
                    $this->load->model('contribute/message');
                    $info = $this->model_contribute_message->resetClickBankTargetURL();
                }else if($tab=='fbaccount'){
                    $this->load->model('contribute/fbaccount');
                    $info = $this->model_contribute_fbaccount->resetClickBankTargetURL();
                }else{
                    $this->load->model('contribute/fbaccount_photo');
                    $info = $this->model_contribute_fbaccount_photo->resetClickBankTargetURL();
                }
                die(json_encode(array('status'=>1,'msg'=>'Total:'.$info['total'].' , Success: '.$info['success'].' , Error: '.$info['error'])));
            }
            $contribute_id = isset($this->request->post['contribute_id']) ? (int)$this->request->post['contribute_id'] : false;
            $target_url = isset($this->request->post['target_url']) ? htmlspecialchars_decode($this->request->post['target_url']) : false;
            require_once(DIR_SYSTEM . 'helper/valid.php');
            if(!isURL($target_url)){
                echo json_encode(array('status'=>0,'msg'=>'Invalid URL!'));
                exit;
            }
            if($contribute_id){
                $_notes[] = array(
                    'mode'=>'user',
                    'operator'=>$this->user->getLastName().' '.$this->user->getFirstName(),
                    'entry_id'=>$this->user->getId(),
                    'msg'=>$this->language->get('text_note'),
                    'time'=>time()
                );
                if($tab=='ads'){
                    $this->load->model('contribute/ads');
                    $contribute_info = $this->model_contribute_ads->getAdPost($contribute_id);
                    
                    if(!empty($contribute_info['contribute_id'])){
                        if(!empty($contribute_info['note'])){
                            $file_notes = json_decode($contribute_info['note'],true);
                            if(is_array($file_notes)){
                                $_notes = array_merge($file_notes,$_notes);
                            }
                        }
                        $tmp = array(
                            'contribute_id' => $this->request->post['contribute_id'],
                            'target_url' => $target_url,
                            //'note' => json_encode($_notes)
                        );
                        $this->model_contribute_ads->editAdPost($tmp,'modified');
                    }
                }else if($tab=='message'){
                    $this->load->model('contribute/message');
                    $contribute_info = $this->model_contribute_message->getMessage($contribute_id);
                    
                    if(!empty($contribute_info['contribute_id'])){
                        if(!empty($contribute_info['note'])){
                            $file_notes = json_decode($contribute_info['note'],true);
                            if(is_array($file_notes)){
                                $_notes = array_merge($file_notes,$_notes);
                            }
                        }
                        $tmp = array(
                            'contribute_id' => $this->request->post['contribute_id'],
                            'url_modified' => 1,
                            'target_url' => $target_url,
                            //'note' => json_encode($_notes)
                        );
                        $this->model_contribute_message->editMessage($tmp,'modified');
                    }
                }else if($tab=='fbaccount'){
                    $this->load->model('contribute/fbaccount');
                    $contribute_info = $this->model_contribute_fbaccount->getContribute($contribute_id);
                    
                    if(!empty($contribute_info['contribute_id'])){
                        if(!empty($contribute_info['note'])){
                            $file_notes = json_decode($contribute_info['note'],true);
                            if(is_array($file_notes)){
                                $_notes = array_merge($file_notes,$_notes);
                            }
                        }
                        $tmp = array(
                            'contribute_id' => $this->request->post['contribute_id'],
                            'url_modified' => 1,
                            'target_url' => $target_url,
                            //'note' => json_encode($_notes)
                        );
                        $this->model_contribute_fbaccount->editContribute($tmp,'modified');
                    }
                }else{
                    $this->load->model('contribute/fbaccount_photo');
                    $contribute_info = $this->model_contribute_fbaccount_photo->getContribute($contribute_id);

                    if(!empty($contribute_info['contribute_id'])){

                        if(!empty($contribute_info['note'])){
                            $file_notes = json_decode($contribute_info['note'],true);
                            if(is_array($file_notes)){
                                $_notes = array_merge($file_notes,$_notes);
                            }
                        }
                        $tmp = array(
                            'contribute_id' => $this->request->post['contribute_id'],
                            'url_modified' => 1,
                            'target_url' => $target_url,
                            //'note' => json_encode($_notes)
                        );
                        $this->model_contribute_fbaccount_photo->editContribute($tmp,'modified');
                    }
                }
                die(json_encode(array('status'=>1,'msg'=>$this->language->get('text_success'))));
            }
            die(json_encode(array('status'=>0,'msg'=>'Exception!')));
        }
    }
    protected function getList() {
        if (isset($this->request->get['filter_entry'])) {
            $filter_entry = trim($this->request->get['filter_entry']);
        } else {
            $filter_entry = null;
        }

        if (isset($this->request->get['filter_customer'])) {
            $filter_customer = trim($this->request->get['filter_customer']);
        } else {
            $filter_customer = null;
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
            $filter_contribute_sn = trim($this->request->get['filter_contribute_sn']);
        } else {
            $filter_contribute_sn = null;
        }

        if (isset($this->request->get['filter_user_id'])) {
            $filter_user_id = (int)$this->request->get['filter_user_id'];
        } else {
            $filter_user_id = null;
        }
        if (isset($this->request->get['filter_publish'])) {
            $filter_publish = (int)$this->request->get['filter_publish'];
        } else {
            $filter_publish = null;
        }
        if (isset($this->request->get['tab'])) {
            $tab = $this->request->get['tab'];
        } else {
            $tab = 'photo_fbaccount';
        }
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'mc.contribute_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';
        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode(trim($this->request->get['filter_customer']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
            $url .= '&filter_contribute_sn=' . urlencode(html_entity_decode(trim($this->request->get['filter_contribute_sn']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode(trim($this->request->get['filter_entry']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['tab'])) {
            $url .= '&tab=' . $this->request->get['tab'];
        }else{
             $url .= '&tab=photo_fbaccount';
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

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('report/link', 'token=' . $this->session->data['token'] , 'SSL'),
            'separator' => ' :: '
        );

        $this->data['tab_photo_fbaccount'] = $this->url->link('report/link', 'tab=photo_fbaccount&token=' . $this->session->data['token'], 'SSL');
        $this->data['tab_fbaccount'] = $this->url->link('report/link', 'tab=fbaccount&token=' . $this->session->data['token'], 'SSL');
        $this->data['tab_message'] = $this->url->link('report/link', 'tab=message&token=' . $this->session->data['token'], 'SSL');
        $this->data['tab_ads'] = $this->url->link('report/link', 'tab=ads&token=' . $this->session->data['token'], 'SSL');

        $this->load->model('user/user');
        $this->data['all_markets'] = $this->model_user_user->getPostGroup('market');//market group
        $this->load->model('localisation/photo_contribute_publish');
        $this->data['photo_post_publishes'] = $this->model_localisation_photo_contribute_publish->getContributePublishes();
        $this->load->model('localisation/contribute_publish');
        $this->data['post_publishes'] = $this->model_localisation_contribute_publish->getContributePublishes();
        $this->load->model('localisation/message_publish');
        $this->data['message_publishes'] = $this->model_localisation_message_publish->getMessagePublishes();
        $this->load->model('localisation/ads_publish');
        $this->data['ads_publishes'] = $this->model_localisation_ads_publish->getAdsPublishes();

        $this->data['contributes'] = array();

        $data = array(
            'filter_entry'              => $filter_entry,           
            'filter_user_id'            => $filter_user_id,
            'filter_publish'            => $filter_publish,
            'filter_contribute_sn'      => $filter_contribute_sn,
            'filter_customer'           => $filter_customer,
            'tab'       => $tab,            
            'sort'      => $sort,
            'order'     => $order,
            'start'     => ($page - 1) * 20,
            'limit'     => 20
        );

        $total = $this->model_report_link->getTotalContributes($data);

        $results = $this->model_report_link->getContributes($data);

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => 'javascript:edit_link(' . $result['contribute_id'] .')'
            );
            if($tab=='ads'){
                $_publish = $this->model_localisation_ads_publish->getAdsPublish($result['publish']);
            }else if($tab=='message'){
                $_publish = $this->model_localisation_message_publish->getMessagePublish($result['publish']);
            }else if($tab=='fbaccount'){
                $_publish = $this->model_localisation_contribute_publish->getContributePublish($result['publish']);
            }else{
                $_publish = $this->model_localisation_photo_contribute_publish->getContributePublish($result['publish']);                
            }
            $publish_text = empty($_publish['name']) ? '<b style="color:red">Exception</b>' : $_publish['name'];
            $this->data['contributes'][] = array(
                'contribute_id'     => $result['contribute_id'],                
                'product'           => $result['product'],
                'publish'           => $result['publish'],
                'publish_text'      => $publish_text,
                'entry_sn'          => empty($result['entry_sn']) ? '' : $result['entry_sn'],
                'entry_name'        => empty($result['entry_name']) ? '' : $result['entry_name'] ,
                'author'            => $result['customer'],
                'contribute_sn'     => $result['contribute_sn'],
                'target_url'        => $result['target_url'],
                'auditor'           => $result['user'],
                'selected'          => isset($this->request->post['selected']) && in_array($result['contribute_id'], $this->request->post['selected']),
                'action'            => $action
            );
        }
         
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['entry_new_type'] = $this->language->get('entry_new_type');
        $this->data['entry_config_type'] = $this->language->get('entry_config_type');
        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_value'] = $this->language->get('entry_value');

        $this->data['column_product'] = $this->language->get('column_product');
        $this->data['column_contribute_sn'] = $this->language->get('column_contribute_sn');
        $this->data['column_entry'] = $this->language->get('column_entry');
        $this->data['column_target_url'] = $this->language->get('column_target_url');
        $this->data['column_auditor'] = $this->language->get('column_auditor');
        $this->data['column_author'] = $this->language->get('column_author');
        $this->data['column_action'] = $this->language->get('column_action');
        $this->data['column_publish'] = $this->language->get('column_publish');

        $this->data['button_filter'] = $this->language->get('button_filter');
        $this->data['button_export'] = $this->language->get('button_export');

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        if (isset($this->session->data['warning'])) {
            $this->data['error_warning'] = $this->session->data['warning'];

            unset($this->session->data['warning']);
        } else {
            $this->data['error_warning'] = '';
        }

        $url = '';
        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode(trim($this->request->get['filter_customer']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
            $url .= '&filter_contribute_sn=' . urlencode(html_entity_decode(trim($this->request->get['filter_contribute_sn']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode(trim($this->request->get['filter_entry']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['tab'])) {
            $url .= '&tab=' . $this->request->get['tab'];
        }else{
             $url .= '&tab=photo_fbaccount';
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $this->data['sort_entry_name'] = $this->url->link('report/link', 'token=' . $this->session->data['token'] . '&sort=entry_name' . $url, 'SSL');
        $this->data['sort_target_url'] = $this->url->link('report/link', 'token=' . $this->session->data['token'] . '&sort=mc.target_url' . $url, 'SSL');
        $this->data['sort_contribute_sn'] = $this->url->link('report/link', 'token=' . $this->session->data['token'] . '&sort=mc.contribute_sn' . $url, 'SSL');
        $this->data['sort_user'] = $this->url->link('report/link', 'token=' . $this->session->data['token'] . '&sort=user' . $url, 'SSL');
        $this->data['sort_product'] = $this->url->link('report/link', 'token=' . $this->session->data['token'] . '&sort=product' . $url, 'SSL');
        $this->data['sort_customer'] = $this->url->link('report/link', 'token=' . $this->session->data['token'] . '&sort=mc.customer_id' . $url, 'SSL');
        $this->data['sort_publish'] = $this->url->link('report/link', 'token=' . $this->session->data['token'] . '&sort=mc.publish' . $url, 'SSL');
        $url = '';
        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode(trim($this->request->get['filter_customer']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
            $url .= '&filter_contribute_sn=' . urlencode(html_entity_decode(trim($this->request->get['filter_contribute_sn']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode(trim($this->request->get['filter_entry']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['tab'])) {
            $url .= '&tab=' . $this->request->get['tab'];
        }else{
             $url .= '&tab=photo_fbaccount';
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
        $pagination->limit = 20;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('report/link', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
         
        $this->data['pagination'] = $pagination->render();

        $this->data['filter_entry'] = $filter_entry;
        $this->data['filter_customer'] = $filter_customer;
        $this->data['filter_contribute_sn'] = $filter_contribute_sn;
        $this->data['filter_publish'] = $filter_publish;
        $this->data['filter_user_id'] = $filter_user_id;
        $this->data['tab'] = $tab;
        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->data['export'] = $this->url->link('report/link/advanced_export','token='.$this->session->data['token'],'SSL');


        $this->template = 'report/link_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function advanced_export(){
        if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
            $tab = !empty($this->request->post['tab']) ? strtolower(trim($this->request->post['tab'])):'fbaccount_photo';
            $filter_customer_id = !empty($this->request->post['customer_id']) ? (int)$this->request->post['customer_id']:false;
            $filter_user_id = !empty($this->request->post['auditor_id']) ? (int)$this->request->post['auditor_id']:false;
            $filter_publish = isset($this->request->post['publish']) && $this->request->post['publish']!='*' ? (int)$this->request->post['publish']:false;
            $filter_entry_sn = !empty($this->request->post['entry_sn']) ? (int)$this->request->post['entry_sn']:false;

            $json = $tmp = $contributes = array();
            $filter = array(
                'tab'                   => $tab,
                'filter_customer_id'    => $filter_customer_id,
                'filter_user_id'        => $filter_user_id,
                'filter_publish'        => $filter_publish,
                'filter_entry_sn'       => $filter_entry_sn,
                'sort'                  => 'mc.contribute_sn',
                'order'                 => 'ASC'
            );

            $this->load->model('report/link');
            $contributes = $this->model_report_link->getContributes($filter);
            
            $operator = '';
            if($contributes){
                foreach ($contributes as $ck => $item){
                    if(!empty($item['contribute_sn'])){
                        $tmp[trim($item['contribute_sn'])] = trim($item['contribute_sn']).",".htmlspecialchars_decode(trim($item['target_url']))."\r\n";
                        if($filter_customer_id){
                            $operator = str_replace(" ", "_", trim($item['customer']));
                        }
                        if($filter_user_id){
                            $operator = str_replace(" ", "_", trim($item['user']));
                        }
                    }else{
                        $json['error'][] = $item['contribute_id'].' Contribute SN Exception!';
                        continue;
                    }
                }
                if($tmp){
                    $this->response->addheader('Pragma: public');
                    $this->response->addheader('Expires: 0');
                    $this->response->addheader('Content-Description: File Transfer');
                    $this->response->addheader("Content-Type: application/force-download"); 
                    $this->response->addheader("Content-Type: application/octet-stream"); 
                    $this->response->addheader("Content-Type: application/download"); 
                    $this->response->addheader('Content-Disposition: attachment; filename=' . date('YmdHis').'_'.$operator.'_TargetURL.csv');
                    $this->response->addheader('Content-Transfer-Encoding: binary');
                    $this->response->setOutput(implode("", $tmp));
                }
            }else{
                $this->session->data['warning'] = "<span>Export Failed:No Match Found!</span>";
                $url = '';
                if (isset($this->request->get['filter_customer'])) {
                    $url .= '&filter_customer=' . urlencode(html_entity_decode(trim($this->request->get['filter_customer']), ENT_QUOTES, 'UTF-8'));
                }

                if (isset($this->request->get['filter_contribute_sn'])) {
                    $url .= '&filter_contribute_sn=' . urlencode(html_entity_decode(trim($this->request->get['filter_contribute_sn']), ENT_QUOTES, 'UTF-8'));
                }

                if (isset($this->request->get['filter_entry'])) {
                    $url .= '&filter_entry=' . urlencode(html_entity_decode(trim($this->request->get['filter_entry']), ENT_QUOTES, 'UTF-8'));
                }

                if (isset($this->request->get['filter_user_id'])) {
                    $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
                }
                if (isset($this->request->get['filter_publish'])) {
                    $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
                }
                if (isset($this->request->get['tab'])) {
                    $url .= '&tab=' . $this->request->get['tab'];
                }else{
                     $url .= '&tab=photo_fbaccount';
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
                $this->redirect($this->url->link('report/link', 'token=' . $this->session->data['token'] . $url, 'SSL'));
            }
        }
    }

    public function autocomplete() {
        $json = array();
        if (isset($this->request->get['filter_sn'])) {
            $this->load->model('report/link');
            $data = array(
                'filter_sn' => $this->request->get['filter_sn'],
                'filter_type'  => isset($this->request->get['filter_type']) ? strtolower($this->request->get['filter_type']) : false,
                'start'        => 0,
                'limit'        => 20
            );
            $results = $this->model_report_link->getPostText($data);
            foreach ($results as $result) {
                $json[] = array(
                    'name'      => strip_tags(html_entity_decode($result['contribute_sn'], ENT_QUOTES, 'UTF-8')),
                    
                    'value'     => $result['content']
                );  
            }
        }
        $sort_order = array();
        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }
        array_multisort($sort_order, SORT_ASC, $json);
        $this->response->setOutput(json_encode($json));
    }
}