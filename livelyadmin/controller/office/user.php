<?php
class ControllerOfficeUser extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('office/user');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/user');

        $this->getList();
    }

    public function add() {
        $this->load->language('office/user');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/user');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('office/user/add')) {
            $this->model_office_user->addUser($this->request->post);

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

            $this->response->redirect($this->url->link('office/user', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('office/user');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/user');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('office/user/edit')) {
            $this->model_office_user->editUser($this->request->get['office_id'], $this->request->post);

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

            $this->response->redirect($this->url->link('office/user', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('office/user');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/user');

        if (isset($this->request->post['selected']) && $this->validateDelete('office/user/delete')) {
            foreach ($this->request->post['selected'] as $office_id) {
                $this->model_office_user->deleteUser($office_id);
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

            $this->response->redirect($this->url->link('office/user', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'office_id';
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
            'href' => $this->url->link('office/user', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('office/user/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('office/user/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['users'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $user_total = $this->model_office_user->getTotalUsers();

        $results = $this->model_office_user->getUsers($filter_data);

        foreach ($results as $result) {
            $data['users'][] = array(
                'office_id'     => $result['office_id'],
                'office_name'   => $result['office_name'],
                'nickname'      => $result['nickname'],
                'qq'            => $result['qq'],
                'handphone'     => $result['handphone'],
                'status'        => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                'date_added'    => date('Y-m-d H:i', strtotime($result['date_added'])),
                'edit'          => $this->url->link('office/user/edit', 'token=' . $this->session->data['token'] . '&office_id=' . $result['office_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_office_name'] = $this->language->get('column_office_name');
        $data['column_nickname'] = $this->language->get('column_nickname');
        $data['column_qq'] = $this->language->get('column_qq');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_handphone'] = $this->language->get('column_handphone');
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

        $data['sort_office_name'] = $this->url->link('office/user', 'token=' . $this->session->data['token'] . '&sort=office_name' . $url, 'SSL');
        $data['sort_handphone'] = $this->url->link('office/user', 'token=' . $this->session->data['token'] . '&sort=handphone' . $url, 'SSL');
        $data['sort_nickname'] = $this->url->link('office/user', 'token=' . $this->session->data['token'] . '&sort=nickname' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('office/user', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('office/user', 'token=' . $this->session->data['token'] . '&sort=date_added' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $user_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('office/user', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($user_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($user_total - $this->config->get('config_limit_admin'))) ? $user_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $user_total, ceil($user_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('office/user_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_form'] = !isset($this->request->get['office_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['entry_office_name'] = $this->language->get('entry_office_name');
        $data['entry_office_group'] = $this->language->get('entry_office_group');
        $data['entry_password'] = $this->language->get('entry_password');
        $data['entry_confirm'] = $this->language->get('entry_confirm');
        $data['entry_nickname'] = $this->language->get('entry_nickname');
        $data['entry_qq'] = $this->language->get('entry_qq');
        $data['entry_handphone'] = $this->language->get('entry_handphone');
        
        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['office_name'])) {
            $data['error_office_name'] = $this->error['office_name'];
        } else {
            $data['error_office_name'] = '';
        }

        if (isset($this->error['password'])) {
            $data['error_password'] = $this->error['password'];
        } else {
            $data['error_password'] = '';
        }

        if (isset($this->error['confirm'])) {
            $data['error_confirm'] = $this->error['confirm'];
        } else {
            $data['error_confirm'] = '';
        }

        if (isset($this->error['nickname'])) {
            $data['error_nickname'] = $this->error['nickname'];
        } else {
            $data['error_nickname'] = '';
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
            'href' => $this->url->link('office/user', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['office_id'])) {
            $data['action'] = $this->url->link('office/user/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('office/user/edit', 'token=' . $this->session->data['token'] . '&office_id=' . $this->request->get['office_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('office/user', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['office_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $office = $this->model_office_user->getUser($this->request->get['office_id']);
        }

        if (isset($this->request->post['office_name'])) {
            $data['office_name'] = $this->request->post['office_name'];
        } elseif (!empty($office)) {
            $data['office_name'] = $office['office_name'];
        } else {
            $data['office_name'] = '';
        }
        if (isset($this->request->post['office_group_id'])) {
            $data['office_group_id'] = $this->request->post['office_group_id'];
        } elseif (!empty($office['office_group_id'])) {
            $data['office_group_id'] = $office['office_group_id'];
        } else {
            $data['office_group_id'] = '';
        }
        
        if (isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        } else {
            $data['password'] = '';
        }

        if (isset($this->request->post['confirm'])) {
            $data['confirm'] = $this->request->post['confirm'];
        } else {
            $data['confirm'] = '';
        }

        if (isset($this->request->post['nickname'])) {
            $data['nickname'] = $this->request->post['nickname'];
        } elseif (!empty($office['nickname'])) {
            $data['nickname'] = $office['nickname'];
        } else {
            $data['nickname'] = '';
        }

        if (isset($this->request->post['qq'])) {
            $data['qq'] = $this->request->post['qq'];
        } elseif (!empty($office['qq'])) {
            $data['qq'] = $office['qq'];
        } else {
            $data['qq'] = '';
        }
        if (isset($this->request->post['handphone'])) {
            $data['handphone'] = $this->request->post['handphone'];
        } elseif (!empty($office['handphone'])) {
            $data['handphone'] = $office['handphone'];
        } else {
            $data['handphone'] = '';
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($office)) {
            $data['status'] = $office['status'];
        } else {
            $data['status'] = 0;
        }
        $data['office_group_ids']=array(1,2,3,4);
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('office/user_form.tpl', $data));
    }

    protected function validateForm($route) {
        if (!$this->user->hasPermission($route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['office_name']) < 3) || (utf8_strlen($this->request->post['office_name']) > 20)) {
            $this->error['office_name'] = $this->language->get('error_office_name');
        }

        $office = $this->model_office_user->getUserByOfficename($this->request->post['office_name']);

        if (!isset($this->request->get['office_id'])) {
            if ($office) {
                $this->error['office_name'] = $this->language->get('error_exists');
            }
        } else {
            if ($office && ($this->request->get['office_id'] != $office['office_id'])) {
                $this->error['office_name'] = $this->language->get('error_exists');
            }
        }


        if ($this->request->post['password'] || (!isset($this->request->get['office_id']))) {
            if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
                $this->error['password'] = $this->language->get('error_password');
            }

            if ($this->request->post['password'] != $this->request->post['confirm']) {
                $this->error['confirm'] = $this->language->get('error_confirm');
            }
        }

        return !$this->error;
    }

    protected function validateDelete($route) {
        if (!$this->user->hasPermission($route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}