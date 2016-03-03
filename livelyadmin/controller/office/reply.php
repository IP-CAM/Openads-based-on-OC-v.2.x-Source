<?php
class ControllerOfficeReply extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('office/reply');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/reply');

        $this->getList();
    }

    public function add() {
        $this->load->language('office/reply');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/reply');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_office_reply->addReply($this->request->post);

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

            $this->response->redirect($this->url->link('office/reply', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('office/reply');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/reply');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_office_reply->editReply($this->request->get['reply_id'], $this->request->post);

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

            $this->response->redirect($this->url->link('office/reply', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('office/reply');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/reply');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $reply_id) {
                $this->model_office_reply->deleteReply($reply_id);
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

            $this->response->redirect($this->url->link('office/reply', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'o_r.date_added';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
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
            'href' => $this->url->link('office/reply', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('office/reply/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('office/reply/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );
        $data['replies'] = array();
        $total = $this->model_office_reply->getTotalReplies();

        $results = $this->model_office_reply->getReplies($filter_data);
        $nl = array("\\r\\n","\\n","\\r");
        $replace = "<br/>";
        foreach ($results as $result) {
            $data['replies'][] = array(
                'reply_id'    => $result['reply_id'],
                'date'        => $result['date'] ,
                'time'        => $result['time'] ,
                'user'          => $result['user'],
                'work_content'  => str_replace($nl,$replace,$result['work_content']),
                'note'          => $result['note'] ,
                'date_added'    => date('Y-m-d H:i:s',strtotime($result['date_added'])) ,
                'edit'          => $this->url->link('office/reply/edit', 'token=' . $this->session->data['token'] . '&reply_id=' . $result['reply_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_date'] = $this->language->get('column_date');
        $data['column_time'] = $this->language->get('column_time');
        $data['column_user'] = $this->language->get('column_user');
        $data['column_content'] = $this->language->get('column_content');
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

        $data['sort_time'] = $this->url->link('office/reply', 'token=' . $this->session->data['token'] . '&sort=o_r.time' . $url, 'SSL');
        $data['sort_date'] = $this->url->link('office/reply', 'token=' . $this->session->data['token'] . '&sort=o_r.date' . $url, 'SSL');
        $data['sort_user'] = $this->url->link('office/reply', 'token=' . $this->session->data['token'] . '&sort=o_r.office_id' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('office/reply', 'token=' . $this->session->data['token'] . '&sort=o_r.date_added' . $url, 'SSL');

        $url = '';

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
        $pagination->url = $this->url->link('office/reply', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('office/reply_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['reply_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['entry_date'] = $this->language->get('entry_date');
        $data['entry_time'] = $this->language->get('entry_time');
        $data['entry_note'] = $this->language->get('entry_note');
        $data['entry_work_content'] = $this->language->get('entry_work_content');

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
        if (isset($this->error['time'])) {
            $data['error_time'] = $this->error['time'];
        } else {
            $data['error_time'] = '';
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
            'href' => $this->url->link('office/reply', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['reply_id'])) {
            $data['action'] = $this->url->link('office/reply/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('office/reply/edit', 'token=' . $this->session->data['token'] . '&reply_id=' . $this->request->get['reply_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('office/reply', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['reply_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $time_info = $this->model_office_reply->getReply($this->request->get['reply_id']);
        }
        if (isset($this->request->post['date'])) {
            $data['date'] = $this->request->post['date'];
        } elseif (!empty($time_info['date'])) {
            $data['date'] = $time_info['date'];
        } else {
            $data['date'] = date('Y-m-d');
        }

        if (isset($this->request->post['time'])) {
            $data['time'] = $this->request->post['time'];
        } elseif (!empty($time_info['time'])) {
            $data['time'] = $time_info['time'];
        } else {
            $data['time'] = '';
        }
        $nl = array("\\r\\n","\\n","\\r");
        $replace = "\r\n";
        if (isset($this->request->post['work_content'])) {
            $data['work_content'] = $this->request->post['work_content'];
        } elseif (!empty($time_info['work_content'])) {
            $data['work_content'] = str_replace($nl,$replace,$time_info['work_content']);
        } else {
            $data['work_content'] = '';
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

        $this->response->setOutput($this->load->view('office/reply_form.tpl', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'office/reply')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['time']) < 3) || (utf8_strlen($this->request->post['time']) > 128)) {
            $this->error['time'] = $this->language->get('error_time');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'office/reply')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

}