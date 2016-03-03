<?php
class ControllerFbpageConfig extends Controller {
    private $error = array();
 
    public function index() {
        $this->language->load('fbpage/config'); 

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('fbpage', $this->request->post);  
            
            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('fbpage/config', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_items'] = $this->language->get('text_items');
        $data['text_edit'] = $this->language->get('text_edit');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        // page start
        $data['text_page_initial_status'] = $this->language->get('text_page_initial_status');
        $data['text_page_initial_publish'] = $this->language->get('text_page_initial_publish');

        $data['text_page_auditor_attention_status'] = $this->language->get('text_page_auditor_attention_status');
        $data['text_page_auditor_attention_publish'] = $this->language->get('text_page_auditor_attention_publish');
        $data['text_page_similar_percent'] = $this->language->get('text_page_similar_percent');
        $data['text_page_level_status'] = $this->language->get('text_page_level_status');
        $data['text_page_rejected_status'] = $this->language->get('text_page_rejected_status');
        $data['text_page_promote_activation'] = $this->language->get('text_page_promote_activation');
        $data['text_page_promote_expired_publish'] = $this->language->get('text_page_promote_expired_publish');

        $data['text_page_auditor_approve_status'] = $this->language->get('text_page_auditor_approve_status');
        $data['text_page_auditor_modify_publish'] = $this->language->get('text_page_auditor_modify_publish');
        $data['text_page_promotion_modify_publish'] = $this->language->get('text_page_promotion_modify_publish');
        $data['text_page_promoting_publish'] = $this->language->get('text_page_promoting_publish');
        $data['text_page_testing_publish'] = $this->language->get('text_page_testing_publish');

        $data['help_page_initial_status'] = $this->language->get('help_page_initial_status');
        $data['help_page_initial_publish'] = $this->language->get('help_page_initial_publish');

        $data['help_page_auditor_attention_status'] = $this->language->get('help_page_auditor_attention_status');
        $data['help_page_auditor_attention_publish'] = $this->language->get('help_page_auditor_attention_publish');
        $data['help_page_similar_percent'] = $this->language->get('help_page_similar_percent');
        $data['help_page_level_status'] = $this->language->get('help_page_level_status');
        $data['help_page_rejected_status'] = $this->language->get('help_page_rejected_status');
        $data['help_page_promote_activation'] = $this->language->get('help_page_promote_activation');
        $data['help_page_promote_expired_publish'] = $this->language->get('help_page_promote_expired_publish');

        $data['help_page_auditor_approve_status'] = $this->language->get('help_page_auditor_approve_status');
        $data['help_page_auditor_modify_publish'] = $this->language->get('help_page_auditor_modify_publish');
        $data['help_page_promotion_modify_publish'] = $this->language->get('help_page_promotion_modify_publish');
        $data['help_page_promoting_publish'] = $this->language->get('help_page_promoting_publish');
        $data['help_page_testing_publish'] = $this->language->get('help_page_testing_publish');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('fbpage/config', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('fbpage/config', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');

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

        //page
        if (isset($this->request->post['fbpage_initial_publish'])) {
            $data['fbpage_initial_publish'] = $this->request->post['fbpage_initial_publish'];
        } elseif ($this->config->get('initial_publish')!==null) {
            $data['fbpage_initial_publish'] = $this->config->get('fbpage_initial_publish'); 
        } else {
            $data['fbpage_initial_publish'] = '';            
        }

        if (isset($this->request->post['fbpage_initial_status'])) {
            $data['fbpage_initial_status'] = $this->request->post['fbpage_initial_status'];
        } elseif ($this->config->get('fbpage_initial_status')!==null) {
            $data['fbpage_initial_status'] = $this->config->get('fbpage_initial_status');   
        } else {
            $data['fbpage_initial_status'] = '';         
        }

        if (isset($this->request->post['fbpage_similar_percent'])) {
            $data['fbpage_similar_percent'] = $this->request->post['fbpage_similar_percent'];
        } elseif ($this->config->get('fbpage_similar_percent')!==null) {
            $data['fbpage_similar_percent'] = $this->config->get('fbpage_similar_percent');
        } else {
            $data['fbpage_similar_percent'] = '';  
        }

        if (isset($this->request->post['fbpage_expired_publish'])) {
            $data['fbpage_expired_publish'] = $this->request->post['fbpage_expired_publish'];
        } elseif ($this->config->get('fbpage_expired_publish')!==null) {
            $data['fbpage_expired_publish'] = $this->config->get('fbpage_expired_publish');
        } else {
            $data['fbpage_expired_publish'] = '';    
        }

        if (isset($this->request->post['fbpage_rejected_status'])) {
            $data['fbpage_rejected_status'] = $this->request->post['fbpage_rejected_status'];
        } elseif ($this->config->get('fbpage_rejected_status')!==null) {
            $data['fbpage_rejected_status'] = $this->config->get('fbpage_rejected_status');
        } else {
            $data['fbpage_rejected_status'] = '';    
        }

        if (isset($this->request->post['fbpage_level_status'])) {
            $data['fbpage_level_status'] = $this->request->post['fbpage_level_status'];
        } elseif ($this->config->get('fbpage_level_status')!==null) {
            $data['fbpage_level_status'] = $this->config->get('fbpage_level_status');   
        } else {
            $data['fbpage_level_status'] = array();          
        }

        if (isset($this->request->post['fbpage_auditor_status'])) {
            $data['fbpage_auditor_status'] = $this->request->post['fbpage_auditor_status'];
        } elseif ($this->config->get('fbpage_auditor_status')!==null) {
            $data['fbpage_auditor_status'] = $this->config->get('fbpage_auditor_status');   
        } else {
            $data['fbpage_auditor_status'] = array();            
        }

        if (isset($this->request->post['fbpage_auditor_publish'])) {
            $data['fbpage_auditor_publish'] = $this->request->post['fbpage_auditor_publish'];
        } elseif ($this->config->get('fbpage_auditor_publish')!==null) {
            $data['fbpage_auditor_publish'] = $this->config->get('fbpage_auditor_publish'); 
        } else {
            $data['fbpage_auditor_publish'] = array();           
        }

        if (isset($this->request->post['fbpage_auditor_approve'])) {
            $data['fbpage_auditor_approve'] = $this->request->post['fbpage_auditor_approve'];
        } elseif ($this->config->get('fbpage_auditor_approve')!==null) {
            $data['fbpage_auditor_approve'] = $this->config->get('fbpage_auditor_approve'); 
        } else {
            $data['fbpage_auditor_approve'] = array();           
        }

        if (isset($this->request->post['fbpage_auditor_modify'])) {
            $data['fbpage_auditor_modify'] = $this->request->post['fbpage_auditor_modify'];
        } elseif ($this->config->get('fbpage_auditor_modify')!==null) {
            $data['fbpage_auditor_modify'] = $this->config->get('fbpage_auditor_modify');   
        } else {
            $data['fbpage_auditor_modify'] = array();            
        }

        if (isset($this->request->post['fbpage_promotion_modify'])) {
            $data['fbpage_promotion_modify'] = $this->request->post['fbpage_promotion_modify'];
        } elseif ($this->config->get('fbpage_promotion_modify')!==null) {
            $data['fbpage_promotion_modify'] = $this->config->get('fbpage_promotion_modify');   
        } else {
            $data['fbpage_promotion_modify'] = array();          
        }

        if (isset($this->request->post['fbpage_promoting_publish'])) {
            $data['fbpage_promoting_publish'] = $this->request->post['fbpage_promoting_publish'];
        } elseif ($this->config->get('fbpage_promoting_publish')!==null) {
            $data['fbpage_promoting_publish'] = $this->config->get('fbpage_promoting_publish'); 
        } else {
            $data['fbpage_promoting_publish'] = '';          
        }

        if (isset($this->request->post['fbpage_testing_publish'])) {
            $data['fbpage_testing_publish'] = $this->request->post['fbpage_testing_publish'];
        } elseif ($this->config->get('fbpage_testing_publish')!==null) {
            $data['fbpage_testing_publish'] = $this->config->get('fbpage_testing_publish'); 
        } else {
            $data['fbpage_testing_publish'] = '';            
        }

        $this->load->model('fbpage/nophoto_status');
        $data['post_statuses'] = $this->model_fbpage_nophoto_status->getStatuses();    
        $this->load->model('fbpage/nophoto_publish');
        $data['post_publishes'] = $this->model_fbpage_nophoto_publish->getPublishes();  

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbpage/setting/config.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'fbpage/config')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        return !$this->error;
    }
}