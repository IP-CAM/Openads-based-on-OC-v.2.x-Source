<?php
class ControllerOfficeMonitor extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('office/monitor');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/monitor');

        $this->getList();
    }

    public function add() {
        $this->load->language('office/monitor');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/monitor');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_office_monitor->addMonitor($this->request->post);

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

            $this->response->redirect($this->url->link('office/monitor', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('office/monitor');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/monitor');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_office_monitor->editMonitor($this->request->get['monitor_id'], $this->request->post);

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

            $this->response->redirect($this->url->link('office/monitor', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('office/monitor');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/monitor');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $monitor_id) {
                $this->model_office_monitor->deleteMonitor($monitor_id);
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

            $this->response->redirect($this->url->link('office/monitor', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['filter_date_start'])) {
            $filter_date_start = $this->request->get['filter_date_start'];
        } else {
            $filter_date_start = null;
        }
        if (isset($this->request->get['filter_date_end'])) {
            $filter_date_end = $this->request->get['filter_date_end'];
        } else {
            $filter_date_end = null;
        }
        if (isset($this->request->get['filter_time'])) {
            $filter_time = $this->request->get['filter_time'];
        } else {
            $filter_time = null;
        }

        if (isset($this->request->get['filter_office'])) {
            $filter_office = $this->request->get['filter_office'];
        } else {
            $filter_office = null;
        }

        if (isset($this->request->get['filter_user'])) {
            $filter_user = $this->request->get['filter_user'];
        } else {
            $filter_user = null;
        }

        if (isset($this->request->get['filter_confirm'])) {
            $filter_confirm = $this->request->get['filter_confirm'];
        } else {
            $filter_confirm = null;
        }

        if (isset($this->request->get['filter_hours'])) {
            $filter_hours = $this->request->get['filter_hours'];
        } else {
            $filter_hours = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'time_name';
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
        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . urlencode(html_entity_decode($this->request->get['filter_date_start'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . urlencode(html_entity_decode($this->request->get['filter_date_end'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_time'])) {
            $url .= '&filter_time=' . $this->request->get['filter_time'];
        }
        if (isset($this->request->get['filter_office'])) {
            $url .= '&filter_office=' . $this->request->get['filter_office'];
        }

        if (isset($this->request->get['filter_user'])) {
            $url .= '&filter_user=' . $this->request->get['filter_user'];
        }

        if (isset($this->request->get['filter_confirm'])) {
            $url .= '&filter_confirm=' . $this->request->get['filter_confirm'];
        }

        if (isset($this->request->get['filter_hours'])) {
            $url .= '&filter_hours=' . $this->request->get['filter_hours'];
        }
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
            'href' => $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('office/monitor/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('office/monitor/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $filter_data = array(
            'filter_date_start'   => $filter_date_start,
            'filter_date_end'   => $filter_date_end,
            'filter_time'   => $filter_time,
            'filter_office' => $filter_office,
            'filter_user'   => $filter_user,
            'filter_confirm'=> $filter_confirm,
            'filter_hours'  => $filter_hours,
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );
        $data['monitors'] = array();
        $total = $this->model_office_monitor->getTotalMonitors($filter_data);

        $results = $this->model_office_monitor->getMonitors($filter_data);

        foreach ($results as $result) {
            $data['monitors'][] = array(
                'monitor_id'    => $result['monitor_id'],
                'date'          => $result['date'] ,
                'time_name'     => $result['time_name'] ,
                'price'         => $result['price'] ,
                'office'        => $result['office'],
                'user'          => $result['user'],
                'work_hours'    => $result['work_hours'],
                'amount'        => (float)$result['amount'],
                'confirm'       => $result['confirm'] ? $this->language->get('text_yes') : $this->language->get('text_no'),
                'edit'          => $this->url->link('office/monitor/edit', 'token=' . $this->session->data['token'] . '&monitor_id=' . $result['monitor_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['column_date'] = $this->language->get('column_date');
        $data['column_time'] = $this->language->get('column_time');
        $data['column_office'] = $this->language->get('column_office');
        $data['column_user'] = $this->language->get('column_user');
        $data['column_confirm'] = $this->language->get('column_confirm');
        $data['column_hours'] = $this->language->get('column_hours');
        $data['column_amount'] = $this->language->get('column_amount');
        $data['column_action'] = $this->language->get('column_action');
        $data['entry_date_start'] = $this->language->get('entry_date_start');
        $data['entry_date_end'] = $this->language->get('entry_date_end');
        $data['entry_time'] = $this->language->get('entry_time');
        $data['entry_office'] = $this->language->get('entry_office');
        $data['entry_user'] = $this->language->get('entry_user');
        $data['entry_confirm'] = $this->language->get('entry_confirm');
        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');

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
        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . urlencode(html_entity_decode($this->request->get['filter_date_start'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . urlencode(html_entity_decode($this->request->get['filter_date_end'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_time'])) {
            $url .= '&filter_time=' . $this->request->get['filter_time'];
        }
        if (isset($this->request->get['filter_office'])) {
            $url .= '&filter_office=' . $this->request->get['filter_office'];
        }

        if (isset($this->request->get['filter_user'])) {
            $url .= '&filter_user=' . $this->request->get['filter_user'];
        }

        if (isset($this->request->get['filter_confirm'])) {
            $url .= '&filter_confirm=' . $this->request->get['filter_confirm'];
        }

        if (isset($this->request->get['filter_hours'])) {
            $url .= '&filter_hours=' . $this->request->get['filter_hours'];
        }
        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_time_name'] = $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . '&sort=om.time_name' . $url, 'SSL');
        $data['sort_date'] = $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . '&sort=om.date' . $url, 'SSL');
        $data['sort_office'] = $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . '&sort=om.office_id' . $url, 'SSL');
        $data['sort_user'] = $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . '&sort=om.user_id' . $url, 'SSL');
        $data['sort_confirm'] = $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . '&sort=om.confirm' . $url, 'SSL');
        $data['sort_hours'] = $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . '&sort=om.work_hours' . $url, 'SSL');
        $data['sort_amount'] = $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . '&sort=amount' . $url, 'SSL');

        $url = '';
        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . urlencode(html_entity_decode($this->request->get['filter_date_start'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . urlencode(html_entity_decode($this->request->get['filter_date_end'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_time'])) {
            $url .= '&filter_time=' . $this->request->get['filter_time'];
        }
        if (isset($this->request->get['filter_office'])) {
            $url .= '&filter_office=' . $this->request->get['filter_office'];
        }

        if (isset($this->request->get['filter_user'])) {
            $url .= '&filter_user=' . $this->request->get['filter_user'];
        }

        if (isset($this->request->get['filter_confirm'])) {
            $url .= '&filter_confirm=' . $this->request->get['filter_confirm'];
        }

        if (isset($this->request->get['filter_hours'])) {
            $url .= '&filter_hours=' . $this->request->get['filter_hours'];
        }
        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));

        $data['token'] = $this->session->data['token'];
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $data['filter_time'] = $filter_time;
        $data['filter_office'] = $filter_office;
        $data['filter_user'] = $filter_user;
        $data['filter_confirm'] = $filter_confirm;
        $data['filter_hours'] = $filter_hours;
        $this->load->model('office/time');
        $data['times'] = $this->model_office_time->getTimes();
        $this->load->model('office/user');
        $data['offices'] = $this->model_office_user->getUsers();
        $this->load->model('user/user');
        $data['users'] = $this->model_user_user->getUsers();
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('office/monitor_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['monitor_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['entry_date'] = $this->language->get('entry_date');
        $data['entry_time'] = $this->language->get('entry_time');
        $data['entry_office'] = $this->language->get('entry_office');
        $data['entry_hours'] = $this->language->get('entry_hours');
        $data['entry_confirm'] = $this->language->get('entry_confirm');
        $data['entry_price'] = $this->language->get('entry_price');
        $data['entry_note'] = $this->language->get('entry_note');
        $data['entry_work_content_a'] = $this->language->get('entry_work_content_a');
        $data['entry_work_content_b'] = $this->language->get('entry_work_content_b');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->error['date'])) {
            $data['error_date'] = $this->error['date'];
        } else {
            $data['error_date'] = '';
        }
        if (isset($this->error['time_name'])) {
            $data['error_time_name'] = $this->error['time_name'];
        } else {
            $data['error_time_name'] = '';
        }

        if (isset($this->error['price'])) {
            $data['error_price'] = $this->error['price'];
        } else {
            $data['error_price'] = '';
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
            'href' => $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['monitor_id'])) {
            $data['action'] = $this->url->link('office/monitor/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('office/monitor/edit', 'token=' . $this->session->data['token'] . '&monitor_id=' . $this->request->get['monitor_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('office/monitor', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['monitor_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $time_info = $this->model_office_monitor->getMonitor($this->request->get['monitor_id']);
        }

        if (isset($this->request->post['date'])) {
            $data['date'] = $this->request->post['date'];
        } elseif (!empty($time_info['date'])) {
            $data['date'] = $time_info['date'];
        } else {
            $data['date'] = date('Y-m-d');
        }

        if (isset($this->request->post['time_name'])) {
            $data['time_name'] = $this->request->post['time_name'];
        } elseif (!empty($time_info['time_name'])) {
            $data['time_name'] = $time_info['time_name'];
        } else {
            $data['time_name'] = '';
        }

        if (isset($this->request->post['price'])) {
            $data['price'] = $this->request->post['price'];
        } elseif (!empty($time_info['price'])) {
            $data['price'] = $time_info['price'];
        } else {
            $data['price'] = '';
        }
        $nl = array("\\r\\n","\\n","\\r");
        $replace = "<br/>";
        if (isset($this->request->post['work_content_a'])) {
            $data['work_content_a'] = $this->request->post['work_content_a'];
        } elseif (!empty($time_info['work_content_a'])) {
            $data['work_content_a'] = str_replace($nl,$replace,$time_info['work_content_a']);
        } else {
            $data['work_content_a'] = '';
        }
        if (isset($this->request->post['work_content_b'])) {
            $data['work_content_b'] = $this->request->post['work_content_b'];
        } elseif (!empty($time_info['work_content_b'])) {
            $data['work_content_b'] = str_replace($nl,$replace,$time_info['work_content_b']);
        } else {
            $data['work_content_b'] = '';
        }

        if (isset($this->request->post['work_hours'])) {
            $data['work_hours'] = $this->request->post['work_hours'];
        } elseif (!empty($time_info['work_hours'])) {
            $data['work_hours'] = $time_info['work_hours'];
        } else {
            $data['work_hours'] = 0;
        }

        if (isset($this->request->post['confirm'])) {
            $data['confirm'] = $this->request->post['confirm'];
        } elseif (!empty($time_info['confirm'])) {
            $data['confirm'] = $time_info['confirm'];
        } else {
            $data['confirm'] = 0;
        }

        if (isset($this->request->post['note'])) {
            $data['note'] = $this->request->post['note'];
        } elseif (isset($time_info['note'])) {
            $data['note'] = $time_info['note'];
        } else {
            $data['note'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('office/monitor_form.tpl', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'office/monitor')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['time_name']) < 3) || (utf8_strlen($this->request->post['time_name']) > 128)) {
            $this->error['time_name'] = $this->language->get('error_time_name');
        }

        if ((int)$this->request->post['price'] <= 0) {
            $this->error['price'] = $this->language->get('error_price');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'office/monitor')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

}