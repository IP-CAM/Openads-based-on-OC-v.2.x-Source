<?php
class ControllerLocalisationPriority extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('localisation/priority');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/priority');

        $this->getList();
    }

    public function add() {
        $this->load->language('localisation/priority');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/priority');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('localisation/priority/add')) {
            $this->model_localisation_priority->addPriority($this->request->post);

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

            $this->response->redirect($this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('localisation/priority');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/priority');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('localisation/priority/edit')) {
            $this->model_localisation_priority->editPriority($this->request->get['priority_id'], $this->request->post);

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

            $this->response->redirect($this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('localisation/priority');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/priority');

        if (isset($this->request->post['selected']) && $this->validateDelete('localisation/priority/delete')) {
            foreach ($this->request->post['selected'] as $priority_id) {
                $this->model_localisation_priority->deletePriority($priority_id);
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

            $this->response->redirect($this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.priority_id';
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
            'href' => $this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        
        $data['add'] = $this->url->link('localisation/priority/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('localisation/priority/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['priorities'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $priority_total = $this->model_localisation_priority->getTotalPriorities();

        $results = $this->model_localisation_priority->getPriorities($filter_data);

        foreach ($results as $result) {
            $data['priorities'][] = array(
                'priority_id'   => $result['priority_id'],
                'name'          => $result['name'] ,
                'money'         => $result['money'] ,
                'operator'      => $result['nickname'] ,
                'date_added'    => date('Y-m-d H:i:s',strtotime($result['date_added'])) ,
                'sort'          => $result['sort'] ,
                'edit'          => $this->url->link('localisation/priority/edit', 'token=' . $this->session->data['token'] . '&priority_id=' . $result['priority_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['column_name'] = $this->language->get('column_name');
        $data['column_money'] = $this->language->get('column_money');
        $data['column_sort'] = $this->language->get('column_sort');
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
        $data['sort_name'] = $this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . '&sort=p.name' . $url, 'SSL');
        $data['sort_money'] = $this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . '&sort=p.money' . $url, 'SSL');
        $data['sort_sort'] = $this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . '&sort=p.sort' . $url, 'SSL');
        $data['sort_operator'] = $this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . '&sort=p.user_id' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . '&sort=p.date_added' . $url, 'SSL');
        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $priority_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($priority_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($priority_total - $this->config->get('config_limit_admin'))) ? $priority_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $priority_total, ceil($priority_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('localisation/priority_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_form'] = !isset($this->request->get['priority_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_money'] = $this->language->get('entry_money');
        $data['entry_number'] = $this->language->get('entry_number');
        $data['entry_increment'] = $this->language->get('entry_increment');
        $data['entry_sort'] = $this->language->get('entry_sort');
        $data['entry_note'] = $this->language->get('entry_note');

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
            'href' => $this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        
        if (!isset($this->request->get['priority_id'])) {
            $data['action'] = $this->url->link('localisation/priority/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('localisation/priority/edit', 'token=' . $this->session->data['token'] . '&priority_id=' . $this->request->get['priority_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('localisation/priority', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['priority_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $priority_info = $this->model_localisation_priority->getPriority($this->request->get['priority_id']);
        }

        if (isset($this->request->post['description'])) {
            $data['description'] = $this->request->post['description'];
        } elseif (isset($this->request->get['priority_id'])) {
            $data['description'] = $this->model_localisation_priority->getPriorityDescriptions($this->request->get['priority_id']);
        } else {
            $data['description'] = array();
        }

        if (isset($this->request->post['money'])) {
            $data['money'] = $this->request->post['money'];
        } elseif (!empty($priority_info['money'])) {
            $data['money'] = $priority_info['money'];
        } else {
            $data['money'] = '';
        }

        if (isset($this->request->post['sort'])) {
            $data['sort'] = $this->request->post['sort'];
        } elseif (!empty($priority_info['sort'])) {
            $data['sort'] = $priority_info['sort'];
        } else {
            $data['sort'] = 1;
        }

        if (isset($this->request->post['note'])) {
            $data['note'] = $this->request->post['note'];
        } elseif (!empty($priority_info['note'])) {
            $data['note'] = $priority_info['note'];
        } else {
            $data['note'] = '';
        }
        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('localisation/priority_form.tpl', $data));
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

        return !$this->error;
    }
}