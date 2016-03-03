<?php
class ModelOfficeUser extends Model {
    public function addUser($data) {
        $salt = substr(md5(uniqid(rand(), true)), 0, 9);
        $fields = array(
            'office_name'   => $data['office_name'],
            'office_group_id'   => '4',
            'salt'          => $salt,
            'password'      => sha1($salt . sha1($salt . sha1($data['password']))),
            'nickname'      => $data['nickname'],
            'handphone'     => $data['handphone'],
            'qq'            => $data['qq'],
            'status'        => (int)$data['status'],
            'date_added'    => date('Y-m-d H:i:s')
        );
        $this->db->insert("office_user",$fields);
    }

    public function editUser($office_id, $data) {
        $fields = array(
            'office_name'   => $data['office_name'],
            'office_group_id'   => $data['office_group_id'],
            'nickname'      => $data['nickname'],
            'handphone'     => $data['handphone'],
            'qq'            => $data['qq'],
            'status'        => (int)$data['status']
        );
        $this->db->update("office_user",array('office_id' =>(int)$office_id),$fields);

        if ($data['password']) {
            $salt = substr(md5(uniqid(rand(), true)), 0, 9);
            $fields = array(
                'salt'      => $salt,
                'password'  => sha1($salt . sha1($salt . sha1($data['password']))),
            );
            $this->db->update("office_user",array('office_id' =>(int)$office_id),$fields );
        }
    }

    public function editPassword($office_id, $password) {
        $this->db->query("UPDATE `" . DB_PREFIX . "office_user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE office_id = '" . (int)$office_id . "'");
    }


    public function deleteUser($office_id) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "office_user` WHERE office_id = '" . (int)$office_id . "'");
    }

    public function getUser($office_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "office_user` WHERE office_id = '" . (int)$office_id . "'");

        return $query->row;
    }

    public function getUsers($data = array()) {
        $sql = "SELECT * FROM `" . DB_PREFIX . "office_user`  ";

        $sort_data = array(
            'office_name',
            'status',
            'date_added',
            'office_id'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY office_id";
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

    public function getTotalUsers() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "office_user`");

        return $query->row['total'];
    }

    public function getUserByOfficename($office_name) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "office_user` WHERE office_name = '" . $this->db->escape($office_name) . "'");

        return $query->row;
    }
}