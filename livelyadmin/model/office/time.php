<?php
class ModelOfficeTime extends Model {
    public function addTime($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "office_time SET time_name = '" . $this->db->escape($data['time_name']) . "', price = '" . (float)$data['price'] . "'");

        $this->cache->delete('office_time');
    }

    public function editTime($office_time_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "office_time SET time_name = '" . $this->db->escape($data['time_name']) . "',  price = '" . (float)$data['price'] . "' WHERE time_id = '" . (int)$office_time_id . "'");

        $this->cache->delete('office_time');
    }

    public function deleteTime($office_time_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "office_time WHERE office_time_id = '" . (int)$office_time_id . "'");

        $this->cache->delete('office_time');
    }

    public function getTime($office_time_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "office_time WHERE time_id = '" . (int)$office_time_id . "'");

        return $query->row;
    }

    public function getTimes($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "office_time";

            $sort_data = array(
                'time_name',
            );

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY time_name";
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
            $office_time_data = $this->cache->get('office_time');

            if (!$office_time_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "office_time ORDER BY time_name ASC");

                $office_time_data = $query->rows;

                $this->cache->set('office_time', $office_time_data);
            }

            return $office_time_data;
        }
    }

    public function getTotalTimes() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "office_time");

        return $query->row['total'];
    }
}