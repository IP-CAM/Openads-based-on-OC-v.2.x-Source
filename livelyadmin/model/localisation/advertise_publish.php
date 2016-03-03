<?php
class ModelLocalisationAdvertisePublish extends Model {
    public function addAdvertisePublish($data) {
        foreach ($data['advertise_publish'] as $language_id => $value) {
            if (isset($publish_id)) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "advertise_publish SET publish_id = '" . (int)$publish_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
            } else {
                $this->db->query("INSERT INTO " . DB_PREFIX . "advertise_publish SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

                $publish_id = $this->db->getLastId();
            }
        }

        $this->cache->delete('advertise_publish');
    }

    public function editAdvertisePublish($publish_id, $data) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "advertise_publish WHERE publish_id = '" . (int)$publish_id . "'");

        foreach ($data['advertise_publish'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "advertise_publish SET publish_id = '" . (int)$publish_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->cache->delete('advertise_publish');
    }

    public function deleteAdvertisePublish($publish_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "advertise_publish WHERE publish_id = '" . (int)$publish_id . "'");

        $this->cache->delete('advertise_publish');
    }

    public function getAdvertisePublish($publish_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advertise_publish WHERE publish_id = '" . (int)$publish_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row;
    }

    public function getAdvertisePublishes($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "advertise_publish WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

            $sql .= " ORDER BY publish_id";

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
            $advertise_publish_data = $this->cache->get('advertise_publish.' . (int)$this->config->get('config_language_id'));

            if (!$advertise_publish_data) {
                $query = $this->db->query("SELECT publish_id, name FROM " . DB_PREFIX . "advertise_publish WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY publish_id");

                $advertise_publish_data = $query->rows;

                $this->cache->set('advertise_publish.' . (int)$this->config->get('config_language_id'), $advertise_publish_data);
            }

            return $advertise_publish_data;
        }
    }

    public function getAdvertisePublishDescriptions($publish_id) {
        $advertise_publish_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advertise_publish WHERE publish_id = '" . (int)$publish_id . "'");

        foreach ($query->rows as $result) {
            $advertise_publish_data[$result['language_id']] = array('name' => $result['name']);
        }

        return $advertise_publish_data;
    }

    public function getTotalAdvertisePublishes() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "advertise_publish WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row['total'];
    }
}