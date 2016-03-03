<?php
class ModelCustomerCustomerGroup extends Model {
    public function addCustomerGroup($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_group SET name = '" . $this->db->escape($data['name']) . "', note = '" . $this->db->escape($data['note']) . "', sort_order = '" . (int)$data['sort_order'] . "'");
    }

    public function editCustomerGroup($customer_group_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "customer_group SET name = '" . $this->db->escape($data['name']) . "',note = '" . $this->db->escape($data['note']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE customer_group_id = '" . (int)$customer_group_id . "'");

    }

    public function deleteCustomerGroup($customer_group_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer_group WHERE customer_group_id = '" . (int)$customer_group_id . "'");
    }

    public function getCustomerGroup($customer_group_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer_group  WHERE customer_group_id = '" . (int)$customer_group_id . "'");

        return $query->row;
    }

    public function getCustomerGroups($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "customer_group ";

        $sort_data = array(
            'name',
            'sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY name";
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


    public function getTotalCustomerGroups() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_group");

        return $query->row['total'];
    }
}