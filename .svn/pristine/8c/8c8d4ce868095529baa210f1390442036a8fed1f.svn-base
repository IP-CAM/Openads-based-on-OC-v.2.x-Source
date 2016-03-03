<?php
class ModelFbaccountPublishPhoto extends Model {
    private $post_type = 1;
    public function copyContribute($data,$without_photo=false){
        
        if(isset($data['entry_sn'])){
            $query = $this->db->query("SELECT * FROM ".DB_PREFIX."fbaccount WHERE entry_sn = '".$this->db->escape($data['entry_sn'])."'");
            if($query->num_rows){
                $tmp = array();
                $tmp['entry_sn']        = $query->row['entry_sn'];
                $tmp['user_id']         = (int)$this->user->getId();
                $tmp['group_id']        = $query->row['group_id'];
                $tmp['is_clickbank']    = $query->row['is_clickbank'];
                $tmp['author_id']       = $this->user->getAuthorId();
                $tmp['content']         = $data['content'];
                $tmp['target_url']      = $data['target_url'];
                $tmp['expired']         = $data['expired'];
                $tmp['submited_date']   = date('Y-m-d H:i:s');
                $tmp['date_modified']   = date('Y-m-d H:i:s');
                $tmp['product_id']      = $data['product_id'];
                $tmp['gender_id']       = $data['gender_id'];
                $tmp['country_id']      = $data['country_id'];
                $auto_num = $this->getAutoNum($data['product_id'],$data['gender_id'],$data['country_id']);
                $tmp['auto_num'] = $auto_num;
                $precode = substr($query->row['precode'], 0,9);
                $table = $url_table = $history_table = $post_type = '';
                if(strlen($precode)==9){
                    if($without_photo){
                        $tmp['status'] = $this->config->get('fbaccount_initial_status');
                        $tmp['publish'] = $this->config->get('fbaccount_initial_publish');
                        $tmp['precode'] = $precode."S";
                        $tmp['contribute_sn'] = $precode."S".zeroFull($auto_num);
                        $table = 'fbaccount_nophoto_post';
                        $url_table = 'fbaccount_nophoto_post_url';
                        $history_table = 'fbaccount_nophoto_post_history';
                        $post_type =2;
                    }else{
                        $tmp['status'] = $this->config->get('fbaccount_photo_initial_status');
                        $tmp['publish'] = $this->config->get('fbaccount_photo_initial_publish');
                        $tmp['precode'] = $precode."P";
                        $tmp['contribute_sn'] = $precode."P".zeroFull($auto_num);
                        $tmp['upload_files']  = $data['upload_files'];
                        $table = 'fbaccount_photo_post';
                        $url_table = 'fbaccount_photo_post_url';
                        $history_table = 'fbaccount_photo_post_history';
                        $post_type = $this->post_type;
                    }

                }else{
                    return false;
                }

                $contribute_id = $this->db->insert($table, $tmp);
                $this->db->query("INSERT INTO ".DB_PREFIX."sns_balance SET contribute_id = '".$contribute_id."',post_type = '".$post_type."',author_id = '".$this->user->getAuthorId()."', user_id = '".(int)$data['user_id']."',date_added = NOW() ");
                $this->db->query("INSERT INTO ".DB_PREFIX.$history_table." SET contribute_id = '".$contribute_id."',type = 'edit',value = '".$tmp['status']."', user_id = '".$this->user->getId()."',date_added = NOW() ");
                $this->db->query("INSERT INTO ".DB_PREFIX.$history_table." SET contribute_id = '".$contribute_id."',type = 'post',value = '".$tmp['publish']."', user_id = '".$this->user->getId()."',date_added = NOW() ");
                //clickbank target url
                if($tmp['is_clickbank']){
                    $query = $this->db->query("SELECT cb_link FROM ".DB_PREFIX."fbaccount_entry WHERE entry_sn = '".$this->db->escape($tmp['entry_sn'])."' AND is_clickbank = '1' ");
                    if(!empty($query->row['cb_link'])){
                        $_target_url = trim($query->row['cb_link']).$tmp['contribute_sn'];
                        $this->db->query("UPDATE ".DB_PREFIX.$table." SET target_url = '".$this->db->escape($_target_url)."' WHERE contribute_id = '".$contribute_id."'");
                    }
                }
                //links
                $links = $this->getContributeLinks($tmp['contribute_sn']);
                if($links){
                    foreach ($links as $item) {
                        if(!empty($item['short_url'])){
                            $this->db->query("INSERT INTO ".DB_PREFIX.$url_table." SET contribute_sn = '".$this->db->escape($tmp['contribute_sn'])."' , short_url = '".$this->db->escape(trim($item['short_url']))."'");
                        }
                    }
                }
                
                $this->db->query("UPDATE ".DB_PREFIX."fbaccount_photo_post SET copied = copied+1 WHERE contribute_sn = '".$this->db->escape($data['contribute_sn'])."'");
                return $tmp['contribute_sn'];
            }
        }
    }

    public function getAutoNum($product_id,$gender_id,$country_id){
        if(!isset($product_id) || !isset($gender_id) || !isset($country_id)){ return false;}
        $where = array(
            " product_id = '".(int)$product_id."' ",
            " gender_id = '".(int)$gender_id."' ",
            " country_id = '".(int)$country_id."' ",
            " author_id = '".$this->user->getAuthorId()."' ",
        );
        $query=$this->db->query("SELECT MAX(auto_num) as max FROM ".DB_PREFIX."fbaccount_nophoto_post WHERE ".implode(" AND ", $where));
        return (int)($query->row['max']+1);
    }

    public function deleteContribute($contribute_id){
        $where = array();
        $where['contribute_id'] = (int)$contribute_id;
        $this->db->delete("fbaccount_photo_post",$where);
        $this->db->delete("fbaccount_photo_post_history",$where);
        $where['post_type'] = $this->post_type;
        $this->db->delete("sns_balance",$where);
        $this->db->delete("fbaccount_photo_text_history",array('post_id' => (int)$contribute_id));
        return true;
    }

    public function getContributes($data) {
        if(!isset($data['filter_mode'])){$data['filter_mode']='';}
        $sql = '';
        switch (strtolower($data['filter_mode']) ){
            case 'links':
                if(!empty($data['filter_url_operator']) && !empty($data['filter_url_number'])){
                    $sql = "SELECT p.* FROM ".DB_PREFIX."fbaccount_photo_post_url mu LEFT JOIN ".DB_PREFIX."fbaccount_photo_post p ON p.contribute_sn = mu.contribute_sn WHERE p.publish IN (".$this->config->get("fbaccount_photo_testing_publish").",".$this->config->get("fbaccount_photo_promoting_publish").") GROUP BY mu.contribute_sn HAVING COUNT(mu.contribute_sn) ".$data['filter_url_operator']." '".(int)$data['filter_url_number']."' ";
                }
                break;
            case 'posts':
                $sql = "SELECT p.* FROM " . DB_PREFIX . "fbaccount_photo_post p ";
                if(isset($data['filter_url_operator']) && $data['filter_url_operator']!== false ){
                    $sql .= " LEFT JOIN ".DB_PREFIX."fbaccount_photo_post_url mu ON p.contribute_sn = mu.contribute_sn ";
                }
                $sql .=" WHERE p.publish > '".$this->config->get('fbaccount_photo_initial_publish')."' ";
                $implode = array();
                if (!empty($data['filter_products']) && is_array($data['filter_products'])) {
                    $implode[] = "p.product_id IN (" . implode(" , ", $data['filter_products']) . ")";
                }
                if (!empty($data['filter_user_id'])) {
                    $implode[] = "p.user_id = '" . (int)$data['filter_user_id'] . "'";
                }
                if (!empty($data['filter_publishes']) && is_array($data['filter_publishes'])) {
                    $implode[] = "p.publish IN (".implode(" , ", $data['filter_publishes']).") ";
                }
                if (!empty($data['filter_statuses']) && is_array($data['filter_statuses'])) {
                    $implode[] = "p.status IN (".implode(" , ", $data['filter_statuses']).") ";
                }
                if ($implode) {
                    $sql .= " AND " . implode(" AND ", $implode);
                }
                if(isset($data['filter_url_operator']) && $data['filter_url_operator']!== false && !empty($data['filter_url_number'])){
                    $implode[] = " GROUP BY mu.contribute_sn HAVING COUNT(mu.contribute_sn) ".$data['filter_url_operator']." '".(int)$data['filter_url_number']."' ";
                }
                $sql .= " ORDER BY p.contribute_sn ASC";
            break;
            default:
                $sql = "SELECT p.* FROM " . DB_PREFIX . "fbaccount_photo_post p WHERE p.publish > '".$this->config->get('fbaccount_photo_initial_publish')."' ";
                $implode = array();
                // 根据当前登录用户,获取用户的下属用户的author_id
                if(!in_array($this->user->getId(), $this->config->get("sns_group_admin"))){
                    $authors = array("'".$this->user->getAuthorId()."'");
                    $wokers = $this->user->geWorkers();
                    $this->load->model('user/user');
                    foreach ($wokers as $value) {
                        $_author = $this->model_user_user->getUser($value);
                        if(!empty($_author['author_id'])){
                            $authors[] = "'".$_author['author_id']."'";
                        }
                    }
                    $implode[] = "p.author_id IN (".implode(",", $authors).") ";
                }
                if (!empty($data['filter_contribute_sn'])) {
                    $implode[] = "p.contribute_sn Like '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
                }
                if (!empty($data['filter_entry'])) {
                    $implode[] = "p.entry_sn Like '%" . $this->db->escape($data['filter_entry']) . "%'";
                }

                if (!empty($data['filter_product_id'])) {
                    $implode[] = "p.product_id = '" . (int)$data['filter_product_id'] . "'";
                }

                if (!empty($data['filter_author'])) {
                    $implode[] = "p.author_id = '" . $this->db->escape(trim($data['filter_author'])) . "'";
                }                 
                if (!empty($data['filter_user_id'])) {
                    $implode[] = "p.user_id = '" . (int)$data['filter_user_id'] . "'";
                }   
                if (!empty($data['filter_artist_id'])) {
                    $implode[] = "p.artist_id = '" . (int)$data['filter_artist_id'] . "'";
                }

                if (isset($data['filter_status']) && !is_null($data['filter_status']) && $data['filter_status']!==false) {
                    $implode[] = "p.status = '" . (int)$data['filter_status'] . "'";
                }   
                if (isset($data['filter_publish'])) {
                    $implode[] = "p.publish = '".(int)$data['filter_publish']."' ";
                }   
                if (!empty($data['filter_submited_date'])) {
                    $implode[] = "DATE(p.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
                }
                if (!empty($data['filter_date_modified'])) {
                    $implode[] = "DATE(p.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
                }
                //export target url start
                if (!empty($data['filter_entry_sn'])) {
                    $implode[] = "p.entry_sn = '" . $this->db->escape($data['filter_entry_sn']) . "'";
                }   
                //uncopied filter
                if (!empty($data['filter_uncopied_status'])) {
                    $implode[] = "p.copied = '0'";
                    $implode[] = "p.status IN (" . $data['filter_uncopied_status'] . ")";
                }
                if (isset($data['filter_clickbank']) ) {
                    $implode[] = "p.copied = '0'";
                    $implode[] = "p.is_clickbank = '" . (int)$data['filter_clickbank'] . "'";
                } 
                if ($implode) {
                    $sql .= " AND " . implode(" AND ", $implode);
                }
                $sort_data = array(
                    'p.status',
                    'p.publish',
                    'p.product_id',
                    'p.entry_sn',
                    'p.author_id',
                    'p.submited_date',
                    'p.date_modified',
                    'p.contribute_sn',
                    'p.user_id',
                    'p.artist_id'
                );  
                
                if (isset($data['order']) && ($data['order'] == 'ASC')) {
                    $order = " ASC";
                } else {
                    $order = " DESC";
                }
                $sql .= " ORDER BY ";
                if(!isset($this->request->get['sort'])){
                    if(in_array($this->user->getId(), $this->config->get("sns_group_artist"))){
                        $sql .= " p.status IN (".implode(" , ",$this->config->get("fbaccount_photo_artist_status")).") ".$order.", p.publish IN (".implode(" , ",$this->config->get("fbaccount_photo_artist_publish")).") ".$order.", ";
                    }else if(in_array($this->user->getId(), $this->config->get("sns_group_market"))){
                        $sql .= " p.status IN (".implode(" , ",$this->config->get("fbaccount_photo_auditor_status")).") ".$order.", ";
                    }
                }

                if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                    $sql .= $data['sort'].$order." ";   
                } else {
                    $sql .= " p.date_modified".$order."  ";    
                }

                if(!isset($this->request->get['sort'])){
                    if(in_array($this->user->getId(), $this->config->get("sns_group_market"))){
                        $sql .= ", p.publish IN (".implode(" , ",$this->config->get("fbaccount_photo_auditor_publish")).") ".$order;
                    }
                }
                if (isset($data['start']) || isset($data['limit'])) {
                    if ($data['start'] < 0) {
                        $data['start'] = 0;
                    }           

                    if ($data['limit'] < 1) {
                        $data['limit'] = 20;
                    }   
                    
                    $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
                }
                break;
        }
        if(!empty($sql)){
            $query = $this->db->query($sql);
            return $query->rows;
        }
        return false;
    }

    public function getTotalContributes($data) {
        $sql = "SELECT COUNT(contribute_id) AS total  FROM " . DB_PREFIX . "fbaccount_photo_post p WHERE p.publish > '".$this->config->get('fbaccount_photo_initial_publish')."'";
        $implode = array();
        // 根据当前登录用户,获取用户的下属用户的author_id
        if(!in_array($this->user->getId(), $this->config->get("sns_group_admin"))){
            $authors = array("'".$this->user->getAuthorId()."'");
            $wokers = $this->user->geWorkers();
            $this->load->model('user/user');
            foreach ($wokers as $value) {
                $_author = $this->model_user_user->getUser($value);
                if(!empty($_author['author_id'])){
                    $authors[] = "'".$_author['author_id']."'";
                }
            }
            $implode[] = "p.author_id IN (".implode(",", $authors).") ";
        }

        if (!empty($data['filter_contribute_sn'])) {
            $implode[] = "p.contribute_sn Like '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
        }
        if (!empty($data['filter_real_contribute_sn'])) {
            $implode[] = "p.contribute_sn = '" . $this->db->escape($data['filter_real_contribute_sn']) . "'";
        }
        if (!empty($data['filter_contribute_sn'])) {
            $implode[] = "p.contribute_sn Like '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
        }
        if (!empty($data['filter_entry'])) {
            $implode[] = "p.entry_sn Like '%" . $this->db->escape($data['filter_entry']) . "%'";
        }
        if (!empty($data['filter_product_id'])) {
            $implode[] = "p.product_id = '" . (int)$data['filter_product_id'] . "'";
        }

        if (!empty($data['filter_user_id'])) {
            $implode[] = "p.user_id = '" . (int)$data['filter_user_id'] . "'";
        }   
        if (!empty($data['filter_artist_id'])) {
            $implode[] = "p.artist_id = '" . (int)$data['filter_artist_id'] . "'";
        }       
        if (!empty($data['filter_author_id'])) {
            $implode[] = "p.author_id = '" . $this->db->escape(trim($data['filter_author_id'])) . "'";
        } 
        if (isset($data['filter_publish'])) {
            $implode[] = "p.publish = '".(int)$data['filter_publish']."' ";
        }
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "p.status = '" . (int)$data['filter_status'] . "'";
        }   
        if (!empty($data['filter_submited_date'])) {
            $implode[] = "DATE(p.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
        }
        if (!empty($data['filter_date_modified'])) {
            $implode[] = "DATE(p.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        //uncopied filter
        if (!empty($data['filter_uncopied_status'])) {
            $implode[] = "p.copied = '0'";
            $implode[] = "p.status IN (" . $data['filter_uncopied_status'] . ")";
        }
        if (isset($data['filter_clickbank']) ) {
            $implode[] = "p.copied = '0'";
            $implode[] = "p.is_clickbank = '" . (int)$data['filter_clickbank'] . "'";
        }
        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $query = $this->db->query($sql);
        return $query->row['total'];
    }
    public function getContributeBySn($contribute_sn){
        $sql = "SELECT p.* FROM " . DB_PREFIX . "fbaccount_photo_post p WHERE contribute_sn = '" . $this->db->escape($contribute_sn) . "'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function getContribute($contribute_id) {
        $sql = "SELECT p.* FROM " . DB_PREFIX . "fbaccount_photo_post p WHERE contribute_id = '" . (int)$contribute_id . "'";
        $query = $this->db->query($sql);
        return $query->row;
    }

    public function getContributeLinks($contribute_sn) {
        $sql = "SELECT * FROM " . DB_PREFIX . "fbaccount_photo_post_url WHERE  contribute_sn = '" . $this->db->escape($contribute_sn) . "'";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function resetTempLocker($contribute_id=false,$locker=false){
        $where= array();
        if($contribute_id){
            $where['contribute_id'] = (int)$contribute_id;
        }
        if($locker){
            $where['locker'] = (int)$locker;
        }else{
            $where['locker'] = (int)$this->user->getId();
        }
        $this->db->update("fbaccount_photo_post",$where,array('locker' => 0));
    }

    public function setTempLocker($contribute_id,$user_id=false){
        $value = $user_id ? (int)$user_id : (int)$this->user->getId();
        $this->db->update("fbaccount_photo_post",array('contribute_id' =>(int)$contribute_id),array('locker' =>$value));
    }
    
    public function editContribute($data,$mode='modified'){      
        if(!isset($data['contribute_id'])){return false;}
        $info = $this->getContribute($data['contribute_id']);
        if(!$info){return false;}
        $log = $fields = $where = array();
        $where['contribute_id'] = $data['contribute_id'];
        switch (strtolower($mode)) {
            case 'modified':
                if(isset($data['artist_auditor']) && $data['artist_auditor']){
                    $fields['artist_id'] = (int)$this->user->getId();
                }else{
                    $fields['user_id'] = (int)$this->user->getId();
                }     
                $fields['date_modified'] = date('Y-m-d H:i:s');        
                if(isset($data['publish']) && $data['publish'] !==false ){
                    if($data['publish'] > $this->config->get("fbaccount_photo_initial_publish") 
                        && in_array($info['status'], $this->config->get("fbaccount_photo_level_status"))){
                        $fields['publish'] = (int)$data['publish'];
                        $log['post'] = (int)$data['publish'];
                    }else{
                        return false;
                    }
                }
                if(!empty($data['upload_files'])){
                    $fields['upload_files'] = $data['upload_files'];
                }
                if(!empty($data['url_modified']) && !empty($data['target_url'])){
                    $fields['url_modified'] = 1;
                    $fields['target_url'] = $data['target_url'];
                    $this->db->delete("fbaccount_photo_post_url",array('contribute_sn' => $info['contribute_sn']));  
                }
                if(!empty($data['content_modified']) && !empty($data['content'])){
                    $fields['content'] = $data['content'];
                }
                if(!empty($data['note'])){
                    $fields['note'] = $data['note'];
                }
                if(!empty($data['finished_type']) && $data['finished_type']=='edit'){
                    $fields['status'] = $this->config->get("fbaccount_photo_artist_finished_status");
                    $log['edit'] = $this->config->get("fbaccount_photo_artist_finished_status");
                }
                if(!empty($data['finished_type']) && $data['finished_type']=='post'){
                    $fields['publish'] = $this->config->get("fbaccount_photo_artist_finished_publish");
                    $log['post'] = $this->config->get("fbaccount_photo_artist_finished_publish");
                }
                if(!empty($data['expired'])){
					$fields['expired'] = $data['expired'];
				}
               if(!empty($data['entry_sn'])){
					$fields['entry_sn'] = $data['entry_sn'];
				}
				$this->db->update("fbaccount_photo_post SET",$where, $fields);
                break;
            case 'init':
                $this->db->update("fbaccount_photo_post SET",$where, array('url_modified'=>0));
                if( $info['publish'] != $this->config->get("fbaccount_photo_testing_publish") ){
                    //$log['post'] = $this->config->get("fbaccount_photo_testing_publish");
                }
                break;
            case 'bulk':
                if(isset($data['publish']) ){
                    if($data['publish'] > $this->config->get("fbaccount_photo_initial_publish") 
                        && in_array($info['status'], $this->config->get("fbaccount_photo_level_status"))){
                        $fields['publish'] = $data['publish'];
                        if($info['publish'] != $data['publish']){
                            $log['post'] = (int)$data['publish'];   
                        }
                    }else{
                        return false;
                    }
                }
                if(isset($data['status']) ){
                    $fields['status'] = (int)$data['status'];
                    if($info['status'] != $data['status']){
                        $log['edit'] = (int)$data['status'];    
                    }
                    if(!isset($data['publish'])){
                        if(in_array($data['status'], $this->config->get("fbaccount_photo_level_status")) && $info['publish'] != $this->config->get("fbaccount_photo_testing_publish") ){
                            $fields['publish'] = $this->config->get("fbaccount_photo_testing_publish");
                            $log['post'] = $this->config->get("fbaccount_photo_testing_publish");
                        }
                    }
                }
                $this->db->update("fbaccount_photo_post",$where, $fields);
                if(isset($data['status'])){
                    $where['post_type'] = $this->post_type ;
                    $tmp = array(
                        'status'    => (int)$data['status'],
                        'amount'    => getContributeAmount($this->post_type,$data['status']),
                        'user_id'   => (int)$this->user->getId(),
                        'date_added'=> date('Y-m-d H:i:s')
                    );
                    $this->db->update("sns_balance",$where,$tmp);
                }
                break;
            case 'expired':
                $condition = array();
                $condition[] = " `contribute_id` = '".(int)$data['contribute_id']."' ";
                $condition[] = " `expired` > 0";
                $query = $this->db->query("SELECT DATEDIFF(NOW() ,expired) is_expired  FROM ".DB_PREFIX."fbaccount_photo_post WHERE ".implode(" AND ", $condition));
                if(isset($query->row['is_expired']) && (int)$query->row['is_expired'] > 0){
                    $this->db->update("fbaccount_photo_post",$where,array('publish' => $this->config->get("fbaccount_photo_expired_publish")));
                    if($info['publish']!=$this->config->get("fbaccount_photo_expired_publish")){
                        $log['post'] = (int)$this->config->get("fbaccount_photo_expired_publish");
                    }
                }   
                break;
        }
        $this->resetTempLocker($data['contribute_id']);
        $history_id = 0;
        if($log){
            foreach ($log as $key => $value) {
                if(in_array(trim($key), array('edit','post'))){
                    $tmp = array(
                        'type' => trim($key), 
                        'value' => (int)$value,
                        'user_id' => (int)$this->user->getId(),
                        'date_added' => date('Y-m-d H:i:s'),
                        'contribute_id' => (int)$data['contribute_id'],
                    );
                    $history_id = $this->db->insert('fbpage_nophoto_post_history',$tmp); 
                }
            }
        }
        return $history_id; 
    }

    public function getContributesHistory($contribute_id,$start=0,$limit=20){
        $sql = "SELECT h.*,u.nickname FROM ".DB_PREFIX."fbaccount_photo_post_history h LEFT JOIN ".DB_PREFIX."user u ON h.user_id = u.user_id WHERE h.contribute_id = '".(int)$contribute_id."'";

        $sql .= " ORDER BY h.date_added DESC LIMIT " . (int)$start. "," . (int)$limit;
        $query = $this->db->query($sql);
    
        return $query->rows;
    }

    public function getTotalContributesHistory($contribute_id){
        $query = $this->db->query("SELECT COUNT(*) total FROM ".DB_PREFIX."fbaccount_photo_post_history h WHERE h.contribute_id = '".(int)$contribute_id."'");
        return $query->row['total'];
    }
    
    public function importUrl($contribute_sn,$shortUrl){
        $this->db->query("INSERT INTO ".DB_PREFIX."fbaccount_photo_post_url SET contribute_sn='".$this->db->escape($contribute_sn)."' , short_url='".$this->db->escape($shortUrl)."'");
        return $this->db->getLastId();
    }
    public function deleUrl($shortUrl){
        $this->db->query("DELETE FROM ".DB_PREFIX."fbaccount_photo_post_url WHERE short_url='".$this->db->escape($shortUrl)."'");
        return $this->db->countAffected();;
    }
    public function emptyUrlByPost($postSn){
        $this->db->query("DELETE FROM ".DB_PREFIX."fbaccount_photo_post_url WHERE contribute_sn='".$this->db->escape($postSn)."'");
        return $this->db->countAffected();;
    }

    public function resetClickBankTargetURL(){
        $n=$e =0;
        $query = $this->db->query("SELECT c.contribute_id,c.contribute_sn,c.target_url,p.cb_link FROM ".DB_PREFIX."fbaccount_photo_post c LEFT JOIN ".DB_PREFIX."fbaccount p ON p.entry_sn = c.entry_sn WHERE c.is_clickbank = 1 AND p.is_clickbank = 1 ");
        if($query->num_rows){
            foreach ($query->rows as $row) {
                if(!empty($row['cb_link'])){
                    $_target_url = $row['cb_link'].$row['contribute_sn'];
                    $this->db->query("UPDATE ".DB_PREFIX."fbaccount_photo_post SET target_url = '".$this->db->escape($_target_url)."' WHERE contribute_id = '".(int)$row['contribute_id']."'");
                    $n++;
                }
            }
        }else{
            $e++;
        }
        return array('total'=>$query->num_rows,'success'=>$n,'error'=>$e);
    }

}