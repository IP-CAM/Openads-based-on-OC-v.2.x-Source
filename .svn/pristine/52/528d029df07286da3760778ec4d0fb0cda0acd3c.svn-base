<?php
class ControllerFbaccountConfig extends Controller {
    private $error = array();
 
    public function index() {
        $this->language->load('fbaccount/config'); 

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('fbaccount', $this->request->post);  
            
            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('fbaccount/config', 'token=' . $this->session->data['token'], 'SSL'));
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

        // nophoto start
        $data['text_nophoto_initial_status'] = $this->language->get('text_nophoto_initial_status');
        $data['text_nophoto_initial_publish'] = $this->language->get('text_nophoto_initial_publish');

        $data['text_nophoto_auditor_attention_status'] = $this->language->get('text_nophoto_auditor_attention_status');
        $data['text_nophoto_auditor_attention_publish'] = $this->language->get('text_nophoto_auditor_attention_publish');
        $data['text_nophoto_similar_percent'] = $this->language->get('text_nophoto_similar_percent');
        $data['text_nophoto_level_status'] = $this->language->get('text_nophoto_level_status');
        $data['text_nophoto_rejected_status'] = $this->language->get('text_nophoto_rejected_status');
        $data['text_nophoto_promote_activation'] = $this->language->get('text_nophoto_promote_activation');
        $data['text_nophoto_promote_expired_publish'] = $this->language->get('text_nophoto_promote_expired_publish');

        $data['text_nophoto_auditor_approve_status'] = $this->language->get('text_nophoto_auditor_approve_status');
        $data['text_nophoto_auditor_modify_publish'] = $this->language->get('text_nophoto_auditor_modify_publish');
        $data['text_nophoto_promotion_modify_publish'] = $this->language->get('text_nophoto_promotion_modify_publish');
        $data['text_nophoto_promoting_publish'] = $this->language->get('text_nophoto_promoting_publish');
        $data['text_nophoto_testing_publish'] = $this->language->get('text_nophoto_testing_publish');

        $data['help_nophoto_initial_status'] = $this->language->get('help_nophoto_initial_status');
        $data['help_nophoto_initial_publish'] = $this->language->get('help_nophoto_initial_publish');

        $data['help_nophoto_auditor_attention_status'] = $this->language->get('help_nophoto_auditor_attention_status');
        $data['help_nophoto_auditor_attention_publish'] = $this->language->get('help_nophoto_auditor_attention_publish');
        $data['help_nophoto_similar_percent'] = $this->language->get('help_nophoto_similar_percent');
        $data['help_nophoto_level_status'] = $this->language->get('help_nophoto_level_status');
        $data['help_nophoto_rejected_status'] = $this->language->get('help_nophoto_rejected_status');
        $data['help_nophoto_promote_activation'] = $this->language->get('help_nophoto_promote_activation');
        $data['help_nophoto_promote_expired_publish'] = $this->language->get('help_nophoto_promote_expired_publish');

        $data['help_nophoto_auditor_approve_status'] = $this->language->get('help_nophoto_auditor_approve_status');
        $data['help_nophoto_auditor_modify_publish'] = $this->language->get('help_nophoto_auditor_modify_publish');
        $data['help_nophoto_promotion_modify_publish'] = $this->language->get('help_nophoto_promotion_modify_publish');
        $data['help_nophoto_promoting_publish'] = $this->language->get('help_nophoto_promoting_publish');
        $data['help_nophoto_testing_publish'] = $this->language->get('help_nophoto_testing_publish');
        // nophoto end


        //photo start
        $data['text_photo_initial_status'] = $this->language->get('text_photo_initial_status');
        $data['text_photo_initial_publish'] = $this->language->get('text_photo_initial_publish');
        $data['text_photo_auditor_attention_status'] = $this->language->get('text_photo_auditor_attention_status');
        $data['text_photo_auditor_attention_publish'] = $this->language->get('text_photo_auditor_attention_publish');
        $data['text_photo_auditor_approve_status'] = $this->language->get('text_photo_auditor_approve_status');
        $data['text_photo_auditor_modify_publish'] = $this->language->get('text_photo_auditor_modify_publish');

        $data['text_photo_artist_finished_status'] = $this->language->get('text_photo_artist_finished_status');
        $data['text_photo_artist_finished_publish'] = $this->language->get('text_photo_artist_finished_publish');
        $data['text_photo_artist_attention_status'] = $this->language->get('text_photo_artist_attention_status');
        $data['text_photo_artist_attention_publish'] = $this->language->get('text_photo_artist_attention_publish');
        $data['text_photo_artist_approve_status'] = $this->language->get('text_photo_artist_approve_status');
        $data['text_photo_artist_modify_publish'] = $this->language->get('text_photo_artist_modify_publish');

        $data['text_photo_promote_expired_publish'] = $this->language->get('text_photo_promote_expired_publish');
        $data['text_photo_promotion_modify_publish'] = $this->language->get('text_photo_promotion_modify_publish');
        $data['text_photo_promoting_publish'] = $this->language->get('text_photo_promoting_publish');

        $data['text_photo_level_status'] = $this->language->get('text_photo_level_status');
        $data['text_photo_rejected_status'] = $this->language->get('text_photo_rejected_status');
        $data['text_photo_similar_percent'] = $this->language->get('text_photo_similar_percent');
        $data['text_photo_testing_publish'] = $this->language->get('text_photo_testing_publish');

        $data['help_photo_initial_status'] = $this->language->get('help_photo_initial_status');
        $data['help_photo_initial_publish'] = $this->language->get('help_photo_initial_publish');
        $data['help_photo_auditor_attention_status'] = $this->language->get('help_photo_auditor_attention_status');
        $data['help_photo_auditor_attention_publish'] = $this->language->get('help_photo_auditor_attention_publish');
        $data['help_photo_auditor_approve_status'] = $this->language->get('help_photo_auditor_approve_status');
        $data['help_photo_auditor_modify_publish'] = $this->language->get('help_photo_auditor_modify_publish');

        $data['help_photo_artist_finished_status'] = $this->language->get('help_photo_artist_finished_status');
        $data['help_photo_artist_finished_publish'] = $this->language->get('help_photo_artist_finished_publish');
        $data['help_photo_artist_attention_status'] = $this->language->get('help_photo_artist_attention_status');
        $data['help_photo_artist_attention_publish'] = $this->language->get('help_photo_artist_attention_publish');
        $data['help_photo_artist_approve_status'] = $this->language->get('help_photo_artist_approve_status');
        $data['help_photo_artist_modify_publish'] = $this->language->get('help_photo_artist_modify_publish');

        $data['help_photo_promote_expired_publish'] = $this->language->get('help_photo_promote_expired_publish');
        $data['help_photo_promotion_modify_publish'] = $this->language->get('help_photo_promotion_modify_publish');
        $data['help_photo_promoting_publish'] = $this->language->get('help_photo_promoting_publish');

        $data['help_photo_level_status'] = $this->language->get('help_photo_level_status');
        $data['help_photo_rejected_status'] = $this->language->get('help_photo_rejected_status');
        $data['help_photo_similar_percent'] = $this->language->get('help_photo_text_similar_percent');
        $data['help_photo_testing_publish'] = $this->language->get('help_photo_testing_publish');

        $data['tab_photo'] = $this->language->get('tab_photo');
        $data['tab_nophoto'] = $this->language->get('tab_nophoto');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('fbaccount/config', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('fbaccount/config', 'token=' . $this->session->data['token'], 'SSL');

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

        //nophoto
        if (isset($this->request->post['fbaccount_initial_publish'])) {
            $data['fbaccount_initial_publish'] = $this->request->post['fbaccount_initial_publish'];
        } elseif ($this->config->get('initial_publish')!==null) {
            $data['fbaccount_initial_publish'] = $this->config->get('fbaccount_initial_publish'); 
        } else {
            $data['fbaccount_initial_publish'] = '';            
        }

        if (isset($this->request->post['fbaccount_initial_status'])) {
            $data['fbaccount_initial_status'] = $this->request->post['fbaccount_initial_status'];
        } elseif ($this->config->get('fbaccount_initial_status')!==null) {
            $data['fbaccount_initial_status'] = $this->config->get('fbaccount_initial_status');   
        } else {
            $data['fbaccount_initial_status'] = '';         
        }

        if (isset($this->request->post['fbaccount_similar_percent'])) {
            $data['fbaccount_similar_percent'] = $this->request->post['fbaccount_similar_percent'];
        } elseif ($this->config->get('fbaccount_similar_percent')!==null) {
            $data['fbaccount_similar_percent'] = $this->config->get('fbaccount_similar_percent');
        } else {
            $data['fbaccount_similar_percent'] = '';  
        }

        if (isset($this->request->post['fbaccount_expired_publish'])) {
            $data['fbaccount_expired_publish'] = $this->request->post['fbaccount_expired_publish'];
        } elseif ($this->config->get('fbaccount_expired_publish')!==null) {
            $data['fbaccount_expired_publish'] = $this->config->get('fbaccount_expired_publish');
        } else {
            $data['fbaccount_expired_publish'] = '';    
        }

        if (isset($this->request->post['fbaccount_rejected_status'])) {
            $data['fbaccount_rejected_status'] = $this->request->post['fbaccount_rejected_status'];
        } elseif ($this->config->get('fbaccount_rejected_status')!==null) {
            $data['fbaccount_rejected_status'] = $this->config->get('fbaccount_rejected_status');
        } else {
            $data['fbaccount_rejected_status'] = '';    
        }

        if (isset($this->request->post['fbaccount_level_status'])) {
            $data['fbaccount_level_status'] = $this->request->post['fbaccount_level_status'];
        } elseif ($this->config->get('fbaccount_level_status')!==null) {
            $data['fbaccount_level_status'] = $this->config->get('fbaccount_level_status');   
        } else {
            $data['fbaccount_level_status'] = array();          
        }

        if (isset($this->request->post['fbaccount_auditor_status'])) {
            $data['fbaccount_auditor_status'] = $this->request->post['fbaccount_auditor_status'];
        } elseif ($this->config->get('fbaccount_auditor_status')!==null) {
            $data['fbaccount_auditor_status'] = $this->config->get('fbaccount_auditor_status');   
        } else {
            $data['fbaccount_auditor_status'] = array();            
        }

        if (isset($this->request->post['fbaccount_auditor_publish'])) {
            $data['fbaccount_auditor_publish'] = $this->request->post['fbaccount_auditor_publish'];
        } elseif ($this->config->get('fbaccount_auditor_publish')!==null) {
            $data['fbaccount_auditor_publish'] = $this->config->get('fbaccount_auditor_publish'); 
        } else {
            $data['fbaccount_auditor_publish'] = array();           
        }

        if (isset($this->request->post['fbaccount_auditor_approve'])) {
            $data['fbaccount_auditor_approve'] = $this->request->post['fbaccount_auditor_approve'];
        } elseif ($this->config->get('fbaccount_auditor_approve')!==null) {
            $data['fbaccount_auditor_approve'] = $this->config->get('fbaccount_auditor_approve'); 
        } else {
            $data['fbaccount_auditor_approve'] = array();           
        }

        if (isset($this->request->post['fbaccount_auditor_modify'])) {
            $data['fbaccount_auditor_modify'] = $this->request->post['fbaccount_auditor_modify'];
        } elseif ($this->config->get('fbaccount_auditor_modify')!==null) {
            $data['fbaccount_auditor_modify'] = $this->config->get('fbaccount_auditor_modify');   
        } else {
            $data['fbaccount_auditor_modify'] = array();            
        }

        if (isset($this->request->post['fbaccount_promotion_modify'])) {
            $data['fbaccount_promotion_modify'] = $this->request->post['fbaccount_promotion_modify'];
        } elseif ($this->config->get('fbaccount_promotion_modify')!==null) {
            $data['fbaccount_promotion_modify'] = $this->config->get('fbaccount_promotion_modify');   
        } else {
            $data['fbaccount_promotion_modify'] = array();          
        }

        if (isset($this->request->post['fbaccount_promoting_publish'])) {
            $data['fbaccount_promoting_publish'] = $this->request->post['fbaccount_promoting_publish'];
        } elseif ($this->config->get('fbaccount_promoting_publish')!==null) {
            $data['fbaccount_promoting_publish'] = $this->config->get('fbaccount_promoting_publish'); 
        } else {
            $data['fbaccount_promoting_publish'] = '';          
        }

        if (isset($this->request->post['fbaccount_testing_publish'])) {
            $data['fbaccount_testing_publish'] = $this->request->post['fbaccount_testing_publish'];
        } elseif ($this->config->get('fbaccount_testing_publish')!==null) {
            $data['fbaccount_testing_publish'] = $this->config->get('fbaccount_testing_publish'); 
        } else {
            $data['fbaccount_testing_publish'] = '';            
        }

        //photo
        if (isset($this->request->post['fbaccount_photo_initial_publish'])) {
            $data['fbaccount_photo_initial_publish'] = $this->request->post['fbaccount_photo_initial_publish'];
        } elseif ($this->config->get('initial_publish')!==null) {
            $data['fbaccount_photo_initial_publish'] = $this->config->get('fbaccount_photo_initial_publish'); 
        } else {
            $data['fbaccount_photo_initial_publish'] = '';            
        }

        if (isset($this->request->post['fbaccount_photo_initial_status'])) {
            $data['fbaccount_photo_initial_status'] = $this->request->post['fbaccount_photo_initial_status'];
        } elseif ($this->config->get('fbaccount_photo_initial_status')!==null) {
            $data['fbaccount_photo_initial_status'] = $this->config->get('fbaccount_photo_initial_status');   
        } else {
            $data['fbaccount_photo_initial_status'] = '';         
        }

        if (isset($this->request->post['fbaccount_photo_artist_status'])) {
            $data['fbaccount_photo_artist_status'] = $this->request->post['fbaccount_photo_artist_status'];
        } elseif ($this->config->get('fbaccount_photo_artist_status')!==null) {
            $data['fbaccount_photo_artist_status'] = $this->config->get('fbaccount_photo_artist_status'); 
        } else {
            $data['fbaccount_photo_artist_status'] = array();         
        }

        if (isset($this->request->post['fbaccount_photo_artist_publish'])) {
            $data['fbaccount_photo_artist_publish'] = $this->request->post['fbaccount_photo_artist_publish'];
        } elseif ($this->config->get('fbaccount_photo_artist_publish')!==null) {
            $data['fbaccount_photo_artist_publish'] = $this->config->get('fbaccount_photo_artist_publish');   
        } else {
            $data['fbaccount_photo_artist_publish'] = array();            
        }

        if (isset($this->request->post['fbaccount_photo_artist_finished_publish'])) {
            $data['fbaccount_photo_artist_finished_publish'] = $this->request->post['fbaccount_photo_artist_finished_publish'];
        } elseif ($this->config->get('fbaccount_photo_artist_finished_publish')!==null) {
            $data['fbaccount_photo_artist_finished_publish'] = $this->config->get('fbaccount_photo_artist_finished_publish'); 
        } else {
            $data['fbaccount_photo_artist_finished_publish'] = '';            
        }

        if (isset($this->request->post['fbaccount_photo_artist_finished_status'])) {
            $data['fbaccount_photo_artist_finished_status'] = $this->request->post['fbaccount_photo_artist_finished_status'];
        } elseif ($this->config->get('fbaccount_photo_artist_finished_status')!==null) {
            $data['fbaccount_photo_artist_finished_status'] = $this->config->get('fbaccount_photo_artist_finished_status');   
        } else {
            $data['fbaccount_photo_artist_finished_status'] = '';         
        }

        if (isset($this->request->post['fbaccount_photo_artist_approve'])) {
            $data['fbaccount_photo_artist_approve'] = $this->request->post['fbaccount_photo_artist_approve'];
        } elseif ($this->config->get('fbaccount_photo_artist_approve')!==null) {
            $data['fbaccount_photo_artist_approve'] = $this->config->get('fbaccount_photo_artist_approve');   
        } else {
            $data['fbaccount_photo_artist_approve'] = array();            
        }

        if (isset($this->request->post['fbaccount_photo_artist_modify'])) {
            $data['fbaccount_photo_artist_modify'] = $this->request->post['fbaccount_photo_artist_modify'];
        } elseif ($this->config->get('fbaccount_photo_artist_modify')!==null) {
            $data['fbaccount_photo_artist_modify'] = $this->config->get('fbaccount_photo_artist_modify'); 
        } else {
            $data['fbaccount_photo_artist_modify'] = array();         
        }

        if (isset($this->request->post['fbaccount_photo_similar_percent'])) {
            $data['fbaccount_photo_similar_percent'] = $this->request->post['fbaccount_photo_similar_percent'];
        } elseif ($this->config->get('similar_percent')!==null) {
            $data['fbaccount_photo_similar_percent'] = $this->config->get('fbaccount_photo_similar_percent');
        } else {
            $data['fbaccount_photo_similar_percent'] = '';  
        }

        if (isset($this->request->post['fbaccount_photo_expired_publish'])) {
            $data['fbaccount_photo_expired_publish'] = $this->request->post['fbaccount_photo_expired_publish'];
        } elseif ($this->config->get('fbaccount_photo_expired_publish')!==null) {
            $data['fbaccount_photo_expired_publish'] = $this->config->get('fbaccount_photo_expired_publish');
        } else {
            $data['fbaccount_photo_expired_publish'] = '';    
        }

        if (isset($this->request->post['fbaccount_photo_rejected_status'])) {
            $data['fbaccount_photo_rejected_status'] = $this->request->post['fbaccount_photo_rejected_status'];
        } elseif ($this->config->get('fbaccount_photo_rejected_status')!==null) {
            $data['fbaccount_photo_rejected_status'] = $this->config->get('fbaccount_photo_rejected_status');
        } else {
            $data['fbaccount_photo_rejected_status'] = '';    
        }

        if (isset($this->request->post['fbaccount_photo_level_status'])) {
            $data['fbaccount_photo_level_status'] = $this->request->post['fbaccount_photo_level_status'];
        } elseif ($this->config->get('fbaccount_photo_level_status')!==null) {
            $data['fbaccount_photo_level_status'] = $this->config->get('fbaccount_photo_level_status');   
        } else {
            $data['fbaccount_photo_level_status'] = array();          
        }

        if (isset($this->request->post['fbaccount_photo_auditor_status'])) {
            $data['fbaccount_photo_auditor_status'] = $this->request->post['fbaccount_photo_auditor_status'];
        } elseif ($this->config->get('fbaccount_photo_auditor_status')!==null) {
            $data['fbaccount_photo_auditor_status'] = $this->config->get('fbaccount_photo_auditor_status');   
        } else {
            $data['fbaccount_photo_auditor_status'] = array();            
        }

        if (isset($this->request->post['fbaccount_photo_auditor_publish'])) {
            $data['fbaccount_photo_auditor_publish'] = $this->request->post['fbaccount_photo_auditor_publish'];
        } elseif ($this->config->get('fbaccount_photo_auditor_publish')!==null) {
            $data['fbaccount_photo_auditor_publish'] = $this->config->get('fbaccount_photo_auditor_publish'); 
        } else {
            $data['fbaccount_photo_auditor_publish'] = array();           
        }

        if (isset($this->request->post['fbaccount_photo_auditor_approve'])) {
            $data['fbaccount_photo_auditor_approve'] = $this->request->post['fbaccount_photo_auditor_approve'];
        } elseif ($this->config->get('fbaccount_photo_auditor_approve')!==null) {
            $data['fbaccount_photo_auditor_approve'] = $this->config->get('fbaccount_photo_auditor_approve'); 
        } else {
            $data['fbaccount_photo_auditor_approve'] = array();           
        }

        if (isset($this->request->post['fbaccount_photo_auditor_modify'])) {
            $data['fbaccount_photo_auditor_modify'] = $this->request->post['fbaccount_photo_auditor_modify'];
        } elseif ($this->config->get('fbaccount_photo_auditor_modify')!==null) {
            $data['fbaccount_photo_auditor_modify'] = $this->config->get('fbaccount_photo_auditor_modify');   
        } else {
            $data['fbaccount_photo_auditor_modify'] = array();            
        }

        if (isset($this->request->post['fbaccount_photo_promotion_modify'])) {
            $data['fbaccount_photo_promotion_modify'] = $this->request->post['fbaccount_photo_promotion_modify'];
        } elseif ($this->config->get('fbaccount_photo_promotion_modify')!==null) {
            $data['fbaccount_photo_promotion_modify'] = $this->config->get('fbaccount_photo_promotion_modify');   
        } else {
            $data['fbaccount_photo_promotion_modify'] = array();          
        }

        if (isset($this->request->post['fbaccount_photo_promoting_publish'])) {
            $data['fbaccount_photo_promoting_publish'] = $this->request->post['fbaccount_photo_promoting_publish'];
        } elseif ($this->config->get('fbaccount_photo_promoting_publish')!==null) {
            $data['fbaccount_photo_promoting_publish'] = $this->config->get('fbaccount_photo_promoting_publish'); 
        } else {
            $data['fbaccount_photo_promoting_publish'] = '';          
        }

        if (isset($this->request->post['fbaccount_photo_testing_publish'])) {
            $data['fbaccount_photo_testing_publish'] = $this->request->post['fbaccount_photo_testing_publish'];
        } elseif ($this->config->get('fbaccount_photo_testing_publish')!==null) {
            $data['fbaccount_photo_testing_publish'] = $this->config->get('fbaccount_photo_testing_publish'); 
        } else {
            $data['fbaccount_photo_testing_publish'] = '';            
        }

//fbaccount nophoto
        $this->load->model('fbaccount/nophoto_status');
        $data['post_statuses'] = $this->model_fbaccount_nophoto_status->getStatuses();    
        $this->load->model('fbaccount/nophoto_publish');
        $data['post_publishes'] = $this->model_fbaccount_nophoto_publish->getPublishes();  
//fbaccount photo
        $this->load->model('fbaccount/photo_status');
        $data['photo_statuses'] = $this->model_fbaccount_photo_status->getStatuses();    
        $this->load->model('fbaccount/photo_publish');
        $data['photo_publishes'] = $this->model_fbaccount_photo_publish->getPublishes();             

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('fbaccount/setting/config.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'fbaccount/config')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        return !$this->error;
    }
}