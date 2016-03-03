<?php
class ControllerSnsGroup extends Controller {
    private $error = array();
 
    public function index() {
        $this->language->load('sns/group'); 

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('sns', $this->request->post);  
            
            $this->session->data['success'] = $this->language->get('text_success');

             $this->response->redirect($this->url->link('sns/group', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_items'] = $this->language->get('text_items');
        $data['text_edit'] = $this->language->get('text_edit');

        $data['text_group'] = $this->language->get('text_group');
        $data['text_group_artist'] = $this->language->get('text_group_artist');
        $data['text_group_promotion'] = $this->language->get('text_group_promotion');
        $data['text_group_admin'] = $this->language->get('text_group_admin');
        $data['text_group_market'] = $this->language->get('text_group_market');

        $data['help_group_artist'] = $this->language->get('help_group_artist');
        $data['help_group_promotion'] = $this->language->get('help_group_promotion');
        $data['help_group_admin'] = $this->language->get('help_group_admin');
        $data['help_group_market'] = $this->language->get('help_group_market');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');


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
            'href' => $this->url->link('sns/group', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('sns/group', 'token=' . $this->session->data['token'], 'SSL');

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

        //general

        if (isset($this->request->post['sns_group_admin'])) {
            $data['sns_group_admin'] = $this->request->post['sns_group_admin'];
        } elseif ($this->config->get('sns_group_admin')!==null) {
            $data['sns_group_admin'] = $this->config->get('sns_group_admin'); 
        } else {
            $data['sns_group_admin'] = array();           
        }

        if (isset($this->request->post['sns_group_market'])) {
            $data['sns_group_market'] = $this->request->post['sns_group_market'];
        } elseif ($this->config->get('sns_group_market')!==null) {
            $data['sns_group_market'] = $this->config->get('sns_group_market');   
        } else {
            $data['sns_group_market'] = array();          
        }

        if (isset($this->request->post['sns_group_promotion'])) {
            $data['sns_group_promotion'] = $this->request->post['sns_group_promotion'];
        } elseif ($this->config->get('sns_group_promotion')!==null) {
            $data['sns_group_promotion'] = $this->config->get('sns_group_promotion'); 
        } else {
            $data['sns_group_promotion'] = array();           
        }

        if (isset($this->request->post['sns_group_artist'])) {
            $data['sns_group_artist'] = $this->request->post['sns_group_artist'];
        } elseif ($this->config->get('sns_group_artist')!==null) {
            $data['sns_group_artist'] = $this->config->get('sns_group_artist');   
        } else {
            $data['sns_group_artist'] = array();          
        }


        $this->load->model('user/user');
        $data['all_users'] = $this->model_user_user->getUsers(array('status'=>1));    


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sns/group.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'sns/group')) {
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