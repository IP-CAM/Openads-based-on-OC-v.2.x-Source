<?php
class ControllerToolCron extends Controller {
    public function index() {

    	    ignore_user_abort(true);
            set_time_limit(0);

    	    $this->language->load('tool/cron');
            
    		$this->document->setTitle($this->language->get('heading_title'));
    		$data['heading_title'] = $this->language->get('heading_title');
    		
    		$token = $this->session->data['token'];
    		$data['breadcrumbs'] = array();
     		$data['breadcrumbs'][] = array(
         		'text'      => $this->language->get('text_home'),
  			    'href'      => $this->url->link('common/home', 'token=' . $token, 'SSL'),       		
        		'separator' => false
     		);
     		$data['breadcrumbs'][] = array(
         		'text'      => $this->language->get('heading_title'),
  			    'href'      => $this->url->link('tool/cron', 'token=' . $token, 'SSL'),
        		'separator' => ' :: '
     		);
 
    		$data['text_success'] = $this->language->get('text_success');
    		$data['text_interval'] = $this->language->get('text_interval');
    		$data['text_minutes'] = $this->language->get('text_minutes');
    		
    		$data['text_status'] = $this->language->get('text_status');
    		$data['text_status_stop'] = $this->language->get('text_status_stop');
    		$data['text_status_start'] = $this->language->get('text_status_start');
    		
    		$data['text_status_note'] = $this->language->get('text_status_note');
    		$data['button_start'] = $this->language->get('button_start');
    		$data['button_stop'] = $this->language->get('button_stop');
    	
    		    		
     		$this->load->model('tool/cron');
     		
    		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
    			
    			//如果提交start 动作
    			if(isset($this->request->post['start']) && isset($this->request->post['interval'])){
    				if($this->request->post['start']=='Start'){
	    						
	    				//更改interval
	    				$this->model_tool_cron->set_similar_text_interval((int)$this->request->post['interval']);

	    				$powerFlag=true;
	    				//已经在运行的，就不再启动新的，只有停止状态，才启动新的。  
	    				if(!$this->model_tool_cron->get_similar_text_status()){
	    					
	    					$this->model_tool_cron->similar_text_start();   					    					
	    					
	    					do{
	    						 $this->model_tool_cron->cron_log("Start new Tast to check Ads Similar Text");  
						         $this->similar_text();
						         $interval=60*(int)$this->model_tool_cron->get_similar_text_interval();
						         sleep($interval);
						         $powerFlag=$this->model_tool_cron->get_similar_text_status();
						         if(!$powerFlag){
						         	$this->model_tool_cron->cron_log("You stop running similar Text");  
						         }
						       }while ($powerFlag);
	    				}
    				}
    				
    			}else{
    				//没有输入interval，要提示输入
    				$data['error_interval']="You need to input Interval";
    			}
    			
    			//如果提交停止动作。
    			if(isset($this->request->post['stop']) && $this->request->post['stop']=='Stop'){
    				$this->model_tool_cron->similar_text_stop();
    				//$this->redirect($this->url->link('tool/cron', 'token=' . $this->session->data['token'] , 'SSL'));
    			}
    			

    		}
    		
    		if (isset($this->session->data['success'])) {
      			$data['success'] = $this->session->data['success'];
      			unset($this->session->data['success']);
    		} else {
    			  $data['success'] = '';
    		}
  		

        	if (isset($this->request->post['status'])) {
      			$data['status'] = $this->request->post['status'];
      			
    		}elseif($this->config->get("similar_text_power")) {
    			  $data['status'] = $this->config->get("similar_text_power");
    		}else{
    			$data['status']='3';
    		}
    		
            if (isset($this->request->post['interval'])) {
      			$data['similar_text_interval'] = $this->request->post['interval'];
      			
    		}elseif($this->config->get("similar_text_interval")) {
    			  $data['similar_text_interval'] = $this->config->get("similar_text_interval");
    		}else{
    			$data['similar_text_interval']=30;
    		}

  		
         	$data['action'] = $this->url->link('tool/cron', 'token=' . $this->session->data['token'] , 'SSL');
            $data['token']= $token;
      
         	$data['header'] = $this->load->controller('common/header');
		    $data['column_left'] = $this->load->controller('common/column_left');
		    $data['footer'] = $this->load->controller('common/footer');
		    $this->response->setOutput($this->load->view('tool/cron.tpl', $data));

  	
    }

    public function similar_text(){
  
    	set_time_limit(0);
		ignore_user_abort(true);
        
		$ads_contribute="advertise_post";
    	$ads_history="advertise_post_history";
    	$ads_content_history="advertise_content_history";
    	
		$ads_headline_similar_config_percent=$this->config->get('ad_similar_headline');
		$ads_content_similar_config_percent=$this->config->get('ad_similar_content');
		
		$robot_review_status='3';
		$reject_status='9';
		//$review_status='4';
		
    	$this->load->model('tool/cron');
 
    	$this->model_tool_cron->FrontSimilarTextAndTitle($ads_contribute,$ads_history,$ads_content_history,$ads_content_similar_config_percent,$ads_headline_similar_config_percent,$reject_status,$robot_review_status);
    	
    }
}