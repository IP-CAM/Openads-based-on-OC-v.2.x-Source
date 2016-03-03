<?php
class ModelServiceAdvertise extends Model {

	public function addAdvertise($data){
		// Advertise
		$fields = array(
			'from'			=> 'member',
			'website_id' 	=> $data['website_id'],
			'product_id' 	=> $data['product_id'],
			'target_url'	=> $data['target_url'],
			'note'			=> $data['note'],
			'customer_id'	=> $this->customer->getId(),
			'in_charge'		=> $this->customer->getInCharge(),
			'publish'		=> 1,
			'date_added'	=> date('Y-m-d H:i:s'),
			'date_modified'	=> date('Y-m-d H:i:s')
		);
		if(isset($data['priority_id'])){
			$priority_id = $data['priority_id'];
		}else{
			$priority_id = $this->config->get('ad_priority_id');
		}
		$fields['priority_id'] = $priority_id;
		$priority_info = $this->getPriority($priority_id);
		if(isset($priority_info['money'])){
			$money = $priority_info['money'];
		}else{
			$money = '0.00';
		}
		$fields['money'] = $money;
		
		$username=$this->customer->getUsername();
		$newAdNum=$this->getMaxAdNum($username);
		
		$fields['advertise_sn'] = $username.zeroFull($newAdNum,3);
		
		$advertise_id = $this->db->insert('advertise',$fields);
		$targeting_id = $post_id = $photo_id = 0;
		$this->db->update('customer',array('customer_id'=>$this->customer->getId()),array('ad_auto_num'=>$newAdNum));
		
		// Targeting
		if(isset($data['targeting'])){
			$targeting_id = $this->addAdvertiseTargeting($advertise_id,$data['targeting'],$data['website_id']);
		}

		// Post
		if(isset($data['post'])){
			$post_id = $this->addAdvertisePost($advertise_id,$data['post'],$data['website_id']);
		}

		// Photo
		if(isset($data['photo'])){
			$photo_id = $this->addAdvertisePhoto($advertise_id,$data['photo'],$data['website_id']);
		}
		$component = array(
			'targeting_id'	=> $targeting_id,
			'post_id'		=> $post_id,
			'photo_id'		=> $photo_id
		);
		$this->db->update('advertise',array('advertise_id'=>$advertise_id),$component);
		// Advertise History
		$history = array(
			'advertise_id' 	=> $advertise_id,
			'customer_id'	=> $this->customer->getId(),
			'from'			=> 'member',
			'publish'		=> 1,
			'notify'		=> 1,
			'note'			=> $data['note'],
			'date_added'	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('advertise_history',$history);
		// balance

		$balance = array(
			'customer_id' 	=> $this->customer->getId(),
			'type'			=> 6,
			'advertise_id'	=> $advertise_id,
			'priority_id'   => $priority_id,
		    'advertise_sn'	=>$fields['advertise_sn'],
			'amount'		=> (float)$money*(-1.00),
			'note'			=> '',
			'date_added'	=> date('Y-m-d H:i:s')
		);
		$this->db->insert('advertise_balance',$balance);

		return $fields['advertise_sn'];
	}

	private function addAdvertiseTargeting($advertise_id,$data,$website_id=0){
		$fields = array(
			'website_id' 	=> $website_id,
			'advertise_id' 	=> $advertise_id,
			'from'			=> isset($data['from']) ? strtolower($data['from']) : 'member',
			'customer_id'	=> $this->customer->getId(),
			'location'		=> isset($data['location']) ? implode(",",$data['location']) : '',
			'other_location'=> isset($data['other_location']) ? trim(strip_tags($data['other_location'])) : '',
			'gender'		=> isset($data['gender']) ? (int)$data['gender'] : '',
			'age_min'		=> isset($data['age_min']) ? (int)$data['age_min'] : 18,
			'age_max'		=> isset($data['age_max']) ? (int)$data['age_max'] : 65,
			'language'		=> isset($data['language']) ? implode(",",$data['language']) :'',
			'other_language'=> isset($data['other_language']) ? trim(strip_tags($data['other_language'])) :'',
			'interest'		=> isset($data['interest']) ? trim(strip_tags($data['interest'])) :'',
			'behavior'		=> isset($data['behavior']) ? trim(strip_tags($data['behavior'])) :'',
			'more'			=> isset($data['more']) ? trim(strip_tags($data['more'])) :'',
			'note'			=> isset($data['note']) ? trim($data['note']) : '',
		    'template_id'	=> isset($data['template_id']) ? (int)($data['template_id']) : '',
		    'audience'	   	=>  isset($data['audience']) ? (int)($data['audience']) : '',
			'in_charge'		=> $this->customer->getInCharge(),
			'user_id'		=> 0,
			'status'		=> isset($data['from']) && $data['from']=='member'  ? $this->config->get('ad_targeting_review') : $this->config->get('ad_targeting_pending'),
			'date_added'	=> date('Y-m-d H:i:s'),
			'date_modified'	=> date('Y-m-d H:i:s')
		);
		if(isset($data['from']) && strtolower($data['from']) == 'backend'){
			$fields['location']	= $fields['gender'] = $fields['language'] = '';
		}
		$targeting_id = $this->db->insert('advertise_targeting',$fields);
		if($fields['status']){
			$history = array(
				'advertise_id' 	=> $advertise_id,
				'targeting_id'	=> $targeting_id,
				'from'			=> isset($data['from']) ? strtolower($data['from']) : 'member',
				'customer_id'	=> $this->customer->getId(),
				'status'		=> isset($data['from']) && $data['from']=='member'  ? $this->config->get('ad_targeting_review') : $this->config->get('ad_targeting_pending'),
				'note'			=> isset($data['note']) ? trim($data['note']) : '',
				'date_added'	=> date('Y-m-d H:i:s')
			);
			$this->db->insert('advertise_targeting_history',$history);
		}
		return $targeting_id;
	}
	private function addAdvertisePost($advertise_id,$data,$website_id=0){
		$fields = array(
			'website_id' 	=> $website_id,
			'advertise_id' 	=> $advertise_id,
			'from'			=> isset($data['from']) ? strtolower($data['from']) : 'member',
			'customer_id'	=> $this->customer->getId(),
			'headline'		=> isset($data['headline']) ? trim($data['headline']) : '',
			'text'			=> isset($data['text']) ? trim($data['text']) : '',
			'note'			=> isset($data['note']) ? trim($data['note']) : '',
			'in_charge'		=> $this->customer->getInCharge(),
			'user_id'		=> 0,
			'status'		=> isset($data['from']) && $data['from']=='member'  ? $this->config->get('ad_post_robot_review') : $this->config->get('ad_post_pending'),
			'date_added'	=> date('Y-m-d H:i:s'),
			'date_modified'	=> date('Y-m-d H:i:s')
		);
		if(isset($data['from']) && strtolower($data['from']) == 'backend'){
			$fields['headline']	= $fields['text'] = '';
		}
		$post_id = $this->db->insert('advertise_post',$fields);
		if($fields['status']){
			$history = array(
				'advertise_id' 	=> $advertise_id,
				'post_id'		=> $post_id,
				'from'			=> isset($data['from']) ? strtolower($data['from']) : 'member',
				'customer_id'	=> $this->customer->getId(),
				'status'		=> isset($data['from']) && $data['from']=='member'  ? $this->config->get('ad_post_robot_review') : $this->config->get('ad_post_pending'),
				'note'			=> isset($data['note']) ? trim($data['note']) : '',
				'date_added'	=> date('Y-m-d H:i:s')
			);
			$this->db->insert('advertise_post_history',$history);
		}
		return $post_id;
	}

	private function addAdvertisePhoto($advertise_id,$data,$website_id=0){
		$fields = array(
			'website_id' 	=> $website_id,
			'advertise_id' 	=> $advertise_id,
			'from'			=> isset($data['from']) ? strtolower($data['from']) : 'member',
			'customer_id'	=> $this->customer->getId(),
			'file'			=> isset($data['file']) ? htmlspecialchars_decode($data['file']) : '',
			'note'			=> isset($data['note']) ? trim($data['note']) : '',
			'in_charge'		=> $this->customer->getInCharge(),
			'user_id'		=> 0,
			'status'		=> isset($data['from']) && $data['from']=='member'  ? $this->config->get('ad_photo_review') : $this->config->get('ad_photo_pending'),
			'date_added'	=> date('Y-m-d H:i:s'),
			'date_modified'	=> date('Y-m-d H:i:s')
		);
		if(isset($data['from']) && strtolower($data['from']) == 'backend'){
			$fields['file']	= '';
		}
		$photo_id = $this->db->insert('advertise_photo',$fields);
		if($fields['status']){
			$history = array(
				'advertise_id' 	=> $advertise_id,
				'photo_id'		=> $photo_id,
				'from'			=> isset($data['from']) ? strtolower($data['from']) : 'member',
				'customer_id'	=> $this->customer->getId(),
				'status'		=> isset($data['from']) && $data['from']=='member'  ? $this->config->get('ad_photo_review') : $this->config->get('ad_photo_pending'),
				'note'			=> isset($data['note']) ? trim($data['note']) : '',
				'date_added'	=> date('Y-m-d H:i:s')
			);
			$this->db->insert('advertise_photo_history',$history);
		}
		return $photo_id;
	}

	public function editAdvertise($advertise_id,$data){
		$this->db->update('advertise',array('advertise_id' => $advertise_id),$data);
	}

	public function getAdvertise($advertise_id,$simple=false){
		if($simple){
			$filter = array(
				'one'	=> true,
				'field' => 'a.*,pd.name priority',
				'alias' => 'a',
				'join'	=> array(
					array(
					'table' => 'priority_description',
					'alias' => 'pd',
					'on' 	=> "pd.priority_id = a.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' "
					),
				),
				'condition' => array(
					'customer_id' => (int)$this->customer->getId(),
					'advertise_id'=> $advertise_id
				)
			);
		}else{
			$filter = array(
				'one'	=> true,
				'alias' => 'a',
				'field' => 'a.*,w.domain,u.nickname,pd.name product,ap.name AS publish_text,pd1.name priority',
				'join' 	=> array(
					array(
						'mode' 	=> 'left join',
						'table' => 'website',
						'alias' => 'w',
						'on' 	=> 'w.website_id = a.website_id'
					),
					array(
						'mode' 	=> 'left join',
						'table' => 'product_description',
						'alias' => 'pd',
						'on' 	=> 'pd.product_id = a.product_id'
					),
					array(
						'mode' 	=> 'left join',
						'table' => 'user',
						'alias' => 'u',
						'on' 	=> 'u.user_id = a.in_charge'
					),
					array(
						'mode' 	=> 'left join',
						'table' => 'advertise_publish',
						'alias' => 'ap',
						'on' 	=> 'ap.publish_id = a.publish'
					),
					array(
						'mode' => 'left join',
						'table' => 'priority_description',
						'alias' => 'pd1',
						'on' => " pd1.priority_id = a.priority_id AND pd1.language_id = '".$this->config->get('config_language_id')."' "
					),
				),
				'condition' => array(
					'customer_id' => (int)$this->customer->getId(),
					'advertise_id'=> $advertise_id,
					'language_id' => array(
						'alias' => 'pd',
						'value' => $this->config->get('config_language_id')
					)
				)
			);
		}
		return $this->db->fetch('advertise',$filter);
	}

	public function getAdvertises($data=array()){

		$filter = array();
		$filter['alias'] = 'a';
		$filter['field'] = 'a.*,w.domain,w.status website_status,u.nickname,pd.name product,ap.name AS publish_text,pd1.name priority';
		$filter['join'] = array(
			array(
				'mode' => 'left join',
				'table' => 'website',
				'alias' => 'w',
				'on' => 'w.website_id = a.website_id AND w.status = 1'
			),
			array(
				'mode' 	=> 'left join',
				'table' => 'product_description',
				'alias' => 'pd',
				'on' 	=> " pd.product_id = a.product_id AND pd.language_id = '".$this->config->get('config_language_id')."' "
			),
			array(
				'mode' => 'left join',
				'table' => 'user',
				'alias' => 'u',
				'on' => 'u.user_id = a.in_charge'
			),
			array(
				'mode' => 'left join',
				'table' => 'advertise_publish',
				'alias' => 'ap',
				'on' => " ap.publish_id = a.publish AND ap.language_id = '".$this->config->get('config_language_id')."' "
			),
			array(
				'mode' => 'left join',
				'table' => 'priority_description',
				'alias' => 'pd1',
				'on' => " pd1.priority_id = a.priority_id AND pd1.language_id = '".$this->config->get('config_language_id')."' "
			),
		);
		$condition = array(
			'customer_id' => (int)$this->customer->getId(),
		);
		if(isset($data['website'])){
			$condition['website_id'] = $data['website'];
		}
		
		if(isset($data['filter_product_id'])){
			$condition['product_id'] = $data['filter_product_id'];
		}
		if(isset($data['filter_target_url'])){
			$condition['target_url'] = array(
				'logic' => 'like',
				'value' => $data['filter_target_url']
			);
		}
		if(isset($data['filter_domain'])){
			$condition['domain'] = array(
				'alias' => 'w',
				'logic' => 'like',
				'value' => $data['filter_domain']
			);
		}
		if(isset($data['filter_publish'])){
			$condition['publish'] = $data['filter_publish'];
		}
		if(isset($data['filter_target_url'])){
			$condition['target_url'] = array(
				'logic' => 'like',
				'value' => $data['filter_target_url']
			);
		}
		if(isset($data['filter_modified_start']) || isset($data['filter_modified_end'])){

			if(isset($data['filter_modified_start']) && isset($data['filter_modified_end'])){
				$condition['date_modified'] = array(
					'logic' => 'noparse',
					'value' => "DATE(a.`date_modified`) >= '".$this->db->escape($data['filter_modified_start']) ."' AND DATE(a.`date_modified`) <='".$data['filter_modified_end']."'"
				);
			}else if(isset($data['filter_modified_start'])){
				$condition['date_modified'] = array(
					'logic' => 'gte',
					'value' => $data['filter_modified_start']
				);
			}else if(isset($data['filter_modified_end'])){
				$condition['date_modified'] = array(
					'logic' => 'lte',
					'value' => $data['filter_modified_end']
				);
			}
		}
		

		$filter['condition'] = $condition;

		$sort_data = array(
			'a.advertise_sn',
			'a.date_modified',
			'a.date_added',
			'a.publish'
		);
		$sort = '';
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sort .= $data['sort'];
		} else {
			$sort .= "a.date_modified";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sort .= " ASC";
		} else {
			$sort .= " DESC";
		}
		$filter['sort'] = $sort;

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$filter['start'] = 0;
			}else{
				$filter['start'] = $data['start'];
			}
			if ($data['limit'] < 1) {
				$filter['limit'] = 20;
			}else{
				$filter['limit'] = $data['limit'];
			}			
		}
		return $this->db->fetch('advertise',$filter);
	}

	public function getTotalAdvertises($data=array()){
		$filter = array('alias'=>'a');
		$filter['field'] = array('COUNT(a.advertise_id) AS total');
		$filter['join'] = array(
			array(
				'mode' => 'left join',
				'table' => 'website',
				'alias' => 'w',
				'on' => 'w.website_id = a.website_id AND w.status = 1'
			)
		);
		$condition = array(
			'customer_id' => (int)$this->customer->getId(),
		);
		if(isset($data['website'])){
			$condition['website_id'] = $data['website'];
		}
		if(isset($data['filter_product_id'])){
			$condition['product_id'] = $data['filter_product_id'];
		}
		if(isset($data['filter_domain'])){
			$condition['domain'] = array(
				'alias' => 'w',
				'logic' => 'like',
				'value' => $data['filter_domain']
			);
		}
		if(isset($data['filter_target_url'])){
			$condition['target_url'] = array(
				'logic' => 'like',
				'value' => $data['filter_target_url']
			);
		}
		if(isset($data['filter_publish'])){
			$condition['publish'] = $data['filter_publish'];
		}
		if(isset($data['filter_target_url'])){
			$condition['target_url'] = array(
				'logic' => 'like',
				'value' => $data['filter_target_url']
			);
		}
		if(isset($data['filter_modified_start']) || isset($data['filter_modified_end'])){

			if(isset($data['filter_modified_start']) && isset($data['filter_modified_end'])){
				$condition['date_modified'] = array(
					'logic' => 'noparse',
					'value' => "DATE(`date_modified`) >= '".$this->db->escape($data['filter_modified_start']) ."' AND DATE(`date_modified`) <='".$data['filter_modified_end']."'"
				);
			}else if(isset($data['filter_modified_start'])){
				$condition['date_modified'] = array(
					'logic' => 'gte',
					'value' => $data['filter_modified_start']
				);
			}else if(isset($data['filter_modified_end'])){
				$condition['date_modified'] = array(
					'logic' => 'lte',
					'value' => $data['filter_modified_end']
				);
			}
		}
		$filter['condition'] = $condition;

		$filter['one'] = true;
		$result = $this->db->fetch('advertise',$filter);
		return isset($result['total']) ? $result['total'] : 0;
	}

	public function addAdvertiseHistory($advertise_id,$data){
		$ad_info = $this->getAdvertise($advertise_id,true);
		if($ad_info){
			
			$fields = array(
				'publish'		=> $data['publish'],
				'note'			=> strip_tags($data['note']),
				'date_modified'	=> date('Y-m-d H:i:s')
			);
			$this->db->update('advertise',array('advertise_id'=>$advertise_id),$fields);
			$history = array(
				'advertise_id' 	=> $advertise_id,
				'publish'		=> $data['publish'],
				'from'			=> 'member',
				'note'			=> strip_tags($data['note']),
				'customer_id'	=> $this->customer->getId(),
				'notify'		=> 1,
				'date_added'	=> date('Y-m-d H:i:s')
			);
			return $this->db->insert('advertise_history',$history);
		}
	}
	public function getAdvertiseHistories($advertise_id){
		$filter = array(
			'field' => 'ah.*,ap.name publish_text',
			'alias' => 'ah',
			'join'	=> array(
					array(
					'table' => 'advertise_publish',
					'alias' => 'ap',
					'on'	=> "ah.publish = ap.publish_id AND ap.language_id = '".$this->config->get('config_language_id')."' "
				)
			),
			'condition' => array(
				'advertise_id'=> $advertise_id,
				'notify'	=>1
			)
		);
		$sort = '';
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sort .= $data['sort'];
		} else {
			$sort .= "date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sort .= " ASC";
		} else {
			$sort .= " DESC";
		}
		$filter['sort'] = $sort;

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$filter['start'] = 0;
			}
			if ($data['limit'] < 1) {
				$filter['limit'] = 20;
			}			
		}
		return $this->db->fetch('advertise_history',$filter);
	}

	public function getTotalAdvertiseHistories($advertise_id){
		$filter = array(
			'one'		=> true,
			'field' 	=> 'COUNT(history_id) total',
			'condition' => array(
				'advertise_id'=> $advertise_id,
				'notify'	=>1
			)
		);
		$result = $this->db->fetch('advertise_history',$filter);
		return isset($result['total']) ? $result['total'] : 0;
	}

	public function getAdvertiseBalances($advertise_id){
		$filter = array(
			'alias'=> 'ab',
			'field'=> 'ab.*,pd.name priority',
			'join' => array(
				array(
					'table' => 'priority_description',
					'alias' => 'pd',
					'on'    => "pd.priority_id = ab.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."'"
				)
			),
			'condition' => array(
				'advertise_id'=> $advertise_id,
				'customer_id'=> $this->customer->getId(),
			)
		);
		$sort = '';
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sort .= $data['sort'];
		} else {
			$sort .= "date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sort .= " ASC";
		} else {
			$sort .= " DESC";
		}
		$filter['sort'] = $sort;

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$filter['start'] = 0;
			}
			if ($data['limit'] < 1) {
				$filter['limit'] = 20;
			}			
		}
		return $this->db->fetch('advertise_balance',$filter);
	}

	public function getTotalAdvertiseBalances($advertise_id){
		$filter = array(
			'one'		=> true,
			'field' 	=> 'COUNT(balance_id) total',
			'condition' => array(
				'advertise_id'=> $advertise_id,
				'customer_id'=> $this->customer->getId(),
			)
		);
		$result = $this->db->fetch('advertise_balance',$filter);
		return isset($result['total']) ? $result['total'] : 0;
	}

	public function getAdvertiseComponentProgress($entry_id,$mode='targeting'){
		$table = '';
		$entry = '';
		switch (strtolower($mode)) {
			case 'targeting':
				$table = 'advertise_targeting';
				$entry = 'targeting_id';
				break;
			case 'post':
				$table = 'advertise_post';
				$entry = 'post_id';
				break;
			case 'photo':
				$table = 'advertise_photo';
				$entry = 'photo_id';
				break;

		}
		if($table){
			$data = array(
				'one'	=> true,
				'alias' => 'am',
				'field' => 'am.progress,ast.name progress_text',
				'join'	=> array(

					array(
						'mode' => 'left join',
						'table' => 'advertise_status',
						'alias' => 'ast',
						'on' => 'am.progress = ast.status_id'
					)
				),
				'condition' => array(

					$entry => $entry_id
				),
			);
			return $this->db->fetch($table,$data);
		}
		return false;
	}
	public function getAdvertiseComponent($advertise_id,$mode = 'targeting'){
		$table = '';
		switch (strtolower($mode)) {
			case 'targeting':
				$table = 'advertise_targeting';
				break;
			case 'post':
				$table = 'advertise_post';
				break;
			case 'photo':
				$table = 'advertise_photo';
				break;

		}
		if($table){
			$data = array(
				'one'	=> true,
				'alias' => 'am',
				'field' => 'am.*,a.target_url,w.domain',
				'join'	=> array(
					array(
						'mode' => 'left join',
						'table' => 'advertise',
						'alias' => 'a',
						'on' => 'am.advertise_id = a.advertise_id'
					),
					array(
						'mode' => 'left join',
						'table' => 'website',
						'alias' => 'w',
						'on' => 'am.website_id = w.website_id'
					)
				),
				'condition' => array(
					'customer_id' => array(
						'value' => $this->customer->getId(),
						'alias' => 'a'
					),
					'advertise_id' => $advertise_id
				),
			);
			return $this->db->fetch($table,$data);
		}
		return false;
	}
	

	private function generatePostSN($advertise_id){
		/*
		$ad_info = $this->getAdvertise($advertise_id,true);
		if($ad_info){
			$targeting = $this->getAdvertiseComponent($advertise_id,'targeting');
			if(!empty($targeting['location']) && !empty($targeting['gender'])){
				$locations = explode(',',$targeting['location']);
				if(is_array($locations)){
					$country_id = current($locations);
					$filter = array(
						'field' => 
					);
					$this->db->fetch('targeting',$filter)
				}
				$gender_id = (int)$targeting['gender'];
			}
			$data = array()
		}
		*/
		return '';
	}

	function addAdvertiseTracking($advertise_id,$data){
		$fields = array(
			'advertise_id' 	=> $advertise_id,
			'text'			=> $data['text'],
			'attach'		=> htmlspecialchars_decode($data['attach']),
			'from'			=> 'member',
			'customer_id'	=> $this->customer->getId(),
			'read'			=> 0,
			'date_added'	=> date('Y-m-d H:i:s'),
		);

		return $this->db->insert('advertise_tracking',$fields);
	}

	function getAdvertiseTrackings($advertise_id){

		$filter = array(
			'alias'=> 'at',
			'field'=> "at.*,CONCAT(c.firstname,' ',c.lastname) customer,c.company,CONCAT(u.lastname,' ',u.firstname) charger",
			'join' => array(
				array(
					'table' =>  'advertise',
					'alias' => 'a',
					'on'	=> 'a.advertise_id = at.advertise_id'
				),
				array(
					'table' =>  'customer',
					'alias' => 'c',
					'on'	=> 'c.customer_id = a.customer_id'
				),
				array(
					'table' => 'user',
					'alias' => 'u',
					'on'	=> 'u.user_id = at.user_id'
				),
			),
			'condition'=> array(
				'advertise_id' => $advertise_id,
				'customer_id'  => array(
					'alias' => 'a',
					'value' => $this->customer->getId()
				)
			),
			'sort'	=> 'at.date_added DESC'
		);

		return $this->db->fetch('advertise_tracking',$filter);
	}

	public function getPriority($priority_id){

		$priority = $this->db->fetch('priority',array('one'=>true,'condition'=>array('priority_id'=>$priority_id)));
		return $priority;
	}

	public function getQueueNumber($advertise_id){
		$sql = "SELECT a.`priority_id`,a.`money`,a.`publish`,pd.name priority FROM ".DB_PREFIX."advertise a LEFT JOIN ".DB_PREFIX."priority_description pd ON ( pd.priority_id = a.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' ) WHERE a.advertise_id = '".$advertise_id."'";
		$query = $this->db->query($sql);
		$number = 0;
		if($query->num_rows){
			if($query->row['publish']==1){
				$number = 1;
				$ad_query = $this->db->query("SELECT advertise_id FROM ".DB_PREFIX."advertise WHERE priority_id = '".$query->row['priority_id']."' AND publish = '1' ORDER BY date_modified ASC");
				if($ad_query->num_rows){
					foreach ($ad_query->rows as $key => $item) {
						if($item['advertise_id'] == $advertise_id){
							$number = $key+1;
						}
					}
				}
			}
		}

		return $number;
	}

	public function getAdvertisesQueue(){
		$sql = "SELECT p.priority_id,p.money ,pd.name priority ,COUNT(a.priority_id) quantity
		FROM ".DB_PREFIX."priority p LEFT JOIN ".DB_PREFIX."advertise a ON ( p.priority_id = a.priority_id AND a.publish = '1') 
		LEFT JOIN ".DB_PREFIX."priority_description pd ON ( pd.priority_id = p.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' ) 
		GROUP BY p.priority_id ORDER BY p.priority_id ASC,a.date_added DESC ";
		
		$query = $this->db->query($sql);
		$queue = array();
		if($query->num_rows){
			foreach ($query->rows as $row) {
				if(!empty($row['priority'])){
					$row['amount'] = $this->currency->format($row['money']);
					$queue[] = $row;
				}
			}
		}
		return $queue;
	}

	public function getPriorityOverview(){
		$priority = array();
		$sql = "SELECT p.priority_id,p.money ,pd.name name FROM ".DB_PREFIX."priority p LEFT JOIN ".DB_PREFIX."priority_description pd ON ( pd.priority_id = p.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' ) GROUP BY p.priority_id ORDER BY p.priority_id ASC ";
		
		$query = $this->db->query($sql);
		if($query->num_rows){
			$designing_publishes = array(
				(int)$this->config->get('ad_publish_designing'),
				(int)$this->config->get('ad_publish_waiting'),
				(int)$this->config->get('ad_publish_confirmed'),
				(int)$this->config->get('ad_publish_opening'),
				(int)$this->config->get('ad_publish_success'),
				(int)$this->config->get('ad_publish_failed'),
			);
			$termination_publishes = array(				
				
				(int)$this->config->get('ad_publish_refunded')
			);
			foreach ($query->rows as $item) {
				$all_totals = $my_totals = array();
				$all_queue_query = $this->db->query("SELECT COUNT(advertise_id) total FROM ".DB_PREFIX."advertise WHERE publish = '1' AND priority_id = '".$item['priority_id']."'");
				$all_totals['queuing'] = empty($all_queue_query->row['total']) ? 0 : $all_queue_query->row['total'];

				$all_designing_query = $this->db->query("SELECT COUNT(advertise_id) total FROM ".DB_PREFIX."advertise WHERE publish IN ( ".implode(",", $designing_publishes)." ) AND priority_id = '".$item['priority_id']."'");
				$all_totals['designing'] = empty($all_designing_query->row['total']) ? 0 : $all_designing_query->row['total'];
				$item['all'] = $all_totals;
				$my_queue_query = $this->db->query("SELECT COUNT(advertise_id) total FROM ".DB_PREFIX."advertise WHERE publish = '1' AND priority_id = '".$item['priority_id']."' AND customer_id = '".$this->customer->getId()."'");
				$my_totals['queuing'] = empty($my_queue_query->row['total']) ? 0 : $my_queue_query->row['total'];
				$my_designing_query = $this->db->query("SELECT COUNT(advertise_id) total FROM ".DB_PREFIX."advertise WHERE publish IN ( ".implode(",", $designing_publishes)." ) AND priority_id = '".$item['priority_id']."' AND customer_id = '".$this->customer->getId()."'");
				$my_totals['designing'] = empty($my_designing_query->row['total']) ? 0 : $my_designing_query->row['total'];
				$my_termination_query = $this->db->query("SELECT COUNT(advertise_id) total FROM ".DB_PREFIX."advertise WHERE publish IN ( ".implode(",", $termination_publishes)." ) AND priority_id = '".$item['priority_id']."' AND customer_id = '".$this->customer->getId()."'");
				$my_totals['termination'] = empty($my_termination_query->row['total']) ? 0 : $my_termination_query->row['total'];
				$my_deliveried_query = $this->db->query("SELECT COUNT(advertise_id) total FROM ".DB_PREFIX."advertise WHERE publish = '".$this->config->get('ad_publish_deliveried')."' AND priority_id = '".$item['priority_id']."' AND customer_id = '".$this->customer->getId()."'");
				$my_totals['deliveried'] = empty($my_deliveried_query->row['total']) ? 0 : $my_deliveried_query->row['total'];
				$item['my'] = $my_totals;
				$item['amount'] = $this->currency->format($item['money']);
				$priority[] = $item;
			}
		}
		return $priority;
	}

	public function getAdvertisePriority($advertise_id = null,$priority_id = null){

		$priority_info = $this->getAdvertisesQueue();
		if($priority_info){
			$balance = 0.00;
			if($advertise_id){
				$ad_info = $this->getAdvertise($advertise_id);
				if(!empty($ad_info['money'])){
					$balance = (float)$ad_info['money'];
				}
			}
			foreach ($priority_info as $key => $item) {
				$_balance = (float)($item['money'] - $balance);
				if($item['money']*1000 > $balance*1000){
					$operator = '+';
				}else if($item['money']*1000 == $balance*1000){
					$operator = '&nbsp;';
				}else{
					$operator = '-';
				}
				$priority_info[$key]['balance'] = $_balance;
				$priority_info[$key]['quantity'] = (int)$item['quantity'];
				$priority_info[$key]['operator'] = $operator;
				$priority_info[$key]['amount'] = $this->currency->format(abs($_balance));
				$priority_info[$key]['default'] = $this->config->get('ad_priority_id') == $item['priority_id'];
			}
		}

		return $priority_info;
	}

	function revokeLevelDown($advertise_id){
		$this->db->delete('advertise_demotion',array('advertise_id'=>$advertise_id));
	}

	function getLevelDown($advertise_id){
		$fields = array(
			'one'=>true,
			'field'=> 'ld.*,pd.name priority',
			'alias'=>'ld',
			'join'=>array(
				array(
					'table'=>'priority_description',
					'alias'=>'pd',
					'on'=>"pd.priority_id = ld.to_priority AND pd.language_id = '".$this->config->get('config_language_id')."'"
				)
			),
			'condition'=>array('advertise_id'=>$advertise_id,'customer_id'=>$this->customer->getId())
		);
		return $this->db->fetch('advertise_demotion',$fields);
	}

	function updatePriority($advertise_id,$priority_id){
		$ad_info = $this->getAdvertise($advertise_id);
		if(isset($ad_info['publish']) && $ad_info['publish']==1){
			$priority = $this->db->fetch('priority',array('one'=>true,'condition'=>array('priority_id'=>$priority_id)));
			if(empty($priority['priority_id']) || $ad_info['priority_id'] == $priority['priority_id']){
				return -1;
			}
			$priority_money = empty($priority['money']) ? 0.00 : $priority['money'];
			if($ad_info['money'] > $priority_money){
				$type = 3;
				$this->db->delete('advertise_demotion',array('advertise_id'=>$advertise_id));
				$fields = array(
					'advertise_id'	=> $advertise_id,
					'from_priority'	=> $ad_info['priority_id'],
					'to_priority'	=> $priority_id,
					'customer_id'	=> $this->customer->getId(),
					'date_added'	=> date('Y-m-d H:i:s')
				);
				$this->db->insert('advertise_demotion',$fields);
				return 2;
			}else{
				$type = 2;
				$diffBalance = $priority_money - $ad_info['money'];
				if(($this->customer->getBalance())*1000 >= $diffBalance*1000){
					$fields = array(
						'priority_id'	=> $priority_id,
						'money'			=> $priority_money,
						'date_modified' => date('Y-m-d H:i:s')
					);
					$this->db->update('advertise',array('advertise_id'=>$advertise_id),$fields);
					$balance = array(
						'type' 			=> $type,
						'advertise_id'  => $advertise_id,
					    'from_priority' => $ad_info['priority_id'],
					    'advertise_sn' => $ad_info['advertise_sn'],
						'priority_id'   => $priority_id,
						'customer_id'   => $this->customer->getId(),
						'amount'		=> -1*$diffBalance,
						'date_added'	=> date('Y-m-d H:i:s')
					);
					$this->db->insert('advertise_balance',$balance);
					return 1;
				}else{
					return -2;
				}
			}

		}else{
			return 0;
		}
	}

    public function getMaxAdNum($username){
        $fields = array(
            'one'   => true,
            'field' => 'ad_auto_num',
            'condition'=> array('username'=>$username)
        );
        $result = $this->db->fetch('customer',$fields);

        return empty($result['ad_auto_num']) ? 1 : $result['ad_auto_num']+1;
    }
    public function getIdBySn($advertise_sn){
    	$fields = array(
            'one'   => true,
            'field' => 'advertise_id',
            'condition'=> array('advertise_sn'=>$advertise_sn)
        );
        $result = $this->db->fetch('advertise',$fields);

        return empty($result['advertise_id']) ? 0 : $result['advertise_id'];
    }

    public function editAdvertiseTargeting($targeting_id,$data=array()){
    	$query = $this->db->query("SELECT a.* FROM ".DB_PREFIX."advertise_targeting at LEFT JOIN ".DB_PREFIX."advertise a ON at.advertise_id = a.advertise_id WHERE at.targeting_id = '".(int)$targeting_id."'");
    	if(!empty($query->row['advertise_sn'])){
    		if(isset($data['from']) && strtolower($data['from'])=='backend'){
    			$fields = array(
    				'from'			=> 'backend',
    				'note'			=> isset($data['note']) ? strip_tags(trim($data['note'])) : '',
    				'status'		=> $this->config->get('ad_targeting_pending'),
    				'date_modified'	=> date('Y-m-d H:i:s')
    			);
    		}else{
	    		$fields = array(
					'from'			=> 'member',
					'customer_id'	=> $this->customer->getId(),
					'location'		=> implode(",",$data['location']),
					'other_location'=> trim(strip_tags($data['other_location'])),
					'gender'		=> (int)$data['gender'],
					'age_min'		=> (int)$data['age_min'],
					'age_max'		=> (int)$data['age_max'],
	    		    'template_id'		=> (int)$data['template_id'],
					'language'		=> implode(",",$data['language']),
					'other_language'=> trim(strip_tags($data['other_language'])),
					'interest'		=> trim(strip_tags($data['interest'])) ,
					'behavior'		=> trim(strip_tags($data['behavior'])),
					'more'			=> trim(strip_tags($data['more'])),
	    		    'audience'		=> (int)$data['audience'],
					'note'			=> isset($data['note']) ? strip_tags(trim($data['note'])) : '',
					'status'		=> $this->config->get('ad_targeting_review'),
					'date_modified'	=> date('Y-m-d H:i:s')
				);
	    	}
			$this->db->update('advertise_targeting',array('targeting_id'=>$targeting_id),$fields);
			$history = array(
				'advertise_id' 	=> $query->row['advertise_id'],
				'targeting_id'	=> $targeting_id,
				'from'			=> 'member',
				'customer_id'	=> $this->customer->getId(),
				'status'		=> $fields['status'],
				'note'			=> $fields['note'],
				'date_added'	=> date('Y-m-d H:i:s')
			);
			return $this->db->insert('advertise_targeting_history',$history);
			
    	}

    	return false;
    }

    public function editAdvertisePost($post_id,$data=array()){
    	$query = $this->db->query("SELECT a.* FROM ".DB_PREFIX."advertise_post at LEFT JOIN ".DB_PREFIX."advertise a ON at.advertise_id = a.advertise_id WHERE at.post_id = '".(int)$post_id."'");
    	if(!empty($query->row['advertise_sn'])){
    		if(isset($data['from']) && strtolower($data['from'])=='backend'){
    			$fields = array(
    				'from'			=> 'backend',
    				'note'			=> isset($data['note']) ? strip_tags(trim($data['note'])) : '',
    				'status'		=> $this->config->get('ad_post_pending'),
    				'date_modified'	=> date('Y-m-d H:i:s')
    			);
    		}else{
	    		$fields = array(
					'from'			=> 'member',
					'customer_id'	=> $this->customer->getId(),
					'headline'		=> strip_tags(trim($data['headline'])),
					'text'			=> strip_tags(trim($data['text'])),
					'note'			=> isset($data['note']) ? strip_tags(trim($data['note'])) : '',
					'status'		=> $this->config->get('ad_post_robot_review'),
					'date_modified'	=> date('Y-m-d H:i:s')
				);
	    	}
			$this->db->update('advertise_post',array('post_id'=>$post_id),$fields);
			$history = array(
				'advertise_id' 	=> $query->row['advertise_id'],
				'post_id'		=> $post_id,
				'from'			=> 'member',
				'customer_id'	=> $this->customer->getId(),
				'status'		=> $fields['status'],
				'note'			=> $fields['note'],
				'date_added'	=> date('Y-m-d H:i:s')
			);
			return $this->db->insert('advertise_post_history',$history);			
    	}

    	return false;
    }    

    public function editAdvertisePhoto($photo_id,$data=array()){
    	$query = $this->db->query("SELECT a.* FROM ".DB_PREFIX."advertise_photo at LEFT JOIN ".DB_PREFIX."advertise a ON at.advertise_id = a.advertise_id WHERE at.photo_id = '".(int)$photo_id."'");
    	if(!empty($query->row['advertise_sn'])){
    		if(isset($data['from']) && strtolower($data['from'])=='backend'){
    			$fields = array(
    				'from'			=> 'backend',
    				'note'			=> isset($data['note']) ? strip_tags(trim($data['note'])) : '',
    				'status'		=> $this->config->get('ad_photo_pending'),
    				'date_modified'	=> date('Y-m-d H:i:s')
    			);
    		}else{
	    		$fields = array(
					'from'			=> 'member',
					'customer_id'	=> $this->customer->getId(),
					'file'			=> isset($data['file']) ? htmlspecialchars_decode($data['file']) : '',
					'note'			=> isset($data['note']) ? strip_tags(trim($data['note'])) : '',
					'status'		=> $this->config->get('ad_photo_review'),
					'date_modified'	=> date('Y-m-d H:i:s')
				);
	    	}
			$this->db->update('advertise_photo',array('photo_id'=>$photo_id),$fields);
			$history = array(
				'advertise_id' 	=> $query->row['advertise_id'],
				'photo_id'		=> $photo_id,
				'from'			=> 'member',
				'customer_id'	=> $this->customer->getId(),
				'status'		=> $fields['status'],
				'note'			=> $fields['note'],
				'date_added'	=> date('Y-m-d H:i:s')
			);
			return $this->db->insert('advertise_photo_history',$history);
			
    	}

    	return false;
    }
}
