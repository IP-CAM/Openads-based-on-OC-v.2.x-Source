<?php
class ModelNflSchedule extends Model {
    public function addSchedule($data) {

        $fields = array(
            'match_id'      => $data['match_id'],
            'date'          => date('Y-m-d',strtotime($data['date'])),
            'time'          => $data['time'],
            'location'      => $data['location'],
            'home_team_id'  => $data['home_team_id'],
            'home_score'    => (int)$data['home_score'],
            'road_team_id'  => $data['road_team_id'],
            'road_score'    => (int)$data['road_score'],
            'status'        => (int)$data['status'],
            'group'         => is_array($data['group']) ? implode(",", $data['group']) : "", 
            'note'          => strip_tags($data['note'])
        );
        $schedule_id = $this->db->insert("nfl_schedule",$fields);

        if(isset($data['player_id']) && is_array($data['player_id'])){
            foreach ($data['player_id'] as $team => $players) {
                if(is_array($players)){
                    foreach ($players as $player_id) {
                        $fields = array(
                            'schedule_id'   => $schedule_id,
                            'team'          => $team == $data['home_team_id'] ? 'home' : 'road',
                            'player_id'     => $player_id
                        );
                        $this->db->insert("nfl_schedule_player",$fields);
                    }
                }
            }
        }
        return $schedule_id;
    }
    
    public function editSchedule($schedule_id, $data) {

        $fields = array(
            'match_id'      => $data['match_id'],
            'date'          => date('Y-m-d',strtotime($data['date'])),
            'time'          => $data['time'],
            'location'      => $data['location'],
            'home_team_id'  => $data['home_team_id'],
            'home_score'    => (int)$data['home_score'],
            'road_team_id'  => $data['road_team_id'],
            'road_score'    => (int)$data['road_score'],
            'status'        => (int)$data['status'],
            'group'         => is_array($data['group']) ? implode(",", $data['group']) : "", 
            'note'          => strip_tags($data['note'])
        );
        $this->db->update("nfl_schedule",array('schedule_id'=>$schedule_id),$fields);
        if(isset($data['player_id']) && is_array($data['player_id'])){
            $this->db->delete("nfl_schedule_player",array('schedule_id' => $schedule_id ));
            foreach ($data['player_id'] as $team => $players) {
                if(is_array($players)){
                    foreach ($players as $player_id) {
                        $fields = array(
                            'schedule_id'   => $schedule_id,
                            'team'          => $team == $data['home_team_id'] ? 'home' : 'road',
                            'player_id'     => $player_id
                        );
                        $this->db->insert("nfl_schedule_player",$fields);
                    }
                }
            }
        }
        return $schedule_id;
    }
    
    public function deleteSchedule($schedule_id) {
        $this->db->delete("nfl_schedule",array('schedule_id' => $schedule_id ));
    }
    
    public function getSchedule($schedule_id) {
        
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nfl_schedule WHERE schedule_id = '" . (int)$schedule_id . "'");
        return $query->row;
    }

    public function getSchedules($data = array()) {
        $sql = "SELECT s.*,m.name AS `match`,t1.name_en home_en,t1.name_cn home_cn,t1.flag home_flag,t1.team_sn home_sn,t2.name_en road_en,t2.name_cn road_cn,t2.flag road_flag,t2.team_sn road_sn FROM " . DB_PREFIX . "nfl_schedule s 
            LEFT JOIN ".DB_PREFIX."nfl_match m ON m.match_id = s.match_id LEFT JOIN ".DB_PREFIX."nfl_team t1 ON t1.team_id = s.home_team_id LEFT JOIN ".DB_PREFIX."nfl_team t2 ON t2.team_id = s.road_team_id WHERE 1 " ;                                                                                                                                                    
        $implode = array();

        if (!empty($data['filter_home_team'])) {
            $implode[] = "s.home_team_id = '" . (int)$data['filter_home_team'] . "'";
        }       
        if (!empty($data['filter_road_team'])) {
            $implode[] = "s.road_team_id = '" . (int)$data['filter_road_team'] . "'";
        }  
        if (!empty($data['filter_date'])) {
            $implode[] = "DATE(s.date) >= DATE('" . $this->db->escape($data['filter_date']) . "')";
        } 
        
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "s.status = '" . (int)$data['filter_status'] . "'";
        }   

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $sort_data = array(
            's.status',
            'road_en',
            'home_en',
            's.road_score',
            's.home_score',
        );  
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];   
        } else {
            $sql .= " ORDER BY s.match_id,s.date";   
        }
            
        if (isset($data['order']) && ($data['order'] == 'ASC')) {
            $sql .= " ASC";
        } else {
            $sql .= " DESC";
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
    
    public function getTotalSchedules($data = array()) {
        $sql = "SELECT COUNT(s.schedule_id) total FROM " . DB_PREFIX . "nfl_schedule s  WHERE 1 " ;                                                                                                                                                    
        $implode = array();

        if (!empty($data['filter_home_team'])) {
            $implode[] = "s.home_team_id = '" . (int)$data['filter_home_team'] . "'";
        }       
        if (!empty($data['filter_road_team'])) {
            $implode[] = "s.road_team_id = '" . (int)$data['filter_road_team'] . "'";
        }  
        if (!empty($data['filter_date'])) {
            $implode[] = "DATE(s.date) >= DATE('" . $this->db->escape($data['filter_date']) . "')";
        } 
        
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "s.status = '" . (int)$data['filter_status'] . "'";
        }  

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $query = $this->db->query($sql);

        return $query->row['total'];
    }
    
    public function getSchedulePlayers($schedule_id){

        $query = $this->db->query("SELECT player_id,team FROM ".DB_PREFIX."nfl_schedule_player WHERE schedule_id = '".(int)$schedule_id."'");

        return $query->num_rows ? $query->rows : array();
    }
}