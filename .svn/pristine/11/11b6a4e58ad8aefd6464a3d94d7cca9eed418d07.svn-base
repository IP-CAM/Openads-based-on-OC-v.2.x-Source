<?php
class ControllerSnsOption extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('sns/option');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sns/option');

        $this->getList();
    }

    public function add() {
        $this->load->language('sns/option');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sns/option');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sns_option->addOption($this->request->post);

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

            $this->response->redirect($this->url->link('sns/option', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('sns/option');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sns/option');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('edit')) {

            $this->model_sns_option->editOption($this->request->get['option_id'], $this->request->post);

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

            $this->response->redirect($this->url->link('sns/option', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('sns/option');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sns/option');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $option_id) {
                $this->model_sns_option->deleteOption($option_id);
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

            $this->response->redirect($this->url->link('sns/option', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.type';
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
            'href' => $this->url->link('sns/option', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('sns/option/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('sns/option/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['options'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $product_total = $this->model_sns_option->getTotalOptions();

        $results = $this->model_sns_option->getOptions($filter_data);

        foreach ($results as $result) {
            $data['options'][] = array(
                'option_id'	=> $result['option_id'],
                'name'      => $result['name'],
                'value'     => $result['value'],
                'status'    => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'sort'      => $result['sort'],
                'default'  	=> $result['default'],
            	'type'  	=> $result['type'],
                'edit'      => $this->url->link('sns/option/edit', 'token=' . $this->session->data['token'] . '&option_id=' . $result['option_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_name'] = $this->language->get('column_name');
        $data['column_value'] = $this->language->get('column_value');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_default'] = $this->language->get('column_default');
        $data['column_sort'] = $this->language->get('column_sort');
        $data['column_type'] = $this->language->get('column_type');
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

        $data['sort_name'] = $this->url->link('sns/option', 'token=' . $this->session->data['token'] . '&sort=p.name' . $url, 'SSL');
        $data['sort_value'] = $this->url->link('sns/option', 'token=' . $this->session->data['token'] . '&sort=p.value' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('sns/option', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
        $data['sort_sort'] = $this->url->link('sns/option', 'token=' . $this->session->data['token'] . '&sort=p.sort' . $url, 'SSL');
        $data['sort_type'] = $this->url->link('sns/option', 'token=' . $this->session->data['token'] . '&sort=p.type' . $url, 'SSL');
        $data['sort_default'] = $this->url->link('sns/option', 'token=' . $this->session->data['token'] . '&sort=p.default' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $product_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('sns/option', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sns/option_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['option_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_value'] = $this->language->get('entry_value');
        $data['entry_type'] = $this->language->get('entry_type');
        $data['entry_sort'] = $this->language->get('entry_sort');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_default'] = $this->language->get('entry_default');

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

        if (isset($this->error['value'])) {
            $data['error_value'] = $this->error['value'];
        } else {
            $data['error_value'] = '';
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
            'href' => $this->url->link('sns/option', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['option_id'])) {
            $data['action'] = $this->url->link('sns/option/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('sns/option/edit', 'token=' . $this->session->data['token'] . '&option_id=' . $this->request->get['option_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('sns/option', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['option_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $product_info = $this->model_sns_option->getOption($this->request->get['option_id']);
        }

        $data['token'] = $this->session->data['token'];
        
        if (isset($this->request->post['name'])) {
        	$data['name'] = $this->request->post['name'];
        } elseif (!empty($product_info['name'])) {
        	$data['name'] = $product_info['name'];
        } else {
        	$data['name'] = '';
        }
        
        if (isset($this->request->post['value'])) {
        	$data['value'] = $this->request->post['value'];
        } elseif (!empty($product_info['value'])) {
        	$data['value'] = $product_info['value'];
        } else {
        	$data['value'] = '';
        }
        
        if (isset($this->request->post['type'])) {
            $data['type'] = $this->request->post['type'];
        } elseif (!empty($product_info['type'])) {
            $data['type'] = $product_info['type'];
        } else {
            $data['type'] = 'country';
        }


        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($product_info['status'])) {
            $data['status'] = $product_info['status'];
        } else {
            $data['status'] = true;
        }

        if (isset($this->request->post['sort'])) {
            $data['sort'] = $this->request->post['sort'];
        } elseif (!empty($product_info['sort'])) {
            $data['sort'] = $product_info['sort'];
        } else {
            $data['sort'] = 1;
        }

        if (isset($this->request->post['default'])) {
        	$data['default'] = $this->request->post['default'];
        } elseif (!empty($product_info['default'])) {
        	$data['default'] = $product_info['default'];
        } else {
        	$data['default'] = 1;
        }
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sns/option_form.tpl', $data));
    }

    protected function validateForm($action='add') {
        if (!$this->user->hasPermission('sns/option/'.$action)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
    	if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 8)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if ((utf8_strlen($this->request->post['value']) < 1) || (utf8_strlen($this->request->post['value']) > 8)) {
            $this->error['value'] = $this->language->get('error_value');
        }
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('sns/option/delete')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}