<?php
class ControllerSnsConfig extends Controller {
    private $error = array();
 
    public function index() {
        $this->language->load('sns/config'); 

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('sns', $this->request->post);  
            
            $this->session->data['success'] = $this->language->get('text_success');

             $this->response->redirect($this->url->link('sns/config', 'token=' . $this->session->data['token'], 'SSL'));
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
        $this->data['text_initial_status'] = $this->language->get('text_initial_status');
        $this->data['text_initial_publish'] = $this->language->get('text_initial_publish');

        $this->data['text_auditor_attention_status'] = $this->language->get('text_auditor_attention_status');
        $this->data['text_auditor_attention_publish'] = $this->language->get('text_auditor_attention_publish');

        $this->data['text_level_status'] = $this->language->get('text_level_status');
        $this->data['text_rejected_status'] = $this->language->get('text_rejected_status');
        $this->data['text_promote_activation'] = $this->language->get('text_promote_activation');
        $this->data['text_promote_expired_publish'] = $this->language->get('text_promote_expired_publish');

        $this->data['text_auditor_approve_status'] = $this->language->get('text_auditor_approve_status');
        $this->data['text_auditor_modify_publish'] = $this->language->get('text_auditor_modify_publish');
        $this->data['text_promotion_modify_publish'] = $this->language->get('text_promotion_modify_publish');
        $this->data['text_promoting_publish'] = $this->language->get('text_promoting_publish');
        $this->data['text_testing_publish'] = $this->language->get('text_testing_publish');
        // nophoto end

        // message start
        $this->data['text_message_initial_status'] = $this->language->get('text_message_initial_status');
        $this->data['text_message_initial_publish'] = $this->language->get('text_message_initial_publish');

        $this->data['text_message_auditor_attention_status'] = $this->language->get('text_message_auditor_attention_status');
        $this->data['text_message_auditor_attention_publish'] = $this->language->get('text_message_auditor_attention_publish');

        $this->data['text_message_level_status'] = $this->language->get('text_message_level_status');
        $this->data['text_message_rejected_status'] = $this->language->get('text_message_rejected_status');
        $this->data['text_message_promote_activation'] = $this->language->get('text_message_promote_activation');
        $this->data['text_message_promote_expired_publish'] = $this->language->get('text_message_promote_expired_publish');

        $this->data['text_message_auditor_approve_status'] = $this->language->get('text_message_auditor_approve_status');
        $this->data['text_message_auditor_modify_publish'] = $this->language->get('text_message_auditor_modify_publish');
        $this->data['text_message_promotion_modify_publish'] = $this->language->get('text_message_promotion_modify_publish');
        $this->data['text_message_promoting_publish'] = $this->language->get('text_message_promoting_publish');
        $this->data['text_message_testing_publish'] = $this->language->get('text_message_testing_publish');
        $this->data['text_message_similar_percent'] = $this->language->get('text_message_similar_percent');
        //message end

        //photo start
        $this->data['text_photo_initial_status'] = $this->language->get('text_photo_initial_status');
        $this->data['text_photo_initial_publish'] = $this->language->get('text_photo_initial_publish');
        $this->data['text_photo_artist_finished_status'] = $this->language->get('text_photo_artist_finished_status');
        $this->data['text_photo_artist_finished_publish'] = $this->language->get('text_photo_artist_finished_publish');

        $this->data['text_photo_artist_attention_status'] = $this->language->get('text_photo_artist_attention_status');
        $this->data['text_photo_artist_attention_publish'] = $this->language->get('text_photo_artist_attention_publish');
        $this->data['text_photo_auditor_attention_status'] = $this->language->get('text_photo_auditor_attention_status');
        $this->data['text_photo_auditor_attention_publish'] = $this->language->get('text_photo_auditor_attention_publish');

        $this->data['text_photo_level_status'] = $this->language->get('text_photo_level_status');
        $this->data['text_photo_rejected_status'] = $this->language->get('text_photo_rejected_status');
        $this->data['text_simillar_percent'] = $this->language->get('text_simillar_percent');
        $this->data['text_photo_promote_expired_publish'] = $this->language->get('text_photo_promote_expired_publish');

        $this->data['text_photo_auditor_approve_status'] = $this->language->get('text_photo_auditor_approve_status');
        $this->data['text_photo_auditor_modify_publish'] = $this->language->get('text_photo_auditor_modify_publish');
        $this->data['text_photo_artist_approve_status'] = $this->language->get('text_photo_artist_approve_status');
        $this->data['text_photo_artist_modify_publish'] = $this->language->get('text_photo_artist_modify_publish');
        $this->data['text_photo_promotion_modify_publish'] = $this->language->get('text_photo_promotion_modify_publish');

        $this->data['text_photo_promoting_publish'] = $this->language->get('text_photo_promoting_publish');
        $this->data['text_photo_testing_publish'] = $this->language->get('text_photo_testing_publish');

        $this->data['tab_photo'] = $this->language->get('tab_photo');
        $this->data['tab_nophoto'] = $this->language->get('tab_nophoto');
        $this->data['tab_message'] = $this->language->get('tab_message');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sns/config', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('sns/config', 'token=' . $this->session->data['token'], 'SSL');

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
        if (isset($this->request->post['nophoto_initial_publish'])) {
            $this->data['nophoto_initial_publish'] = $this->request->post['nophoto_initial_publish'];
        } elseif ($this->config->get('initial_publish')!==null) {
            $this->data['nophoto_initial_publish'] = $this->config->get('nophoto_initial_publish'); 
        } else {
            $this->data['nophoto_initial_publish'] = '';            
        }

        if (isset($this->request->post['nophoto_initial_status'])) {
            $this->data['nophoto_initial_status'] = $this->request->post['nophoto_initial_status'];
        } elseif ($this->config->get('nophoto_initial_status')!==null) {
            $this->data['nophoto_initial_status'] = $this->config->get('nophoto_initial_status');   
        } else {
            $this->data['nophoto_initial_status'] = '';         
        }

        if (isset($this->request->post['nophoto_similar_text_percent'])) {
            $this->data['nophoto_similar_text_percent'] = $this->request->post['nophoto_similar_text_percent'];
        } elseif ($this->config->get('nophoto_similar_text_percent')!==null) {
            $this->data['nophoto_similar_text_percent'] = $this->config->get('nophoto_similar_text_percent');
        } else {
            $this->data['nophoto_similar_text_percent'] = '';  
        }

        if (isset($this->request->post['nophoto_expired_publish'])) {
            $this->data['nophoto_expired_publish'] = $this->request->post['nophoto_expired_publish'];
        } elseif ($this->config->get('nophoto_expired_publish')!==null) {
            $this->data['nophoto_expired_publish'] = $this->config->get('nophoto_expired_publish');
        } else {
            $this->data['nophoto_expired_publish'] = '';    
        }

        if (isset($this->request->post['nophoto_rejected_status'])) {
            $this->data['nophoto_rejected_status'] = $this->request->post['nophoto_rejected_status'];
        } elseif ($this->config->get('nophoto_rejected_status')!==null) {
            $this->data['nophoto_rejected_status'] = $this->config->get('nophoto_rejected_status');
        } else {
            $this->data['nophoto_rejected_status'] = '';    
        }

        if (isset($this->request->post['nophoto_level_status'])) {
            $this->data['nophoto_level_status'] = $this->request->post['nophoto_level_status'];
        } elseif ($this->config->get('nophoto_level_status')!==null) {
            $this->data['nophoto_level_status'] = $this->config->get('nophoto_level_status');   
        } else {
            $this->data['nophoto_level_status'] = array();          
        }

        if (isset($this->request->post['nophoto_auditor_status'])) {
            $this->data['nophoto_auditor_status'] = $this->request->post['nophoto_auditor_status'];
        } elseif ($this->config->get('nophoto_auditor_status')!==null) {
            $this->data['nophoto_auditor_status'] = $this->config->get('nophoto_auditor_status');   
        } else {
            $this->data['nophoto_auditor_status'] = array();            
        }

        if (isset($this->request->post['nophoto_auditor_publish'])) {
            $this->data['nophoto_auditor_publish'] = $this->request->post['nophoto_auditor_publish'];
        } elseif ($this->config->get('nophoto_auditor_publish')!==null) {
            $this->data['nophoto_auditor_publish'] = $this->config->get('nophoto_auditor_publish'); 
        } else {
            $this->data['nophoto_auditor_publish'] = array();           
        }

        if (isset($this->request->post['nophoto_auditor_approve'])) {
            $this->data['nophoto_auditor_approve'] = $this->request->post['nophoto_auditor_approve'];
        } elseif ($this->config->get('nophoto_auditor_approve')!==null) {
            $this->data['nophoto_auditor_approve'] = $this->config->get('nophoto_auditor_approve'); 
        } else {
            $this->data['nophoto_auditor_approve'] = array();           
        }

        if (isset($this->request->post['nophoto_auditor_modify'])) {
            $this->data['nophoto_auditor_modify'] = $this->request->post['nophoto_auditor_modify'];
        } elseif ($this->config->get('nophoto_auditor_modify')!==null) {
            $this->data['nophoto_auditor_modify'] = $this->config->get('nophoto_auditor_modify');   
        } else {
            $this->data['nophoto_auditor_modify'] = array();            
        }

        if (isset($this->request->post['nophoto_promotion_modify'])) {
            $this->data['nophoto_promotion_modify'] = $this->request->post['nophoto_promotion_modify'];
        } elseif ($this->config->get('nophoto_promotion_modify')!==null) {
            $this->data['nophoto_promotion_modify'] = $this->config->get('nophoto_promotion_modify');   
        } else {
            $this->data['nophoto_promotion_modify'] = array();          
        }

        if (isset($this->request->post['nophoto_promoting_publish'])) {
            $this->data['nophoto_promoting_publish'] = $this->request->post['nophoto_promoting_publish'];
        } elseif ($this->config->get('nophoto_promoting_publish')!==null) {
            $this->data['nophoto_promoting_publish'] = $this->config->get('nophoto_promoting_publish'); 
        } else {
            $this->data['nophoto_promoting_publish'] = '';          
        }

        if (isset($this->request->post['nophoto_testing_publish'])) {
            $this->data['nophoto_testing_publish'] = $this->request->post['nophoto_testing_publish'];
        } elseif ($this->config->get('nophoto_testing_publish')!==null) {
            $this->data['nophoto_testing_publish'] = $this->config->get('nophoto_testing_publish'); 
        } else {
            $this->data['nophoto_testing_publish'] = '';            
        }

        //message
        if (isset($this->request->post['message_initial_publish'])) {
            $this->data['message_initial_publish'] = $this->request->post['message_initial_publish'];
        } elseif ($this->config->get('message_initial_publish')!==null) {
            $this->data['message_initial_publish'] = $this->config->get('message_initial_publish'); 
        } else {
            $this->data['message_initial_publish'] = '';            
        }

        if (isset($this->request->post['message_initial_status'])) {
            $this->data['message_initial_status'] = $this->request->post['message_initial_status'];
        } elseif ($this->config->get('message_initial_status')!==null) {
            $this->data['message_initial_status'] = $this->config->get('message_initial_status');   
        } else {
            $this->data['message_initial_status'] = '';         
        }

        if (isset($this->request->post['message_similar_text_percent'])) {
            $this->data['message_similar_text_percent'] = $this->request->post['message_similar_text_percent'];
        } elseif ($this->config->get('message_similar_text_percent')!==null) {
            $this->data['message_similar_text_percent'] = $this->config->get('message_similar_text_percent');
        } else {
            $this->data['message_similar_text_percent'] = '';  
        }

        if (isset($this->request->post['message_expired_publish'])) {
            $this->data['message_expired_publish'] = $this->request->post['message_expired_publish'];
        } elseif ($this->config->get('message_expired_publish')!==null) {
            $this->data['message_expired_publish'] = $this->config->get('message_expired_publish');
        } else {
            $this->data['message_expired_publish'] = '';    
        }

        if (isset($this->request->post['message_rejected_status'])) {
            $this->data['message_rejected_status'] = $this->request->post['message_rejected_status'];
        } elseif ($this->config->get('message_rejected_status')!==null) {
            $this->data['message_rejected_status'] = $this->config->get('message_rejected_status');
        } else {
            $this->data['message_rejected_status'] = '';    
        }

        if (isset($this->request->post['message_level_status'])) {
            $this->data['message_level_status'] = $this->request->post['message_level_status'];
        } elseif ($this->config->get('message_level_status')!==null) {
            $this->data['message_level_status'] = $this->config->get('message_level_status');   
        } else {
            $this->data['message_level_status'] = array();          
        }

        if (isset($this->request->post['message_auditor_status'])) {
            $this->data['message_auditor_status'] = $this->request->post['message_auditor_status'];
        } elseif ($this->config->get('message_auditor_status')!==null) {
            $this->data['message_auditor_status'] = $this->config->get('message_auditor_status');   
        } else {
            $this->data['message_auditor_status'] = array();            
        }

        if (isset($this->request->post['message_auditor_publish'])) {
            $this->data['message_auditor_publish'] = $this->request->post['message_auditor_publish'];
        } elseif ($this->config->get('message_auditor_publish')!==null) {
            $this->data['message_auditor_publish'] = $this->config->get('message_auditor_publish'); 
        } else {
            $this->data['message_auditor_publish'] = array();           
        }

        if (isset($this->request->post['message_auditor_approve'])) {
            $this->data['message_auditor_approve'] = $this->request->post['message_auditor_approve'];
        } elseif ($this->config->get('message_auditor_approve')!==null) {
            $this->data['message_auditor_approve'] = $this->config->get('message_auditor_approve'); 
        } else {
            $this->data['message_auditor_approve'] = array();           
        }

        if (isset($this->request->post['message_auditor_modify'])) {
            $this->data['message_auditor_modify'] = $this->request->post['message_auditor_modify'];
        } elseif ($this->config->get('message_auditor_modify')!==null) {
            $this->data['message_auditor_modify'] = $this->config->get('message_auditor_modify');   
        } else {
            $this->data['message_auditor_modify'] = array();            
        }

        if (isset($this->request->post['message_promotion_modify'])) {
            $this->data['message_promotion_modify'] = $this->request->post['message_promotion_modify'];
        } elseif ($this->config->get('message_promotion_modify')!==null) {
            $this->data['message_promotion_modify'] = $this->config->get('message_promotion_modify');   
        } else {
            $this->data['message_promotion_modify'] = array();          
        }

        if (isset($this->request->post['message_promoting_publish'])) {
            $this->data['message_promoting_publish'] = $this->request->post['message_promoting_publish'];
        } elseif ($this->config->get('message_promoting_publish')!==null) {
            $this->data['message_promoting_publish'] = $this->config->get('message_promoting_publish'); 
        } else {
            $this->data['message_promoting_publish'] = '';          
        }

        if (isset($this->request->post['message_testing_publish'])) {
            $this->data['message_testing_publish'] = $this->request->post['message_testing_publish'];
        } elseif ($this->config->get('message_testing_publish')!==null) {
            $this->data['message_testing_publish'] = $this->config->get('message_testing_publish'); 
        } else {
            $this->data['message_testing_publish'] = '';            
        }

        //photo
        if (isset($this->request->post['photo_initial_publish'])) {
            $this->data['photo_initial_publish'] = $this->request->post['photo_initial_publish'];
        } elseif ($this->config->get('initial_publish')!==null) {
            $this->data['photo_initial_publish'] = $this->config->get('photo_initial_publish'); 
        } else {
            $this->data['photo_initial_publish'] = '';            
        }

        if (isset($this->request->post['photo_initial_status'])) {
            $this->data['photo_initial_status'] = $this->request->post['photo_initial_status'];
        } elseif ($this->config->get('photo_initial_status')!==null) {
            $this->data['photo_initial_status'] = $this->config->get('photo_initial_status');   
        } else {
            $this->data['photo_initial_status'] = '';         
        }

        if (isset($this->request->post['photo_artist_status'])) {
            $this->data['photo_artist_status'] = $this->request->post['photo_artist_status'];
        } elseif ($this->config->get('photo_artist_status')!==null) {
            $this->data['photo_artist_status'] = $this->config->get('photo_artist_status'); 
        } else {
            $this->data['photo_artist_status'] = array();         
        }

        if (isset($this->request->post['photo_artist_publish'])) {
            $this->data['photo_artist_publish'] = $this->request->post['photo_artist_publish'];
        } elseif ($this->config->get('photo_artist_publish')!==null) {
            $this->data['photo_artist_publish'] = $this->config->get('photo_artist_publish');   
        } else {
            $this->data['photo_artist_publish'] = array();            
        }

        if (isset($this->request->post['photo_artist_finished_publish'])) {
            $this->data['photo_artist_finished_publish'] = $this->request->post['photo_artist_finished_publish'];
        } elseif ($this->config->get('photo_artist_finished_publish')!==null) {
            $this->data['photo_artist_finished_publish'] = $this->config->get('photo_artist_finished_publish'); 
        } else {
            $this->data['photo_artist_finished_publish'] = '';            
        }

        if (isset($this->request->post['photo_artist_finished_status'])) {
            $this->data['photo_artist_finished_status'] = $this->request->post['photo_artist_finished_status'];
        } elseif ($this->config->get('photo_artist_finished_status')!==null) {
            $this->data['photo_artist_finished_status'] = $this->config->get('photo_artist_finished_status');   
        } else {
            $this->data['photo_artist_finished_status'] = '';         
        }

        if (isset($this->request->post['photo_artist_approve'])) {
            $this->data['photo_artist_approve'] = $this->request->post['photo_artist_approve'];
        } elseif ($this->config->get('photo_artist_approve')!==null) {
            $this->data['photo_artist_approve'] = $this->config->get('photo_artist_approve');   
        } else {
            $this->data['photo_artist_approve'] = array();            
        }

        if (isset($this->request->post['photo_artist_modify'])) {
            $this->data['photo_artist_modify'] = $this->request->post['photo_artist_modify'];
        } elseif ($this->config->get('photo_artist_modify')!==null) {
            $this->data['photo_artist_modify'] = $this->config->get('photo_artist_modify'); 
        } else {
            $this->data['photo_artist_modify'] = array();         
        }

        if (isset($this->request->post['photo_similar_text_percent'])) {
            $this->data['photo_similar_text_percent'] = $this->request->post['photo_similar_text_percent'];
        } elseif ($this->config->get('similar_text_percent')!==null) {
            $this->data['photo_similar_text_percent'] = $this->config->get('photo_similar_text_percent');
        } else {
            $this->data['photo_similar_text_percent'] = '';  
        }

        if (isset($this->request->post['photo_expired_publish'])) {
            $this->data['photo_expired_publish'] = $this->request->post['photo_expired_publish'];
        } elseif ($this->config->get('photo_expired_publish')!==null) {
            $this->data['photo_expired_publish'] = $this->config->get('photo_expired_publish');
        } else {
            $this->data['photo_expired_publish'] = '';    
        }

        if (isset($this->request->post['photo_rejected_status'])) {
            $this->data['photo_rejected_status'] = $this->request->post['photo_rejected_status'];
        } elseif ($this->config->get('photo_rejected_status')!==null) {
            $this->data['photo_rejected_status'] = $this->config->get('photo_rejected_status');
        } else {
            $this->data['photo_rejected_status'] = '';    
        }

        if (isset($this->request->post['photo_level_status'])) {
            $this->data['photo_level_status'] = $this->request->post['photo_level_status'];
        } elseif ($this->config->get('photo_level_status')!==null) {
            $this->data['photo_level_status'] = $this->config->get('photo_level_status');   
        } else {
            $this->data['photo_level_status'] = array();          
        }

        if (isset($this->request->post['photo_auditor_status'])) {
            $this->data['photo_auditor_status'] = $this->request->post['photo_auditor_status'];
        } elseif ($this->config->get('photo_auditor_status')!==null) {
            $this->data['photo_auditor_status'] = $this->config->get('photo_auditor_status');   
        } else {
            $this->data['photo_auditor_status'] = array();            
        }

        if (isset($this->request->post['photo_auditor_publish'])) {
            $this->data['photo_auditor_publish'] = $this->request->post['photo_auditor_publish'];
        } elseif ($this->config->get('photo_auditor_publish')!==null) {
            $this->data['photo_auditor_publish'] = $this->config->get('photo_auditor_publish'); 
        } else {
            $this->data['photo_auditor_publish'] = array();           
        }

        if (isset($this->request->post['photo_auditor_approve'])) {
            $this->data['photo_auditor_approve'] = $this->request->post['photo_auditor_approve'];
        } elseif ($this->config->get('photo_auditor_approve')!==null) {
            $this->data['photo_auditor_approve'] = $this->config->get('photo_auditor_approve'); 
        } else {
            $this->data['photo_auditor_approve'] = array();           
        }

        if (isset($this->request->post['photo_auditor_modify'])) {
            $this->data['photo_auditor_modify'] = $this->request->post['photo_auditor_modify'];
        } elseif ($this->config->get('photo_auditor_modify')!==null) {
            $this->data['photo_auditor_modify'] = $this->config->get('photo_auditor_modify');   
        } else {
            $this->data['photo_auditor_modify'] = array();            
        }

        if (isset($this->request->post['photo_promotion_modify'])) {
            $this->data['photo_promotion_modify'] = $this->request->post['photo_promotion_modify'];
        } elseif ($this->config->get('photo_promotion_modify')!==null) {
            $this->data['photo_promotion_modify'] = $this->config->get('photo_promotion_modify');   
        } else {
            $this->data['photo_promotion_modify'] = array();          
        }

        if (isset($this->request->post['photo_promoting_publish'])) {
            $this->data['photo_promoting_publish'] = $this->request->post['photo_promoting_publish'];
        } elseif ($this->config->get('photo_promoting_publish')!==null) {
            $this->data['photo_promoting_publish'] = $this->config->get('photo_promoting_publish'); 
        } else {
            $this->data['photo_promoting_publish'] = '';          
        }

        if (isset($this->request->post['photo_testing_publish'])) {
            $this->data['photo_testing_publish'] = $this->request->post['photo_testing_publish'];
        } elseif ($this->config->get('photo_testing_publish')!==null) {
            $this->data['photo_testing_publish'] = $this->config->get('photo_testing_publish'); 
        } else {
            $this->data['photo_testing_publish'] = '';            
        }
//page nophoto    
        $this->load->model('fbpage/nophoto_status');
        $this->data['page_statuses'] = $this->model_fbpage_nophoto_status->getStatuses();    
        $this->load->model('fbpage/nophoto_publish');
        $this->data['page_publishes'] = $this->model_fbpage_nophoto_publish->getPublishes(); 
//fbaccount nophoto
        $this->load->model('fbaccount/nophoto_status');
        $this->data['post_statuses'] = $this->model_fbaccount_nophoto_status->getStatuses();    
        $this->load->model('fbaccount/nophoto_publish');
        $this->data['post_publishes'] = $this->model_fbaccount_nophoto_publish->getPublishes();  
//fbaccount photo
        $this->load->model('fbaccount/photo_status');
        $this->data['photo_statuses'] = $this->model_fbaccount_photo_status->getStatuses();    
        $this->load->model('fbaccount/photo_publish');
        $this->data['photo_publishes'] = $this->model_fbaccount_photo_publish->getPublishes();             
//message
        $this->load->model('fbmessage/nophoto_status');
        $this->data['message_statuses'] = $this->model_fbmessage_nophoto_status->getStatuses();    
        $this->load->model('fbmessage/nophoto_publish');
        $this->data['message_publishes'] = $this->model_fbmessage_nophoto_publish->getPublishes(); 

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sns/config.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'sns/config')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        return !$this->error;
    }
}