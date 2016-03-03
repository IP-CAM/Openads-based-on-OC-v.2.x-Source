<?php
class ModelNflMatch extends Model {
    public function addMatch($data) {
        $fields = array(
            'name'          => $data['name'],
            'start_date'    => date('Y-m-d',strtotime($data['start_date'])),
            'status'    => (int)$data['status'],
            'sort'      => (int)$data['sort'],
        );
        $match_id = $this->db->insert("nfl_match",$fields);
        
        $this->cache->delete('nfl_match');
        
        return $match_id;
    }
    
    public function editMatch($match_id, $data) {
        
        $fields = array(
            'name'          => $data['name'],
            'start_date'    => date('Y-m-d',strtotime($data['start_date'])),
            'status'    => (int)$data['status'],
            'sort'      => (int)$data['sort'],
        );  
        $this->db->update("nfl_match",array('match_id'=>$match_id),$fields);   
        $this->cache->delete('nfl_match');
    }
    
    public function deleteMatch($match_id) {
        $this->db->delete("nfl_match",array('match_id' => (int)$match_id));
        
        $this->cache->delete('nfl_match');       
    }
    
    public function getMatch($match_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "nfl_match WHERE match_id = '" . (int)$match_id . "'");
    
        return $query->row;
    }

    public function getMatches($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "nfl_match";
            if(isset($data['filter_status'])){
                $sql .= " WHERE status = '".(int)$data['filter_status']."' ";
            }
            $sort_data = array(
                'name',
                'sort',
                'status',
            );  
            
            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];   
            } else {
                $sql .= " ORDER BY sort";   
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
        } else {
            $team_data = $this->cache->get('nfl_match');
        
            if (!$team_data) {
                $team_data = array();
                
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nfl_match ORDER BY sort");
    
                foreach ($query->rows as $result) {
                    $team_data[] = array(
                        'match_id' => $result['match_id'],
                        'name' => $result['name'],
                        'start_date' => $result['start_date'],
                        'sort'    => $result['sort'],
                        'status'  => $result['status']
                    );
                }   
            
                $this->cache->set('nfl_match', $team_data);
            }
        
            return $team_data;          
        }
    }

    public function getTotalMatches() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "nfl_match");
        
        return $query->row['total'];
    }
}