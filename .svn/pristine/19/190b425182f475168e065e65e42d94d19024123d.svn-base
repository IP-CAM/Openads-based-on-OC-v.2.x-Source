<?php
class ControllerNflReport extends Controller {

	public function index(){
		$this->language->load('nfl/report');

		$this->document->setTitle($this->language->get('heading_title'));
		
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
        $this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');
        $this->load->model('nfl/report');
        $this->load->model('nfl/status');
        $this->load->model('nfl/team');
        $this->load->model('nfl/player');
        $this->load->model('user/user');        
        $filter_teams = $filter_players = $filter_authors = $filter_statuses = $filter_column = null;
        if (isset($this->request->get['filter_teams'])) {
            $teams = explode(",", $this->request->get['filter_teams']);
            if(is_array($teams)){
                foreach ($teams as $team_id) {
                    if((int)$team_id)
                    $filter_teams[] = (int)$team_id;
                }
                $filter_column = true;
            }
        } 

        if (isset($this->request->get['filter_players'])) {
            $players = explode(",", $this->request->get['filter_players']);
            if(is_array($players)){
                foreach ($players as $player_id) {
                    if((int)$player_id)
                    $filter_players[] = (int)$player_id;
                }
                $filter_column = true;
            }
        } 

        if (isset($this->request->get['filter_authors'])) {
            $authors = explode(",", $this->request->get['filter_authors']);
            if(is_array($authors)){
                foreach ($authors as $author_id) {
                    if((int)$author_id && strlen($author_id)==3)
                    $filter_authors[] = $author_id;
                }
                $filter_column = true;
            }
        }

        if (isset($this->request->get['filter_statuses'])) {
            $statuses = explode(",", $this->request->get['filter_statuses']);
            if(is_array($statuses)){
                foreach ($statuses as $status_id) {
                    if((int)$status_id)
                    $filter_statuses[] = (int)$status_id;
                }
                $filter_column = true;
            }
        }

        if (isset($this->request->get['filter_user_id'])) {
            $filter_user_id = (int)$this->request->get['filter_user_id'];
            $filter_column = true;
        } else {
            $filter_user_id = null;
        }

        if (isset($this->request->get['filter_time_range'])) {
            $filter_time_range = (int)$this->request->get['filter_time_range'];
            $filter_column = true;
        } else {
            $filter_time_range = null;
        }

        if (isset($this->request->get['filter_date_start'])) {
            $filter_date_start = trim($this->request->get['filter_date_start']);
            $filter_column = true;
        } else {
            $filter_date_start = null;
        }

        if (isset($this->request->get['filter_date_end'])) {
            $filter_date_end = trim($this->request->get['filter_date_end']);
            $filter_column = true;
        } else {
            $filter_date_end = null;
        }
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'posts';
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
        if (isset($this->request->get['filter_teams'])) {
            $url .= '&filter_teams=' . urlencode(html_entity_decode(trim($this->request->get['filter_teams']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_players'])) {
            $url .= '&filter_players=' . urlencode(html_entity_decode(trim($this->request->get['filter_players']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_authors'])) {
            $url .= '&filter_authors=' . urlencode(html_entity_decode(trim($this->request->get['filter_authors']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_statuses'])) {
            $url .= '&filter_statuses=' . urlencode(html_entity_decode(trim($this->request->get['filter_statuses']), ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }
        if (isset($this->request->get['filter_time_range'])) {
            $url .= '&filter_time_range=' . (int)$this->request->get['filter_time_range'];
        }

        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_start']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_end']), ENT_QUOTES, 'UTF-8'));
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
        		'href' => $this->url->link('nfl/report', 'token=' . $this->session->data['token'] , 'SSL')
        );


        $data['records'] = array();
        $limit = 32;
        $filter_data = array(
            'filter_teams'      => $filter_teams,           
            'filter_players'	=> $filter_players,
            'filter_authors'    => $filter_authors,         
            'filter_user_id'    => $filter_user_id,
            'filter_statuses'   => $filter_statuses,
            'filter_date_start' => $filter_date_start,
            'filter_date_end'   => $filter_date_end,
            'sort'              => $sort,
            'order'             => $order,
            'start'             => ($page - 1) * $limit,
            'limit'             => $limit
        );
        $total = $this->model_nfl_report->getTotalBalances($filter_data);
        $results = $this->model_nfl_report->getBalances($filter_data);
        $data['total_results'] = $this->model_nfl_report->getTotalResult($filter_data);

        foreach ($results as $result) {
            $team = $this->model_nfl_team->getTeam($result['team_id']);
            $player = $this->model_nfl_player->getPlayer($result['player_id']);
            $status = $this->model_nfl_status->getStatus($result['status']);
            $auditor = $this->model_user_user->getUser($result['user_id']);
            $author = $this->model_user_user->getUserByAuthorId($result['author_id']);
            $data['records'][] = array(
                'team'          => $team['team_sn'].' '.$team['name_en'],
                'player'        => empty($player['name']) ? '' : $player['name'].' '.$player['number'],                
                'status_text'   => empty($status['name'])? '' :$status['name'],
                'auditor'       => empty($auditor['username']) ? '' : $auditor['nickname'],
                'author'        => empty($author['username']) ? '' : $author['nickname'] .' '. $author['author_id'],
                'posts'        	=> $result['posts'],
                'amount'       	=> $result['amount']
            );
        }
        
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['entry_team'] = $this->language->get('entry_team');
        $data['entry_player'] = $this->language->get('entry_player');
        $data['entry_author'] = $this->language->get('entry_author');
        $data['entry_auditor'] = $this->language->get('entry_auditor');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_time_range'] = $this->language->get('entry_time_range');
        $data['entry_yesterday'] = $this->language->get('entry_yesterday');
        $data['entry_thisweek'] = $this->language->get('entry_thisweek');
        $data['entry_lastweek'] = $this->language->get('entry_lastweek');
        $data['entry_thismonth'] = $this->language->get('entry_thismonth');
        $data['entry_lastmonth'] = $this->language->get('entry_lastmonth');
        $data['entry_thisyear'] = $this->language->get('entry_thisyear');
        $data['entry_lastyear'] = $this->language->get('entry_lastyear');
        $data['entry_custom'] = $this->language->get('entry_custom');
        $data['entry_date_start'] = $this->language->get('entry_date_start');
        $data['entry_date_end'] = $this->language->get('entry_date_end');

        $data['column_team'] = $this->language->get('column_team');
        $data['column_player'] = $this->language->get('column_player');
        $data['column_auditor'] = $this->language->get('column_auditor');
        $data['column_author'] = $this->language->get('column_author');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_posts'] = $this->language->get('column_posts');
        $data['column_amount'] = $this->language->get('column_amount');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_reset'] = $this->language->get('button_reset');
        $data['filter_column'] = $filter_column;

        $data['reset'] = $this->url->link('nfl/report', 'token='.$this->session->data['token'],'SSL');

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
        if (isset($this->request->get['filter_teams'])) {
            $url .= '&filter_teams=' . urlencode(html_entity_decode(trim($this->request->get['filter_teams']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_players'])) {
            $url .= '&filter_players=' . urlencode(html_entity_decode(trim($this->request->get['filter_players']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_authors'])) {
            $url .= '&filter_authors=' . urlencode(html_entity_decode(trim($this->request->get['filter_authors']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_statuses'])) {
            $url .= '&filter_statuses=' . urlencode(html_entity_decode(trim($this->request->get['filter_statuses']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_time_range'])) {
            $url .= '&filter_time_range=' . (int)$this->request->get['filter_time_range'];
        }

        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_start']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_end']), ENT_QUOTES, 'UTF-8'));
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['sort_team'] = $this->url->link('nfl/report', 'token=' . $this->session->data['token'] . '&sort=tp.team_id' . $url, 'SSL');
        $data['sort_player'] = $this->url->link('nfl/report', 'token=' . $this->session->data['token'] . '&sort=tp.player_id' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('nfl/report', 'token=' . $this->session->data['token'] . '&sort=tp.status' . $url, 'SSL');
        $data['sort_posts'] = $this->url->link('nfl/report', 'token=' . $this->session->data['token'] . '&sort=posts' . $url, 'SSL');
        $data['sort_amount'] = $this->url->link('nfl/report', 'token=' . $this->session->data['token'] . '&sort=amount' . $url, 'SSL');
        $data['sort_contribute_sn'] = $this->url->link('nfl/report', 'token=' . $this->session->data['token'] . '&sort=tp.contribute_sn' . $url, 'SSL');
        $data['sort_auditor'] = $this->url->link('nfl/report', 'token=' . $this->session->data['token'] . '&sort=tp.user_id' . $url, 'SSL');
        $data['sort_author'] = $this->url->link('nfl/report', 'token=' . $this->session->data['token'] . '&sort=tp.author_id' . $url, 'SSL');
        $url = '';
        if (isset($this->request->get['filter_teams'])) {
            $url .= '&filter_teams=' . urlencode(html_entity_decode(trim($this->request->get['filter_teams']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_players'])) {
            $url .= '&filter_players=' . urlencode(html_entity_decode(trim($this->request->get['filter_players']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_authors'])) {
            $url .= '&filter_authors=' . urlencode(html_entity_decode(trim($this->request->get['filter_authors']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_statuses'])) {
            $url .= '&filter_statuses=' . urlencode(html_entity_decode(trim($this->request->get['filter_statuses']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_time_range'])) {
            $url .= '&filter_time_range=' . (int)$this->request->get['filter_time_range'];
        }

        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_start']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_end']), ENT_QUOTES, 'UTF-8'));
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
        
        $pagination->url = $this->url->link('nfl/report', 'token=' . $this->session->data['token']. $url . '&page={page}', 'SSL');
        
        $data['pagination'] = $pagination->render();
        
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

    	$data['filter_teams'] = $filter_teams;
        $data['filter_statuses'] = $filter_statuses;
        $data['filter_players'] = $filter_players;
        $data['filter_authors'] = $filter_authors;
        $data['filter_user_id'] = $filter_user_id;
        $data['filter_time_range'] = $filter_time_range;
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['filter_players_data'] = '';
        if(is_array($filter_players)){
            foreach ($filter_players as $player_id) {
                $_player = $this->model_nfl_player->getPlayer($player_id);
                if($_player){
                    $data['filter_players_data'][] = array(
                        'number' => $_player['number'],
                        'name' => $_player['name'],
                        'team_id' => $_player['team_id'],
                        'player_id' => $_player['player_id'],
                    );
                }
            }
        }
		
  		$data['all_teams'] = $this->model_nfl_team->getTeams();
        $data['all_users'] = $this->model_user_user->getUsers();
        $data['all_authors'] = $this->model_user_user->getAuthors();
        $data['post_statuses'] = $this->model_nfl_status->getStatuses();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/post/report.tpl', $data));
    }

    public function ajax_data(){
        $this->language->load('nfl/report');
        $action = isset($this->request->post['action']) ? strtolower(trim($this->request->post['action'])) : 'get';
        $this->load->model('nfl/report');
        switch ($action) {
            case 'statistics':
                $start_time = time();
                $n = $this->model_nfl_report->do_statistics();
                $result = 'Total: '.$n.' , In '.(int)(date('s',time() - $start_time)).'s.';
                die(json_encode(array('status'=>1,'msg'=>$result)));
        }
    }
}