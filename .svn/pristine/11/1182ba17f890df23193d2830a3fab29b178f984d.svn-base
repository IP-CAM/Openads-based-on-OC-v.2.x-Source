<?php
class ModelNflPostSchedule extends Model {
    
    public function getSchedule($schedule_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "nfl_schedule WHERE schedule_id = '" . (int)$schedule_id . "'");
        
        return $query->row;
    }

    public function getSchedules($data = array()) {
        $sql = "SELECT ns.*,nm.name `match` FROM " . DB_PREFIX . "nfl_schedule ns LEFT JOIN ".DB_PREFIX."nfl_match nm ON ns.match_id = nm.match_id WHERE 1 ";

        if(isset($data['filter_status'])){
            $sql .= " AND ns.status = '".(int)$data['filter_status']."' ";
        }
        if(isset($data['filter_schedule_id'])){
            $sql .= " AND ns.schedule_id = '".(int)$data['filter_schedule_id']."' ";
        }
        if(isset($data['filter_team'])){
            $sql .= " AND (ns.home_team_id = '".(int)$data['filter_team']."' OR ns.road_team_id = '".(int)$data['filter_team']."')";
        }
        if(isset($data['filter_date'])){
            $sql .= " AND DATE(ns.date) >= DATE('".$data['filter_date']."') ";
        }
        $sort_data = array(
            'ns.date',
            'ns.time',
            'ns.status',
        );  
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];   
        } else {
            $sql .= " ORDER BY ns.date,ns.time";   
        }
        
        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
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

    public function getTotalSchedules() {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "nfl_schedule WHERE 1 ";
        if(isset($data['filter_schedule_id'])){
            $sql .= " AND schedule_id = '".(int)$data['filter_schedule_id']."' ";
        }
        if(isset($data['filter_team'])){
            $sql .= " AND (ns.home_team_id = '".(int)$data['filter_team']."' OR ns.road_team_id = '".(int)$data['filter_team']."')";
        }
        if(isset($data['filter_date'])){
            $sql .= " AND DATE(ns.date) >= DATE('".$data['filter_date']."') ";
        }
        $query = $this->db->query($sql);
        
        return $query->row['total'];
    }

    public function getTotalPosts($schedule_id){
        $query = $this->db->query("SELECT COUNT(*) total FROM ".DB_PREFIX."nfl_contribute WHERE schedule_id = '".$schedule_id."' ");
        return $query->row['total'];
    }

    public function getPlayer($player_id) {
        $query = $this->db->query("SELECT np.*,nt.name_en,nt.name_cn,nt.team_sn,nt.team_id,nt.desc,nt.flag FROM " . DB_PREFIX . "nfl_player np LEFT JOIN ".DB_PREFIX."nfl_team nt ON nt.team_id = np.team_id WHERE np.player_id = '" . (int)$player_id . "' AND np.status = '1'");

        return $query->row;
    }
    public function getPlayers($data=array()){
        $sql = "SELECT np.*,nt.team_sn,nt.name_en,nt.name_cn FROM " . DB_PREFIX . "nfl_player np LEFT JOIN ".DB_PREFIX."nfl_team nt ON nt.team_id = np.team_id WHERE 1";
        if (!empty($data['filter_name']) ) {
            $sql .= " AND np.`name` LIKE '%".$this->db->escape($data['filter_name'])."%' ";
        }
        if (isset($data['filter_status']) ) {
            $sql .= " AND np.`status` = '".(int)$data['filter_status']."' ";
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
    public function getPlayersByScheduleId($schedule_id) {
        $sql = "SELECT np.* FROM " . DB_PREFIX . "nfl_schedule_player nsp LEFT JOIN ".DB_PREFIX."nfl_player np ON np.player_id = nsp.player_id WHERE nsp.schedule_id = '" . (int)$schedule_id . "'";
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function postContribute($data){
        $now = date('Y-m-d H:i:s');
        $auto_num = $this->getAutoNum(array('team_id'=>(int)$data['team_id'],'gender_id'=>(int)$data['gender_id'],'customer_id'=>$this->customer->getId()));
        $contribute_sn = $data['precode'].zeroFull($auto_num);
        $fields = array(
            'schedule_id'       => $data['schedule_id'],
            'team_id'           => $data['team_id'],
            'player_id'         => $data['player_id'],
            'match_id'          => $data['match_id'],
            'gender_id'         => $data['gender_id'],
            'expired'           => $data['expired'],
            'content'           => $data['content'],
            'note'              => $data['note'],
            'precode'           => $data['precode'],
            'auto_num'          => $auto_num,
            'contribute_sn'     => $contribute_sn,
            'status'            => $this->config->get("nfl_initial_status"),
            'publish'           => $this->config->get("nfl_initial_publish"),
            'customer_id'       => (int)$this->customer->getId(),
            'submited_times'    => 1,
            'submited_date'     => $now,
            'date_modified'     => $now,
        );

        $contribute_id = $this->db->insert("nfl_contribute",$fields);
        $this->db->insert('manage_balance',array('contribute_id' => $contribute_id,'post_type' => 8,'customer_id' => $this->customer->getId(), 'user_id' => 0,'date_added' => $now ));
        $this->db->insert('nfl_contribute_history',array('contribute_id' => $contribute_id,'type' => 'edit','value' => $this->config->get("nfl_initial_status"), 'user_id' => 0,'date_added' => $now ));
        $this->db->insert('nfl_contribute_history',array('contribute_id' => $contribute_id,'type' => 'post','value' => $this->config->get("nfl_initial_publish"), 'user_id' => 0,'date_added' => $now));
        return $contribute_id;
    }
    public function getAutoNum($data){
        if(!isset($data['team_id']) || !isset($data['gender_id']) ){ return false;}
        $implode = array();
        $implode[] = " team_id = '".(int)$data['team_id']."' ";
        $implode[] = " gender_id = '".(int)$data['gender_id']."' ";
        $implode[] = " customer_id = '".isset($data['customer_id']) ? $data['customer_id'] : (int)$this->customer->getId()."' ";
        $query=$this->db->query("SELECT MAX(auto_num) as max FROM ".DB_PREFIX."nfl_contribute WHERE ".implode(" AND ", $implode));
        $newValue = (int)($query->row['max']+1);
        return $newValue;
    }

    public function getConfigValue($contribute_config_id){
        $result=$this->db->query("SELECT value FROM ".DB_PREFIX."contribute_config WHERE contribute_config_id = '".(int)$contribute_config_id."'");
    
        return $result->row['value'] ;
    }


}