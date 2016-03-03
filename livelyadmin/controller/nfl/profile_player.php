<?php
class ControllerNflProfilePlayer extends Controller {
    private $error = array();

    public function index() {
        $this->language->load('nfl/profile_player');

        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');

        $this->document->addStyle(TPL_JS.'fancybox/jquery.fancybox.css?v=2.1.5');
        $this->document->addScript(TPL_JS.'fancybox/jquery.fancybox.pack.js?v=2.1.5');
        $this->load->model('nfl/profile_player');

        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js'); 
        $filter_column = false;
        if (isset($this->request->get['filter_team'])) {
            $filter_team = $this->request->get['filter_team'];
            $filter_column = true;
        } else {
            $filter_team = null;
        }

        if (isset($this->request->get['filter_player_id'])) {
            $filter_player_id = (int)$this->request->get['filter_player_id'];
            $filter_column = true;
        } else {
            $filter_player_id = null;
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
            $filter_contribute_sn = $this->request->get['filter_contribute_sn'];
            $filter_column = true;
        } else {
            $filter_contribute_sn = null;
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $filter_date_modified = $this->request->get['filter_date_modified'];
            $filter_column = true;
        } else {
            $filter_date_modified = null;
        }

        if (isset($this->request->get['filter_user_id'])) {
            $filter_user_id = (int)$this->request->get['filter_user_id'];
            $filter_column = true;
        } else {
            $filter_user_id = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = (int)$this->request->get['filter_status'];
            $filter_column = true;
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'nc.contribute_id';
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
        $limit = 20;
        $url = '';
        if (isset($this->request->get['filter_team'])) {
            $url .= '&filter_team=' . urlencode(html_entity_decode($this->request->get['filter_team'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
            $url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_player_id'])) {
            $url .= '&filter_player_id=' . (int)$this->request->get['filter_player_id'];
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
        $this->load->model('user/user');
        $data['all_markets'] = $this->model_user_user->getUsers();

        $this->load->model('nfl/team');
        $this->load->model('nfl/player');
        $data['all_teams'] = $this->model_nfl_team->getTeams();

        $this->load->model('nfl/status');
        $data['post_statuses'] = $this->model_nfl_status->getStatuses();
        $this->load->model('nfl/publish');
        $data['post_publishes'] = $this->model_nfl_publish->getPublishes();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['contributes'] = array();

        $filter_data = array(
            'filter_team'          => $filter_team,           
            'filter_user_id'       => $filter_user_id,
            'filter_contribute_sn' => $filter_contribute_sn,
            'filter_player_id'     => $filter_player_id,
            'filter_status'        => $filter_status,
            'filter_date_modified' => $filter_date_modified,
            'sort'                 => $sort,
            'order'                => $order,
            'start'                => ($page - 1) * $limit,
            'limit'                => $limit
        );

        $total = $this->model_nfl_profile_player->getTotalContributes($filter_data);

        $results = $this->model_nfl_profile_player->getContributes($filter_data);

        foreach ($results as $result) {
            $action = array();
            $lock = (!empty($result['locker']) && $result['locker']!=$this->user->getId()) ? true :false ;
            if($lock){
                $action[] = array(
                    'text' => $this->language->get('text_readonly'),
                    'href' => $this->url->link('nfl/profile_player/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')
                    );
            }else{
                $action[] = array(
                    'text' => $this->language->get('button_edit'),
                    'href' => $this->url->link('nfl/profile_player/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')
                );
            }
            $_status = $this->model_nfl_status->getStatus($result['status']);
            if(in_array($result['status'], $this->config->get('nfl_auditor_status'))){
                $status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : '<b style="color:blue">'.$_status['name'].'</b>' ;
            }else{
                $status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'];
            }
            
            $auditor = $this->model_user_user->getUser($result['user_id']);
            $team = $this->model_nfl_team->getTeam($result['team_id']);
            $player = $this->model_nfl_player->getPlayer($result['player_id']);
            $data['contributes'][] = array(
                'contribute_id' => $result['contribute_id'],
                'contribute_sn' => $result['contribute_sn'] ,
                'team'          => empty($team['team_sn']) ? '' : $team['name_en'] . '<br>'.$team['name_cn'],
                'player'        => empty($player['name']) ? '' : $player['number'].' '.$player['name'] ,
                'auditor'       => empty($auditor['nickname']) ? '' : $auditor['nickname'],
                'lock'          => $lock,
                'status_text'   => $status_text,
                'submited_date' => date('Y-m-d', strtotime($result['submited_date'])).'<br>'.date('H:i:s',strtotime($result['submited_date'])),
                'date_modified' => date('Y-m-d', strtotime($result['date_modified'])).'<br>'.date('H:i:s',strtotime($result['date_modified'])),
                'note'          => !empty($result['note']) ? trim($result['note']) : false,
                'selected'      => isset($this->request->post['selected']) && in_array($result['contribute_id'], $this->request->post['selected']),
                'action'        => $action
            );
        }
         
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_list'] = $this->language->get('text_list');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['column_team'] = $this->language->get('column_team');
        $data['column_contribute_sn'] = $this->language->get('column_contribute_sn');
        $data['column_player'] = $this->language->get('column_player');
        $data['column_auditor'] = $this->language->get('column_auditor');
        $data['column_submited_date'] = $this->language->get('column_submited_date');
        $data['column_date_modified'] = $this->language->get('column_date_modified');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_edit'] = $this->language->get('button_edit');

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

        $url = '';
        if (isset($this->request->get['filter_team'])) {
            $url .= '&filter_team=' . urlencode(html_entity_decode($this->request->get['filter_team'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
            $url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_player_id'])) {
            $url .= '&filter_player_id=' . (int)$this->request->get['filter_player_id'];
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }
        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
        }
        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['sort_team'] = $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . '&sort=nc.team_id' . $url, 'SSL');
        $data['sort_player'] = $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . '&sort=nc.player_id' . $url, 'SSL');
        $data['sort_contribute_sn'] = $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . '&sort=nc.contribute_sn' . $url, 'SSL');
        $data['sort_submited_date'] = $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . '&sort=nc.submited_date' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . '&sort=nc.date_modified' . $url, 'SSL');
        $data['sort_user'] = $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . '&sort=user' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . '&sort=nc.status' . $url, 'SSL');

        $url = '';
        if (isset($this->request->get['filter_team'])) {
            $url .= '&filter_team=' . urlencode(html_entity_decode($this->request->get['filter_team'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
            $url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_player_id'])) {
            $url .= '&filter_player_id=' . (int)$this->request->get['filter_player_id'];
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
        $pagination->limit = $limit;
        
        $pagination->url = $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
         
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

        $data['filter_team'] = $filter_team;
        $data['filter_contribute_sn'] = $filter_contribute_sn;
        $data['filter_date_modified'] = $filter_date_modified;
        $data['filter_player_id'] = $filter_player_id;
        $data['filter_user_id'] = $filter_user_id;
        $data['filter_status'] = $filter_status;
        $data['filter_column'] = $filter_column;

        $data['filter_player'] = '';
        if($filter_player_id){
            $player = $this->model_nfl_player->getPlayer($filter_player_id);
            $data['filter_player'] = empty($player['name']) ? '' : $player['name'].' #'.$player['number'];
        }
        $data['sort'] = $sort;
        $data['order'] = $order;       
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/profile/player_list.tpl', $data));
    }

    public function detail() {
        $this->language->load('nfl/profile_player');
        $this->load->model('nfl/profile_player');
        $this->load->model('nfl/status');
        $this->load->model('nfl/team');
        $this->load->model('nfl/player');
        $this->load->model('user/user');
        $this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');        
        $data['heading_title'] = $this->language->get('heading_title');     
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_post'] = $this->language->get('text_post');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_loading'] = $this->language->get('text_loading');
        $data['text_history'] = $this->language->get('text_history');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_unlock'] = $this->language->get('button_unlock');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_info'] = $this->language->get('tab_info');
        $data['tab_post'] = $this->language->get('tab_post');
        $data['tab_history'] = $this->language->get('tab_history');
        $data['token'] = $this->session->data['token'];
        $url = '';
        if (isset($this->request->get['filter_team'])) {
            $url .= '&filter_team=' . urlencode(html_entity_decode($this->request->get['filter_team'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_contribute_sn'])) {
            $url .= '&filter_contribute_sn=' . urlencode(html_entity_decode($this->request->get['filter_contribute_sn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . urlencode(html_entity_decode($this->request->get['filter_date_modified'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_player_id'])) {
            $url .= '&filter_player_id=' . (int)$this->request->get['filter_player_id'];
        }
        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
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
            'href' => $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        $data['cancel'] = $this->url->link('nfl/profile_player', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['action'] = $this->url->link('nfl/profile_player/save', '&token=' . $this->session->data['token'] , 'SSL');
        
        $data['tool_similar_action'] = htmlspecialchars_decode($this->url->link('tool/cron/similar_text','token='.$this->session->data['token'],'SSL'));
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
        
        $_post = $this->model_nfl_profile_player->getContribute($this->request->get['contribute_id']);
        $data['contribute_id'] = $_post['contribute_id'];
        $data['contribute_sn'] = $_post['contribute_sn'];
        $data['submited_date'] = $_post['submited_date'];   
        $data['submited_times'] = $_post['submited_times'];       
        $data['expired'] = $_post['expired'];   
        $data['content'] = $_post['content'];   
        $data['copied'] = $_post['copied'];   
        $data['locker'] = $_post['locker'];
        $data['notes'] = utf8_strlen($_post['note'])>5 ? json_decode($_post['note'],true) : false;

        //team
        $team = $this->model_nfl_team->getTeam($_post['team_id']);
        $data['team'] = empty($team['team_sn']) ? '' : $team['name_en'].' '.$team['name_cn']; 
        //player
        $player = $this->model_nfl_player->getPlayer($_post['player_id']);
        $data['player'] = empty($player['name']) ? '' : $player['name'];
        //status
        $_status = $this->model_nfl_status->getStatus($_post['status']);
        $data['status_text'] = empty($_status['name']) ? $this->language->get('text_exception_red') : trim($_status['name']);
        //author
        $author = $this->model_user_user->getUserByAuthorId($_post['author_id']);
        $data['author'] = empty($author['nickname']) ? '' : $author['nickname'];
        $author_user = empty($author['user_id']) ? 0 : $author['user_id'];
        //operator
        $operator = $this->model_user_user->getUser($_post['user_id']);
        $data['user'] = empty($operator['nickname']) ? '' : $operator['nickname'];

        //modify lock
        $data['locked'] = false;  
        $data['edit'] = ($this->user->getId() == $author_user) && !in_array($_post['status'], $this->config->get('nfl_level_status'));
        $locker = $this->model_user_user->getUser($_post['locker']);
        $data['lock_user'] = empty($locker['nickname']) ? '' : $locker['nickname'];
        
        if(empty($data['lock_user']) || $_post['locker'] == $this->user->getId()){
            $this->model_nfl_profile_player->setTempLocker((int)$_post['contribute_id']); 
        }else{
            $data['locked'] = true;
            $data['edit'] = false;
            $data['text_lock'] = sprintf($this->language->get('text_lock'), $data['lock_user']);
        }

        $this->document->setTitle($_post['contribute_sn']);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/profile/player_form.tpl', $data));
    }

    public function save(){
        $this->language->load('nfl/profile_player');
        $this->load->model('nfl/profile_player');
        $this->load->model('nfl/status');
        $result= array('status'=>0,'msg'=>$this->language->get('text_exception'));
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $_post = $this->model_nfl_profile_player->getContribute($this->request->post['contribute_id']);

            if($_post['locker']!=(int)$this->user->getId()){
                die(json_encode(array('status'=>0,'msg'=> $this->language->get('error_locker'))));
            }

            $team_id = isset($this->request->post['team_id']) ?  $this->request->post['team_id'] : 0;
            $team_modified = isset($this->request->post['team_modified']) ? $this->request->post['team_modified'] : 0;
            $expired_date = isset($this->request->post['expired_date']) ?  $this->request->post['expired_date'] : '';
            $expired_modified = isset($this->request->post['expired_modified']) ? $this->request->post['expired_modified'] : 0;
            $content = isset($this->request->post['content']) ? htmlspecialchars_decode($this->request->post['content']) : false;
            $content_modified = isset($this->request->post['content_modified']) ? $this->request->post['content_modified'] : 0;
            $note = !empty($this->request->post['note']) ? strip_tags($this->request->post['note']) : false;

            if($content_modified && empty($content)){
                die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_text'))));
            }
            $_notes = array();
            if(!empty($_post['note'])){
                $_notes = json_decode($_post['note'],true);
            }
            if($note){
                $_notes[] = array(
                    'mode'      => 'user',
                    'operator'  => $this->user->getNickName(),
                    'entry_id'  => $this->user->getId(),
                    'msg'       => trim($note),
                    'time'      => time()
                );
            }
            $tmp = array(
                'contribute_id'     => $this->request->post['contribute_id'],
                'team_id'           => $team_id,
                'team_modified'     => $team_modified,
                'expired'           => $expired_date,
                'expired_modified'  => $expired_modified,
                'content'           => $content,
                'content_modified'  => $content_modified,
                'note'              => json_encode($_notes)
            );
            if($this->model_nfl_profile_player->modify($tmp)){
                $this->session->data['success'] = sprintf($this->language->get('text_approve_success'),'['.$_post['contribute_sn'].' '.$_post['contribute_id'].']');
                $result= array('status'=>1,'msg'=> $this->language->get('text_success'));
            }else{
                $result= array('status'=>0,'msg'=> $this->language->get('error_level'));
            }
        }
        $this->response->setOutput(json_encode($result));
    }

    public function history(){
        $this->language->load('nfl/profile_player');
        $this->load->model('nfl/profile_player');
        $this->load->model('nfl/status');

        $contribute_id = (int)$this->request->get['contribute_id'];
        $data['token'] = $this->session->data['token'] ;
        $data['text_no_results'] = $this->language->get('text_no_results');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        $limit = 20;
        $data['histories'] = array();
        $total = $this->model_nfl_profile_player->getTotalHistory($contribute_id);
        $results = $this->model_nfl_profile_player->getHistories($contribute_id,($page - 1) * $limit, $limit);
        foreach ($results as $result) {
            $_status = $this->model_nfl_status->getStatus($result['value']);
            if($result['user_id']==0){
                $operator = $this->language->get('text_author');
            }elseif ($result['user_id']==-1){
                $operator = $this->language->get('text_system');
            }else{
                $operator = $result['nickname'];
            }
            $data['histories'][] = array(
                'history_id'    => $result['history_id'] ,              
                'type'          => 'Edit Status' ,
                'value'         => (int)$result['value'],
                'status_text'   => empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'],
                'operator'      => $operator,
                'date_added'    => date('Y-m-d H:i:s', strtotime($result['date_added']))
            );
        }
        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->url = $this->url->link('nfl/profile_player/history', 'token=' . $this->session->data['token'] . '&contribute_id='.$contribute_id . '&page={page}', 'SSL');
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

        
        $this->response->setOutput($this->load->view('nfl/profile/player_history.tpl', $data));
    }

    function ajax_data(){
        $this->language->load('nfl/profile_player');
        $action = isset($this->request->post['action']) ? strtolower(trim($this->request->post['action'])) : 'get';
        $this->load->model('nfl/profile_player');
        switch ($action) {
            case 'reset':
                $this->model_nfl_profile_player->resetTempLocker($this->request->post['contribute_id'],$this->request->post['locker']);
                if(isset($this->request->get['set']) && $this->request->get['set']){
                    $this->model_nfl_profile_player->setTempLocker($this->request->post['contribute_id']);
                }
                die(json_encode(array('status' =>1 ,'msg'=>'reset success')));
                break;
            case 'get':
                $status = isset($this->request->post['status']) ? strtolower(trim($this->request->post['status'])) : false;
                if($status){
                    $total = $this->model_nfl_profile_player->getTotalContributes(array('filter_uncopied_status'=>$status));
                    die(json_encode(array('status' =>1 ,'total'=>$total)));
                }
                break;
        }
        die(json_encode(array('status' =>0 ,'msg'=>$this->language->get('text_exception'))));
    }
}