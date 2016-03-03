<?php
class ModelLocalisationAdvertiseTargeting extends Model {
    public function addAdvertiseTargeting($data) {
        foreach ($data['advertise_targeting'] as $language_id => $value) {
            if (isset($status_id)) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "advertise_targeting_status SET status_id = '" . (int)$status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', `value` = '".$this->db->escape($value['value'])."'");
            } else {
                $this->db->query("INSERT INTO " . DB_PREFIX . "advertise_targeting_status SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', `value` = '".$this->db->escape($value['value'])."'");

                $status_id = $this->db->getLastId();
            }
        }

        $this->cache->delete('advertise_targeting');
    }

    public function editAdvertiseTargeting($status_id, $data) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "advertise_targeting_status WHERE status_id = '" . (int)$status_id . "'");

        foreach ($data['advertise_targeting'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "advertise_targeting_status SET status_id = '" . (int)$status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', `value` = '".$this->db->escape($value['value'])."'");
        }

        $this->cache->delete('advertise_targeting');
    }

    public function deleteAdvertiseTargeting($status_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "advertise_targeting_status WHERE status_id = '" . (int)$status_id . "'");

        $this->cache->delete('advertise_targeting');
    }

    public function getAdvertiseTargeting($status_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advertise_targeting_status WHERE status_id = '" . (int)$status_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row;
    }

    public function getAdvertiseTargetings($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "advertise_targeting_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";
            if(isset($data['filter_gt_status'])){
                $sql .= " AND `status_id` > '".$data['filter_gt_status']."' ";
            }
            $sql .= " ORDER BY status_id";

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
            $advertise_targeting_status_data = $this->cache->get('advertise_targeting_status.' . (int)$this->config->get('config_language_id'));

            if (!$advertise_targeting_status_data) {
                $query = $this->db->query("SELECT status_id, name,value FROM " . DB_PREFIX . "advertise_targeting_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY status_id");

                $advertise_targeting_status_data = $query->rows;

                $this->cache->set('advertise_targeting_status.' . (int)$this->config->get('config_language_id'), $advertise_targeting_status_data);
            }

            return $advertise_targeting_status_data;
        }
    }

    public function getAdvertiseTargetingDescriptions($status_id) {
        $advertise_targeting_status_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advertise_targeting_status WHERE status_id = '" . (int)$status_id . "'");

        foreach ($query->rows as $result) {
            $advertise_targeting_status_data[$result['language_id']] = array('name' => $result['name'],'value' => $result['value']);
        }

        return $advertise_targeting_status_data;
    }

    public function getTotalAdvertiseTargetings() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "advertise_targeting_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row['total'];
    }
}