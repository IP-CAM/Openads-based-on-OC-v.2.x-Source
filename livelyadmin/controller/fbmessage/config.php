<?php
class ControllerFbmessageConfig extends Controller {
    private $error = array();
 
    public function index() {
        $this->language->load('fbmessage/config'); 

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('fbmessage', $this->request->post);  
            
            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('fbmessage/config', 'token=' . $this->session->data['token'], 'SSL'));
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
        $data['text_message_initial_status'] = $this->language->get('text_message_initial_status');
        $data['text_message_initial_publish'] = $this->language->get('text_message_initial_publish');

        $data['text_message_auditor_attention_status'] = $this->language->get('text_message_auditor_attention_status');
        $data['text_message_auditor_attention_publish'] = $this->language->get('text_message_auditor_attention_publish');
        $data['text_message_similar_percent'] = $this->language->get('text_message_similar_percent');
        $data['text_message_level_status'] = $this->language->get('text_message_level_status');
        $data['text_message_rejected_status'] = $this->language->get('text_message_rejected_status');
        $data['text_message_promote_activation'] = $this->language->get('text_message_promote_activation');
        $data['text_message_promote_expired_publish'] = $this->language->get('text_message_promote_expired_publish');

        $data['text_message_auditor_approve_status'] = $this->language->get('text_message_auditor_approve_status');
        $data['text_message_auditor_modify_publish'] = $this->language->get('text_message_auditor_modify_publish');
        $data['text_message_promotion_modify_publish'] = $this->language->get('text_message_promotion_modify_publish');
        $data['text_message_promoting_publish'] = $this->language->get('text_message_promoting_publish');
        $data['text_message_testing_publish'] = $this->language->get('text_message_testing_publish');

        $data['help_message_initial_status'] = $this->language->get('help_message_initial_status');
        $data['help_message_initial_publish'] = $this->language->get('help_message_initial_publish');

        $data['help_message_auditor_attention_status'] = $this->language->get('help_message_auditor_attention_status');
        $data['help_message_auditor_attention_publish'] = $this->language->get('help_message_auditor_attention_publish');
        $data['help_message_similar_percent'] = $this->language->get('help_message_similar_percent');
        $data['help_message_level_status'] = $this->language->get('help_message_level_status');
        $data['help_message_rejected_status'] = $this->language->get('help_message_rejected_status');
        $data['help_message_promote_activation'] = $this->language->get('help_message_promote_activation');
        $data['help_message_promote_expired_publish'] = $this->language->get('help_message_promote_expired_publish');

        $data['help_message_auditor_approve_status'] = $this->language->get('help_message_auditor_approve_status');
        $data['help_message_auditor_modify_publish'] = $this->language->get('help_message_auditor_modify_publish');
        $data['help_message_promotion_modify_publish'] = $this->language->get('help_message_promotion_modify_publish');
        $data['help_message_promoting_publish'] = $this->language->get('help_message_promoting_publish');
        $data['help_message_testing_publish'] = $this->language->get('help_message_testing_publish');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('fbmessage/config', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('fbmessage/config', 'token=' . $this->session->data['token'], 'SSL');

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

        //message
        if (isset($this->request->post['fbmessage_initial_publish'])) {
            $data['fbmessage_initial_publish'] = $this->request->post['fbmessage_initial_publish'];
        } elseif ($this->config->get('initial_publish')!==null) {
            $data['fbmessage_initial_publish'] = $this->config->get('fbmessage_initial_publish'); 
        } else {
            $data['fbmessage_initial_publish'] = '';            
        }

        if (isset($this->request->post['fbmessage_initial_status'])) {
            $data['fbmessage_initial_status'] = $this->request->post['fbmessage_initial_status'];
        } elseif ($this->config->get('fbmessage_initial_status')!==null) {
            $data['fbmessage_initial_status'] = $this->config->get('fbmessage_initial_status');   
        } else {
            $data['fbmessage_initial_status'] = '';         
        }

        if (isset($this->request->post['fbmessage_similar_percent'])) {
            $data['fbmessage_similar_percent'] = $this->request->post['fbmessage_similar_percent'];
        } elseif ($this->config->get('fbmessage_similar_percent')!==null) {
            $data['fbmessage_similar_percent'] = $this->config->get('fbmessage_similar_percent');
        } else {
            $data['fbmessage_similar_percent'] = '';  
        }

        if (isset($this->request->post['fbmessage_expired_publish'])) {
            $data['fbmessage_expired_publish'] = $this->request->post['fbmessage_expired_publish'];
        } elseif ($this->config->get('fbmessage_expired_publish')!==null) {
            $data['fbmessage_expired_publish'] = $this->config->get('fbmessage_expired_publish');
        } else {
            $data['fbmessage_expired_publish'] = '';    
        }

        if (isset($this->request->post['fbmessage_rejected_status'])) {
            $data['fbmessage_rejected_status'] = $this->request->post['fbmessage_rejected_status'];
        } elseif ($this->config->get('fbmessage_rejected_status')!==null) {
            $data['fbmessage_rejected_status'] = $this->config->get('fbmessage_rejected_status');
        } else {
            $data['fbmessage_rejected_status'] = '';    
        }

        if (isset($this->request->post['fbmessage_level_status'])) {
            $data['fbmessage_level_status'] = $this->request->post['fbmessage_level_status'];
        } elseif ($this->config->get('fbmessage_level_status')!==null) {
            $data['fbmessage_level_status'] = $this->config->get('fbmessage_level_status');   
        } else {
            $data['fbmessage_level_status'] = array();          
        }

        if (isset($this->request->post['fbmessage_auditor_status'])) {
            $data['fbmessage_auditor_status'] = $this->request->post['fbmessage_auditor_status'];
        } elseif ($this->config->get('fbmessage_auditor_status')!==null) {
            $data['fbmessage_auditor_status'] = $this->config->get('fbmessage_auditor_status');   
        } else {
            $data['fbmessage_auditor_status'] = array();            
        }

        if (isset($this->request->post['fbmessage_auditor_publish'])) {
            $data['fbmessage_auditor_publish'] = $this->request->post['fbmessage_auditor_publish'];
        } elseif ($this->config->get('fbmessage_auditor_publish')!==null) {
            $data['fbmessage_auditor_publish'] = $this->config->get('fbmessage_auditor_publish'); 
        } else {
            $data['fbmessage_auditor_publish'] = array();           
        }

        if (isset($this->request->post['fbmessage_auditor_approve'])) {
            $data['fbmessage_auditor_approve'] = $this->request->post['fbmessage_auditor_approve'];
        } elseif ($this->config->get('fbmessage_auditor_approve')!==null) {
            $data['fbmessage_auditor_approve'] = $this->config->get('fbmessage_auditor_approve'); 
        } else {
            $data['fbmessage_auditor_approve'] = array();           
        }

        if (isset($this->request->post['fbmessage_auditor_modify'])) {
            $data['fbmessage_auditor_modify'] = $this->request->post['fbmessage_auditor_modify'];
        } elseif ($this->config->get('fbmessage_auditor_modify')!==null) {
            $data['fbmessage_auditor_modify'] = $this->config->get('fbmessage_auditor_modify');   
        } else {
            $data['fbmessage_auditor_modify'] = array();            
        }

        if (isset($this->request->post['fbmessage_promotion_modify'])) {
            $data['fbmessage_promotion_modify'] = $this->request->post['fbmessage_promotion_modify'];
        } elseif ($this->config->get('fbmessage_promotion_modify')!==null) {
            $data['fbmessage_promotion_modify'] = $this->config->get('fbmessage_promotion_modify');   
        } else {
            $data['fbmessage_promotion_modify'] = array();          
        }

        if (isset($this->request->post['fbmessage_promoting_publish'])) {
            $data['fbmessage_promoting_publish'] = $this->request->post['fbmessage_promoting_publish'];
        } elseif ($this->config->get('fbmessage_promoting_publish')!==null) {
            $data['fbmessage_promoting_publish'] = $this->config->get('fbmessage_promoting_publish'); 
        } else {
            $data['fbmessage_promoting_publish'] = '';          
        }

        if (isset($this->request->post['fbmessage_testing_publish'])) {
            $data['fbmessage_testing_publish'] = $this->request->post['fbmessage_testing_publish'];
        } elseif ($this->config->get('fbmessage_testing_publish')!==null) {
            $data['fbmessage_testing_publish'] = $this->config->get('fbmessage_testing_publish'); 
        } else {
            $data['fbmessage_testing_publish'] = '';            
        }

        $this->load->model('fbmessage/nophoto_status');
        $data['post_statuses'] = $this->model_fbmessage_nophoto_status->getStatuses();    
        $this->load->model('fbmessage/nophoto_publish');
        $data['post_publishes'] = $this->model_fbmessage_nophoto_publish->getPublishes();  

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbmessage/setting/config.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'fbmessage/config')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        return !$this->error;
    }
}