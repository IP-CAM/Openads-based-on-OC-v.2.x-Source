<?php  
class ControllerNflPostSchedule extends Controller {
    public function index() {
        $this->language->load('nfl/post_schedule');
        $this->load->model('nfl/post_schedule');
        $this->load->model('tool/image');

        $this->document->setTitle($this->language->get('heading_title'));
        $this->data['heading_title'] =$this->language->get('heading_title');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
        ); 

        $this->data['breadcrumbs'][] = array(           
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('nfl/post_schedule', '', 'SSL'),
            'separator' => $this->language->get('text_separator')
        );
        $this->data['text_no_result'] = $this->language->get('text_no_result');
        $this->data['title_post'] = $this->language->get('title_post');

        $this->data['text_date'] = $this->language->get('text_date');
        $this->data['text_team'] = $this->language->get('text_team');
        $this->data['text_info_number'] = $this->language->get('text_info_number');
        $this->data['text_info_hw']       = $this->language->get('text_info_hw');
        $this->data['text_info_age']       = $this->language->get('text_info_age');
        $this->data['text_info_birthday'] = $this->language->get('text_info_birthday');
        $this->data['text_info_school']   = $this->language->get('text_info_school');
        $this->data['text_info_position'] = $this->language->get('text_info_position');
        $this->data['text_info_veteran']  = $this->language->get('text_info_veteran');
        $this->data['text_info_location']  = $this->language->get('text_info_location');
        $this->data['text_info_match']  = $this->language->get('text_info_match');
        $this->data['item_team'] = $this->language->get('item_team');
        $this->data['item_posted'] = $this->language->get('item_posted');
        $this->data['item_partition'] = $this->language->get('item_partition');
        $this->data['item_home_court'] = $this->language->get('item_home_court');
        $this->data['item_status'] = $this->language->get('item_status');
        $this->data['item_trainer'] = $this->language->get('item_trainer');
        $this->data['item_short'] = $this->language->get('item_short');
  
        $this->data['entry_post_text'] = $this->language->get('entry_post_text');
        $this->data['entry_post_img'] = $this->language->get('entry_post_img');
        $this->data['entry_post_gender'] = $this->language->get('entry_post_gender');
        $this->data['entry_post_match'] = $this->language->get('entry_post_match');
        $this->data['entry_note'] = $this->language->get('entry_note');
        $this->data['entry_expired'] = $this->language->get('entry_expired');

        $this->data['button_filter'] = $this->language->get('button_filter');
        $this->data['button_submit'] = $this->language->get('button_submit');
        $this->data['button_reset'] = $this->language->get('button_reset');
        $this->data['button_close'] = $this->language->get('button_close');
        $this->data['button_post'] = $this->language->get('button_post');
        
        $this->data['button_my_posts'] = $this->language->get('button_my_posts');
        $this->data['my_posts'] =$this->url->link('account/schedule', '', 'SSL');
        $this->data['error_post'] = $this->language->get('error_post');
        $this->data['error_post_text'] = $this->language->get('error_post_text');

        $this->load->model('nfl/team');
        $this->data['all_teams']=$this->model_nfl_team->getTeams();
        $this->data['all_matches']=$this->model_nfl_team->getMatches();
        $this->data['all_gender']=$this->model_nfl_team->getContributeConfigsByType('gender');

        $filter_team = isset($this->request->get['filter_team']) ? $this->request->get['filter_team'] : null;
        $filter_date = isset($this->request->get['filter_date']) ? $this->request->get['filter_date'] : null;

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        $this->data['teams'] = array();
        $data = array(
            'filter_date'   => $filter_date,
            'filter_team'   => $filter_team,
            'start'         => ($page - 1) * 1000,
            'limit'         => 1000
        );
        
        $total = $this->model_nfl_post_schedule->getTotalSchedules($data);
        $results = $this->model_nfl_post_schedule->getSchedules($data);
        if($results){
            foreach ($results as $result){
                $home_team = $this->model_nfl_team->getTeam($result['home_team_id']);
                if(empty($home_team['flag']) || !file_exists('.'.substr($home_team['flag'], strpos($home_team['flag'],'/')))){
                    $home_team['flag'] = $this->model_tool_image->resize('data/nfl/nfl.jpg',150,150);
                }
                $road_team = $this->model_nfl_team->getTeam($result['road_team_id']);
                if(empty($road_team['flag']) || !file_exists('.'.substr($road_team['flag'], strpos($road_team['flag'],'/')))){
                    $road_team['flag'] = $this->model_tool_image->resize('data/nfl/nfl.jpg',150,150);
                }
                $players = $this->model_nfl_post_schedule->getPlayersByScheduleId($result['schedule_id']);
                if($players){
                    foreach ($players as $k => $item) {
                        if(empty($item['avatar']) || !file_exists('.'.substr($item['avatar'], strpos($item['avatar'],'/')))){
                            $players[$k]['avatar'] = $this->model_tool_image->resize('data/nfl/player.png',100,100);
                        }
                    }
                }
                $this->data['teams'][] = array(
                    'schedule_id'   => $result['schedule_id'],
                    'home_team_id'  => $result['home_team_id'],
                    'road_team_id'  => $result['road_team_id'],
                    'home_team'     => $home_team,
                    'road_team'     => $road_team,
                    'match'         => $result['match'] ,
                    'match_id'      => $result['match_id'] ,
                    'location'      => $result['location'] ,
                    'date'          => date('Y-m-d',strtotime($result['date'])),
                    'time'          => date('H:i',strtotime($result['date'].' '.$result['time'])),
                    'players'       => $players,
                    'note'          => !empty($result['note']) ? html_entity_decode($result['note'],ENT_QUOTES, 'UTF-8') : '',
                    'total'         => !empty($result['schedule_id']) ? $this->model_nfl_post_schedule->getTotalPosts($result['schedule_id']) : 0,
                );
            }
            
        }

        $url = '';
        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . $this->request->get['filter_date'];
        }
        if (isset($this->request->get['filter_team'])) {
            $url .= '&filter_team=' . $this->request->get['filter_team'];
        }
        $pagination = new Pagination();
        $pagination->bootstrap = 3;
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = 1000;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('nfl/schedule'.$url, '&page={page}', 'SSL');
        
        $this->data['pagination'] = $pagination->render();

        $this->data['filter_date'] = $filter_date;
        $this->data['filter_team'] = $filter_team;

        $this->template = $this->config->get('config_template') . '/template/nfl/schedule.tpl';
        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'
        );
        $this->response->setOutput($this->render());
        
    }
    function info(){
        $schedule_id = isset($this->request->get['schedule_id']) ? (int)$this->request->get['schedule_id'] : false;
        if(!$schedule_id ){
            die(json_encode(array('status'=>0,'msg'=>'Exception')));
        }
        $this->load->model('nfl/schedule');
        $this->load->model('nfl/team');
        $this->load->model('tool/image');
        $result = $this->model_nfl_post_schedule->getSchedule($schedule_id);    
        
        if($result){
            $result['home'] = $this->model_nfl_team->getTeam($result['home_team_id']);
            if(empty($result['home']['flag']) || !file_exists('.'.substr($result['home']['flag'], strpos($result['home']['flag'],'/')))){
                $result['home']['flag'] = $this->model_tool_image->resize('data/nfl/nfl.jpg',80,80);
            }
            $result['road'] = $this->model_nfl_team->getTeam($result['road_team_id']);
            if(empty($result['road']['flag']) || !file_exists('.'.substr($result['road']['flag'], strpos($result['road']['flag'],'/')))){
                $result['road']['flag'] = $this->model_tool_image->resize('data/nfl/nfl.jpg',80,80);
            }
            $vs_img = "./image/data/nfl/vs/".$result['home']['team_sn'].'-vs-'.$result['road']['team_sn'].'.png';
            
            $home_flag = '.'.substr($result['home']['flag'], strpos($result['home']['flag'],'/'));
            $road_flag = '.'.substr($result['road']['flag'], strpos($result['road']['flag'],'/'));
            
            $vs = createVSImage($vs_img,$home_flag,$road_flag);
            $result['vs'] = $vs === false ? $this->model_tool_image->resize('data/nfl/nfl.jpg',120,120) : $vs;

            die(json_encode(array('status'=>1,'data'=>$result)));
        }
        die(json_encode(array('status'=>0,'msg'=>'No Result')));
    }
    
    function post(){
        $content = !empty($this->request->post['content']) ? htmlspecialchars_decode($this->request->post['content']) : false;
        $schedule_id = isset($this->request->post['schedule_id']) ? (int)$this->request->post['schedule_id'] : false;
        $team_id = isset($this->request->post['team_id']) ? (int)$this->request->post['team_id'] : false;
        $player_id = isset($this->request->post['player_id']) ? (int)$this->request->post['player_id'] : false;
        $gender_id = isset($this->request->post['gender_id']) ? (int)$this->request->post['gender_id'] : false;
        $match_id = isset($this->request->post['match_id']) ? (int)$this->request->post['match_id'] : false;
        $expired = !empty($this->request->post['expired']) ? htmlspecialchars_decode($this->request->post['expired']) : false;
        $note = !empty($this->request->post['note']) ? htmlspecialchars_decode($this->request->post['note']) : false;
        
        $this->language->load('nfl/post_schedule');

        if($content === false){
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_post_text'))));
        }

        $this->load->model('nfl/post_schedule');
        $team = $this->model_nfl_post_schedule->getSchedule($schedule_id);
        if(!isset($team['schedule_id']) ){
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_schedule'))));
        }
        $this->load->model('nfl/team');
        $team = $this->model_nfl_team->getTeam($team_id);
        if(!isset($team['team_id']) ){
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_team'))));
        }
        if($player_id){
            $player = $this->model_nfl_post_schedule->getPlayer($player_id);
            if(!isset($player['player_id']) || !$player['status'] ){
                die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_player'))));
            }
        }
        $precode = $team['team_sn'].$this->model_nfl_post_schedule->getConfigValue($gender_id).'01'.$this->customer->getAuthorId()."S";
        if(strlen($precode)!=10){
            die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_post'))));
        }
        if($note){
            $note = json_encode(array(array('mode'=>'customer','operator'=>$this->customer->getFirstName().' '.$this->customer->getLastName(),'schedule_id'=>$this->customer->getId(),'msg'=>$note,'time'=>time())));
        }  
        $data = array(
            'match_id'  => $match_id,
            'team_id'   => $team_id,
            'player_id' => $player_id,
            'schedule_id'   => $schedule_id,
            'gender_id' => $gender_id,
            'precode'   => $precode,
            'note'      => $note,
            'content'   => $content,
            'expired'   => $expired,
        );
        if($this->model_nfl_post_schedule->postContribute($data)){
            die(json_encode(array('status'=>1,'msg'=>$this->language->get('success_post'))));
        }
        die(json_encode(array('status'=>0,'msg'=>$this->language->get('error_post'))));
    }


}