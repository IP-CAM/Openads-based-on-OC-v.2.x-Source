<?php  
class ControllerSettingMenu extends Controller {
    private $error = array();
    public function index() {
        $this->language->load('setting/menu');

        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->addStyle(TPL_JS."jstree/dist/themes/default/style.min.css");
        $this->document->addScript(TPL_JS.'jstree/dist/jstree.min.js');
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('setting/menu', 'token=' . $this->session->data['token'] , 'SSL'),
        );
        if (isset($this->session->data['warning'])) {
            $data['error_warning'] = $this->session->data['warning'];
            unset($this->session->data['warning']);
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        $data['token'] = $this->session->data['token'];
        $this->language->setText($data,array(
            'heading_title' => 'heading_title',
            'text_no_results' => 'text_no_results',
            'text_edit' => 'text_edit',
            'text_wait' => 'text_wait',
            'text_yes' => 'text_yes',
            'text_no' => 'text_no',
            'text_inside' => 'text_inside',
            'text_before' => 'text_before',
            'text_after' => 'text_after',
            'text_root' => 'text_root',
            'text_expand_collapse' => 'text_expand_collapse',
            'text_create_root' => 'text_create_root',
            'text_new_node' => 'text_new_node',
            'text_confirm_del' => 'text_confirm_del',
            'text_confirm_move' => 'text_confirm_move',
            'button_remove' => 'button_remove',
            'button_create' => 'button_create',
            'button_edit' => 'button_edit',
            'tab_menu' => 'tab_menu',
            'tab_role' => 'tab_role',
            'text_title_menu' => 'text_title_menu',
            'text_title_edit' => 'text_title_edit',
            'entry_parent' => 'entry_parent',
            'entry_key' => 'entry_key',
            'entry_title' => 'entry_title',
            'entry_path' => 'entry_path',
            'entry_auth' => 'entry_auth',
            'entry_sort' => 'entry_sort',
            'entry_style' => 'entry_style',
            'entry_status' => 'entry_status',
            'text_role_menu' => 'text_role_menu',
            'text_role_member' => 'text_role_member',
            'text_save_member' => 'text_save_member',
            'entry_role_name' => 'entry_role_name',
            'entry_role_member' => 'entry_role_member',
            'entry_action' => 'entry_action',
            'entry_group_supervisor' => 'entry_group_supervisor',
            'help_group_supervisor'  => 'help_group_supervisor',
            'entry_group_publisher'  => 'entry_group_publisher',
            'help_group_publisher'   => 'help_group_publisher',
            'entry_group_promoter'  => 'entry_group_promoter',
            'help_group_promoter'   => 'help_group_promoter',
            'entry_group_manager'    => 'entry_group_manager',
            'help_group_manager'     => 'help_group_manager',
            'entry_group_targeting'  => 'entry_group_targeting',
            'help_group_targeting'   => 'help_group_targeting',
            'entry_group_post'       => 'entry_group_post',
            'help_group_post'        => 'help_group_post',
            'entry_group_photo'      => 'entry_group_photo',
            'help_group_photo'       => 'help_group_photo',
            'button_save' => 'button_save',
            'button_close' => 'button_close',
            'button_cancel' => 'button_cancel',
        ));

// group
        if (isset($this->request->post['ad_group_supervisor'])) {
            $data['ad_group_supervisor'] = $this->request->post['ad_group_supervisor'];
        } else if ($this->config->get('ad_group_supervisor') !== null) {
            $data['ad_group_supervisor'] = $this->config->get('ad_group_supervisor');
        } else {
            $data['ad_group_supervisor'] = array();
        }
        if (isset($this->request->post['ad_group_manager'])) {
            $data['ad_group_manager'] = $this->request->post['ad_group_manager'];
        } else if ($this->config->get('ad_group_manager') !== null) {
            $data['ad_group_manager'] = $this->config->get('ad_group_manager');
        } else {
            $data['ad_group_manager'] = array();
        }
        if (isset($this->request->post['ad_group_targeting'])) {
            $data['ad_group_targeting'] = $this->request->post['ad_group_targeting'];
        } else if ($this->config->get('ad_group_targeting') !== null) {
            $data['ad_group_targeting'] = $this->config->get('ad_group_targeting');
        } else {
            $data['ad_group_targeting'] = array();
        }
        if (isset($this->request->post['ad_group_post'])) {
            $data['ad_group_post'] = $this->request->post['ad_group_post'];
        } else if ($this->config->get('ad_group_post') !== null) {
            $data['ad_group_post'] = $this->config->get('ad_group_post');
        } else {
            $data['ad_group_post'] = array();
        }
        if (isset($this->request->post['ad_group_photo'])) {
            $data['ad_group_photo'] = $this->request->post['ad_group_photo'];
        } else if ($this->config->get('ad_group_photo') !== null) {
            $data['ad_group_photo'] = $this->config->get('ad_group_photo');
        } else {
            $data['ad_group_photo'] = array();
        }
        if (isset($this->request->post['ad_group_publisher'])) {
            $data['ad_group_publisher'] = $this->request->post['ad_group_publisher'];
        } else if ($this->config->get('ad_group_publisher') !== null) {
            $data['ad_group_publisher'] = $this->config->get('ad_group_publisher');
        } else {
            $data['ad_group_publisher'] = array();
        }
        if (isset($this->request->post['ad_group_promoter'])) {
            $data['ad_group_promoter'] = $this->request->post['ad_group_promoter'];
        } else if ($this->config->get('ad_group_promoter') !== null) {
            $data['ad_group_promoter'] = $this->config->get('ad_group_promoter');
        } else {
            $data['ad_group_promoter'] = array();
        }
        $this->load->model('user/user');
        $data['users'] = $this->model_user_user->getUsers(array('filter_status'=>1));

        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();

        $this->load->model('setting/menu');
        if(!empty($this->request->get['permission'])){

            $nodes = $this->render_tree($this->model_setting_menu->getNodeTree(null),'',true);
            $this->response->setOutput(json_encode($nodes));
        }else{
            $this->response->setOutput($this->load->view('setting/menu.tpl', $data,true));
        }
    }
    private function render_tree($nodes,$role='',$open=false){

        if(is_array($nodes)){
            $data = array();
            foreach ($nodes as $key => $item) {
                $tmp = array();
                $tmp['text'] = trim($item['name']);

                if($open){
                    $tmp['state'] = array('opened'=>true);
                }
                if(isset($item['children']) && is_array($item['children'])){
                    $tmp['icon'] = 'jstree-folder';
                    $tmp['children'] = $this->render_tree($item['children'],$role);
                }else{
                    $tmp['icon'] = "jstree-file";
                    $_roles = explode(",",$item['role']);
                    if(is_array($_roles))
                    $tmp['state'] = array('checked'=>is_array($_roles) && in_array($role, $_roles) );
                }
                $tmp['li_attr'] = array(
                    'node_id' => $item['node_id'],
                    'title' => $item['name'],
                    'level' => $item['level'],
                    'p_id' => $item['p_id'],
                    'p_key' => $item['p_key'],
                    'p_path' => trim($item['p_path']),
                    'key' => $item['key'],
                    'path' => trim($item['path']),
                    'status' => $item['status'],
                    'auth' => $item['auth'],
                    'sort' => $item['sort'],
                    'note' => $item['note'],
                    'lang' => $item['lang'],
                );
                $tmp['id'] = $item['node_id'];
                $data[] = $tmp;
            }
            return $data;
        }
        return false;
    }

    public function menu(){
        $this->language->load('setting/menu');
        $action = empty($this->request->post['action']) ? 'get' : strtolower($this->request->post['action']);
        $this->load->model('setting/menu');
        switch($action){
            case 'setup':
                $this->model_setting_menu->setRoleNodes($this->request->post['role'],$this->request->post['node']);
                $json = array('status'=>1,'msg'=>$this->language->get('text_success'));
                break;
            default :
                $role = empty($this->request->get['role']) ? '' : strtolower($this->request->get['role']);
                $json = $this->render_tree($this->model_setting_menu->getNodeTree(null),$role);
                break;
        }
        $this->response->setOutput(json_encode($json));
    }

    public function save() {
        $this->language->load('setting/menu');

        $this->load->model('setting/menu');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $res = $this->model_setting_menu->saveNode($this->request->post);
            if($res){
                $data = array('status'=>1,'msg'=>$this->language->get('text_success'));
            }else{
                $data = array('status'=>0,'msg'=>$this->language->get('text_error'));
            }
            $this->response->setOutput(json_encode($data));
        }
    }

    protected function validateForm() {

        if(!empty($this->request->post['note_node'])){
            if ((utf8_strlen($this->request->post['note']) < 3) || (utf8_strlen($this->request->post['note']) > 64)) {
                $this->error['note'] = $this->language->get('error_note');
            }
        }else if(empty($this->request->post['drag'])){
            if ((utf8_strlen($this->request->post['key']) < 3) || (utf8_strlen($this->request->post['key']) > 64)) {
                $this->error['menu_key'] = $this->language->get('error_menu_key');
            }
        }
        return !$this->error;
    }

    public function delete() {
        $this->language->load('setting/menu');

        $this->load->model('setting/menu');

        if (isset($this->request->post['node_id']) && $this->validateDelete('setting/menu/delete')) {
            if($this->model_setting_menu->deleteNode($this->request->post['node_id'])){
                $this->response->setOutput(json_encode(array('status'=>1,'msg'=>'Deleted!')));
            }
        }
    }
    protected function validateDelete($route) { 
        if (!$this->user->hasPermission($route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        } 
        if (!isset($this->request->post['node_id'])) {
            $this->error['warning'] = $this->language->get('text_error');
        }
        return !$this->error;
    }

}