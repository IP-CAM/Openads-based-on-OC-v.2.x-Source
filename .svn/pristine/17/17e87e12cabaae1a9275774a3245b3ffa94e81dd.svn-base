<?php
class ModelLocalisationPriority extends Model {
 
    public function getPriority($priority_id) {
        $query = $this->db->query("SELECT p.*,pd.name FROM " . DB_PREFIX . "priority p LEFT JOIN ".DB_PREFIX."priority_description pd ON pd.priority_id = p.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' WHERE p.priority_id = '" . (int)$priority_id . "' ");

        return $query->row;
    }

    public function getPriorities($data = array()) {
        if ($data) {
            $sql = "SELECT p.*,pd.name FROM " . DB_PREFIX . "priority p LEFT JOIN ".DB_PREFIX."priority_description pd ON pd.priority_id = p.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' ";

            $sql .= " ORDER BY p.priority_id";

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
            $priority_data = $this->cache->get('priority.' . (int)$this->config->get('config_language_id'));

            if (!$priority_data) {
                $query = $this->db->query("SELECT p.priority_id, pd.name FROM " . DB_PREFIX . "priority p LEFT JOIN ".DB_PREFIX."priority_description pd ON pd.priority_id = p.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' ORDER BY p.priority_id");

                $priority_data = $query->rows;

                $this->cache->set('priority.' . (int)$this->config->get('config_language_id'), $priority_data);
            }

            return $priority_data;
        }
    }

    public function getPriorityDescriptions($priority_id) {
        $priority_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "priority p LEFT JOIN ".DB_PREFIX."priority_description pd ON pd.priority_id = p.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' WHERE p.priority_id = '" . (int)$priority_id . "'");

        foreach ($query->rows as $result) {
            $priority_data[$result['language_id']] = array('name' => $result['name']);
        }

        return $priority_data;
    }


}