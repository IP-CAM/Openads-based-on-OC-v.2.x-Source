<?php
class ControllerLocalisationTargeting extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('localisation/targeting');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/targeting');

        $this->getList();
    }

    public function add() {
        $this->load->language('localisation/targeting');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/targeting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('localisation/targeting/add')) {
            $this->model_localisation_targeting->addTargeting($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('localisation/targeting');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/targeting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('localisation/targeting/edit')) {
            $this->model_localisation_targeting->editTargeting($this->request->get['targeting_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('localisation/targeting');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/targeting');

        if (isset($this->request->post['selected']) && $this->validateDelete('localisation/targeting/delete')) {
            foreach ($this->request->post['selected'] as $targeting_id) {
                $this->model_localisation_targeting->deleteTargeting($targeting_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 't.targeting_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

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
            'href' => $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        
        $data['add'] = $this->url->link('localisation/targeting/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('localisation/targeting/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['targetings'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $targeting_total = $this->model_localisation_targeting->getTotalTargetings();

        $results = $this->model_localisation_targeting->getTargetings($filter_data);

        foreach ($results as $result) {
            $data['targetings'][] = array(
                'targeting_id'  => $result['targeting_id'],
                'category'      => ucfirst($result['category']),
                'name'          => $result['name'] ,
                'value'         => $result['value'] ,
                'default'       => $result['default'] ? $this->language->get('text_yes') : $this->language->get('text_no'),
                'status'        => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'operator'      => $result['lastname'].$result['firstname'],
                'date_added'    => date('Y-m-d H:i:s',strtotime($result['date_added'])),
                'edit'          => $this->url->link('localisation/targeting/edit', 'token=' . $this->session->data['token'] . '&targeting_id=' . $result['targeting_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['column_category'] = $this->language->get('column_category');
        $data['column_name'] = $this->language->get('column_name');
        $data['column_value'] = $this->language->get('column_value');
        $data['column_default'] = $this->language->get('column_default');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_operator'] = $this->language->get('column_operator');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['sort_category'] = $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . '&sort=t.category' . $url, 'SSL');
        $data['sort_name'] = $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . '&sort=t.name' . $url, 'SSL');
        $data['sort_value'] = $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . '&sort=t.value' . $url, 'SSL');
        $data['sort_default'] = $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . '&sort=t.default' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . '&sort=t.status' . $url, 'SSL');
        $data['sort_user_id'] = $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . '&sort=t.user_id' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . '&sort=t.date_added' . $url, 'SSL');
        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $targeting_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($targeting_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($targeting_total - $this->config->get('config_limit_admin'))) ? $targeting_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $targeting_total, ceil($targeting_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('localisation/targeting_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_form'] = !isset($this->request->get['targeting_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_location'] = $this->language->get('text_location');
        $data['text_gender'] = $this->language->get('text_gender');
        $data['text_language'] = $this->language->get('text_language');
        $data['text_product'] = $this->language->get('text_product');
        $data['entry_category'] = $this->language->get('entry_category');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_value'] = $this->language->get('entry_value');
        $data['entry_default'] = $this->language->get('entry_default');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort'] = $this->language->get('entry_sort');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

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

        $url = '';

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
            'href' => $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        
        if (!isset($this->request->get['targeting_id'])) {
            $data['action'] = $this->url->link('localisation/targeting/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('localisation/targeting/edit', 'token=' . $this->session->data['token'] . '&targeting_id=' . $this->request->get['targeting_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('localisation/targeting', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['targeting_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $targeting_info = $this->model_localisation_targeting->getTargeting($this->request->get['targeting_id']);
        }

        if (isset($this->request->post['category'])) {
            $data['category'] = $this->request->post['category'];
        } elseif (!empty($targeting_info['category'])) {
            $data['category'] = $targeting_info['category'];
        } else {
            $data['category'] = 'location';
        }

        if (isset($this->request->post['description'])) {
            $data['description'] = $this->request->post['description'];
        } elseif (isset($this->request->get['targeting_id'])) {
            $data['description'] = $this->model_localisation_targeting->getTargetingDescriptions($this->request->get['targeting_id']);
        } else {
            $data['description'] = array();
        }

        if (isset($this->request->post['value'])) {
            $data['value'] = $this->request->post['value'];
        } elseif (!empty($targeting_info['value'])) {
            $data['value'] = $targeting_info['value'];
        } else {
            $data['value'] = '';
        }

        if (isset($this->request->post['default'])) {
            $data['default'] = $this->request->post['default'];
        } elseif (!empty($targeting_info['default'])) {
            $data['default'] = $targeting_info['default'];
        } else {
            $data['default'] = 0;
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (isset($targeting_info['status'])) {
            $data['status'] = $targeting_info['status'];
        } else {
            $data['status'] = 1;
        }

        if (isset($this->request->post['sort'])) {
            $data['sort'] = $this->request->post['sort'];
        } elseif (!empty($targeting_info['sort'])) {
            $data['sort'] = $targeting_info['sort'];
        } else {
            $data['sort'] = 1;
        }
        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('localisation/targeting_form.tpl', $data));
    }

    protected function validateForm($route) {
        if (!$this->user->hasPermission($route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['description'] as $language_id => $value) {
            if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 64)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }
        }

        return !$this->error;
    }

    protected function validateDelete($route) {
        if (!$this->user->hasPermission($route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $this->load->model('customer/customer');

        foreach ($this->request->post['selected'] as $targeting_id) {
            if ($this->config->get('config_targeting_id') == $targeting_id) {
                $this->error['warning'] = $this->language->get('error_default');
            }

        }

        return !$this->error;
    }
}