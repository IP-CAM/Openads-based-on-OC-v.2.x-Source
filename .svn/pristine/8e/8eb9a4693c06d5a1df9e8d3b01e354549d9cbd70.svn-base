<?php 
class ControllerNflPlayer extends Controller {
    private $error = array();
  
    public function index() {
        $this->language->load('nfl/player');
        
        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
        $this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');

        $this->document->addStyle(TPL_JS.'fancybox/jquery.fancybox.css?v=2.1.5');
        $this->document->addScript(TPL_JS.'fancybox/jquery.fancybox.pack.js?v=2.1.5');
        $this->load->model('nfl/player');
        
        $this->getList();
    }

    public function add() {
        $this->language->load('nfl/player');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('nfl/player');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('nfl/player/add')) {
            $this->model_nfl_player->addPlayer($this->request->post);
            
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
            
            $this->response->redirect($this->url->link('nfl/player', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

	public function import_data(){
		$this->language->load('nfl/player');
		$filename = isset($this->request->files['filename']['name']) ? trim($this->request->files['filename']['name']) : false;
		$token = $this->session->data['token'];
		$this->load->model('nfl/player');
		$path_array = pathinfo($filename);
		$import_file = $this->request->files['filename']['tmp_name'];
		
		if(!isset($path_array['extension']) || !in_array($path_array['extension'], array('csv','xls'))){
			die(json_encode(array('status'=>0,'msg'=>'File Exception!')));
		}
		$importNum=$errorNum=0;
		$players_list = $player_key=$player=array();
        switch ($path_array['extension']) {
            case 'xls':
                $data = readExcel($import_file);
                $this->load->model('nfl/team');
                if(is_array($data)){
                    foreach ($data as $key => $item) {
                        if(!$key || empty($item[1])){continue;}
                        $team = isset($item[2]) ? trim($item[2]) : '';
                        $team_id = $this->model_nfl_team->getTeamIdByName($team);
                        $temp = array(
                            'number'    => isset($item[0]) ? (int) $item[0] : 0,
                            'name'      => isset($item[1]) ? trim($item[1]) : '',
                            'team_id'   => (int)$team_id,
                            'position'  => isset($item[3]) ? trim($item[3]) : '',
                            'age'       => isset($item[4]) ? (int)$item[4] : 0,
                            'height'    => isset($item[5]) ? trim($item[5]) : '',
                            'weight'    => isset($item[6]) ? trim($item[6]) : '',
                            'veteran'   => isset($item[7]) ? trim($item[7]) : '',
                            'school'    => isset($item[8]) ? trim($item[8]) : '',
                            'sort'      => isset($item[9]) && $item[9] == '是' ? 1 : 9,
                            'note'      => isset($item[10]) ? trim($item[10]) : '',
                            'status'    => 1
                        );
                        if($this->model_nfl_player->addPlayer($temp)){
                            $importNum++;
                        }else{
                            $errorNum++;
                        }

                    }
                }
                break;
            
            default:
                $fp=fopen($import_file,'r');
                while ($data = fgetcsv($fp)) {
                    $players_list[] = $data;
                }
                fclose($fp);
                for($j=0;$j<count($players_list['0']);$j++){
                    $player_key[$j]=$players_list['0'][$j];
                }
                
                array_shift($players_list);

                if(count($players_list)){
                    $num=count($players_list);
                    for($i=0;$i<$num;$i++){
                        for($j=0;$j<count($player_key);$j++){
                            $player[$player_key[$j]]=$players_list[$i][$j];
                        }
                        $result=$this->model_nfl_player->importPlayer($player);
                        if($result){
                            $importNum++;
                        }else{
                            $errorNum++;
                        }
                    }
                }
                
                break;
        }

		die(json_encode(array('status'=>1,'msg'=>"You have importted ".$importNum." Players. And there are ".$errorNum." error.")));
		break;
		
	}
	
    public function edit() {
        $this->language->load('nfl/player');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('nfl/player');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('nfl/player/edit')) {
            $this->model_nfl_player->editPlayer($this->request->get['player_id'], $this->request->post);
            
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
                    
            $this->response->redirect($this->url->link('nfl/player', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('nfl/player');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('nfl/player');
        
        if (isset($this->request->post['selected']) && $this->validateDelete('nfl/player/delete')) {
            foreach ($this->request->post['selected'] as $player_id) {
                $this->model_nfl_player->deletePlayer($player_id);
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

            $this->response->redirect($this->url->link('nfl/player', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');
        $filter_column = false;
        if (isset($this->request->get['filter_number'])) {
            $filter_number = $this->request->get['filter_number'];
            $filter_column = true;
        } else {
            $filter_number = null;
        }

        if (isset($this->request->get['filter_player_id'])) {
            $filter_player_id = $this->request->get['filter_player_id'];
            $filter_column = true;
        } else {
            $filter_player_id = null;
        }
        if (isset($this->request->get['filter_team_id'])) {
            $filter_team_id = $this->request->get['filter_team_id'];
            $filter_column = true;
        } else {
            $filter_team_id = null;
        }
        if (isset($this->request->get['filter_position'])) {
            $filter_position = $this->request->get['filter_position'];
            $filter_column = true;
        } else {
            $filter_position = null;
        }
        if (isset($this->request->get['filter_birthday'])) {
            $filter_birthday = $this->request->get['filter_birthday'];
            $filter_column = true;
        } else {
            $filter_birthday = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
            $filter_column = true;
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.sort';
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
        if (isset($this->request->get['filter_number'])) {
            $url .= '&filter_number=' . (int)$this->request->get['filter_number'];
        }
        if (isset($this->request->get['filter_player_id'])) {
            $url .= '&filter_player_id=' . urlencode(html_entity_decode($this->request->get['filter_player_id'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_team_id'])) {
            $url .= '&filter_team_id=' . (int)$this->request->get['filter_team_id'];
        }
        if (isset($this->request->get['filter_position'])) {
            $url .= '&filter_position=' . urlencode(html_entity_decode($this->request->get['filter_position'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_birthday'])) {
            $url .= '&filter_birthday=' . urlencode(html_entity_decode($this->request->get['filter_birthday'], ENT_QUOTES, 'UTF-8'));
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
            'href' => $this->url->link('nfl/player', 'token=' . $this->session->data['token'] , 'SSL')
        );
    
        $data['add'] = $this->url->link('nfl/player/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('nfl/player/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    
        $data['players'] = array();

        $filter_data = array(
            'filter_number'     => $filter_number,
            'filter_player_id'       => $filter_player_id,
            'filter_team_id'    => $filter_team_id,
            'filter_position'   => $filter_position,
            'filter_birthday'   => $filter_birthday,
            'filter_status'     => $filter_status,
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );
        $total = $this->model_nfl_player->getTotalPlayers($filter_data);
        
        $results = $this->model_nfl_player->getPlayers($filter_data);

        foreach ($results as $result) {
                   
            $data['players'][] = array(
                'player_id'     => $result['player_id'],
                'team_id'       => $result['team_id'],
                'team_sn'       => $result['team_sn'],
                'name'          => $result['name'],
                'number'        => $result['number'], 
                'team'          => $result['name_en'].'<br>'.$result['team_sn'].' '.$result['name_cn'],
                'flag'          => (empty($result['flag']) || !file_exists($result['flag'])) ? '../asset/image/nfl/nfl.png' :$result['flag'],
                'avatar'        => (empty($result['avatar']) || !file_exists($result['avatar'])) ? '../asset/image/nfl/player.png' :$result['avatar'],
                'position'      => $result['position'],
                'height'        => $result['height'],
                'weight'        => $result['weight'],
                'birthday'      => $result['birthday'],
                'veteran'       => $result['veteran'],
                'status'        => $result['status'],
                'status_text'   => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'sort'          => $result['sort'],
                'edit'          => $this->url->link('nfl/player/edit', 'token=' . $this->session->data['token'] . '&player_id=' . $result['player_id'] . $url, 'SSL')
            );      
        }
    
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['text_info_number'] = $this->language->get('text_info_number');
        $data['text_info_hw']       = $this->language->get('text_info_hw');
        $data['text_info_age']       = $this->language->get('text_info_age');
        $data['text_info_birthday'] = $this->language->get('text_info_birthday');
        $data['text_info_school']   = $this->language->get('text_info_school');
        $data['text_info_position'] = $this->language->get('text_info_position');
        $data['text_info_veteran']  = $this->language->get('text_info_veteran');

        $data['entry_post_text'] = $this->language->get('entry_post_text');
        $data['entry_post_img'] = $this->language->get('entry_post_img');
        $data['entry_post_gender'] = $this->language->get('entry_post_gender');
        $data['entry_post_match'] = $this->language->get('entry_post_match');
        $data['entry_note'] = $this->language->get('entry_note');
        $data['entry_expired'] = $this->language->get('entry_expired');

        $data['error_post'] = $this->language->get('error_post');
        $data['error_post_text'] = $this->language->get('error_post_text');

        $data['column_name'] = $this->language->get('column_name');
        $data['column_number'] = $this->language->get('column_number');
        $data['column_team'] = $this->language->get('column_team');
        $data['column_avatar'] = $this->language->get('column_avatar');
        $data['column_position'] = $this->language->get('column_position');
        $data['column_height'] = $this->language->get('column_height');
        $data['column_weight'] = $this->language->get('column_weight');
        $data['column_veteran'] = $this->language->get('column_veteran');
        $data['column_birthday'] = $this->language->get('column_birthday');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_sort'] = $this->language->get('column_sort');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_add'] = $this->language->get('button_add');        
        $data['button_edit'] = $this->language->get('button_edit');        
        $data['button_post'] = $this->language->get('button_post');        
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_import'] = $this->language->get('button_import');
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
        if (isset($this->request->get['filter_number'])) {
            $url .= '&filter_number=' . (int)$this->request->get['filter_number'];
        }
        if (isset($this->request->get['filter_player_id'])) {
            $url .= '&filter_player_id=' . urlencode(html_entity_decode($this->request->get['filter_player_id'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_team_id'])) {
            $url .= '&filter_team_id=' . (int)$this->request->get['filter_team_id'];
        }
        if (isset($this->request->get['filter_position'])) {
            $url .= '&filter_position=' . urlencode(html_entity_decode($this->request->get['filter_position'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_birthday'])) {
            $url .= '&filter_birthday=' . urlencode(html_entity_decode($this->request->get['filter_birthday'], ENT_QUOTES, 'UTF-8'));
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
                    
        $data['sort_name'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=p.name' . $url, 'SSL');
        $data['sort_number'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=p.number' . $url, 'SSL');
        $data['sort_team'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=team' . $url, 'SSL');
        $data['sort_position'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=p.position' . $url, 'SSL');
        $data['sort_weight'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=p.weight' . $url, 'SSL');
        $data['sort_height'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=p.height' . $url, 'SSL');
        $data['sort_birthday'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=p.birthday' . $url, 'SSL');
        $data['sort_veteran'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=p.veteran' . $url, 'SSL');
        $data['sort_sort'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=p.sort' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');

        $url = '';
        if (isset($this->request->get['filter_number'])) {
            $url .= '&filter_number=' . (int)$this->request->get['filter_number'];
        }
        if (isset($this->request->get['filter_player_id'])) {
            $url .= '&filter_player_id=' . urlencode(html_entity_decode($this->request->get['filter_player_id'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_team_id'])) {
            $url .= '&filter_team_id=' . (int)$this->request->get['filter_team_id'];
        }
        if (isset($this->request->get['filter_position'])) {
            $url .= '&filter_position=' . urlencode(html_entity_decode($this->request->get['filter_position'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_birthday'])) {
            $url .= '&filter_birthday=' . urlencode(html_entity_decode($this->request->get['filter_birthday'], ENT_QUOTES, 'UTF-8'));
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
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));
        
        $data['filter_player_id'] = $filter_player_id;
        $data['filter_number'] = $filter_number;
        $data['filter_position'] = $filter_position;
        $data['filter_birthday'] = $filter_birthday;
        $data['filter_status'] = $filter_status;
        $data['filter_team_id'] = $filter_team_id;
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['token'] = $this->session->data['token'];
        $data['filter_column'] = $filter_column ;

        $this->load->model('nfl/team');
        $data['teams'] = $this->model_nfl_team->getTeams();
        $this->load->model('nfl/match');
        $data['matches']=$this->model_nfl_match->getMatches();
        $this->load->model('nfl/player');
        $data['gender']=$this->model_nfl_player->getOptionsByType('gender');
        $data['filter_player'] = '' ; 
        if($filter_player_id){
            $player = $this->model_nfl_player->getPlayer($filter_player_id);
            $data['filter_player'] = empty($player['name']) ? '' : $player['name'].' #'.$player['number'];
        }
        
        if(in_array($this->user->getId(), $this->config->get("sns_group_admin"))){
            $data['admin_group'] = true;
        }else{
            $data['admin_group'] = false;
        }

        if(in_array($this->user->getId(), $this->config->get("sns_group_promotion"))){
            $data['promotion_group'] = false;// true;
        }else{
            $data['promotion_group'] = false;
        }

        if(in_array($this->user->getId(), array_merge($this->config->get("sns_group_admin"),$this->config->get("sns_group_market")))){
            $data['bulk'] = true;
        }else{
            $data['bulk'] = false;
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/player_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_form'] = !isset($this->request->get['player_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
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
        
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_number'] = $this->language->get('entry_number');
        $data['entry_avatar'] = $this->language->get('entry_avatar');
        $data['entry_team'] = $this->language->get('entry_team');
        $data['entry_position'] = $this->language->get('entry_position');
        $data['entry_height'] = $this->language->get('entry_height');
        $data['entry_weight'] = $this->language->get('entry_weight');
        $data['entry_veteran'] = $this->language->get('entry_veteran');
        $data['entry_school'] = $this->language->get('entry_school');
        $data['entry_birthday'] = $this->language->get('entry_birthday');
        $data['entry_sort'] = $this->language->get('entry_sort');
        $data['entry_status'] = $this->language->get('entry_status');
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

        if (isset($this->error['number'])) {
            $data['error_number'] = $this->error['number'];
        } else {
            $data['error_number'] = '';
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
            'href' => $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        
        if (!isset($this->request->get['player_id'])) {
            $data['action'] = $this->url->link('nfl/player/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('nfl/player/edit', 'token=' . $this->session->data['token'] . '&player_id=' . $this->request->get['player_id'] . $url, 'SSL');
        }
        
        $data['cancel'] = $this->url->link('nfl/player', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['player_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $player_info = $this->model_nfl_player->getPlayer($this->request->get['player_id']);
        }

        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($player_info['name'])) {
            $data['name'] = $player_info['name'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['number'])) {
            $data['number'] = $this->request->post['number'];
        } elseif (!empty($player_info['number'])) {
            $data['number'] = $player_info['number'];
        } else {
            $data['number'] = '';
        }

        if (isset($this->request->post['avatar'])) {
            $data['avatar'] = $this->request->post['avatar'];
        } elseif (!empty($player_info['avatar'])) {
            $data['avatar'] = $player_info['avatar'];
        } else {
            $data['avatar'] = '';
        }

        if (isset($this->request->post['note'])) {
            $data['note'] = $this->request->post['note'];
        } elseif (!empty($player_info['note'])) {
            $data['note'] = $player_info['note'];
        } else {
            $data['note'] = '';
        }

        if (isset($this->request->post['team_id'])) {
            $data['team_id'] = $this->request->post['team_id'];
        } elseif (!empty($player_info['team_id'])) {
            $data['team_id'] = $player_info['team_id'];
        } else {
            $data['team_id'] = '';
        }

        if (isset($this->request->post['position'])) {
            $data['position'] = $this->request->post['position'];
        } elseif (!empty($player_info['position'])) {
            $data['position'] = $player_info['position'];
        } else {
            $data['position'] = '';
        }
        
        if (isset($this->request->post['height'])) {
            $data['height'] = $this->request->post['height'];
        } elseif (!empty($player_info['height'])) {
            $data['height'] = $player_info['height'];
        } else {
            $data['height'] = '';
        }

        if (isset($this->request->post['weight'])) {
            $data['weight'] = $this->request->post['weight'];
        } elseif (!empty($player_info['weight'])) {
            $data['weight'] = $player_info['weight'];
        } else {
            $data['weight'] = '';
        }

        if (isset($this->request->post['birthday'])) {
            $data['birthday'] = $this->request->post['birthday'];
        } elseif ((int)$player_info['birthday']) {
            $data['birthday'] = date('Y-m-d',strtotime($player_info['birthday']));
        } else {
            $data['birthday'] = date('Y-m-d');
        }

        if (isset($this->request->post['veteran'])) {
            $data['veteran'] = $this->request->post['veteran'];
        } elseif (!empty($player_info['veteran'])) {
            $data['veteran'] = $player_info['veteran'];
        } else {
            $data['veteran'] = '';
        }

        if (isset($this->request->post['school'])) {
            $data['school'] = $this->request->post['school'];
        } elseif (!empty($player_info['school'])) {
            $data['school'] = $player_info['school'];
        } else {
            $data['school'] = '';
        }

        if (isset($this->request->post['sort'])) {
            $data['sort'] = $this->request->post['sort'];
        } elseif (isset($player_info['sort'])) {
            $data['sort'] = $player_info['sort'];
        } else {
            $data['sort'] = 1;
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (isset($player_info['status'])) {
            $data['status'] = $player_info['status'];
        } else {
            $data['status'] = 1;
        }

        $this->load->model('nfl/team');
        $data['teams'] = $this->model_nfl_team->getTeams();
        $data['token'] = $this->session->data['token'];
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/player_form.tpl', $data));
    }

    public function detail(){
        $player_id = isset($this->request->get['player_id']) ? (int)$this->request->get['player_id'] : false;
        if(!$player_id){
            die(json_encode(array('status'=>0,'msg'=>'Exception')));
        }
        $this->load->model('tool/image');
        $this->load->model('nfl/player');
        $result = $this->model_nfl_player->getPlayer($player_id);
        if($result){
            if(empty($result['avatar']) || !file_exists($result['avatar'])){
                $result['avatar'] = '../asset/image/nfl/player.png';
            }
            die(json_encode(array('status'=>1,'data'=>$result)));
        }
        die(json_encode(array('status'=>0,'msg'=>'No Result')));
    }

    public function post(){
        
        $team_id = isset($this->request->post['team_id']) ? (int)$this->request->post['team_id'] : false;
        $player_id = isset($this->request->post['player_id']) ? (int)$this->request->post['player_id'] : false;
        $gender_id = isset($this->request->post['gender_id']) ? (int)$this->request->post['gender_id'] : false;
        $match_id = isset($this->request->post['match_id']) ? (int)$this->request->post['match_id'] : false;
        $expired = !empty($this->request->post['expired']) ? htmlspecialchars_decode($this->request->post['expired']) : false;
        $content = !empty($this->request->post['content']) ? htmlspecialchars_decode($this->request->post['content']) : false;
        $note = !empty($this->request->post['note']) ? htmlspecialchars_decode($this->request->post['note']) : false;
        
        $this->language->load('nfl/player');

        if($content === false){
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_post_text'))));
        }
        if(!(int)$this->user->getAuthorId()){
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_author'))));
        }
        $this->load->model('nfl/player');
        $team = $this->model_nfl_player->getTeam($team_id);
        if(!isset($team['team_id']) || !$team['status'] ){
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_team'))));
        }
        if($player_id){
            $player = $this->model_nfl_player->getPlayer($player_id);
            if(!isset($player['player_id']) || !$player['status'] ){
                die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_player'))));
            }
        }
        $precode = $team['team_sn'].$this->model_nfl_player->getOptionValue($gender_id).'01'.$this->user->getAuthorId()."S";
        if(strlen($precode)!=10){
            die(json_encode(array('status'=>0,'msg'=>$precode.$this->language->get('error_post'))));
        }
        if($note){
            $note = json_encode(array(
                array(
                    'mode'      => 'author',
                    'operator'  => $this->user->getNickName(),
                    'team_id'   => $this->user->getId(),
                    'msg'       => $note,
                    'time'      => time()
                )
            ));
        }  
        $data = array(
            'match_id'  => $match_id,
            'player_id' => $player_id,
            'team_id'   => $team_id,
            'gender_id' => $gender_id,
            'precode'   => $precode,
            'note'      => $note,
            'content'   => $content,
            'expired'   => $expired,
        );
        if($this->model_nfl_player->postContribute($data)){
            die(json_encode(array('status'=>1,'msg'=>$this->language->get('text_success_post'))));
        }
        die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_post'))));
    }
    
    protected function validateForm($route) {
        if (!$this->user->hasPermission('modify', $route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if (!(int)$this->request->post['number']) {
            $this->error['number'] = $this->language->get('error_number');
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

    public function autocomplete() {
        $json = array();
        
        if (isset($this->request->get['filter_name'])) {
            $this->load->model('nfl/player');
            
            $data = array(
                'filter_name' => $this->request->get['filter_name'],
                'start'       => 0,
                'limit'       => 20
            );
        
            $results = $this->model_nfl_player->getPlayers($data);
            
            foreach ($results as $result) {
                $json[] = array(
                    'player_id' => $result['player_id'], 
                    'team_id'   => $result['team_id'],                    
                    'name'      => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')).' #'.$result['number'],
                    'team'      => html_entity_decode($result['team_sn'].' '.$result['name_en'].' '.$result['name_cn'], ENT_QUOTES, 'UTF-8'),
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