<?php
class ControllerSettingAdvertise extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('setting/advertise');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('ad', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('setting/advertise', 'token=' . $this->session->data['token'], 'SSL'));
        }
        $data['token'] = $this->session->data['token'];
        $this->language->setText($data,array(
            'heading_title'          => 'heading_title',
            'text_edit'              => 'text_edit',
            'text_select'            => 'text_select',
            'text_none'              => 'text_none',
            'text_yes'               => 'text_yes',
            'text_no'                => 'text_no',
            'text_publish'           => 'text_publish',
            'text_checkout'          => 'text_checkout',

            'entry_checkout'         => 'entry_checkout',
            'entry_priority'         => 'entry_priority',
            'button_save'            => 'button_save',
            'button_cancel'          => 'button_cancel',
            'button_close'           => 'button_close',
            'tab_general'            => 'tab_general',
            'tab_role'               => 'tab_role',
            'tab_targeting'          => 'tab_targeting',
            'tab_post'               => 'tab_post',
            'tab_photo'              => 'tab_photo',

            'help_checkout'          => 'help_checkout',
        //targeting
            'text_targeting_progress'            => 'text_targeting_progress',
            'text_targeting_status'              => 'text_targeting_status',
            'entry_targeting_pending'            => 'entry_targeting_pending',
            'entry_targeting_transferred'        => 'entry_targeting_transferred',
            'entry_targeting_review'             => 'entry_targeting_review',
            'entry_targeting_levels'             => 'entry_targeting_levels',
            'entry_targeting_rejected'           => 'entry_targeting_rejected',
        //post
            'text_post_progress'                 => 'text_post_progress',
            'text_post_status'                   => 'text_post_status',
            'entry_post_pending'                 => 'entry_post_pending',
            'entry_post_transferred'             => 'entry_post_transferred',
            'entry_post_review'                  => 'entry_post_review',
            'entry_post_robot_review'            => 'entry_post_robot_review',
            'entry_post_levels'                  => 'entry_post_levels',
            'entry_post_rejected'                => 'entry_post_rejected',
            'entry_similar_headline'             => 'entry_similar_headline',
            'entry_similar_content'              => 'entry_similar_content',
        //photo
            'text_photo_progress'                => 'text_photo_progress',
            'text_photo_status'                  => 'text_photo_status',
            'entry_photo_pending'                => 'entry_photo_pending',
            'entry_photo_transferred'            => 'entry_photo_transferred',
            'entry_photo_review'                 => 'entry_photo_review',
            'entry_photo_levels'                 => 'entry_photo_levels',
            'entry_photo_rejected'               => 'entry_photo_rejected',
        //publish
            'entry_publish_queue'                => 'entry_publish_queue',
            'entry_publish_indesign'            => 'entry_publish_indesign',
            'entry_publish_waiting'              => 'entry_publish_waiting',
            'entry_publish_confirmed'            => 'entry_publish_confirmed',
            'entry_publish_opening'              => 'entry_publish_opening',
            'entry_publish_success'              => 'entry_publish_success',
            'entry_publish_deliveried'           => 'entry_publish_deliveried',
            'entry_publish_failed'               => 'entry_publish_failed',
            'entry_publish_terminal'             => 'entry_publish_terminal',
            'entry_publish_closed'               => 'entry_publish_closed',
            'help_publish_queue'                 => 'help_publish_queue',
            'help_publish_indesign'             => 'help_publish_indesign',
            'help_publish_waiting'               => 'help_publish_waiting',
            'help_publish_confirmed'             => 'help_publish_confirmed',
            'help_publish_opening'               => 'help_publish_opening',
            'help_publish_success'               => 'help_publish_success',
            'help_publish_deliveried'            => 'help_publish_deliveried',
            'help_publish_failed'                => 'help_publish_failed',
            'help_publish_terminal'              => 'help_publish_terminal',
            'help_publish_closed'                => 'help_publish_closed',

            'help_targeting_status'              => 'help_targeting_status',
            'help_targeting_pending'             => 'help_targeting_pending',
            'help_targeting_transferred'         => 'help_targeting_transferred',
            'help_targeting_review'              => 'help_targeting_review',
            'help_targeting_levels'              => 'help_targeting_levels',
            'help_targeting_rejected'            => 'help_targeting_rejected',
            'help_post_pending'                 => 'help_post_pending',
            'help_post_transferred'             => 'help_post_transferred',
            'help_post_review'                  => 'help_post_review',
            'help_post_robot_review'            => 'help_post_robot_review',
            'help_post_levels'                  => 'help_post_levels',
            'help_post_rejected'                => 'help_post_rejected',
            'help_similar_headline'             => 'help_similar_headline',
            'help_similar_content'              => 'help_similar_content',
            'help_photo_pending'                => 'help_photo_pending',
            'help_photo_transferred'            => 'help_photo_transferred',
            'help_photo_review'                 => 'help_photo_review',
            'help_photo_levels'                 => 'help_photo_levels',
            'help_photo_rejected'               => 'help_photo_rejected',
            )
        );
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('setting/advertise', 'token=' . $this->session->data['token'], 'SSL')
        );

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['action'] = $this->url->link('setting/advertise', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->post['ad_checkout_id'])) {
            $data['ad_checkout_id'] = $this->request->post['ad_checkout_id'];
        } else {
            $data['ad_checkout_id'] = $this->config->get('ad_checkout_id');
        }
        if (isset($this->request->post['ad_priority_id'])) {
            $data['ad_priority_id'] = $this->request->post['ad_priority_id'];
        } else {
            $data['ad_priority_id'] = $this->config->get('ad_priority_id');
        }
// publish
        if (isset($this->request->post['ad_publish_queue'])) {
            $data['ad_publish_queue'] = $this->request->post['ad_publish_queue'];
        } else if ($this->config->get('ad_publish_queue') !== null) {
            $data['ad_publish_queue'] = $this->config->get('ad_publish_queue');
        } else {
            $data['ad_publish_queue'] = 1;
        }

        if (isset($this->request->post['ad_publish_indesign'])) {
            $data['ad_publish_indesign'] = $this->request->post['ad_publish_indesign'];
        } else if ($this->config->get('ad_publish_indesign') !== null) {
            $data['ad_publish_indesign'] = $this->config->get('ad_publish_indesign');
        } else {
            $data['ad_publish_indesign'] = '';
        }

        if (isset($this->request->post['ad_publish_waiting'])) {
            $data['ad_publish_waiting'] = $this->request->post['ad_publish_waiting'];
        } else if ($this->config->get('ad_publish_waiting') !== null) {
            $data['ad_publish_waiting'] = $this->config->get('ad_publish_waiting');
        } else {
            $data['ad_publish_waiting'] = '';
        }

        if (isset($this->request->post['ad_publish_confirmed'])) {
            $data['ad_publish_confirmed'] = $this->request->post['ad_publish_confirmed'];
        } else if ($this->config->get('ad_publish_confirmed') !== null) {
            $data['ad_publish_confirmed'] = $this->config->get('ad_publish_confirmed');
        } else {
            $data['ad_publish_confirmed'] = '';
        }
        if (isset($this->request->post['ad_publish_opening'])) {
            $data['ad_publish_opening'] = $this->request->post['ad_publish_opening'];
        } else if ($this->config->get('ad_publish_opening') !== null) {
            $data['ad_publish_opening'] = $this->config->get('ad_publish_opening');
        } else {
            $data['ad_publish_opening'] = '';
        }
        if (isset($this->request->post['ad_publish_success'])) {
            $data['ad_publish_success'] = $this->request->post['ad_publish_success'];
        } else if ($this->config->get('ad_publish_success') !== null) {
            $data['ad_publish_success'] = $this->config->get('ad_publish_success');
        } else {
            $data['ad_publish_success'] = '';
        }

        if (isset($this->request->post['ad_publish_deliveried'])) {
            $data['ad_publish_deliveried'] = $this->request->post['ad_publish_deliveried'];
        } else if ($this->config->get('ad_publish_deliveried') !== null) {
            $data['ad_publish_deliveried'] = $this->config->get('ad_publish_deliveried');
        } else {
            $data['ad_publish_deliveried'] = '';
        }

        if (isset($this->request->post['ad_publish_failed'])) {
            $data['ad_publish_failed'] = $this->request->post['ad_publish_failed'];
        } else if ($this->config->get('ad_publish_failed') !== null) {
            $data['ad_publish_failed'] = $this->config->get('ad_publish_failed');
        } else {
            $data['ad_publish_failed'] = '';
        }

        if (isset($this->request->post['ad_publish_terminal'])) {
            $data['ad_publish_terminal'] = $this->request->post['ad_publish_terminal'];
        } else if ($this->config->get('ad_publish_terminal') !== null) {
            $data['ad_publish_terminal'] = $this->config->get('ad_publish_terminal');
        } else {
            $data['ad_publish_terminal'] = '';
        }
        if (isset($this->request->post['ad_publish_closed'])) {
            $data['ad_publish_closed'] = $this->request->post['ad_publish_closed'];
        } else if ($this->config->get('ad_publish_closed') !== null) {
            $data['ad_publish_closed'] = $this->config->get('ad_publish_closed');
        } else {
            $data['ad_publish_closed'] = '';
        }

// targeting

        //status for operator
        if (isset($this->request->post['ad_targeting_pending'])) {
            $data['ad_targeting_pending'] = $this->request->post['ad_targeting_pending'];
        } else if ($this->config->get('ad_targeting_pending') !== null) {
            $data['ad_targeting_pending'] = $this->config->get('ad_targeting_pending');
        } else {
            $data['ad_targeting_pending'] = '';
        }
        if (isset($this->request->post['ad_targeting_transferred'])) {
            $data['ad_targeting_transferred'] = $this->request->post['ad_targeting_transferred'];
        } else if ($this->config->get('ad_targeting_transferred') !== null) {
            $data['ad_targeting_transferred'] = $this->config->get('ad_targeting_transferred');
        } else {
            $data['ad_targeting_transferred'] = '';
        }

        if (isset($this->request->post['ad_targeting_review'])) {
            $data['ad_targeting_review'] = $this->request->post['ad_targeting_review'];
        } else if ($this->config->get('ad_targeting_review') !== null) {
            $data['ad_targeting_review'] = $this->config->get('ad_targeting_review');
        } else {
            $data['ad_targeting_review'] = '';
        }

        if (isset($this->request->post['ad_targeting_levels'])) {
            $data['ad_targeting_levels'] = $this->request->post['ad_targeting_levels'];
        } else if ($this->config->get('ad_targeting_levels') !== null) {
            $data['ad_targeting_levels'] = $this->config->get('ad_targeting_levels');
        } else {
            $data['ad_targeting_levels'] = array();
        }

        if (isset($this->request->post['ad_targeting_rejected'])) {
            $data['ad_targeting_rejected'] = $this->request->post['ad_targeting_rejected'];
        } else if ($this->config->get('ad_targeting_rejected') !== null) {
            $data['ad_targeting_rejected'] = $this->config->get('ad_targeting_rejected');
        } else {
            $data['ad_targeting_rejected'] = '';
        }

//Photo

        // status for operator
        if (isset($this->request->post['ad_photo_pending'])) {
            $data['ad_photo_pending'] = $this->request->post['ad_photo_pending'];
        } else if ($this->config->get('ad_photo_pending') !== null) {
            $data['ad_photo_pending'] = $this->config->get('ad_photo_pending');
        } else {
            $data['ad_photo_pending'] = '';
        }

        if (isset($this->request->post['ad_post_transferred'])) {
            $data['ad_post_transferred'] = $this->request->post['ad_post_transferred'];
        } else if ($this->config->get('ad_post_transferred') !== null) {
            $data['ad_post_transferred'] = $this->config->get('ad_post_transferred');
        } else {
            $data['ad_post_transferred'] = '';
        }

        if (isset($this->request->post['ad_photo_review'])) {
            $data['ad_photo_review'] = $this->request->post['ad_photo_review'];
        } else if ($this->config->get('ad_photo_review') !== null) {
            $data['ad_photo_review'] = $this->config->get('ad_photo_review');
        } else {
            $data['ad_photo_review'] = '';
        }

        if (isset($this->request->post['ad_photo_levels'])) {
            $data['ad_photo_levels'] = $this->request->post['ad_photo_levels'];
        } else if ($this->config->get('ad_photo_levels') !== null) {
            $data['ad_photo_levels'] = $this->config->get('ad_photo_levels');
        } else {
            $data['ad_photo_levels'] = array();
        }

        if (isset($this->request->post['ad_photo_rejected'])) {
            $data['ad_photo_rejected'] = $this->request->post['ad_photo_rejected'];
        } else if ($this->config->get('ad_photo_rejected') !== null) {
            $data['ad_photo_rejected'] = $this->config->get('ad_photo_rejected');
        } else {
            $data['ad_photo_rejected'] = '';
        }

//Post
        if (isset($this->request->post['ad_post_pending'])) {
            $data['ad_post_pending'] = $this->request->post['ad_post_pending'];
        } else if ($this->config->get('ad_post_pending') !== null) {
            $data['ad_post_pending'] = $this->config->get('ad_post_pending');
        } else {
            $data['ad_post_pending'] = '';
        }
        if (isset($this->request->post['ad_photo_transferred'])) {
            $data['ad_photo_transferred'] = $this->request->post['ad_photo_transferred'];
        } else if ($this->config->get('ad_photo_transferred') !== null) {
            $data['ad_photo_transferred'] = $this->config->get('ad_photo_transferred');
        } else {
            $data['ad_photo_transferred'] = '';
        }
        if (isset($this->request->post['ad_post_robot_review'])) {
            $data['ad_post_robot_review'] = $this->request->post['ad_post_robot_review'];
        } else if ($this->config->get('ad_post_robot_review') !== null) {
            $data['ad_post_robot_review'] = $this->config->get('ad_post_robot_review');
        } else {
            $data['ad_post_robot_review'] = '';
        }
        if (isset($this->request->post['ad_post_review'])) {
            $data['ad_post_review'] = $this->request->post['ad_post_review'];
        } else if ($this->config->get('ad_post_review') !== null) {
            $data['ad_post_review'] = $this->config->get('ad_post_review');
        } else {
            $data['ad_post_review'] = '';
        }

        if (isset($this->request->post['ad_post_levels'])) {
            $data['ad_post_levels'] = $this->request->post['ad_post_levels'];
        } else if ($this->config->get('ad_post_levels') !== null) {
            $data['ad_post_levels'] = $this->config->get('ad_post_levels');
        } else {
            $data['ad_post_levels'] = array();
        }

        if (isset($this->request->post['ad_post_rejected'])) {
            $data['ad_post_rejected'] = $this->request->post['ad_post_rejected'];
        } else if ($this->config->get('ad_post_rejected') !== null) {
            $data['ad_post_rejected'] = $this->config->get('ad_post_rejected');
        } else {
            $data['ad_post_rejected'] = '';
        }
        if (isset($this->request->post['ad_similar_content'])) {
            $data['ad_similar_content'] = $this->request->post['ad_similar_content'];
        } else if ($this->config->get('ad_similar_content') !== null) {
            $data['ad_similar_content'] = $this->config->get('ad_similar_content');
        } else {
            $data['ad_similar_content'] = '';
        }
        if (isset($this->request->post['ad_similar_headline'])) {
            $data['ad_similar_headline'] = $this->request->post['ad_similar_headline'];
        } else if ($this->config->get('ad_similar_headline') !== null) {
            $data['ad_similar_headline'] = $this->config->get('ad_similar_headline');
        } else {
            $data['ad_similar_headline'] = '';
        }
//data
        $this->load->model('catalog/information');
        $data['informations'] = $this->model_catalog_information->getInformations();

        $this->load->model('localisation/advertise_targeting');
        $data['targeting_statuses'] = $this->model_localisation_advertise_targeting->getAdvertiseTargetings();

        $this->load->model('localisation/advertise_publish');
        $data['ad_publishes'] = $this->model_localisation_advertise_publish->getAdvertisePublishes();

        $this->load->model('localisation/advertise_post');
        $data['post_statuses'] = $this->model_localisation_advertise_post->getAdvertisePosts();   

        $this->load->model('localisation/advertise_photo');
        $data['photo_statuses'] = $this->model_localisation_advertise_photo->getAdvertisePhotos();

        $this->load->model('localisation/priority');
        $data['priorities'] = $this->model_localisation_priority->getPriorities();

        $this->response->setOutput($this->load->view('setting/advertise.tpl', $data,true));
    }

    public function save(){
        $this->language->load('setting/advertise');

        $this->load->model('setting/setting');
        if(isset($this->request->post['name']))
            $this->model_setting_setting->editItemValue($this->request->post['name'],$this->request->post['value'],'ad');
    }
    protected function validate() {
        if (!$this->user->hasPermission('setting/advertise/index')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

}