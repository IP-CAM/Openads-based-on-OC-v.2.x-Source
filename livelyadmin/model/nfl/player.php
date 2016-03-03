<?php
class ModelNflPlayer extends Model {
    private $post_type = 8;
    public function addPlayer($data) {
        $fields = array(
            'name'      => $data['name'],
            'number'    => $data['number'],
            'avatar'    => isset($data['avatar']) ? htmlspecialchars_decode($data['avatar']) : '',
            'note'      => isset($data['note']) ? htmlspecialchars_decode($data['note']) : '',
            'team_id'   => (int)$data['team_id'],
            'position'  => $data['position'],
            'height'    => $data['height'],
            'weight'    => $data['weight'],
            'birthday'  => isset($data['birthday']) && $data['birthday'] ? date('Y-m-d',strtotime($data['birthday'])) : '',
            'age'       => isset($data['age']) ? (int)$data['age'] : '',
            'veteran'  => $data['veteran'],
            'school'   => $data['school'],
            'status'   => (int)$data['status'],
            'sort'     => (int)$data['sort'],
        );
        return $this->db->insert("nfl_player",$fields);
        
    }

    public function importPlayer($data){
    	if ($data['team_id']){
    		$data['team_id']=$this->getTeamIdByNameEn($data['team_id']);
    	}    	
        return $this->db->insert("nfl_player",$data);
    }
    public function getTeamIdByNameEn($name_en){
    	$query=$this->db->query("SELECT team_id FROM ".DB_PREFIX."nfl_team WHERE name_en='".$name_en."'");
        return $query->row['team_id'];
    }
    public function editPlayer($player_id, $data) {
        $fields = array(
            'name'     => $data['name'],
            'number'   => $data['number'],
            'avatar'   => isset($data['avatar']) ? htmlspecialchars_decode($data['avatar']) : '',
            'note'      => isset($data['note']) ? htmlspecialchars_decode($data['note']) : '',
            'team_id'  => (int)$data['team_id'],
            'position' => $data['position'],
            'height'   => $data['height'],
            'weight'   => $data['weight'],
            'birthday' => isset($data['birthday']) && $data['birthday'] ? date('Y-m-d',strtotime($data['birthday'])) : '',
            'age'       => isset($data['age']) ? (int)$data['age'] : '',
            'veteran'  => $data['veteran'],
            'school'   => strip_tags($data['school']),
            'status'   => (int)$data['status'],
            'sort'     => (int)$data['sort'],
        );
        return $this->db->update("nfl_player",array('player_id'=>$player_id),$fields);
    }
    
    public function deletePlayer($player_id) {
        $this->db->delete("nfl_player",array('player_id' => $player_id ));
    }

    public function getTeam($team_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "nfl_team WHERE team_id = '" . (int)$team_id . "'");
        if(!empty($query->row['group'])){
            $query->row['group'] = explode(",", $query->row['group']);
        }
        return $query->row;
    }
    
    public function getPlayer($player_id) {
        
        $query = $this->db->query("SELECT np.*,nt.team_sn,nt.name_en FROM " . DB_PREFIX . "nfl_player np LEFT JOIN ".DB_PREFIX."nfl_team nt ON nt.team_id = np.team_id WHERE np.player_id = '" . (int)$player_id . "'");
        return $query->row;
    }

    public function getPlayers($data = array()) {

        $sql = "SELECT p.*,t.team_id,t.name_en,t.name_cn,t.team_sn,t.flag FROM " . DB_PREFIX . "nfl_player p LEFT JOIN ".DB_PREFIX."nfl_team t ON t.team_id = p.team_id WHERE 1 " ;                                                                                                                                                    
        $implode = array();

        if (!empty($data['filter_name'])) {
            $implode[] = "CONCAT(p.name,' #',p.number) Like '%" . $this->db->escape($data['filter_name']) . "%'";
        }
        if (!empty($data['filter_position'])) {
            $implode[] = "p.position LIKE '%" . $this->db->escape($data['filter_position']) . "%'";
        }
        if (!empty($data['filter_team_id'])) {
            $implode[] = "p.team_id = '" . (int)$data['filter_team_id'] . "'";
        }  
        if (!empty($data['filter_player_id'])) {
            $implode[] = "p.player_id = '" . (int)$data['filter_player_id'] . "'";
        }      
        if (!empty($data['filter_number'])) {
            $implode[] = "p.number = '" . (int)$data['filter_number'] . "'";
        }   
        if (!empty($data['filter_date'])) {
            $implode[] = "DATE(p.date) >= DATE('" . $this->db->escape($data['filter_date']) . "')";
        } 
        
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "p.status = '" . (int)$data['filter_status'] . "'";
        }   

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $sort_data = array(
            'p.status',
            'p.sort',
            'p.name',
            'p.number',
            'team',
            'p.height',
            'p.weight',
            'p.birthday',
            'p.position',
            'p.veteran',
        );  
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];   
        } else {
            $sql .= " ORDER BY p.team_id,p.sort";   
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
    
    public function getTotalPlayers($data = array()) {
        $sql = "SELECT COUNT(p.player_id) total FROM " . DB_PREFIX . "nfl_player p LEFT JOIN ".DB_PREFIX."nfl_team t ON t.team_id = p.team_id WHERE 1 " ;                                                                                                                                                    
        $implode = array();

        if (!empty($data['filter_name'])) {
            $implode[] = "p.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }
        if (!empty($data['filter_position'])) {
            $implode[] = "p.position LIKE '%" . $this->db->escape($data['filter_position']) . "%'";
        }
        if (!empty($data['filter_team_id'])) {
            $implode[] = "p.team_id = '" . (int)$data['filter_team_id'] . "'";
        }       
        if (!empty($data['filter_player_id'])) {
            $implode[] = "p.player_id = '" . (int)$data['filter_player_id'] . "'";
        }
        if (!empty($data['filter_number'])) {
            $implode[] = "p.number = '" . (int)$data['filter_number'] . "'";
        }   
        if (!empty($data['filter_date'])) {
            $implode[] = "DATE(p.date) >= DATE('" . $this->db->escape($data['filter_date']) . "')";
        }
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "p.status = '" . (int)$data['filter_status'] . "'";
        }   

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getOptionsByType($type='product'){
        $result=$this->db->query("SELECT * FROM ".DB_PREFIX."sns_option WHERE type = '".$this->db->escape(strtolower($type))."'");
        return $result->rows;
    }

    public function postContribute($data){
        $now = date('Y-m-d H:i:s');
        $auto_num = $this->getAutoNum(array('team_id'=>(int)$data['team_id'],'gender_id'=>(int)$data['gender_id'],'author_id'=>$this->user->getAuthorId()));
        $contribute_sn = $data['precode'].zeroFull($auto_num,3);
        $fields = array(
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
            'author_id'         => $this->user->getAuthorId(),
            'submited_times'    => 1,
            'submited_date'     => $now,
            'date_modified'     => $now,
        );

        $contribute_id = $this->db->insert("nfl_contribute",$fields);
        $this->db->insert('sns_balance', array(
                'contribute_id' => $contribute_id,
                'post_type' => $this->post_type,
                'user_id' => $this->user->getId(), 
                'date_added' => $now 
            ));
        $this->db->insert('nfl_contribute_history',array(
                'contribute_id' => $contribute_id,
                'type' => 'edit',
                'value' => $this->config->get("nfl_initial_status"), 
                'user_id' => 0,
                'date_added' => $now 
            ));
        $this->db->insert('nfl_contribute_history',array(
                'contribute_id' => $contribute_id,
                'type' => 'post',
                'value' => $this->config->get("nfl_initial_publish"), 
                'user_id' => 0,
                'date_added' => $now
            ));
        return $contribute_id;
    }
    public function getAutoNum($data){
        if(!isset($data['team_id']) || !isset($data['gender_id']) ){ return false;}
        $implode = array();
        $implode[] = " team_id = '".(int)$data['team_id']."' ";
        $implode[] = " gender_id = '".(int)$data['gender_id']."' ";
        $implode[] = " author_id = '".$this->user->getAuthorId()."' ";
        $query=$this->db->query("SELECT MAX(auto_num) as max FROM ".DB_PREFIX."nfl_contribute WHERE ".implode(" AND ", $implode));
        return (int)($query->row['max']+1);
    }

    public function getOptionValue($option_id){
        $query = $this->db->query("SELECT value FROM ".DB_PREFIX."sns_option WHERE option_id = '".(int)$option_id."'");
    
        return $query->row['value'] ;
    }
    
}