<?php
class ModelSnsOption extends Model {
    public function addOption($data) {

        $fields = array(
            'type' 		=> strtolower($data['name']), 
            'name' 		=> $data['name'],
        	'value' 	=> $data['value'],
        	'sort' 		=> (int)$data['sort'] ,
            'status' 	=> (int)$data['status'],
        	'default' 	=> (int)$data['default']
        );

        return $this->db->insert("sns_option",$fields);

    }

    public function editOption($option_id, $data) {
        $fields = array(
            'type' 		=> strtolower($data['name']), 
            'name' 		=> $data['name'],
        	'value' 	=> $data['value'],
        	'sort' 		=> (int)$data['sort'] ,
            'status' 	=> (int)$data['status'],
        	'default' 	=> (int)$data['default']
        );
        $this->db->update("sns_option",array('option_id'=>$option_id),$fields);

		return $option_id;
    }

    public function deleteOption($option_id) {
        $this->db->delete("option",array('option_id'=>$option_id));
    }

    public function getOption($option_id) {
        $query = $this->db->query("SELECT DISTINCT p.* FROM " . DB_PREFIX . "sns_option p WHERE p.option_id = '" . (int)$option_id . "'");

        return $query->row;
    }

    public function getOptions($data = array()) {
        $sql = "SELECT p.* FROM " . DB_PREFIX . "sns_option p  WHERE 1";

        $sort_data = array(
            'p.default',
            'p.type',
            'p.status',
            'p.value',
            'p.sort',
            'p.type',
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY p.type,p.sort";
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

    public function getTotalOptions() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sns_option");

        return $query->row['total'];
    }
    public function getOptionsByType($type='country'){
    	$result=$this->db->query("SELECT * FROM ".DB_PREFIX."sns_option WHERE type = '".$this->db->escape(strtolower($type))."'");
    	return $result->rows;
    }

    public function getOptionValue($option_id){
        $query = $this->db->query("SELECT value FROM ".DB_PREFIX."sns_option WHERE option_id = '".(int)$option_id."'");
    
        return $query->row['value'] ;
    }
}