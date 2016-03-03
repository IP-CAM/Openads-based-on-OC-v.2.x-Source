<?php
class ModelLocalisationPriority extends Model {
    public function addPriority($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "priority SET `money`='".(float)$data['money']."',`sort`='".(int)$data['sort']."', user_id = '".$this->user->getId()."' ,date_added = NOW()");
        $priority_id = $this->db->getLastId();
        foreach ($data['description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "priority_description SET priority_id = '" . (int)$priority_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
        }
        $this->cache->delete('priority');

        return $priority_id;
    }
    
    public function editPriority($priority_id, $data) {
        $this->db->query("UPDATE  " . DB_PREFIX . "priority SET  `money`='".(float)$data['money']."', `sort`='".(int)$data['sort']."', user_id = '".$this->user->getId()."' ,date_added = NOW() WHERE priority_id = '".(int)$priority_id."'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "priority_description WHERE priority_id = '" . (int)$priority_id . "'");

        foreach ($data['description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "priority_description SET priority_id = '" . (int)$priority_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->cache->delete('priority');
    }
    
    public function deletePriority($priority_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "priority WHERE priority_id = '" . (int)$priority_id . "' ");
        $this->db->query("DELETE FROM " . DB_PREFIX . "priority_description WHERE priority_id = '" . (int)$priority_id . "' ");
    }
    
    
    public function getPriority($priority_id) {
        $query = $this->db->query("SELECT p.*,pd.name FROM " . DB_PREFIX . "priority p LEFT JOIN ".DB_PREFIX."priority_description pd ON ( p.priority_id = pd.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' ) WHERE p.priority_id = '" . (int)$priority_id . "' ");
        return $query->row;
    }

    public function getPriorities($data = array()) {
        $sql = "SELECT p.*,pd.name,u.nickname FROM " . DB_PREFIX . "priority p LEFT JOIN " . DB_PREFIX . "priority_description pd ON (p.priority_id = pd.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' )
        LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = p.user_id WHERE 1 " ;

        $sort_data = array(
            'pd.name',
            'p.money',
            'p.user_id',
            'p.sort'
        );  
            
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];   
        } else {
            $sql .= " ORDER BY p.sort "; 
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
    
    public function getTotalPriorities($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "priority WHERE 1 ";

        $query = $this->db->query($sql);

        return $query->row['total'];
    }


    public function getPriorityDescriptions($priority_id) {
        $description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "priority_description WHERE priority_id = '" . (int)$priority_id . "' ");

        foreach ($query->rows as $result) {
            $description_data[$result['language_id']] = array(
                'name'            => $result['name'],
            );
        }

        return $description_data;
    }
    
}