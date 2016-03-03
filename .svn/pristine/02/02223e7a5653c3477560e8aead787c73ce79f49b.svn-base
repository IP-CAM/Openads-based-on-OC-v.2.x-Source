<?php 
class ControllerNflTeam extends Controller {
	private $error = array();
  
	public function index() {
		$this->language->load('nfl/team');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('nfl/team');
		
		$this->getList();
	}

	public function add() {
		$this->language->load('nfl/team');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('nfl/team');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('nfl/team/add')) {
			$this->model_nfl_team->addTeam($this->request->post);
			
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
			
			$this->response->redirect($this->url->link('nfl/team', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('nfl/team');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('nfl/team');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('nfl/team/edit')) {
			$this->model_nfl_team->editTeam($this->request->get['team_id'], $this->request->post);
			
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
					
			$this->response->redirect($this->url->link('nfl/team', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('nfl/team');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('nfl/team');
		
		if (isset($this->request->post['selected']) && $this->validateDelete('nfl/team/delete')) {
			foreach ($this->request->post['selected'] as $team_id) {
				$this->model_nfl_team->deleteTeam($team_id);
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

			$this->response->redirect($this->url->link('nfl/team', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
        $this->document->addStyle(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.css');
        $this->document->addScript(TPL_JS.'bootstrap/ui/custom-theme/jquery-ui-1.10.3.custom.js');		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'team_sn';
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
            'href' => $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

		$data['add'] = $this->url->link('nfl/team/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('nfl/team/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->load->model('user/user');
		$data['all_teams'] = array();
		$limit = 40;
		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		
		$total = $this->model_nfl_team->getTotalTeams();
		
		$results = $this->model_nfl_team->getTeams($filter_data);

		foreach ($results as $result) {

			$users = array();
			$_users = !empty($result['group']) ? explode(",", $result['group']) : ''; 
			if($_users){
				foreach ($_users as $_user_id) {
					$_user = $this->model_user_user->getUser($_user_id);
					$users[] = $_user['lastname'].$_user['firstname'];
				}
			}	
			
			$data['all_teams'][] = array(
				'team_id' 	=> $result['team_id'],
				'team_sn' 	=> $result['team_sn'],
				'name_en'   => $result['name_en'], 
				'name_cn'   => $result['name_cn'],
				'flag'   	=> (empty($result['flag']) || !file_exists($result['flag'])) ? '../asset/image/nfl/nfl.png' :$result['flag'],
				'partition' => ucfirst($result['partition']),
			    'group'		=> implode(" , ", $users),
				'short'   => $result['short'],
				'nickname'   => $result['nickname'],
				'status'    => $result['status'],				
				'status_text'  	=> $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'sort'  	=> $result['sort'],
				'edit'          => $this->url->link('nfl/team/edit', 'token=' . $this->session->data['token'] . '&team_id=' . $result['team_id'] . $url, 'SSL')
			);		
			
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
    	$data['column_sn'] = $this->language->get('column_sn');
    	$data['column_group'] = $this->language->get('column_group');
    	$data['column_flag'] = $this->language->get('column_flag');
    	$data['column_short'] = $this->language->get('column_short');
    	$data['column_nickname'] = $this->language->get('column_nickname');
    	$data['column_partition'] = $this->language->get('column_partition');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_sort'] = $this->language->get('column_sort');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_import'] = $this->language->get('button_import');
		$data['button_post'] = $this->language->get('button_post');
		$data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');

        $data['entry_post_text'] = $this->language->get('entry_post_text');
        $data['entry_post_img'] = $this->language->get('entry_post_img');
        $data['entry_post_gender'] = $this->language->get('entry_post_gender');
        $data['entry_post_match'] = $this->language->get('entry_post_match');
        $data['entry_note'] = $this->language->get('entry_note');
        $data['entry_expired'] = $this->language->get('entry_expired');

        $data['error_post'] = $this->language->get('error_post');
        $data['error_post_text'] = $this->language->get('error_post_text');

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
					
		$data['sort_name_en'] = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . '&sort=nt.name_en' . $url, 'SSL');
		$data['sort_group'] = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . '&sort=nt.group' . $url, 'SSL');
		$data['sort_partition'] = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . '&sort=nt.partition' . $url, 'SSL');
		$data['sort_nickname'] = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . '&sort=nt.nickname' . $url, 'SSL');
		$data['sort_team_sn'] = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . '&sort=nt.team_sn' . $url, 'SSL');
		$data['sort_sort'] = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . '&sort=nt.sort' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . '&sort=nt.status' . $url, 'SSL');
		$data['sort_short'] = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . '&sort=nt.short' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
				
	    $data['token'] = $this->session->data['token'];
			 
		$pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->url = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));
		
        $data['teams'] = $this->model_nfl_team->getTeams();
        $this->load->model('nfl/player');
        $data['gender']=$this->model_nfl_player->getOptionsByType('gender');
        $this->load->model('nfl/match');
        $data['matches']=$this->model_nfl_match->getMatches();
        
		$data['sort'] = $sort;
		$data['order'] = $order;

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

        $this->response->setOutput($this->load->view('nfl/team_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form'] = !isset($this->request->get['team_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

    	$this->document->addScript(TPL_JS.'jquery.ajaxupload.js');
		$this->document->addScript(TPL_JS.'jquery.json.min.js');
		$this->document->addStyle(TPL_JS.'fancybox/jquery.fancybox.css?v=2.1.5');
        $this->document->addScript(TPL_JS.'fancybox/jquery.fancybox.pack.js?v=2.1.5');
		$this->document->addStyle(TPL_JS.'formvalidation/dist/css/formValidation.css');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/formValidation.js');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/framework/bootstrap.min.js');

    	$data['text_eastern'] = $this->language->get('text_eastern');
    	$data['text_western'] = $this->language->get('text_western');
    	$data['text_southern'] = $this->language->get('text_southern');
    	$data['text_northern'] = $this->language->get('text_northern');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_sn'] = $this->language->get('entry_sn');
		$data['entry_group'] = $this->language->get('entry_group');
		$data['entry_flag'] = $this->language->get('entry_flag');
		$data['entry_desc'] = $this->language->get('entry_desc');
		$data['entry_short'] = $this->language->get('entry_short');
		$data['entry_partition'] = $this->language->get('entry_partition');
		$data['entry_nickname'] = $this->language->get('entry_nickname');
		$data['entry_home_court'] = $this->language->get('entry_home_court');
		$data['entry_trainer'] = $this->language->get('entry_trainer');
		$data['entry_sort'] = $this->language->get('entry_sort');
		$data['entry_status'] = $this->language->get('entry_status');
		

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_upload'] = $this->language->get('button_upload');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['name_en'])) {
			$data['error_name_en'] = $this->error['name_en'];
		} else {
			$data['error_name_en'] = '';
		}

 		if (isset($this->error['sn'])) {
			$data['error_sn'] = $this->error['sn'];
		} else {
			$data['error_sn'] = '';
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
            'href' => $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
		
		if (!isset($this->request->get['team_id'])) {
			$data['action'] = $this->url->link('nfl/team/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('nfl/team/edit', 'token=' . $this->session->data['token'] . '&team_id=' . $this->request->get['team_id'] . $url, 'SSL');
		}
		
		$data['cancel'] = $this->url->link('nfl/team', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['team_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$team_info = $this->model_nfl_team->getTeam($this->request->get['team_id']);
		}

		if (isset($this->request->post['team_sn'])) {
			$data['team_sn'] = $this->request->post['team_sn'];
		} elseif (!empty($team_info['team_sn'])) {
			$data['team_sn'] = $team_info['team_sn'];
		} else {
			$data['team_sn'] = '';
		}

		if (isset($this->request->post['name_en'])) {
			$data['name_en'] = $this->request->post['name_en'];
		} elseif (!empty($team_info['name_en'])) {
			$data['name_en'] = $team_info['name_en'];
		} else {
			$data['name_en'] = '';
		}

		if (isset($this->request->post['name_cn'])) {
			$data['name_cn'] = $this->request->post['name_cn'];
		} elseif (!empty($team_info['name_cn'])) {
			$data['name_cn'] = $team_info['name_cn'];
		} else {
			$data['name_cn'] = '';
		}
		if (isset($this->request->post['flag'])) {
			$data['flag'] = $this->request->post['flag'];
		} elseif (!empty($team_info['flag'])) {
			$data['flag'] = $team_info['flag'];
		} else {
			$data['flag'] = '';
		}

		if (isset($this->request->post['group'])) {
			$data['group'] = $this->request->post['group'];
		} elseif (!empty($team_info['group'])) {
			$data['group'] = $team_info['group'];
		} else {
			$data['group'] = array();
		}

		if (isset($this->request->post['short'])) {
			$data['short'] = $this->request->post['short'];
		} elseif (!empty($team_info['short'])) {
			$data['short'] = $team_info['short'];
		} else {
			$data['short'] = '';
		}

		if (isset($this->request->post['desc'])) {
			$data['desc'] = $this->request->post['desc'];
		} elseif (!empty($team_info['desc'])) {
			$data['desc'] = $team_info['desc'];
		} else {
			$data['desc'] = '';
		}
		
		if (isset($this->request->post['partition'])) {
			$data['partition'] = $this->request->post['partition'];
		} elseif (!empty($team_info['partition'])) {
			$data['partition'] = $team_info['partition'];
		} else {
			$data['partition'] = '';
		}

		if (isset($this->request->post['nickname'])) {
			$data['nickname'] = $this->request->post['nickname'];
		} elseif (!empty($team_info['nickname'])) {
			$data['nickname'] = $team_info['nickname'];
		} else {
			$data['nickname'] = '';
		}

		if (isset($this->request->post['home_court'])) {
			$data['home_court'] = $this->request->post['home_court'];
		} elseif (!empty($team_info['home_court'])) {
			$data['home_court'] = $team_info['home_court'];
		} else {
			$data['home_court'] = '';
		}
		if (isset($this->request->post['trainer'])) {
			$data['trainer'] = $this->request->post['trainer'];
		} elseif (!empty($team_info['trainer'])) {
			$data['trainer'] = $team_info['trainer'];
		} else {
			$data['trainer'] = '';
		}

		if (isset($this->request->post['sort'])) {
			$data['sort'] = $this->request->post['sort'];
		} elseif (isset($team_info['sort'])) {
			$data['sort'] = $team_info['sort'];
		} else {
			$data['sort'] = 1;
		}

    	if (isset($this->request->post['status'])) {
      		$data['status'] = $this->request->post['status'];
    	} elseif (isset($team_info['status'])) {
			$data['status'] = $team_info['status'];
		} else {
      		$data['status'] = 1;
    	}
    	$this->load->model('user/user');
        $data['all_users'] = $this->model_user_user->getUsers(array('status'=>1)); 

        $data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('nfl/team_form.tpl', $data));
	}
	
	protected function validateForm($route) {
		if (!$this->user->hasPermission('modify', $route)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name_en']) < 3) || (utf8_strlen($this->request->post['name_en']) > 32)) {
			$this->error['name_en'] = $this->language->get('error_name_en');
		}

		if (utf8_strlen($this->request->post['team_sn']) < 2) {
			$this->error['sn'] = $this->language->get('error_sn');
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
    public function detail(){
        $team_id = isset($this->request->get['team_id']) ? (int)$this->request->get['team_id'] : false;
        if(!$team_id ){
            die(json_encode(array('status'=>0,'msg'=>'Exception')));
        }
        $this->load->model('nfl/team');
        $this->load->model('tool/image');
        $result = $this->model_nfl_team->getTeam($team_id);    
        
        if($result){
            if(empty($result['flag']) || !file_exists($result['flag'])){
                $result['flag'] = '../asset/image/nfl/nfl.png';
            }
            die(json_encode(array('status'=>1,'data'=>$result)));
        }
        die(json_encode(array('status'=>0,'msg'=>'No Result')));
    }
	public function autocomplete() {
		$json = array();
		if (isset($this->request->get['filter_name'])) {
			$this->load->model('nfl/team');
			$data = array(
				'filter_keyword'=> $this->request->get['filter_name'],
				'filter_status'	=> 1,
				'start'       	=> 0,
				'limit'       	=> 40
			);
			$results = $this->model_nfl_team->getTeams($data);
			foreach ($results as $result) {
				$json[] = array(
					'team_id' 	=> $result['team_id'], 
					'name'      => $result['team_sn'].' '.strip_tags(html_entity_decode($result['name_en'].' '.$result['name_cn'], ENT_QUOTES, 'UTF-8')),
					'value'    	=> $result['team_id']
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