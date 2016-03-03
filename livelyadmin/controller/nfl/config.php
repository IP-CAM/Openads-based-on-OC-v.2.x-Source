<?php
class ControllerNflConfig extends Controller {
    private $error = array();
 
    public function index() {
        $this->language->load('nfl/config'); 

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('sns', $this->request->post);  
            
            $this->session->data['success'] = $this->language->get('text_success');

             $this->response->redirect($this->url->link('nfl/config', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_items'] = $this->language->get('text_items');
        $data['text_edit'] = $this->language->get('text_edit');


        // nophoto start
        $data['text_nfl_initial_status'] = $this->language->get('text_nfl_initial_status');
        $data['text_nfl_initial_publish'] = $this->language->get('text_nfl_initial_publish');

        $data['text_nfl_auditor_attention_status'] = $this->language->get('text_nfl_auditor_attention_status');
        $data['text_nfl_auditor_attention_publish'] = $this->language->get('text_nfl_auditor_attention_publish');

        $data['text_nfl_level_status'] = $this->language->get('text_nfl_level_status');
        $data['text_nfl_rejected_status'] = $this->language->get('text_nfl_rejected_status');
        $data['text_nfl_promote_activation'] = $this->language->get('text_nfl_promote_activation');
        $data['text_nfl_promote_expired_publish'] = $this->language->get('text_nfl_promote_expired_publish');

        $data['text_nfl_auditor_approve_status'] = $this->language->get('text_nfl_auditor_approve_status');
        $data['text_nfl_auditor_modify_publish'] = $this->language->get('text_nfl_auditor_modify_publish');
        $data['text_nfl_promotion_modify_publish'] = $this->language->get('text_nfl_promotion_modify_publish');
        $data['text_nfl_promoting_publish'] = $this->language->get('text_nfl_promoting_publish');
        $data['text_nfl_testing_publish'] = $this->language->get('text_nfl_testing_publish');
        $data['text_similar_percent'] = $this->language->get('text_similar_percent');

        $data['help_nfl_initial_status'] = $this->language->get('help_nfl_initial_status');
        $data['help_nfl_initial_publish'] = $this->language->get('help_nfl_initial_publish');

        $data['help_nfl_auditor_attention_status'] = $this->language->get('help_nfl_auditor_attention_status');
        $data['help_nfl_auditor_attention_publish'] = $this->language->get('help_nfl_auditor_attention_publish');

        $data['help_nfl_level_status'] = $this->language->get('help_nfl_level_status');
        $data['help_nfl_rejected_status'] = $this->language->get('help_nfl_rejected_status');
        $data['help_nfl_promote_activation'] = $this->language->get('help_nfl_promote_activation');
        $data['help_nfl_promote_expired_publish'] = $this->language->get('help_nfl_promote_expired_publish');

        $data['help_nfl_auditor_approve_status'] = $this->language->get('help_nfl_auditor_approve_status');
        $data['help_nfl_auditor_modify_publish'] = $this->language->get('help_nfl_auditor_modify_publish');
        $data['help_nfl_promotion_modify_publish'] = $this->language->get('help_nfl_promotion_modify_publish');
        $data['help_nfl_promoting_publish'] = $this->language->get('help_nfl_promoting_publish');
        $data['help_nfl_testing_publish'] = $this->language->get('help_nfl_testing_publish');
        $data['help_similar_percent'] = $this->language->get('help_similar_percent');
        // nophoto end

        //photo start
        $data['text_photo_initial_status'] = $this->language->get('text_photo_initial_status');
        $data['text_photo_initial_publish'] = $this->language->get('text_photo_initial_publish');
        $data['text_photo_artist_finished_status'] = $this->language->get('text_photo_artist_finished_status');
        $data['text_photo_artist_finished_publish'] = $this->language->get('text_photo_artist_finished_publish');

        $data['text_photo_artist_attention_status'] = $this->language->get('text_photo_artist_attention_status');
        $data['text_photo_artist_attention_publish'] = $this->language->get('text_photo_artist_attention_publish');
        $data['text_photo_auditor_attention_status'] = $this->language->get('text_photo_auditor_attention_status');
        $data['text_photo_auditor_attention_publish'] = $this->language->get('text_photo_auditor_attention_publish');

        $data['text_photo_level_status'] = $this->language->get('text_photo_level_status');
        $data['text_photo_rejected_status'] = $this->language->get('text_photo_rejected_status');
        
        $data['text_photo_promote_expired_publish'] = $this->language->get('text_photo_promote_expired_publish');

        $data['text_photo_auditor_approve_status'] = $this->language->get('text_photo_auditor_approve_status');
        $data['text_photo_auditor_modify_publish'] = $this->language->get('text_photo_auditor_modify_publish');
        $data['text_photo_artist_approve_status'] = $this->language->get('text_photo_artist_approve_status');
        $data['text_photo_artist_modify_publish'] = $this->language->get('text_photo_artist_modify_publish');
        $data['text_photo_promotion_modify_publish'] = $this->language->get('text_photo_promotion_modify_publish');

        $data['text_photo_promoting_publish'] = $this->language->get('text_photo_promoting_publish');
        $data['text_photo_testing_publish'] = $this->language->get('text_photo_testing_publish');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_photo'] = $this->language->get('tab_photo');
        $data['tab_nophoto'] = $this->language->get('tab_nophoto');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('nfl/config', 'token=' . $this->session->data['token'], 'SSL')
        );

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['action'] = $this->url->link('nfl/config', 'token=' . $this->session->data['token'], 'SSL');

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
        $data['action'] = $this->url->link('nfl/config', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['cancel'] = $this->url->link('nfl/config', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['token'] = $this->session->data['token'];


        //nophoto

        if (isset($this->request->post['nfl_initial_publish'])) {
            $data['nfl_initial_publish'] = $this->request->post['nfl_initial_publish'];
        } elseif ($this->config->get('initial_publish')!==null) {
            $data['nfl_initial_publish'] = $this->config->get('nfl_initial_publish'); 
        } else {
            $data['nfl_initial_publish'] = '';            
        }

        if (isset($this->request->post['nfl_initial_status'])) {
            $data['nfl_initial_status'] = $this->request->post['nfl_initial_status'];
        } elseif ($this->config->get('nfl_initial_status')!==null) {
            $data['nfl_initial_status'] = $this->config->get('nfl_initial_status');   
        } else {
            $data['nfl_initial_status'] = '';         
        }


        if (isset($this->request->post['nfl_similar_percent'])) {
            $data['nfl_similar_percent'] = $this->request->post['nfl_similar_percent'];
        } elseif ($this->config->get('nfl_similar_percent')!==null) {
            $data['nfl_similar_percent'] = $this->config->get('nfl_similar_percent');
        } else {
            $data['nfl_similar_percent'] = '';  
        }

        if (isset($this->request->post['nfl_expired_publish'])) {
            $data['nfl_expired_publish'] = $this->request->post['nfl_expired_publish'];
        } elseif ($this->config->get('nfl_expired_publish')!==null) {
            $data['nfl_expired_publish'] = $this->config->get('nfl_expired_publish');
        } else {
            $data['nfl_expired_publish'] = '';    
        }

        if (isset($this->request->post['nfl_rejected_status'])) {
            $data['nfl_rejected_status'] = $this->request->post['nfl_rejected_status'];
        } elseif ($this->config->get('nfl_rejected_status')!==null) {
            $data['nfl_rejected_status'] = $this->config->get('nfl_rejected_status');
        } else {
            $data['nfl_rejected_status'] = '';    
        }

        if (isset($this->request->post['nfl_level_status'])) {
            $data['nfl_level_status'] = $this->request->post['nfl_level_status'];
        } elseif ($this->config->get('nfl_level_status')!==null) {
            $data['nfl_level_status'] = $this->config->get('nfl_level_status');   
        } else {
            $data['nfl_level_status'] = array();          
        }

        if (isset($this->request->post['nfl_auditor_status'])) {
            $data['nfl_auditor_status'] = $this->request->post['nfl_auditor_status'];
        } elseif ($this->config->get('nfl_auditor_status')!==null) {
            $data['nfl_auditor_status'] = $this->config->get('nfl_auditor_status');   
        } else {
            $data['nfl_auditor_status'] = array();            
        }

        if (isset($this->request->post['nfl_auditor_publish'])) {
            $data['nfl_auditor_publish'] = $this->request->post['nfl_auditor_publish'];
        } elseif ($this->config->get('nfl_auditor_publish')!==null) {
            $data['nfl_auditor_publish'] = $this->config->get('nfl_auditor_publish'); 
        } else {
            $data['nfl_auditor_publish'] = array();           
        }

        if (isset($this->request->post['nfl_auditor_approve'])) {
            $data['nfl_auditor_approve'] = $this->request->post['nfl_auditor_approve'];
        } elseif ($this->config->get('nfl_auditor_approve')!==null) {
            $data['nfl_auditor_approve'] = $this->config->get('nfl_auditor_approve'); 
        } else {
            $data['nfl_auditor_approve'] = array();           
        }

        if (isset($this->request->post['nfl_auditor_modify'])) {
            $data['nfl_auditor_modify'] = $this->request->post['nfl_auditor_modify'];
        } elseif ($this->config->get('nfl_auditor_modify')!==null) {
            $data['nfl_auditor_modify'] = $this->config->get('nfl_auditor_modify');   
        } else {
            $data['nfl_auditor_modify'] = array();            
        }

        if (isset($this->request->post['nfl_promotion_modify'])) {
            $data['nfl_promotion_modify'] = $this->request->post['nfl_promotion_modify'];
        } elseif ($this->config->get('nfl_promotion_modify')!==null) {
            $data['nfl_promotion_modify'] = $this->config->get('nfl_promotion_modify');   
        } else {
            $data['nfl_promotion_modify'] = array();          
        }

        if (isset($this->request->post['nfl_promoting_publish'])) {
            $data['nfl_promoting_publish'] = $this->request->post['nfl_promoting_publish'];
        } elseif ($this->config->get('nfl_promoting_publish')!==null) {
            $data['nfl_promoting_publish'] = $this->config->get('nfl_promoting_publish'); 
        } else {
            $data['nfl_promoting_publish'] = '';          
        }

        if (isset($this->request->post['nfl_testing_publish'])) {
            $data['nfl_testing_publish'] = $this->request->post['nfl_testing_publish'];
        } elseif ($this->config->get('nfl_testing_publish')!==null) {
            $data['nfl_testing_publish'] = $this->config->get('nfl_testing_publish'); 
        } else {
            $data['nfl_testing_publish'] = '';            
        }

        $this->load->model('user/user');
        $data['all_users'] = $this->model_user_user->getUsers(array('status'=>1));    

        $this->load->model('nfl/status');
        $data['post_statuses'] = $this->model_nfl_status->getStatuses();    
        $this->load->model('nfl/publish');
        $data['post_publishes'] = $this->model_nfl_publish->getPublishes();  
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/config.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'nfl/config')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
                
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
            
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
    
    
        

}