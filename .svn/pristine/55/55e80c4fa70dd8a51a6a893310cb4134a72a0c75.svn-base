<?php
class ModelNflProfilePlayer extends Model {

    private $post_type = 8;

    public function getTeamSN($team_id){
        $query = $this->db->query("SELECT team_sn FROM ".DB_PREFIX."nfl_team WHERE team_id = '".(int)$team_id."'");
        return $query->row['team_sn'];
    }

    public function getContributes($data) {

        $sql = "SELECT nc.*  FROM " . DB_PREFIX . "nfl_contribute nc WHERE author_id = '".$this->user->getAuthorId()."' AND (nc.schedule_id = 0 OR nc.schedule_id IS NULL )";
        $implode = array();

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

        if (isset($data['filter_status']) && !is_null($data['filter_status']) && $data['filter_status']!==false) {
            $implode[] = "nc.status = '" . (int)$data['filter_status'] . "'";
        }

        if (!empty($data['filter_submited_date'])) {
            $implode[] = "DATE(nc.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
        }
        if (!empty($data['filter_date_modified'])) {
            $implode[] = "DATE(nc.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $sort_data = array(
            'nc.status',
            'nc.player_id',
            'nc.team_id',
            'nc.submited_date',
            'nc.date_modified',
            'nc.contribute_sn',
            'nc.user_id',
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


        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }


        $query = $this->db->query($sql);
        return $query->rows;

    }

    public function getTotalContributes($data) {
        $sql = "SELECT COUNT(contribute_id) AS total  FROM " . DB_PREFIX . "nfl_contribute nc LEFT JOIN ".DB_PREFIX."nfl_team nt ON nt.team_id = nc.team_id WHERE author_id = '".$this->user->getAuthorId()."' AND (nc.schedule_id = 0 OR nc.schedule_id IS NULL ) ";
        $implode = array();

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

        if (isset($data['filter_status']) && !is_null($data['filter_status']) && $data['filter_status']!==false) {
            $implode[] = "nc.status = '" . (int)$data['filter_status'] . "'";
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
        if($contribute_id){
            $where['contribute_id'] = (int)$contribute_id;
        }
        if($locker){
            $where['locker'] = (int)$locker;
        }else{
            $where['locker'] = (int)$this->user->getId();
        }
        $this->db->update("nfl_contribute",$where ,array('locker' => '0'));
    }

    public function setTempLocker($contribute_id,$user_id=false){
        $data = array('locker' => $user_id ? (int)$user_id : (int)$this->user->getId());
        $this->db->update("nfl_contribute", array('contribute_id' => (int)$contribute_id), $data);
    }
    public function modify($data){
        if(!isset($data['contribute_id'])){return false;}
        $info = $this->getContribute($data['contribute_id']);
        if(!$info){return false;}
        $log = $fields = $where = array();
        $where['contribute_id'] = $data['contribute_id'];
        $fields['user_id'] = $this->user->getId();
        $fields['date_modified'] = date('Y-m-d H:i:s');

        if(!empty($data['content_modified']) && !empty($data['content'])){
            $fields['content'] = $data['content'];
        }
        if(!empty($data['expired_modified']) && !empty($data['expired'])){
            $fields['expired'] = $data['expired'];
        }
        if(!empty($data['team_modified']) && !empty($data['team_id'])){
            $fields['team_id'] = (int)$data['team_id'];
        }
        if(!empty($data['player_modified']) && !empty($data['player_id'])){
            $fields['player_id'] = (int)$data['player_id'];
        }        
        if(!empty($data['note'])){
            $fields['note'] = $data['note'];
        }
        $this->db->update("nfl_contribute",$where, $fields);

        $this->resetTempLocker($data['contribute_id']);
        $history_id = 0;
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

    public function getHistories($contribute_id,$start=0,$limit=20){
        $sql = "SELECT h.*,u.nickname FROM ".DB_PREFIX."nfl_contribute_history h LEFT JOIN ".DB_PREFIX."user u ON h.user_id = u.user_id WHERE h.type='edit' AND h.contribute_id = '".(int)$contribute_id."' ORDER BY h.date_added DESC LIMIT " . (int)$start. "," . (int)$limit;
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalHistory($contribute_id){
        $query = $this->db->query("SELECT COUNT(history_id) total FROM ".DB_PREFIX."nfl_contribute_history WHERE type = 'edit' AND contribute_id = '".(int)$contribute_id."'");
        return $query->row['total'];
    }

}