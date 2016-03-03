<?php
class ModelNflPublishPlayer extends Model {

    private $post_type = 8;
    public function copyContribute($data,$with_photo=false){

        if(isset($data['team_id']) && isset($data['author_id'])){
            $query = $this->db->query("SELECT * FROM ".DB_PREFIX."nfl_team WHERE team_id = '".(int)$data['team_id']."'");
            if($query->num_rows){
                $tmp = array();
                $tmp['user_id']         = $this->user->getId();
                $tmp['author_id']       = $data['author_id'];
                $tmp['content']         = $data['content'];
                $tmp['expired']         = $data['expired'];
                $tmp['publish']         = 1;
                $tmp['submited_date']   = date('Y-m-d H:i:s');
                $tmp['date_modified']   = date('Y-m-d H:i:s');
                $tmp['submited_times']  = 1;
                $tmp['team_id'] = $data['team_id'];
                $tmp['gender_id'] = $data['gender_id'];
                $tmp['player_id'] = $data['player_id'];
                $code_team = $this->getTeamSN($data['team_id']);
                $code_gender = $this->getConfigValue($data['gender_id']);
                $code_country = '01';
                $auto_num = $this->getAutoNum($data['team_id'],$data['gender_id'],$data['author_id']);
                $tmp['auto_num'] = $auto_num;
                $precode = $code_team.$code_gender.$code_country.$data['author_id'];
                $tmp['precode'] = $precode."S";
                $table = $history_table = $post_type = '';
                if(strlen($precode)==9){
                    if($with_photo){
                        $tmp['status'] = 2;
                        $tmp['publish'] = 1;
                        $tmp['precode'] = $precode."P";
                        $tmp['contribute_sn'] = $precode."P".zeroFull($auto_num);
                        $table = 'nfl_contribute';
                        $history_table = 'nfl_contribute_history';
                        $post_type =7;
                    }else{
                        $tmp['status'] = 1;
                        $tmp['publish'] = 1;
                        $tmp['precode'] = $precode."S";
                        $tmp['contribute_sn'] = $precode."S".zeroFull($auto_num);
                        $table = 'nfl_contribute';
                        $history_table = 'nfl_contribute_history';
                        $post_type = $this->post_type;
                    }
                }else{
                    return false;
                }

                $contribute_id = $this->db->insert($table, $tmp);
                $this->db->query("INSERT INTO ".DB_PREFIX."sns_balance SET contribute_id = '".$contribute_id."',post_type = '".$post_type."',author_id = '".$data['author_id']."', user_id = '".(int)$data['user_id']."',date_added = NOW() ");
                $this->db->query("INSERT INTO ".DB_PREFIX.$history_table." SET contribute_id = '".$contribute_id."',type = 'edit',value = '".$tmp['status']."', user_id = '".$this->user->getId()."',date_added = NOW() ");
                $this->db->query("INSERT INTO ".DB_PREFIX.$history_table." SET contribute_id = '".$contribute_id."',type = 'post',value = '".$tmp['publish']."', user_id = '".$this->user->getId()."',date_added = NOW() ");

                $this->db->query("UPDATE ".DB_PREFIX."nfl_contribute SET copied = copied+1 WHERE contribute_sn = '".$this->db->escape($data['contribute_sn'])."'");
                return $tmp['contribute_sn'];
            }
        }
    }

    public function getAutoNum($team_id,$gender_id,$author_id){
        if(!isset($team_id) || !isset($gender_id) ){ return false;}
        $implode = array(
            " team_id = '".(int)$team_id."' ",
            " gender_id = '".(int)$gender_id."' ",
            " author_id = '".$author_id."' " 
        );
        $query=$this->db->query("SELECT MAX(auto_num) as max FROM ".DB_PREFIX."nfl_contribute WHERE ".implode(" AND ", $implode));
        $newValue = (int)($query->row['max']+1);
        return $newValue;
    }
    public function getConfigValue($option_id){
        $result=$this->db->query("SELECT value FROM ".DB_PREFIX."sns_option WHERE option_id = '".(int)$option_id."'");

        return $result->row['value'] ;
    }
    public function getTeamSN($team_id){
        $query = $this->db->query("SELECT team_sn FROM ".DB_PREFIX."nfl_team WHERE team_id = '".(int)$team_id."'");
        return $query->row['team_sn'];
    }

    public function deleteContribute($contribute_id,$bulk = false,$delimiter = ','){
            $where = array();
            $where['contribute_id'] = $contribute_id;
            $this->db->delete("nfl_contribute",$where);
            $this->db->delete("nfl_contribute_history",$where);
            $where['post_type'] = $this->post_type;
            $this->db->delete("sns_balance",$where);
            $this->db->delete("nfl_content_history",array('post_id'=>$contribute_id));
    }

    public function getContributes($data) {
        if(!isset($data['filter_mode'])){$data['filter_mode']='';}
        $sql = '';
        switch (strtolower($data['filter_mode']) ){

            case 'posts':
                $sql = "SELECT nc.*,nt.name_en,nf.name player,nm.name `match` FROM " . DB_PREFIX . "nfl_contribute nc LEFT JOIN ".DB_PREFIX."nfl_team nt ON nt.team_id = nc.team_id LEFT JOIN ".DB_PREFIX."nfl_player nf ON nf.player_id = nc.player_id LEFT JOIN ".DB_PREFIX."nfl_match nm ON nc.match_id = nm.match_id  WHERE (nc.schedule_id = 0 OR nc.schedule_id IS NULL ) ";
                $implode = array();
                if (!empty($data['filter_teams']) && is_array($data['filter_teams'])) {
                    $implode[] = "nc.team_id IN (" . implode(" , ", $data['filter_teams']) . ")";
                }
                if (!empty($data['filter_players']) && is_array($data['filter_players'])) {
                    $implode[] = "nc.player_id IN (" . implode(" , ", $data['filter_players']) . ")";
                }
                if (!empty($data['filter_user_id'])) {
                    $implode[] = "nc.user_id = '" . (int)$data['filter_user_id'] . "'";
                }
                if (!empty($data['filter_publishes']) && is_array($data['filter_publishes'])) {
                    $implode[] = "nc.publish IN (".implode(" , ", $data['filter_publishes']).") ";
                }
                if (!empty($data['filter_statuses']) && is_array($data['filter_statuses'])) {
                    $implode[] = "nc.status IN (".implode(" , ", $data['filter_statuses']).") ";
                }
                if ($implode) {
                    $sql .= " AND " . implode(" AND ", $implode);
                }
                $sql .= " ORDER BY nc.contribute_sn ASC";
                break;
            default:
                $sql = "SELECT nc.*,nt.name_en,nt.name_cn, nf.name player FROM " . DB_PREFIX . "nfl_contribute nc
                LEFT JOIN ".DB_PREFIX."nfl_team nt ON nt.team_id = nc.team_id LEFT JOIN ".DB_PREFIX."nfl_player nf ON nf.player_id = nc.player_id WHERE (nc.schedule_id = 0 OR nc.schedule_id IS NULL )";
                $implode = array();
                if($this->user->getGroupId()!=1){
                    
                    $worker = array();
                    if($this->user->getAuthorId()){
                        $worker[] = "'".$this->user->getAuthorId()."'";
                    }
                    $query = $this->db->query("SELECT worker FROM ".DB_PREFIX."user WHERE user_id = '".$this->user->getId()."'");
                    if(!empty($query->row['worker'])){
                        $authors = explode(",", $query->row['worker']);
                        if(is_array($authors)){
                            foreach ($authors as $author) {
                                $query = $this->db->query("SELECT author_id FROM ".DB_PREFIX."user WHERE user_id = '".(int)$author."'");
                                if((int)$query->row['author_id']){
                                    $worker[] = "'".$query->row['author_id']."'";
                                }
                            }
                        }
                    }  
                    if($worker)                {
                        $implode[] = "nc.author_id IN (".implode(",", $worker).") ";
                    }else{
                        return array();
                    } 
                }
                
                if (!empty($data['filter_contribute_sn'])) {
                    $implode[] = "nc.contribute_sn LIKE '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
                }
                if (!empty($data['filter_team'])) {
                    $implode[] = "nc.team_id = '" . (int)$data['filter_team'] . "'";
                }
                if (!empty($data['filter_player_id'])) {
                    $implode[] = "nc.player_id = '" . (int)$data['filter_player_id'] . "'";
                }
                if (!empty($data['filter_user_id'])) {
                    $implode[] = "nc.user_id = '" . (int)$data['filter_user_id'] . "'";
                }
                if (!empty($data['filter_author_id'])) {
                    $implode[] = "nc.author_id = '" . $this->db->escape($data['filter_author_id']) . "'";
                }
                if (isset($data['filter_status']) && !is_null($data['filter_status']) && $data['filter_status']!==false) {
                    $implode[] = "nc.status = '" . (int)$data['filter_status'] . "'";
                }

                if (isset($data['filter_publish'])) {
                    $implode[] = "nc.publish = '".(int)$data['filter_publish']."' ";
                }
                if (!empty($data['filter_submited_date'])) {
                    $implode[] = "DATE(nc.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
                }
                if (!empty($data['filter_date_modified'])) {
                    $implode[] = "DATE(nc.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
                }

                //uncopied filter
                if (!empty($data['filter_uncopied_status'])) {
                    $implode[] = "nc.copied = '0'";
                    $implode[] = "nc.status IN (" . $data['filter_uncopied_status'] . ")";
                }
                if ($implode) {
                    $sql .= " AND " . implode(" AND ", $implode);
                }
                $sort_data = array(
                    'nc.status',
                    'nc.publish',
                    'nc.player_id',
                    'nc.team_id',
                    'nc.author_id',
                    'nc.submited_date',
                    'nc.date_modified',
                    'nc.contribute_sn',
                    'user',
                );

                if (isset($data['order']) && ($data['order'] == 'ASC')) {
                    $order = " ASC";
                } else {
                    $order = " DESC";
                }
                $sql .= " ORDER BY ";
                if(!isset($this->request->get['sort'])){
                    if(in_array($this->user->getId(), $this->config->get("sns_group_market"))){
                        $sql .= " nc.status IN (".implode(" , ",$this->config->get("nfl_auditor_status")).") ".$order.", ";
                    }
                }

                if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                    $sql .= $data['sort'].$order." ";
                } else {
                    $sql .= " nc.date_modified".$order."  ";
                }

                if(!isset($this->request->get['sort'])){
                    if(in_array($this->user->getId(), $this->config->get("sns_group_market"))){
                        $sql .= ", nc.publish IN (".implode(" , ",$this->config->get("nfl_auditor_publish")).") ".$order;
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
        $sql = "SELECT COUNT(contribute_id) AS total  FROM " . DB_PREFIX . "nfl_contribute nc LEFT JOIN ".DB_PREFIX."nfl_team nt ON nt.team_id = nc.team_id WHERE (nc.schedule_id = 0 OR nc.schedule_id IS NULL ) ";
        $implode = array();
        if($this->user->getGroupId()!=1){
            //$implode[] = "FIND_IN_SET('".$this->user->getId()."',nt.group) ";
            $worker = array();
            if((int)$this->user->getAuthorId()){
                $worker[] = "'".$this->user->getAuthorId()."'";
            }
            $query = $this->db->query("SELECT worker FROM ".DB_PREFIX."user WHERE user_id = '".$this->user->getId()."'");
            if(!empty($query->row['worker'])){
                $authors = explode(",", $query->row['worker']);
                if(is_array($authors)){
                    foreach ($authors as $author) {
                        $query = $this->db->query("SELECT author_id FROM ".DB_PREFIX."user WHERE user_id = '".(int)$author."'");
                        if((int)$query->row['author_id']){
                            $worker[] = "'".$query->row['author_id']."'";
                        }
                    }
                }
            }  
            if($worker)                {
                $implode[] = "nc.author_id IN (".implode(",", $worker).") ";
            }else{
                return 0;
            } 
        }
        if (!empty($data['filter_contribute_sn'])) {
            $implode[] = "nc.contribute_sn LIKE '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
        }

        if (!empty($data['filter_team'])) {
            $implode[] = "nc.team_id = '" . (int)$data['filter_team'] . "'";
        }
        if (!empty($data['filter_player_id'])) {
            $implode[] = "nc.player_id = '" . (int)$data['filter_player_id'] . "'";
        }
        if (!empty($data['filter_user_id'])) {
            $implode[] = "nc.user_id = '" . (int)$data['filter_user_id'] . "'";
        }

        if (!empty($data['filter_author_id'])) {
            $implode[] = "nc.author_id = '" . $this->db->escape($data['filter_author_id']) . "'";
        }
        if (isset($data['filter_status']) && !is_null($data['filter_status']) && $data['filter_status']!==false) {
            $implode[] = "nc.status = '" . (int)$data['filter_status'] . "'";
        }

        if (isset($data['filter_publish'])) {
            $implode[] = "nc.publish = '".(int)$data['filter_publish']."' ";
        }
        if (!empty($data['filter_submited_date'])) {
            $implode[] = "DATE(nc.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
        }
        if (!empty($data['filter_date_modified'])) {
            $implode[] = "DATE(nc.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        //uncopied filter
        if (!empty($data['filter_uncopied_status'])) {
            $implode[] = "nc.copied = '0'";
            $implode[] = "nc.status IN (" . $data['filter_uncopied_status'] . ")";
        }
        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $query = $this->db->query($sql);
        return $query->row['total'];
    }
    public function getContributeBySn($contribute_sn){
        $sql = "SELECT nc.* FROM " . DB_PREFIX . "nfl_contribute nc WHERE (nc.schedule_id = 0 OR nc.schedule_id IS NULL ) AND contribute_sn = '" . $this->db->escape($contribute_sn) . "'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function getContribute($contribute_id) {
        $sql = "SELECT nc.* FROM " . DB_PREFIX . "nfl_contribute nc WHERE (nc.schedule_id = 0 OR nc.schedule_id IS NULL ) AND contribute_id = '" . (int)$contribute_id . "'";
        $query = $this->db->query($sql);
        return $query->row;
    }

    public function resetTempLocker($contribute_id=false,$locker=false){
        $where= array();
        if($contribute_id){
            $where['contribute_id'] = $contribute_id;
        }
        if($locker){
            $where['locker'] = $locker;
        }else{
            $where['locker'] = $this->user->getId();
        }
        $this->db->update("nfl_contribute",$where ,array('locker' => '0'));
    }

    public function setTempLocker($contribute_id,$user_id=false){
        $data = array('locker' => $user_id ? (int)$user_id : (int)$this->user->getId());
        $this->db->update("nfl_contribute", array('contribute_id' => (int)$contribute_id), $data);
    }
    public function editContribute($data,$mode='approve'){
        if(!isset($data['contribute_id'])){return false;}
        $info = $this->getContribute($data['contribute_id']);
        if(!$info){return false;}
        $log = $where = array();
        $where['contribute_id'] = $data['contribute_id'];
        switch (strtolower($mode)) {
            case 'approve':
                $fields = array();
                $fields['user_id'] = $this->user->getId();
                $fields['date_modified'] = date('Y-m-d H:i:s');
                if(!empty($data['note'])){
                    $fields['note'] = $data['note'];
                }
                if(isset($data['status'])){
                    $fields['status'] = (int)$data['status'];
                    if(in_array($data['status'], $this->config->get("nfl_level_status")) && $info['publish'] != $this->config->get("nfl_testing_publish") ){
                        $fields['publish'] = $this->config->get("nfl_testing_publish");
                        $log['post'] = $this->config->get("nfl_testing_publish");
                    }else if(!in_array($data['status'], $this->config->get("nfl_level_status")) && $info['publish'] != $this->config->get("nfl_initial_publish")){
                        $fields['publish'] = $this->config->get("nfl_initial_publish");
                        $log['post'] = $this->config->get("nfl_initial_publish");
                    }
                    $log['edit'] = (int)$data['status'];
                }
                $this->db->update("nfl_contribute",$where, $fields);
                if(isset($data['status'])){
                    $fields = array(
                        'user_id' => $this->user->getId(),
                        'status' => $data['status'],
                        'amount' => getContributeAmount($this->post_type,$data['status']),
                        'date_added' => date('Y-m-d H:i:s')
                    );
                    $where['post_type'] = $this->post_type;
                    $this->db->update("sns_balance",$where,$fields);
                }
                break;
            case 'modified':
                $fields = array();
                $fields['user_id'] = $this->user->getId();
                $fields['date_modified'] = date('Y-m-d H:i:s');
                if(isset($data['publish']) && $data['publish'] !==false ){
                    if($data['publish']>1 && in_array($info['status'], $this->config->get("nfl_level_status"))){
                        $fields['publish'] = (int)$data['publish'];
                        $log['post'] = (int)$data['publish'];
                    }else{
                        return false;
                    }
                }

                if(!empty($data['content_modified']) && !empty($data['content'])){
                    $fields['content'] = $data['content'];
                }
                if(!empty($data['note'])){
                    $fields['note'] = $data['note'];
                }

                if(!empty($data['expired'])){
                    $fields['expired'] = $data['expired'];
                }
                if(!empty($data['team_id'])){
                    $fields['team_id'] = (int)$data['team_id'];
                }
                $this->db->update("nfl_contribute",$where, $fields);
                break;
            case 'bulk':
                $fields = array();
                $fields['user_id'] = $this->user->getId();
                $fields['date_modified'] = date('Y-m-d H:i:s');
                if(isset($data['publish']) ){
                    if($data['publish']> $this->config->get("nfl_initial_publish") 
                        && in_array($info['status'], $this->config->get("nfl_level_status"))){
                        $fields['publish'] = (int)$data['publish'];
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
                        if(in_array($data['status'], $this->config->get("nfl_level_status")) 
                            && $info['publish'] != $this->config->get("nfl_testing_publish") ){
                            $fields['publish'] = $this->config->get("nfl_testing_publish");
                            $log['post'] = $this->config->get("nfl_testing_publish");
                        }
                    }
                }
                $this->db->update("nfl_contribute",$where, $fields);
                if(isset($data['status'])){
                    $fields = array(
                        'user_id' => $this->user->getId(),
                        'status' => $data['status'],
                        'amount' => getContributeAmount($this->post_type,$data['status']),
                        'date_added' => date('Y-m-d H:i:s')
                    );
                    $where['post_type'] = $this->post_type;
                    $this->db->update("sns_balance",$where,$fields);
                }
                break;
            case 'expired':
                $condition = array();
                $condition[] = " `contribute_id` = '".(int)$data['contribute_id']."' ";
                $condition[] = " `expired` > 0";
                $query = $this->db->query("SELECT DATEDIFF(NOW() ,expired) is_expired  FROM ".DB_PREFIX."nfl_contribute WHERE ".implode(" AND ", $condition));

                if(isset($query->row['is_expired']) && (int)$query->row['is_expired'] > 0){
                    $this->db->query("UPDATE ".DB_PREFIX."nfl_contribute SET publish = '".$this->config->get("nfl_expired_publish")."' WHERE contribute_id = '".(int)$data['contribute_id']."'");

                    if($info['publish']!=$this->config->get("nfl_expired_publish")){
                        $log['post'] = (int)$this->config->get("nfl_expired_publish");
                    }
                }
                break;
        }
        $this->resetTempLocker($data['contribute_id']);
        $history_id = 0 ;
        if($log){
            foreach ($log as $key => $value) {
                if(in_array(trim($key), array('edit','post'))){
                    $tmp = array(
                        'type' => trim($key), 
                        'value' => (int)$value,
                        'user_id' => $this->user->getId(),
                        'date_added' => date('Y-m-d H:i:s'),
                        'contribute_id' => (int)$data['contribute_id'],
                    );
                    $history_id = $this->db->insert('nfl_contribute_history',$tmp); 
                }
            }
        }
        return $history_id;
    }
    public function insertContribute($data){
        $fields = array(
            'contribute_sn'      => $data['contribute_sn'],
            'precode'   => $data['precode'],
            'auto_num'   => $data['auto_num'],
            'status'   => '4',
            'publish'  => '3',
            'user_id'  => '1',
            'content'   => htmlspecialchars_decode($data['content']),
            'match_id'   => !empty($data['season']) ? $this->getMatchIdByName($data['season']) : "",
            'player_id' => !empty($data['player_name']) ? $this->getPlayIdByPlayerName($data['player_name']) : "",
            'team_id'  => !empty($data['productcode']) ? $this->getTeamIdByProductCode($data['productcode']) : "",
            'author_id'  => substr($data['contribute_sn'], 6,3),
            'date_modified'  => date('Y-m-d H:i:s'),

        );
        return $this->db->insert("nfl_contribute",$fields);
    }

    public function getTeamIdByProductCode($productCode){
        $query=$this->db->query("SELECT team_id FROM ".DB_PREFIX."nfl_team WHERE team_sn='".$productCode."'");
        return $query->row['team_id'];
    }
    public function getPlayIdByPlayerName($playname){
        $playname=$this->TrimallAndToLower($playname);
        $query=$this->db->query("SELECT player_id FROM ".DB_PREFIX."nfl_player WHERE replace(lower(`name`),' ','')='".$this->db->escape($playname)."'");
        if($query->rows){
            return $query->row['player_id'];
        }else{
            return "";
        }
        
    }
    public function getMatchIdByName($seasonName){
        $seasonName=strtolower($seasonName);
        $query=$this->db->query("SELECT match_id FROM ".DB_PREFIX."nfl_match WHERE lower(`name`)='".$this->db->escape($seasonName)."'");
       if($query->rows){
            return $query->row['match_id'];
        }else{
            return "";
        }       
    }
    public function isSameContribute($contribute_sn){
        $query=$this->db->query("SELECT * FROM ".DB_PREFIX."nfl_contribute WHERE contribute_sn='".$contribute_sn."'");
        if ($query->rows){
            return true;
        }else{
            return false;
        }
    }

    public function getHistories($contribute_id,$start=0,$limit=20){
        $sql = "SELECT h.*,u.nickname FROM ".DB_PREFIX."nfl_contribute_history h LEFT JOIN ".DB_PREFIX."user u ON h.user_id = u.user_id WHERE h.contribute_id = '".(int)$contribute_id."' ORDER BY h.date_added DESC LIMIT " . (int)$start. "," . (int)$limit;
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalHistory($contribute_id){
        $query = $this->db->query("SELECT COUNT(history_id) total FROM ".DB_PREFIX."nfl_contribute_history WHERE contribute_id = '".(int)$contribute_id."'");
        return $query->row['total'];
    }
    function TrimallAndToLower($str)//删除空格
    {
        $qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
        $str = strtolower($str);
        return str_replace($qian,$hou,$str);
    }

}