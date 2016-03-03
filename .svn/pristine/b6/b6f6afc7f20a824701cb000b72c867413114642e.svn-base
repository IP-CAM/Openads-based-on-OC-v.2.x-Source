<?php
class ControllerFbpageNophoto extends Controller {
    private $error = array();

    public function index() {
        $this->language->load('fbpage/nophoto');
            
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('fbpage/nophoto');

        $this->getList();
    }

    public function delete() {
        $this->language->load('fbpage/nophoto');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('fbpage/nophoto');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $post_id) {
                $this->model_fbpage_nophoto->deleteContribute($post_id);
            }

            $this->session->data['success'] = sprintf($this->language->get('text_delete_success'),$this->request->post['selected'] );
            $url = '';
            if (isset($this->request->get['filter_entry'])) {
                $url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
            }
            if (isset($this->request->get['filter_author_id'])) {
                $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_date_modified'])) {
                $url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_product_id'])) {
                $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
            }

            if (isset($this->request->get['filter_publish'])) {
                $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
            }
            if (isset($this->request->get['filter_author_id'])) {
                $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
            }
            if (isset($this->request->get['filter_user_id'])) {
                $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
            }
            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
            $this->response->redirect($this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'fbpage/nophoto/delete')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error ;
    }    
    protected function getList() {
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
        $filter_column = false;
        if (isset($this->request->get['filter_entry'])) {
            $filter_product = $this->request->get['filter_entry'];
            $filter_column = true;
        } else {
            $filter_product = null;
        }

        if (isset($this->request->get['filter_product_id'])) {
            $filter_product_id = (int)$this->request->get['filter_product_id'];
            $filter_column = true;
        } else {
            $filter_product_id = null;
        }

        if (isset($this->request->get['filter_author_id'])) {
            $filter_author_id = $this->request->get['filter_author_id'];
            $filter_column = true;
        } else {
            $filter_author_id = null;
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $filter_date_modified = $this->request->get['filter_date_modified'];
            $filter_column = true;
        } else {
            $filter_date_modified = null;
        }

        if (isset($this->request->get['filter_publish'])) {
            $filter_publish = (int)$this->request->get['filter_publish'];
            $filter_column = true;
        } else {
            $filter_publish = null;
        }

        if (isset($this->request->get['filter_user_id'])) {
            $filter_user_id = (int)$this->request->get['filter_user_id'];
            $filter_column = true;
        } else {
            $filter_user_id = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = (int)$this->request->get['filter_status'];
            $filter_column = true;
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.contribute_id';
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
        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }

        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
        $this->load->model('fbpage/entry');
        $this->load->model('user/user');
        $data['all_markets'] = $this->model_user_user->getUsers();//market group
        $this->load->model('catalog/product');
        $data['all_products'] = $this->model_catalog_product->getProducts();

        $this->load->model('fbpage/nophoto_status');
        $data['post_statuses'] = $this->model_fbpage_nophoto_status->getStatuses();
        $this->load->model('fbpage/nophoto_publish');
        $data['post_publishes'] = $this->model_fbpage_nophoto_publish->getPublishes();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] , 'SSL'),
        );

        $data['delete'] = $this->url->link('fbpage/nophoto/delete', 'token=' . $this->session->data['token'].$url , 'SSL');
        $limit = 20;
        $data['contributes'] = array();

        $filter_data = array(
            'filter_entry'          => $filter_product, 
            'filter_user_id'        => $filter_user_id,
            'filter_product_id'     => $filter_product_id,
            'filter_author_id'       => $filter_author_id,
            'filter_status'         => $filter_status,
            'filter_publish'        => $filter_publish,
            'filter_date_modified'  => $filter_date_modified,
            'sort'                  => $sort,
            'order'                 => $order,
            'start'                 => ($page - 1) * $limit,
            'limit'                 => $limit
        );

        $total = $this->model_fbpage_nophoto->getTotalContributes($filter_data);

        $results = $this->model_fbpage_nophoto->getContributes($filter_data);

        foreach ($results as $result) {
            $product = $this->model_catalog_product->getProduct($result['product_id']);
            $entry = $this->model_fbpage_entry->getEntryBySN($result['entry_sn']);
            $author = $this->model_user_user->getUserByAuthorId($result['author_id']);
            $auditor = $this->model_user_user->getUser($result['user_id']);            
            $action = array();
            $lock = (!empty($result['locker']) && $result['locker']!=$this->user->getId()) ? true :false ;
            if($lock){
                $action[] = array(
                    'text' => $this->language->get('text_readonly'),
                    'href' => $this->url->link('fbpage/nophoto/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')//.'&mode=approve'
                );
            }else{
                $action[] = array(
                    'text' => $this->language->get('text_edit'),
                    'href' =>  $this->url->link('fbpage/nophoto/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')
                );

            }

            $_status = $this->model_fbpage_nophoto_status->getStatus($result['status']);
            if(in_array($result['status'], $this->config->get('fbpage_auditor_status'))){
                $status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : '<b style="color:blue">'.$_status['name'].'</b>' ;
            }else{
                $status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'];
            }

            $_publish = $this->model_fbpage_nophoto_publish->getPublish($result['publish']);
            if(in_array($result['publish'], $this->config->get('fbpage_auditor_publish'))){
                $publish_text = empty($_publish['name']) ? $this->language->get('text_exception_red') : '<b style="color:blue">'.$_publish['name'].'</b>' ;
            }else{
                $publish_text = empty($_publish['name']) ? $this->language->get('text_exception_red') : $_publish['name'];
            }
            $data['contributes'][] = array(
                'contribute_id'     => $result['contribute_id'],                
                'entry_sn'          => $result['entry_sn'],
                'entry_name'        => empty($entry['entry_name']) ? '' : $entry['entry_name'] ,
                'product'           => empty($product['name']) ? '' : $product['code'].' '.$product['name'],
                'status_text'       => $status_text,
                'publish_text'      => $publish_text,
                'author'            => empty($author['nickname']) ? '' : $author['nickname'],
                'auditor'           => empty($auditor['nickname']) ? '' : $auditor['nickname'],
                'lock'              => $lock,
                'submited_date'     => date('Y-m-d', strtotime($result['submited_date'])).'<br>'.date('H:i:s',strtotime($result['submited_date'])),
                'date_modified'     => date('Y-m-d', strtotime($result['date_modified'])).'<br>'.date('H:i:s',strtotime($result['date_modified'])),
                'note'              => !empty($result['note']) ? trim($result['note']) : false,
                'selected'          => isset($this->request->post['selected']) && in_array($result['contribute_id'], $this->request->post['selected']),
                'action'            => $action
            );
        }
         
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['column_product'] = $this->language->get('column_product');
        $data['column_entry'] = $this->language->get('column_entry');
        $data['column_auditor'] = $this->language->get('column_auditor');
        $data['column_author'] = $this->language->get('column_author');
        $data['column_submited_date'] = $this->language->get('column_submited_date');
        $data['column_date_modified'] = $this->language->get('column_date_modified');
        $data['column_publish'] = $this->language->get('column_publish');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_import'] = $this->language->get('button_import');
        $data['button_export'] = $this->language->get('button_export');
        $data['button_bulk'] = $this->language->get('button_bulk');
        $data['button_delete'] = $this->language->get('button_delete');

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
        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }

        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
        }
        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['sort_entry_sn'] = $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . '&sort=p.entry_sn' . $url, 'SSL');
        $data['sort_submited_date'] = $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . '&sort=p.submited_date' . $url, 'SSL');
        $data['sort_user'] = $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . '&sort=user' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
        $data['sort_publish'] = $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . '&sort=p.publish' . $url, 'SSL');
        $data['sort_product'] = $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . '&sort=p.product_id' . $url, 'SSL');
        $data['sort_author'] = $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . '&sort=p.author_id' . $url, 'SSL');
        $url = '';
        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }

        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
        
        $pagination->url = $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
         
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
        $data['filter_entry'] = $filter_product;
        $data['filter_author_id'] = $filter_author_id;
        $data['filter_date_modified'] = $filter_date_modified;
        $data['filter_product_id'] = $filter_product_id;
        $data['filter_user_id'] = $filter_user_id;
        $data['filter_status'] = $filter_status;
        $data['filter_publish'] = $filter_publish;
        $data['filter_column'] = $filter_column ;
        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['level_status'] = $this->config->get("fbpage_level_status");
        $data['promoting_publish'] = $this->config->get("fbpage_promoting_publish");

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbpage/handling/nophoto_list.tpl', $data));
    }

    public function detail(){
        $this->language->load('fbpage/nophoto');
        $this->load->model('catalog/product');
        $this->load->model('fbpage/nophoto');
        $this->load->model('fbpage/entry');
        $this->load->model('fbpage/nophoto_status');
        $this->load->model('fbpage/nophoto_publish');
        $this->load->model('user/user');
        $this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');

        $data['heading_title'] = $this->language->get('heading_title'); 
            
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_approve'] = $this->language->get('text_approve');
        $data['text_targeting'] = $this->language->get('text_targeting');
        $data['text_post'] = $this->language->get('text_post');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_loading'] = $this->language->get('text_loading');
        $data['text_history'] = $this->language->get('text_history');
        
        $data['entry_copy'] = $this->language->get('entry_copy');
        $data['entry_file'] = $this->language->get('entry_file');
        $data['button_update'] = $this->language->get('button_update');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_unlock'] = $this->language->get('button_unlock');
        $data['button_reset'] = $this->language->get('button_reset');
        $data['button_upload'] = $this->language->get('button_upload');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_info'] = $this->language->get('tab_info');
        $data['tab_post'] = $this->language->get('tab_post');
        $data['tab_history'] = $this->language->get('tab_history');
        $data['token'] = $this->session->data['token'];
        
        $url = '';
        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode($this->request->get['filter_entry'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_product_id'])) {
            $url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
        }

        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['filter_group_id'])) {
            $url .= '&filter_group_id=' . (int)$this->request->get['filter_group_id'];
        }
        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }
        if (isset($this->request->get['filter_author_id'])) {
            $url .= '&filter_author_id=' . urlencode(html_entity_decode($this->request->get['filter_author_id'], ENT_QUOTES, 'UTF-8'));
        }        
        if (isset($this->request->get['filter_artist_id'])) {
            $url .= '&filter_artist_id=' . (int)$this->request->get['filter_artist_id'];
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
            'href' => $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        $data['cancel'] = $this->url->link('fbpage/nophoto', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['action'] = $this->url->link('fbpage/nophoto/save', '&token=' . $this->session->data['token'] , 'SSL');
        $data['tool_similar_action'] = htmlspecialchars_decode($this->url->link('tool/cron/similar_text','token='.$this->session->data['token'],'SSL'));
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

        $_post = $this->model_fbpage_nophoto->getContribute($this->request->get['contribute_id']);        
        $data['contribute_id'] = $_post['contribute_id'];
        $data['submited_date'] = $_post['submited_date'];   
        $data['submited_times'] = $_post['submited_times'];   
        $data['expired'] = $_post['expired'];   
        $data['content'] = $_post['content'];   
        $data['locker'] = $_post['locker'];   
        $data['publish'] = $_post['publish'];   
        $data['status'] = $_post['status']; 
        $data['product_id'] = $_post['product_id']; 
        $data['entry_sn'] = $_post['entry_sn']; 
        $data['target_url'] = $_post['target_url']; 
        $data['notes'] = utf8_strlen($_post['note'])>5 ? json_decode($_post['note'],true) : false;
        
        //product
        $_product = $this->model_catalog_product->getProduct($_post['product_id']);
        $data['product'] = empty($_product['name']) ? '' : $_product['name'];

        //entry
        $_entry = $this->model_fbpage_entry->getEntryBySN($_post['entry_sn']);
        $data['entry_name'] = empty($_entry['entry_name']) ? '' : $_entry['entry_name'];

        //operator
        $_operator = $this->model_user_user->getUser($_post['user_id']);
        $data['user'] = empty($_operator['nickname']) ? '' : $_operator['nickname'];
        
        //author
        $_author = $this->model_user_user->getUserByAuthorId($_post['author_id']);
        $data['author'] = empty($_author['nickname']) ? '' : $_author['nickname'];
        $author_user = empty($_author['user_id']) ? 0 : $_author['user_id'];

        $superior = $this->model_user_user->getSuperiors($author_user);
        $data['approve'] = in_array($this->user->getId(), $superior) && !in_array($_post['publish'], array($this->config->get('fbpage_promotion_modify')));

        //lock relax
        $data['locked'] = $data['relax'] = false;
        $_locker = $this->model_user_user->getUser($_post['locker']);
        $data['lock_user'] = empty($_locker['nickname']) ? '' : $_locker['nickname'];
        if(empty($data['lock_user']) || ((int)$_post['locker'] == $this->user->getId()) ){
            $this->model_fbpage_nophoto->setTempLocker((int)$_post['contribute_id']);
        }else {
            $data['locked'] = true;
            $data['approve'] = false;
            $data['text_lock'] = sprintf($this->language->get('text_lock'),$data['lock_user']);
            if(in_array($this->user->getId(), array_merge($this->config->get('sns_group_admin'),$this->config->get('sns_group_promotion')))){
                $data['relax'] = true;
                $data['text_confirm_relax'] = sprintf($this->language->get('text_relax'),$data['lock_user']);
            }
        }

        $this->document->setTitle('Approve');

        $data['post_statuses'] = $this->model_fbpage_nophoto_status->getStatuses();
        $data['post_publishes'] = $this->model_fbpage_nophoto_publish->getPublishes();
        $data['level_statuses'] = $this->config->get('fbpage_level_status');
        $data['auditor_approves'] = $this->config->get("fbpage_auditor_approve");

        $data['market_group'] = in_array($this->user->getId(), $this->config->get("sns_group_market"));
        $data['admin_group'] = in_array($this->user->getId(), $this->config->get("sns_group_admin"));
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbpage/handling/nophoto_form.tpl', $data));
    }

    public function history(){
        $this->language->load('fbpage/nophoto');
        $this->load->model('fbpage/nophoto');
        $this->load->model('fbpage/nophoto_status');
        $this->load->model('fbpage/nophoto_publish');

        $contribute_id = (int)$this->request->get['contribute_id'];
        $data['token'] = $this->session->data['token'] ;
        $data['text_no_results'] = $this->language->get('text_no_results');
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }  
        $limit = 20;
        $data['histories'] = array();
        $total = $this->model_fbpage_nophoto->getTotalHistory($contribute_id);
        $results = $this->model_fbpage_nophoto->getHistories($contribute_id,($page - 1) * $limit, $limit);
        foreach ($results as $result) {
            if(strtolower($result['type']) == 'edit'){
                
                $_status = $this->model_fbpage_nophoto_status->getStatus($result['value']);
                $text = empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'];
            }else{
                
                $_publish = $this->model_fbpage_nophoto_publish->getPublish($result['value']);
                $text = empty($_publish['name']) ? $this->language->get('text_exception_red') : $_publish['name'];
            }
            
            if($result['user_id']==0){
                $operator = $this->language->get('text_author');
            }elseif ($result['user_id']==-1){
                $operator = $this->language->get('text_system');
            }else{
                $operator = $result['nickname'];
            }           
            $data['histories'][] = array(
                'history_id'    => $result['history_id'] ,              
                'type'          => strtolower($result['type']) == 'edit' ? 'Edit Status' : 'Post Status',
                'status_text'   => $text,
                'operator'      => $operator,
                'date_added'    => date('Y-m-d H:i:s', strtotime($result['date_added']))
            );
        }           
        
        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $limit; 
        $pagination->url = $this->url->link('fbpage/nophoto/history', 'token=' . $this->session->data['token'] . '&contribute_id='.$contribute_id . '&page={page}', 'SSL');
            
        $data['pagination'] = $pagination->render();
        
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
        
        $this->response->setOutput($this->load->view('fbpage/handling/nophoto_history.tpl', $data));
    }

    public function save(){
        $this->language->load('fbpage/nophoto');
        $this->load->model('fbpage/nophoto');
        $result= array('status'=>0,'msg'=>$this->language->get('text_exception'));
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $_post = $this->model_fbpage_nophoto->getContribute($this->request->post['contribute_id']);
            if($_post['locker'] && $_post['locker']!=(int)$this->user->getId()){
                die(json_encode(array('status'=>0,'msg'=> $this->language->get('error_locker'))));
            }

            $note = !empty($this->request->post['note']) ? strip_tags($this->request->post['note']) : false;
            $_notes = array();
            if(!empty($_post['note'])){
                $_notes = json_decode($_post['note'],true);
            }
            if($note){
                $_notes[] = array(
                    'mode'      => 'user',
                    'operator'  => $this->user->getNickName(),
                    'entry_id'  => $this->user->getId(),
                    'msg'       => trim($note),
                    'time'      => time()
                );
            }

            $tmp = array(
                'contribute_id' => $this->request->post['contribute_id'],
                'status'        => $this->request->post['status'],
                'note'          => json_encode($_notes)
            );

            $this->model_fbpage_nophoto->approve($tmp);
            $this->session->data['success'] = sprintf($this->language->get('text_approve_success'),$_post['contribute_id']);
            $result= array('status'=>1,'msg'=> $this->language->get('text_success'));            
        }
        $this->response->setOutput(json_encode($result));
    }

    function ajax_data(){
        $this->language->load('fbpage/nophoto');
        $action = isset($this->request->post['action']) ? strtolower(trim($this->request->post['action'])) : 'get';
        $this->load->model('fbpage/nophoto');
        switch ($action) {
            case 'reset':
                $this->model_fbpage_nophoto->resetTempLocker($this->request->post['contribute_id'],$this->request->post['locker']);
                if(isset($this->request->get['set']) && $this->request->get['set']){
                    $this->model_fbpage_nophoto->setTempLocker($this->request->post['contribute_id']);
                }
                die(json_encode(array('status' =>1 ,'msg'=>'reset success')));
                break;
        }
        die(json_encode(array('status' =>0 ,'msg'=>$this->language->get('text_exception'))));
    }

}