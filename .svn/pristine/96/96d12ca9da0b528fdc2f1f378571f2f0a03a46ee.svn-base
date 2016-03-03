<?php 
class ControllerNflSchedule extends Controller {
    private $error = array();
  
    public function index() {
        $this->language->load('nfl/schedule');
        
        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('nfl/schedule');
        
        $this->getList();
    }

    public function add() {
        $this->language->load('nfl/schedule');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('nfl/schedule');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('nfl/schedule/add')) {
            $this->model_nfl_schedule->addSchedule($this->request->post);
            
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
            
            $this->response->redirect($this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }
	
    public function edit() {
        $this->language->load('nfl/schedule');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('nfl/schedule');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('nfl/schedule/edit')) {
            $this->model_nfl_schedule->editSchedule($this->request->get['schedule_id'], $this->request->post);
            
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
                    
            $this->response->redirect($this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('nfl/schedule');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('nfl/schedule');
        
        if (isset($this->request->post['selected']) && $this->validateDelete('nfl/schedule/delete')) {
            foreach ($this->request->post['selected'] as $schedule_id) {
                $this->model_nfl_schedule->deleteSchedule($schedule_id);
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

            $this->response->redirect($this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['filter_road_team'])) {
            $filter_road_team = $this->request->get['filter_road_team'];
        } else {
            $filter_road_team = null;
        }

        if (isset($this->request->get['filter_home_team'])) {
            $filter_home_team = $this->request->get['filter_home_team'];
        } else {
            $filter_home_team = null;
        }
        if (isset($this->request->get['filter_date'])) {
            $filter_date = $this->request->get['filter_date'];
        } else {
            $filter_date = null;
        }

        if (isset($this->request->get['filter_match_id'])) {
            $filter_match_id = $this->request->get['filter_match_id'];
        } else {
            $filter_match_id = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 's.date';
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
        if (isset($this->request->get['filter_road_team'])) {
            $url .= '&filter_road_team=' . (int)$this->request->get['filter_road_team'];
        }

        if (isset($this->request->get['filter_home_team'])) {
            $url .= '&filter_home_team=' . (int)$this->request->get['filter_home_team'];
        }
        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_match_id'])) {
            $url .= '&filter_match_id=' . (int)$this->request->get['filter_match_id'];
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
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
            'href' => $this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
    
        $data['add'] = $this->url->link('nfl/schedule/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('nfl/schedule/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    
        $data['schedules'] = array();

        $filter_data = array(
            'filter_road_team'  => $filter_road_team,
            'filter_home_team'  => $filter_home_team,
            'filter_match_id'   => $filter_match_id,
            'filter_date'       => $filter_date,
            'filter_status'     => $filter_status,
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );
        $this->load->model('user/user');
        $total = $this->model_nfl_schedule->getTotalSchedules($filter_data);
        
        $results = $this->model_nfl_schedule->getSchedules($filter_data);

        foreach ($results as $result) {

            $users = array();
            $_users = !empty($result['group']) ? explode(",", $result['group']) : ''; 
            if($_users){
                foreach ($_users as $_user_id) {
                    $_user = $this->model_user_user->getUser($_user_id);
                    $users[] = $_user['lastname'].$_user['firstname'];
                }
            }        
            $data['schedules'][] = array(
                'schedule_id' => $result['schedule_id'],
                'home_team'   => $result['home_sn'].' '.$result['home_en'].'<br>'.$result['home_cn'],
                'home_flag'   => $result['home_flag'], 
                'home_score'  => $result['home_score'],
                'road_team'   => $result['road_sn'].' '.$result['road_en'].'<br>'.$result['road_cn'],
                'road_flag'   => $result['road_flag'], 
                'road_score'  => $result['road_score'],
                'date'        => date('Y-m-d',strtotime($result['date'])),
                'time'        => date('H:i',strtotime($result['date'].' '.$result['time'])),
                'match'       => $result['match'],
                'group'       => implode(" , ", $users),
                'location'    => $result['location'],
                'status'      => $result['status'],
                'status_text' => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),

                'edit'      => $this->url->link('nfl/schedule/edit', 'token=' . $this->session->data['token'] . '&schedule_id=' . $result['schedule_id'] . $url, 'SSL')
            );      
        }
    
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['column_match'] = $this->language->get('column_match');
        $data['column_home_team'] = $this->language->get('column_home_team');
        $data['column_road_team'] = $this->language->get('column_road_team');
        $data['column_home_flag'] = $this->language->get('column_home_flag');
        $data['column_road_flag'] = $this->language->get('column_road_flag');
        $data['column_score'] = $this->language->get('column_score');
        $data['column_location'] = $this->language->get('column_location');
        $data['column_date'] = $this->language->get('column_date');
        $data['column_time'] = $this->language->get('column_time');
        $data['column_group'] = $this->language->get('column_group');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_import'] = $this->language->get('button_import');
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
        if (isset($this->request->get['filter_road_team'])) {
            $url .= '&filter_road_team=' . (int)$this->request->get['filter_road_team'];
        }

        if (isset($this->request->get['filter_home_team'])) {
            $url .= '&filter_home_team=' . (int)$this->request->get['filter_home_team'];
        }
        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_match_id'])) {
            $url .= '&filter_match_id=' . (int)$this->request->get['filter_match_id'];
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }
        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
                    
        $data['sort_home_team'] = $this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . '&sort=s.home_team_id' . $url, 'SSL');
        $data['sort_road_team'] = $this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . '&sort=s.road_team_id' . $url, 'SSL');
        $data['sort_date'] = $this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . '&sort=s.date' . $url, 'SSL');
        $data['sort_match'] = $this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . '&sort=s.match' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . '&sort=s.status' . $url, 'SSL');
        $url = '';
        if (isset($this->request->get['filter_road_team'])) {
            $url .= '&filter_road_team=' . (int)$this->request->get['filter_road_team'];
        }

        if (isset($this->request->get['filter_home_team'])) {
            $url .= '&filter_home_team=' . (int)$this->request->get['filter_home_team'];
        }
        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_match_id'])) {
            $url .= '&filter_match_id=' . (int)$this->request->get['filter_match_id'];
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
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
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->url = $this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));
        
        $data['filter_match_id'] = $filter_match_id;
        $data['filter_road_team'] = $filter_road_team;
        $data['filter_date'] = $filter_date;
        $data['filter_status'] = $filter_status;
        $data['filter_home_team'] = $filter_home_team;
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['token'] = $this->session->data['token'];

        $this->load->model('nfl/team');
        $data['teams'] = $this->model_nfl_team->getTeams();
        $this->load->model('nfl/match');
        $data['matches'] = $this->model_nfl_match->getMatches();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/schedule_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_form'] = !isset($this->request->get['schedule_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $this->document->addScript(TPL_JS.'jquery.ajaxupload.js');
        $this->document->addScript(TPL_JS.'jquery.json.min.js');
        $this->document->addStyle(TPL_JS.'fancybox/jquery.fancybox.css?v=2.1.5');
        $this->document->addScript(TPL_JS.'fancybox/jquery.fancybox.pack.js?v=2.1.5');
        $this->document->addStyle(TPL_JS.'formvalidation/dist/css/formValidation.css');
        $this->document->addScript(TPL_JS.'formvalidation/dist/js/formValidation.js');
        $this->document->addScript(TPL_JS.'formvalidation/dist/js/framework/bootstrap.min.js');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        
        $data['entry_date'] = $this->language->get('entry_date');
        $data['entry_time'] = $this->language->get('entry_time');
        $data['entry_location'] = $this->language->get('entry_location');
        $data['entry_match'] = $this->language->get('entry_match');
        $data['entry_team'] = $this->language->get('entry_team');
        $data['entry_score'] = $this->language->get('entry_score');
        $data['entry_group'] = $this->language->get('entry_group');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_note'] = $this->language->get('entry_note');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['home'])) {
            $data['error_home'] = $this->error['home'];
        } else {
            $data['error_home'] = '';
        }

        if (isset($this->error['road'])) {
            $data['error_road'] = $this->error['road'];
        } else {
            $data['error_road'] = '';
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
            'href' => $this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        
        if (!isset($this->request->get['schedule_id'])) {
            $data['action'] = $this->url->link('nfl/schedule/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('nfl/schedule/edit', 'token=' . $this->session->data['token'] . '&schedule_id=' . $this->request->get['schedule_id'] . $url, 'SSL');
        }
        
        $data['cancel'] = $this->url->link('nfl/schedule', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['schedule_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $schedule_info = $this->model_nfl_schedule->getSchedule($this->request->get['schedule_id']);
        }

        if (isset($this->request->post['date'])) {
            $data['date'] = $this->request->post['date'];
        } elseif (!empty($schedule_info['date'])) {
            $data['date'] = $schedule_info['date'];
        } else {
            $data['date'] = '';
        }

        if (isset($this->request->post['time'])) {
            $data['time'] = $this->request->post['time'];
        } elseif (!empty($schedule_info['time'])) {
            $data['time'] = $schedule_info['time'];
        } else {
            $data['time'] = '';
        }

        if (isset($this->request->post['location'])) {
            $data['location'] = $this->request->post['location'];
        } elseif (!empty($schedule_info['location'])) {
            $data['location'] = $schedule_info['location'];
        } else {
            $data['location'] = '';
        }

        if (isset($this->request->post['note'])) {
            $data['note'] = $this->request->post['note'];
        } elseif (!empty($schedule_info['note'])) {
            $data['note'] = $schedule_info['note'];
        } else {
            $data['note'] = '';
        }

        if (isset($this->request->post['match_id'])) {
            $data['match_id'] = $this->request->post['match_id'];
        } elseif (!empty($schedule_info['match_id'])) {
            $data['match_id'] = $schedule_info['match_id'];
        } else {
            $data['match_id'] = '';
        }
        
        if (isset($this->request->post['home_team_id'])) {
            $data['home_team_id'] = $this->request->post['home_team_id'];
        } elseif (!empty($schedule_info['home_team_id'])) {
            $data['home_team_id'] = $schedule_info['home_team_id'];
        } else {
            $data['home_team_id'] = '';
        }

        if (isset($this->request->post['home_score'])) {
            $data['home_score'] = $this->request->post['home_score'];
        } elseif (!empty($schedule_info['home_score'])) {
            $data['home_score'] = $schedule_info['home_score'];
        } else {
            $data['home_score'] = 0;
        }

        if (isset($this->request->post['road_score'])) {
            $data['road_score'] = $this->request->post['road_score'];
        } elseif (!empty($schedule_info['road_score'])) {
            $data['road_score'] = $schedule_info['road_score'];
        } else {
            $data['road_score'] = 0;
        }

        if (isset($this->request->post['road_team_id'])) {
            $data['road_team_id'] = $this->request->post['road_team_id'];
        } elseif (!empty($schedule_info['road_team_id'])) {
            $data['road_team_id'] = $schedule_info['road_team_id'];
        } else {
            $data['road_team_id'] = '';
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (isset($schedule_info['status'])) {
            $data['status'] = $schedule_info['status'];
        } else {
            $data['status'] = 1;
        }
        if (isset($this->request->post['group'])) {
            $data['group'] = $this->request->post['group'];
        } elseif (!empty($team_info['group'])) {
            $data['group'] = $team_info['group'];
        } else {
            $data['group'] = array();
        }

        
        $this->load->model('user/user');
        $data['all_users'] = $this->model_user_user->getUsers(array('status'=>1));
        $this->load->model('nfl/team');
        $data['teams'] = $this->model_nfl_team->getTeams();
        $this->load->model('nfl/match');
        $data['matches'] = $this->model_nfl_match->getMatches();
        $data['token'] = $this->session->data['token'];

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/schedule_form.tpl', $data));
    }
    
    protected function validateForm($route) {
        if (!$this->user->hasPermission('modify', $route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!(int)$this->request->post['home_team_id']) {
            $this->error['home'] = $this->language->get('error_home');
        }

        if (!(int)$this->request->post['road_team_id']) {
            $this->error['road'] = $this->language->get('error_road');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateDelete($route) {
        if (!$this->user->hasPermission('modify', $route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        } 
        
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }  

    public function players() {
        $json = array();
        $this->load->model('nfl/player');
        $this->load->model('nfl/schedule');
        if(!empty($this->request->get['team_id'])){     
            $selected = array();
            if(isset($this->request->get['schedule_id'])){
                $players = $this->model_nfl_schedule->getSchedulePlayers((int)$this->request->get['schedule_id']);
                if($players){
                    foreach ($players as $item) {
                        if($item['player_id'])
                        $selected[] = $item['player_id'];
                    }
                }
            }            
            
            $data = array(
                'filter_team_id' =>  (int)$this->request->get['team_id'],
                'start'       => 0,
                'limit'       => 20
            );
        
            $results = $this->model_nfl_player->getPlayers($data);
            
            foreach ($results as $result) {
                $json[] = array(
                    'player_id' => $result['player_id'], 
                    'team_id'   => $result['team_id'],                    
                    'name'      => '#'.$result['number'].' '.strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                    'selected' => in_array($result['player_id'], $selected)
                );                  
            }
        
        }

        $sort_order = array();
      
        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->setOutput(json_encode($json));
    }    
}
?>