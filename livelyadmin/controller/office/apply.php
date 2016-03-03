<?php
class ControllerOfficeApply extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('office/apply');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('office/apply');

        $data['token'] = $this->session->data['token'];
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('office/apply', 'token=' . $this->session->data['token'] , 'SSL')
        );

        $week_value = isset($this->request->get['week']) ? (int)$this->request->get['week'] : date('W');

        $week = getWeekDate($week_value);
    
        $data['this_week'] = $this->url->link('office/apply','token='.$this->session->data['token'],'SSL');
        $data['weekday'] = dayList($week['begin'],$week['end']);
        $this->load->model('office/time');

        $data['daytime'] = $this->model_office_time->getTimes();
        $data['edit'] =  $week_value >= date('W');
        $data['current'] = array(
            'week' => 'Week:'.$week_value,
            'text' => $week['begin'].' - '.$week['end'],
        );
        $data['applies'] = array();
        foreach ($data['daytime'] as $item) {     
            $tmp = array();       
            foreach ($data['weekday'] as $day) {                
                $apply = $this->model_office_apply->getApplyByDay($day,$item['time_id']);
                if(!empty($apply['apply_id'])){
                    $apply['users'] = $this->model_office_apply->getApplicantsByApplyId($apply['apply_id']);
                }else{
                    $field = array(
                        'date'      => $day,
                        'time_id'   => $item['time_id'],                        
                    );
                    $this->model_office_apply->addApply($field);
                    $apply = $this->model_office_apply->getApplyByDay($day,$item['time_id']);
                    $apply['users'] = array();
                }

                $tmp[date('Y-m-d',strtotime($day)).":".zeroFull($item['time_id'])] = $apply ;
            }
            $item['apply'] = $tmp;
            $item['price'] = $this->currency->format($item['price']);
            $data['applies'][] = $item;
        }
        $prev_week = $week_value -1;
        $prevs = $this->model_office_apply->getTotalAppliesByWeek($prev_week);
        if($prevs){
            $prev = getWeekDate($prev_week);
            $data['prev']  = array(
                'week' => 'Prev Week:'.$prev_week,
                'text' => $prev['begin'].' - '.$prev['end'],
                'href' => $this->url->link('office/apply','token='.$this->session->data['token'].'&week='.$prev_week,'SSL')
            );
        }else{
            $data['prev'] = false;
        }

        $next_week = $week_value +1;
        $next = getWeekDate($next_week);       
        $data['next']  = array(
            'week' => 'Next Week:'.$next_week,
            'text' => $next['begin'].' - '.$next['end'],
            'href' => $this->url->link('office/apply','token='.$this->session->data['token'].'&week='.$next_week,'SSL')
        );

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_this_week'] = $this->language->get('text_this_week');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_cancel'] = $this->language->get('button_cancel');

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

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('office/apply.tpl', $data));
    }
    
    public function getUsers(){        
        
        $this->load->model('office/apply');
        $apply_id = isset($this->request->get['apply_id']) ? (int)$this->request->get['apply_id'] : false;
        $apply_sn = isset($this->request->get['apply_sn']) ? trim($this->request->get['apply_sn']) : false;
        
        $result = $ignore = array();
        if($apply_id){
            $applicants = $this->model_office_apply->getApplicantsByApplyId($apply_id);
            foreach ($applicants as $item) {
                if($item['office_id'])
                $ignore[] = $item['office_id'];
            }
        }else if(strlen($apply_sn)==13){
            $key = explode(":", $apply_sn);
            
            if(is_array($key)){
                $date = isset($key[0]) ? date('Y-m-d',strtotime($key[0])) : false;
                $time_id = isset($key[1]) ? (int)$key[1] : 0;
                $apply = $this->model_office_apply->getApplyByDay($date,$time_id);                
                if(!$apply){
                    $tmp = array(
                        'date'      => date('Y-m-d',strtotime($date)),
                        'time_id'   => $time_id,                        
                    );
                    
                    $apply_id = $this->model_office_apply->addApply($tmp);
                }
            }
        }
        $this->load->model('office/user');
        $users = $this->model_office_user->getUsers();
        foreach ($users as $user) {
            if(in_array($user['office_id'], $ignore)){
                continue;
            }
            $user['nickname'] = lively_truncate($user['nickname'],10);
            $result[] = $user;
        }
        $this->response->setOutput(json_encode(array('apply'=>$apply_id,'data'=>$result)));
    }

    public function remove(){
        $json = array('status'=>0,'msg'=>$this->language->get('text_exception'));
        $apply_id = isset($this->request->get['apply_id']) ? (int)$this->request->get['apply_id'] : false;
        $office_id = isset($this->request->get['office_id']) ? (int)$this->request->get['office_id'] : false;
        $this->load->model('office/apply');
        if($this->model_office_apply->deleteApplicant($apply_id,$office_id)){
            $json = array('status'=>1,'msg'=>$this->language->get('text_success_remove'));
        }
        $this->response->setOutput(json_encode($json));
    }

    public function insert(){
        $json = array('status'=>0,'msg'=>$this->language->get('text_exception'));
        $apply_id = isset($this->request->get['apply_id']) ? (int)$this->request->get['apply_id'] : false;
        $office_id = isset($this->request->get['office_id']) ? (int)$this->request->get['office_id'] : false;
        $this->load->model('office/apply');
        
        if($this->model_office_apply->addApplicant($apply_id,$office_id)){
            $json = array('status'=>1);
        }
        $this->response->setOutput(json_encode($json));
    }

    public function history(){

    }
}