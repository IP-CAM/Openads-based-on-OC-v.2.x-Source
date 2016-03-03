<?php
class ModelNflPublish extends Model {
    public function addPublish($data) {
        foreach ($data['publish'] as $language_id => $value) {
            if (isset($publish_id)) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "nfl_publish SET publish_id = '" . (int)$publish_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
            } else {
                $this->db->query("INSERT INTO " . DB_PREFIX . "nfl_publish SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

                $publish_id = $this->db->getLastId();
            }
        }

        $this->cache->delete('nfl_publish');
    }

    public function editPublish($publish_id, $data) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "nfl_publish WHERE publish_id = '" . (int)$publish_id . "'");

        foreach ($data['publish'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "nfl_publish SET publish_id = '" . (int)$publish_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->cache->delete('nfl_publish');
    }

    public function deletePublish($publish_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "nfl_publish WHERE publish_id = '" . (int)$publish_id . "'");

        $this->cache->delete('nfl_publish');
    }

    public function getPublish($publish_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nfl_publish WHERE publish_id = '" . (int)$publish_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row;
    }

    public function getPublishes($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "nfl_publish WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

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
            $nfl_publish_data = $this->cache->get('nfl_publish.' . (int)$this->config->get('config_language_id'));

            if (!$nfl_publish_data) {
                $query = $this->db->query("SELECT publish_id, name FROM " . DB_PREFIX . "nfl_publish WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY publish_id");

                $nfl_publish_data = $query->rows;

                $this->cache->set('nfl_publish.' . (int)$this->config->get('config_language_id'), $nfl_publish_data);
            }

            return $nfl_publish_data;
        }
    }

    public function getPublishDescriptions($publish_id) {
        $nfl_publish_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nfl_publish WHERE publish_id = '" . (int)$publish_id . "'");

        foreach ($query->rows as $result) {
            $nfl_publish_data[$result['language_id']] = array('name' => $result['name']);
        }

        return $nfl_publish_data;
    }

    public function getTotalPublishes() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "nfl_publish WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row['total'];
    }
}