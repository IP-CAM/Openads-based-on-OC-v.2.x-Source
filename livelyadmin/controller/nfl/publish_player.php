<?php
class ControllerNflPublishPlayer extends Controller {
    private $error = array();

    public function index() {
        $this->language->load('nfl/publish_player');

        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');

        $this->document->addStyle(TPL_JS.'fancybox/jquery.fancybox.css?v=2.1.5');
        $this->document->addScript(TPL_JS.'fancybox/jquery.fancybox.pack.js?v=2.1.5');
        $this->load->model('nfl/publish_player');
        $this->getList();
    }

    public function bulk() {
        $this->language->load('nfl/publish_player');
        $this->load->model('nfl/publish_player');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
            $failed = $finished =  array();
            if(isset($this->request->post['selecteds']) && trim($this->request->post['selecteds'])){
                $selecteds = explode(",", trim($this->request->post['selecteds']));
                if(is_array($selecteds)){
                    foreach ($selecteds as $contribute_id) {
                        if((int)$contribute_id){
                            $_post = $this->model_nfl_publish_player->getContribute($contribute_id);
                            $tmp = array();
                            if(isset($this->request->post['_status']) && $this->request->post['_status'] != '*'){
                                $tmp['status'] = (int)$this->request->post['_status'];
                            }
                            if(isset($this->request->post['_publish']) && $this->request->post['_publish'] != '*'){
                                $tmp['publish'] = (int)$this->request->post['_publish'];
                            }
                            if($tmp){
                                $tmp['contribute_id'] = (int)$contribute_id;
                                if(!$this->model_nfl_publish_player->editContribute($tmp,'bulk')){
                                    $failed[$contribute_id] = $_post['contribute_sn'];
                                    continue;
                                }
                            }else{
                                $failed[$contribute_id] = $_post['contribute_sn'];
                                continue;
                            }
                            $finished[] = $contribute_id;
                        }                        
                    }
                }else{
                    die(json_encode(array('status'=>0,'msg'=>$this->language->get('text_exception'))));
                }
            }
            $msg = $failed ? sprintf($this->language->get('text_permission_data'),implode(",", $failed)): '';
            if($finished){
                $this->session->data['success'] = sprintf($this->language->get('text_approve_success'),implode(",", $finished)).$msg;
                die(json_encode(array('status'=>1,'msg'=>'Update Success!')));
            }else{
                die(json_encode(array('status'=>0,'msg'=>$msg)));
            }            
        }
    }

    public function delete(){
        $this->language->load('nfl/publish_player');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('nfl/publish_player');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $post_id) {
                $this->model_nfl_publish_player->deleteContribute($post_id);
            }
            $this->session->data['success'] = sprintf($this->language->get('text_delete_success'),$this->request->post['selected'] );
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

            if (isset($this->request->get['filter_publish'])) {
                $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
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
            $this->response->redirect($this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
    }
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'nfl/publish_player/delete')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error ;
    }    
    protected function getList() {
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

        if (isset($this->request->get['filter_author'])) {
            $filter_author = $this->request->get['filter_author'];
            $filter_column = true;
        } else {
            $filter_author = null;
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

        if (isset($this->request->get['filter_publish'])) {
            $filter_publish = (int)$this->request->get['filter_publish'];
            $filter_column = true;
        } else {
            $filter_publish = null;
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

        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
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
            'href' => $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['contributes'] = array();

        $filter_data = array(
            'filter_team'          => $filter_team,           
            'filter_user_id'       => $filter_user_id,
            'filter_contribute_sn' => $filter_contribute_sn,
            'filter_player_id'     => $filter_player_id,
            'filter_author'        => $filter_author,
            'filter_status'        => $filter_status,
            'filter_publish'       => $filter_publish,
            'filter_date_modified' => $filter_date_modified,
            'sort'                 => $sort,
            'order'                => $order,
            'start'                => ($page - 1) * $limit,
            'limit'                => $limit
        );

        $total = $this->model_nfl_publish_player->getTotalContributes($filter_data);

        $results = $this->model_nfl_publish_player->getContributes($filter_data);

        foreach ($results as $result) {
            $action = array();
            $lock = (!empty($result['locker']) && $result['locker']!=$this->user->getId()) ? true :false ;
            if($lock){
                $action[] = array(
                    'text' => $this->language->get('text_readonly'),
                    'href' => $this->url->link('nfl/publish_player/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')
                    );
            }else{
                $action[] = array(
                    'text' => $this->language->get('button_audit'),
                    'href' => $this->url->link('nfl/publish_player/detail', 'token=' . $this->session->data['token'] .'&contribute_id='.$result['contribute_id'], 'SSL')
                );
            }
            $_status = $this->model_nfl_status->getStatus($result['status']);
            if(in_array($result['status'], $this->config->get('nfl_auditor_status'))){
                $status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : '<b style="color:blue">'.$_status['name'].'</b>' ;
            }else{
                $status_text = empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'];
            }

            $_publish = $this->model_nfl_publish->getPublish($result['publish']);
            if(in_array($result['publish'], $this->config->get('nfl_auditor_publish'))){
                $publish_text = empty($_publish['name']) ? $this->language->get('text_exception_red') : '<b style="color:blue">'.$_publish['name'].'</b>' ;
            }else{
                $publish_text = empty($_publish['name']) ? $this->language->get('text_exception_red') : $_publish['name'];
            }
            $group = array();
            $_users = !empty($result['group']) ? explode(",", $result['group']) : '';
            if($_users){
                foreach ($_users as $_user_id) {
                    $_user = $this->model_user_user->getUser($_user_id);
                    $group[] = $_user['lastname'].$_user['firstname'];
                }
            }
            $author = $this->model_user_user->getUserByAuthorId($result['author_id']);
            $auditor = $this->model_user_user->getUser($result['user_id']);
            $team = $this->model_nfl_team->getTeam($result['team_id']);
            $player = $this->model_nfl_player->getPlayer($result['player_id']);
            $data['contributes'][] = array(
                'contribute_id' => $result['contribute_id'],
                'contribute_sn' => $result['contribute_sn'] ,
                'team'          => empty($team['team_sn']) ? '' : $team['name_en'] . '<br>'.$team['name_cn'],
                'player'        => empty($player['name']) ? '' : $player['number'].' '.$player['name'] ,
                'auditor'       => empty($auditor['nickname']) ? '' : $auditor['nickname'],
                'author'        => empty($author['nickname']) ? '' : $author['nickname'],
                'status_text'   => $status_text,
                'publish_text'  => $publish_text,
                'lock'          => $lock,
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
        $data['column_author'] = $this->language->get('column_author');
        $data['column_submited_date'] = $this->language->get('column_submited_date');
        $data['column_date_modified'] = $this->language->get('column_date_modified');
        $data['column_publish'] = $this->language->get('column_publish');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_export'] = $this->language->get('button_export');
        $data['button_import'] = $this->language->get('button_import');
        $data['button_bulk'] = $this->language->get('button_bulk');
        $data['button_copy'] = $this->language->get('button_copy');
        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_audit'] = $this->language->get('button_audit');

        $data['token'] = $this->session->data['token'];

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
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
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
        $data['sort_team'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . '&sort=nc.team_id' . $url, 'SSL');
        $data['sort_player'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . '&sort=nc.player_id' . $url, 'SSL');
        $data['sort_contribute_sn'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . '&sort=nc.contribute_sn' . $url, 'SSL');
        $data['sort_submited_date'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . '&sort=nc.submited_date' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . '&sort=nc.date_modified' . $url, 'SSL');
        $data['sort_user'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . '&sort=user' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . '&sort=nc.status' . $url, 'SSL');
        $data['sort_publish'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . '&sort=nc.publish' . $url, 'SSL');
        $data['sort_author'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . '&sort=nc.author_id' . $url, 'SSL');

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

        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
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
        
        $pagination->url = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
         
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

        $data['filter_team'] = $filter_team;
        $data['filter_author'] = $filter_author;
        $data['filter_contribute_sn'] = $filter_contribute_sn;
        $data['filter_date_modified'] = $filter_date_modified;
        $data['filter_player_id'] = $filter_player_id;
        $data['filter_user_id'] = $filter_user_id;
        $data['filter_status'] = $filter_status;
        $data['filter_publish'] = $filter_publish;
        $data['filter_column'] = $filter_column;

        $data['filter_player'] = '';
        if($filter_player_id){
            $player = $this->model_nfl_player->getPlayer($filter_player_id);
            $data['filter_player'] = empty($player['name']) ? '' : $player['name'].' #'.$player['number'];
        }
        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['promoter'] = in_array($this->user->getId(), $this->config->get("sns_group_promotion"));

        $data['level_status'] = $this->config->get("nfl_level_status");
        $data['promoting_publish'] = $this->config->get("nfl_promoting_publish");

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/publish/player_list.tpl', $data));
    }

    public function detail() {
        $this->language->load('nfl/publish_player');
        $this->load->model('nfl/publish_player');
        $this->load->model('nfl/team');
        $this->load->model('nfl/player');
        $this->load->model('nfl/status');
        $this->load->model('nfl/publish');
        $this->load->model('user/user');
        
        $data['heading_title'] = $this->language->get('heading_title');     
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_post'] = $this->language->get('text_post');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_loading'] = $this->language->get('text_loading');
        $data['text_history'] = $this->language->get('text_history');

        $data['error_text'] = $this->language->get('error_text');
        $data['button_update'] = $this->language->get('button_update');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_unlock'] = $this->language->get('button_unlock');
        $data['button_reset'] = $this->language->get('button_reset');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_info'] = $this->language->get('tab_info');
        $data['tab_post'] = $this->language->get('tab_post');
        $data['tab_history'] = $this->language->get('tab_history');
        $data['token'] = $this->session->data['token'];
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

        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
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
            'href' => $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        $data['cancel'] = $this->url->link('nfl/publish_player', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['action'] = $this->url->link('nfl/publish_player/save', '&token=' . $this->session->data['token'] , 'SSL');
        
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
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $_post = $this->model_nfl_publish_player->getContribute($this->request->get['contribute_id']);
        $data['contribute_id'] = $_post['contribute_id'];
        $data['contribute_sn'] = $_post['contribute_sn'];
        $data['submited_date'] = $_post['submited_date'];   
        $data['submited_times'] = $_post['submited_times'];   
        $data['expired'] = $_post['expired'];   
        $data['content'] = $_post['content'];   
        $data['copied'] = $_post['copied'];   
        $data['locker'] = $_post['locker'];   
        $data['publish'] = $_post['publish'];   
        $data['status'] = $_post['status'];   
        $data['notes'] = utf8_strlen($_post['note'])>5 ? json_decode($_post['note'],true) : false;

        //team
        $team = $this->model_nfl_team->getTeam($_post['team_id']);
        $data['team'] = empty($team['team_sn']) ? '' : $team['name_en'].' '.$team['name_cn']; 
        //player
        $player = $this->model_nfl_player->getPlayer($_post['player_id']);
        $data['player'] = empty($player['name']) ? '' : $player['name'];
        //status
        $_status = $this->model_nfl_status->getStatus($_post['status']);
        $data['status_text'] = empty($_status['name']) ? '<b style="color:red">Exception</b>' : trim($_status['name']);
        //author
        $author = $this->model_user_user->getUserByAuthorId($_post['author_id']);
        $data['author'] = empty($author['nickname']) ? '' : $author['nickname'];
        $author_user = empty($author['user_id']) ? 0 : $author['user_id'];
        //operator
        $operator = $this->model_user_user->getUser($_post['user_id']);
        $data['user'] = empty($operator['nickname']) ? '' : $operator['nickname'];

        //modify
        $data['modify'] = in_array($this->user->getId(), $this->config->get('sns_group_promotion')) && !in_array($_post['publish'], $this->config->get('nfl_promotion_modify'));
        //modify lock
        $data['locked'] = $data['relax'] = false;
        $locker = $this->model_user_user->getUser($_post['locker']);
        $data['lock_user'] = empty($locker['nickname']) ? '' : $locker['nickname'];
        
        if(empty($data['lock_user']) || $_post['locker'] == $this->user->getId()){
            $this->model_nfl_publish_player->setTempLocker((int)$_post['contribute_id']); 
        }else{
            $data['locked'] = true;
            $data['modify'] = false;
            $data['text_lock'] = sprintf($this->language->get('text_lock'), $data['lock_user']);
            if(in_array($this->user->getId(), $this->config->get('sns_group_promotion'))){
                $data['relax'] = true;
                $data['text_confirm_relax'] = sprintf($this->language->get('text_relax'),$data['lock_user']);
            }
        }

        $this->document->setTitle($_post['contribute_sn']);

        $data['post_statuses'] = $this->model_nfl_status->getStatuses();
        $data['post_publishes'] = $this->model_nfl_publish->getPublishes();

        $data['level_statuses'] = $this->config->get('nfl_level_status');
        $data['auditor_approves'] = $this->config->get("nfl_auditor_approve");
        $data['promotion_modifies'] = $this->config->get("nfl_promotion_modify");
        $data['promoter'] = in_array($this->user->getId(), $this->config->get("sns_group_promotion"));
       
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/publish/player_form.tpl', $data));
    }

    public function save(){
        $this->language->load('nfl/publish_player');
        $this->load->model('nfl/publish_player');
        $this->load->model('nfl/status');
        $this->load->model('nfl/publish');
        $this->load->model('user/user');
        $result= array('status'=>0,'msg'=>$this->language->get('text_exception'));
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $_post = $this->model_nfl_publish_player->getContribute($this->request->post['contribute_id']);

            if($_post['locker']!=(int)$this->user->getId()){
                die(json_encode(array('status'=>0,'msg'=> $this->language->get('error_locker'))));
            }
            $team_id = isset($this->request->post['team_id']) ?  $this->request->post['team_id'] : 0;
            $team_modified = isset($this->request->post['team_modified']) ? $this->request->post['team_modified'] : 0;
            $expired_date = isset($this->request->post['expired_date']) ?  $this->request->post['expired_date'] : '';
            $expired_modified = isset($this->request->post['expired_modified']) ? $this->request->post['expired_modified'] : 0;
            $content = isset($this->request->post['content']) ? htmlspecialchars_decode($this->request->post['content']) : false;
            $content_modified = isset($this->request->post['content_modified']) ? $this->request->post['content_modified'] : 0;
            $publish = isset($this->request->post['publish']) ? $this->request->post['publish'] : false;
            $note = !empty($this->request->post['note']) ? strip_tags($this->request->post['note']) : false;

            if($content_modified && empty($content)){
                echo json_encode(array('status'=>0,'msg'=>$this->language->get('error_text')));
                exit;
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
                'publish'           => $publish, 
                'team_id'           => $team_id,
                'team_modified'     => $team_modified,
                'expired'           => $expired_date,
                'expired_modified'  => $expired_modified,
                'content'           => $content,
                'content_modified'  => $content_modified,
                'note'              => json_encode($_notes)
            );
            if($this->model_nfl_publish_player->editContribute($tmp,'modified')){
                $this->session->data['success'] = sprintf($this->language->get('text_approve_success'),'['.$_post['contribute_sn'].' '.$_post['contribute_id'].']');
                $result= array('status'=>1,'msg'=> $this->language->get('text_success'));
            }else{
                $result= array('status'=>0,'msg'=> $this->language->get('error_level'));
            }

        }
        $this->response->setOutput(json_encode($result));
    }

    public function history(){
        $this->language->load('nfl/publish_player');

        $this->load->model('nfl/publish_player');
        $this->load->model('nfl/status');
        $this->load->model('nfl/publish');

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
        $total = $this->model_nfl_publish_player->getTotalHistory($contribute_id);
        $results = $this->model_nfl_publish_player->getHistories($contribute_id,($page - 1) * $limit, $limit);
        foreach ($results as $result) {
            if(strtolower($result['type']) == 'edit'){
                $_status = $this->model_nfl_status->getStatus($result['value']);
                $text = empty($_status['name']) ? $this->language->get('text_exception_red') : $_status['name'];
            }else{
                $_publish = $this->model_nfl_publish->getPublish($result['value']);
                $text = empty($_publish['name']) ? $this->language->get('text_exception_red') : $_publish['name'];
            }

            if($result['user_id']==0){
                $operator = $this->language->get('text_author');
            }elseif ($result['user_id']==-1){
                $operator = $this->language->get('text_system');
            }else{
                $operator = $result['nickname'];
            }
            $data['histories'][] = array(
                'history_id'    => $result['history_id'] ,              
                'type'          => strtolower($result['type']) == 'edit' ? 'Edit Status' : 'Post Status',
                'value'         => (int)$result['value'],
                'status_text'   => $text,
                'operator'      => $operator,
                'date_added'    => date('Y-m-d H:i:s', strtotime($result['date_added']))
            );
        }
        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->url = $this->url->link('nfl/publish_player/history', 'token=' . $this->session->data['token'] . '&contribute_id='.$contribute_id . '&page={page}', 'SSL');
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
        $this->response->setOutput($this->load->view('nfl/publish/player_history.tpl', $data));
    }

    public function import_data(){
        $this->language->load('nfl/publish_player');

        $filename = isset($this->request->files['filename']['name']) ? trim($this->request->files['filename']['name']) : false;
        $note = !empty($this->request->post['note']) ? strip_tags($this->request->post['note']) : false;
        $token = $this->session->data['token'];
        $this->load->model('nfl/publish_player');
        $path_array = pathinfo($filename);
        $import_file = $this->request->files['filename']['tmp_name'];
        defined('DIR_UPLOAD') || define('DIR_UPLOAD', DOCUMENTROOT.'uploads/');

        if(!isset($path_array['extension']) || $path_array['extension']!='zip'){
            die(json_encode(array( 'status'=>0,'msg'=>'Zip File Exception!')));
        }
        $timePath = date('Ymd');
        $targetPath = DIR_UPLOAD.$timePath;
        if(!file_exists($targetPath)){
            mkdir($targetPath);
        }
        
        $archive = new PHPZip();
        $array     = $archive->GetZipInnerFilesInfo($import_file);

        $successCount = $failedCount  = $sameCount = 0;
        $allfiles =$allposts=$allpost=$alldata=array();


        for($i=0; $i<count($array); $i++) {
            if(!$array[$i]['folder']){
                $stat = $archive->unZip($import_file, $targetPath, $i,true,true);
                if($stat){
                    $info = pathinfo($array[$i]['filename']);
                    $allfiles[$info['dirname']]=$targetPath."/".trim(end($stat));
                    //$fp=fopen("test.txt", "a+");
                    //fwrite($fp, $allfiles[$info['dirname']]." ³É¹¦½âÑ¹ ".$info['dirname']."/".$info['basename']."\r\n");
                    //fclose($fp);
                }
            }
        }
        $fp=fopen($allfiles['.'],'r');
        while ($data = fgetcsv($fp)) {
            $allposts[] = $data;
        }
        if(count($allposts)){
            $num=count($allposts);
            for($i=0;$i<$num;$i++){

                $alldata['contribute_sn']=$allpost['postsn']=$allposts[$i][0];
                $allpost['team']=$allposts[$i][1];
                $alldata['player_name']=$allpost['player']=$allposts[$i][2];
                $alldata['season']=$allpost['season']=$allposts[$i][3];

                $alldata['productcode']=$preCode = substr($allpost['postsn'],0,3);
                $alldata['precode']=$productCode = substr($allpost['postsn'],0,10);
                $alldata['authorid']=$authorId = substr($allpost['postsn'],-6,2);
                $alldata['auto_num']=$auto_num = substr($allpost['postsn'],-3);
                $alldata['content']="";

                if (!empty($allpost['postsn'])){
                    $sameResult=$this->model_nfl_publish_player->isSameContribute($allpost['postsn']);
                    if (!$sameResult){
                        $filepath=$allfiles[$allpost['postsn']];
                        if(strpos($filepath, 'Post')){
                            $fpy=fopen($allfiles[$allpost['postsn']], "a+");
                            $content="";
                            while (!feof($fpy))
                            {
                                $content.=fgets($fpy);
                            }
                            $alldata['content']=$content;
                            fclose($fpy);
                        }
                        $res=$this->model_nfl_publish_player->insertContribute($alldata);
                        if($res){
                            $successCount++;
                        }else{
                            $failedCount++;
                        }
                    }else {
                        $sameCount++;
                    }
                }

            }
        }
        die(json_encode(array('status'=>1,'msg'=>"You have importted ".$successCount." Posts. And there are ".$failedCount." error. And there are ".$sameCount." Same Posts.")));
    }

    public function advanced_export(){
        $mode = isset($this->request->post['mode']) ? strtolower(trim($this->request->post['mode'])):'posts';
        $filter_publishes = isset($this->request->post['filter_publishes']) ? (array)$this->request->post['filter_publishes']:false;
        $filter_statuses = isset($this->request->post['filter_statuses']) ? (array)$this->request->post['filter_statuses']:false;
        $filter_teams = isset($this->request->post['filter_teams']) ? (array)$this->request->post['filter_teams']:false;
        $filter_players = isset($this->request->post['filter_players']) ? (int)$this->request->post['filter_players']:false;
        $token = $this->session->data['token'];
        $this->language->load('nfl/publish_player');
        if(!in_array($this->user->getId(), $this->config->get("sns_group_admin"))){
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_permission'))));
        }

        $basePath = DIR_DOWNLOAD.'tmp_posts';
        if(!file_exists($basePath)){
            @mkdir($basePath);
            //@chmod($basePath, 0777);
        }
        $targetPath = $basePath.'/'.date('Ymd').'_'.$mode;
        if(!file_exists($targetPath)){
            @mkdir($targetPath);
        }
        $topPath = $targetPath.'/Post';
        if(!file_exists($topPath)){
            @mkdir($topPath);
        }
        $this->load->model('nfl/publish_player');
        $filter = array(
            'filter_mode'       => $mode, 
            'filter_publishes'  => $filter_publishes,
            'filter_statuses'   => $filter_statuses,
            'filter_teams'      => $filter_teams,
            'filter_players'    => $filter_players,
            'sort'              => 'nc.contribute_sn',
            'order'             => 'ASC'
        );
        $json = $_tmp = array();
        $contributes = $this->model_nfl_publish_player->getContributes($filter);
        if($contributes){
            foreach ($contributes as $ck => $item){
                if(!empty($item['contribute_sn'])){
                    if($mode == 'posts') {
                        // Check Expired
                        if((int)$item['expired']){
                            if(time() > strtotime($item['expired'])){
                                $this->model_nfl_publish_player->editContribute($item,'expired');
                                continue;
                            }
                        }
                    }
                    $_tmp[trim($item['contribute_sn'])] = trim($item['contribute_sn']).",".trim($item['name_en']).",".trim($item['player']).",".trim($item['match'])."\r\n";

                    //DIR contribute_sn
                    $lastPath = $topPath.'/'.trim($item['contribute_sn']);
                    !file_exists($lastPath) && @mkdir($lastPath);

                    //File Post.txt
                    file_put_contents($lastPath.'/Post.txt',$item['content']);//Post.txt

                }else{
                    $json['error'][] = $item['contribute_id'].' Contribute SN Exception!';
                    continue;
                }
            }

        }else{
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('text_no_results'))));
        }
        if($_tmp){
            
            $list_csv = $topPath.'/List.csv';
            $handle = @fopen($list_csv, 'w');
            foreach ($_tmp as $line) {
                @fwrite($handle, $line);
            }
            @fclose($handle);
            
            $zip_name = date('YmdHis').'_'.$mode.'_NoPhoto.zip';
            $file_path = '/asset/download/'.$zip_name;
            
            $archive = new PclZip(DIR_DOWNLOAD.$zip_name);
            $archive->create($topPath,PCLZIP_OPT_REMOVE_PATH,$targetPath);
            deldir($targetPath);
            die(json_encode(array(
            'status'=>1,
            'msg'=>sprintf($this->language->get('text_export_success'),basename($file_path).sprintf($this->language->get('download_link'),$this->url->download(array('token'=>$token,'path'=>$file_path))))
            )));
        }else{
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('text_no_results'))));
        }

    }

    function ajax_data(){
        $this->language->load('nfl/publish_player');
        $action = isset($this->request->post['action']) ? strtolower(trim($this->request->post['action'])) : 'get';
        $this->load->model('nfl/publish_player');
        switch ($action) {
            case 'reset':
                $this->model_nfl_publish_player->resetTempLocker($this->request->post['contribute_id'],$this->request->post['locker']);
                if(isset($this->request->get['set']) && $this->request->get['set']){
                    $this->model_nfl_publish_player->setTempLocker($this->request->post['contribute_id']);
                }
                die(json_encode(array('status' =>1 ,'msg'=>'reset success')));
                break;
            case 'get':
                $status = isset($this->request->post['status']) ? strtolower(trim($this->request->post['status'])) : false;
                if($status){
                    $total = $this->model_nfl_publish_player->getTotalContributes(array('filter_uncopied_status'=>$status));
                    die(json_encode(array('status' =>1 ,'total'=>$total)));
                }
                break;
            case 'copy':
                $status = isset($this->request->post['status']) ? strtolower(trim($this->request->post['status'])) : false;
                $contribute_id = isset($this->request->post['contribute_id']) ? (int)$this->request->post['contribute_id'] : false;
                $results = array();
                if($status){
                    $results = $this->model_nfl_publish_player->getContributes(array('filter_uncopied_status'=>$status));
                }else if($contribute_id){
                    $contribute = $this->model_nfl_publish_player->getContribute($contribute_id);
                    if(!isset($contribute['user_id'])){
                        die(json_encode(array('status' =>0 ,'msg'=>'Data Exception')));
                    }else if(!in_array($this->user->getId(), $this->config->get('sns_group_admin'))) {
                        die(json_encode(array('status' =>0 ,'msg'=>$this->language->get('error_permission'))));
                    }
                    $results[] = $contribute;
                }
                $n = $e = $last = 0;
                if($results){
                    foreach ($results as $item) {
                        $sn = $this->model_nfl_publish_player->copyContribute($item,true);
                        if($sn){
                            $last = $sn;
                            $n++;
                        }else{
                            $e++;
                        }
                    }
                    if($n){
                        die(json_encode(array('status' =>1 ,'last'=>$last,'msg'=>sprintf($this->language->get('text_copy_success'),$n,$e))));
                    }
                }
                break;
        }
        die(json_encode(array('status' =>0 ,'msg'=>$this->language->get('text_exception'))));
    }
}