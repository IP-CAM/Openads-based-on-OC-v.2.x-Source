<?php
class ModelCustomerCustomer extends Model {
    public function addCustomer($data) {
        $salt = substr(md5(uniqid(rand(), true)), 0, 9);
        $auto_num = $this->getMaxAutoNum(date('ymd'));
        $fields = array(
            'username'      => date('ymd').zeroFull($auto_num),
            'precode'       => date('ymd'),
            'auto_num'      => $auto_num,
            'customer_group_id' => (int)$data['customer_group_id'],
            'nickname'      => $data['nickname'],
            'firstname'     => $data['firstname'],
            'lastname'      => $data['lastname'],
            'email'         => $data['email'],
            'author_id'     => $data['author_id'],
            'salt'          => $salt,
            'password'      => sha1($salt . sha1($salt . sha1($data['password']))),
            'status'        => $data['status'],
            'in_charge'     => $data['in_charge'],
            'user_id'       => $this->user->getId(),
            'company'       => $data['company'],
            'contact'       => $data['contact'],
            'date_added'    => date('Y-m-d H:i:s')
        );
        $customer_id = $this->db->insert("customer",$fields);

        return array('customer_id'=>$customer_id,'username'=>$fields['username'],'password'=>$data['password']);
    }

    public function editCustomer($customer_id, $data) {
        $fields = array(
            'customer_group_id' => (int)$data['customer_group_id'],
            'nickname'      => $data['nickname'],
            'firstname'     => $data['firstname'],
            'lastname'      => $data['lastname'],
            'email'         => $data['email'],
            'author_id'     => $data['author_id'],
            'status'        => $data['status'],
            'user_id'       => $this->user->getId(),
            'in_charge'     => $data['in_charge'],
            'company'       => $data['company'],
            'contact'       => $data['contact'],
        );
        $this->db->update("customer",array('customer_id' => (int)$customer_id),$fields);

        $this->db->update('website',array('customer_id'=>$customer_id),array('in_charge'=>(int)$data['in_charge']));
        $this->db->update('advertise',array('customer_id'=>$customer_id),array('in_charge'=>(int)$data['in_charge']));
        $this->db->update('advertise_targeting',array('customer_id'=>$customer_id),array('in_charge'=>(int)$data['in_charge']));
        $this->db->update('advertise_post',array('customer_id'=>$customer_id),array('in_charge'=>(int)$data['in_charge']));
        $this->db->update('advertise_photo',array('customer_id'=>$customer_id),array('in_charge'=>(int)$data['in_charge']));
        if ($data['password']) {
            $salt = substr(md5(uniqid(rand(), true)), 0, 9);
            $fields = array(
                'salt'      => $salt,
                'password'  => sha1($salt . sha1($salt . sha1($data['password']))),
            );
            $this->db->update("customer", array('customer_id' => (int)$customer_id),$fields);
        }
        return array('customer_id'=>$customer_id,'username'=>$data['username'],'password'=>$data['password']);

    }

    public function editToken($customer_id, $token) {
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET token = '" . $this->db->escape($token) . "' WHERE customer_id = '" . (int)$customer_id . "'");
    }

    public function deleteCustomer($customer_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
    }

    public function getCustomer($customer_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

        return $query->row;
    }

    public function getCustomerByUsername($username) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE username = '" . $this->db->escape($username) . "'");

        return $query->row;
    }
    public function getCustomerByEmail($email) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

        return $query->row;
    }


    public function getCustomerByAuthorId($author_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE LCASE(author_id) = '" . $this->db->escape(utf8_strtolower($author_id)) . "'");

        return $query->row;
    }

    public function getUserNameCustomerId($customer_id) {
        $query = $this->db->query("SELECT username,nickname FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

        return $query->row;
    }

    public function getCustomers($data = array()) {
        $sql = "SELECT c.*, c.nickname AS name,CONCAT(c.firstname, ' ', c.lastname) AS fullname,u.nickname AS charger,u1.nickname AS operator, cg.name AS customer_group FROM " . DB_PREFIX . "customer c 
        LEFT JOIN " . DB_PREFIX . "user u ON (u.user_id = c.in_charge) LEFT JOIN " . DB_PREFIX . "customer_group cg ON (c.customer_group_id = cg.customer_group_id) LEFT JOIN " . DB_PREFIX . "user u1 ON (u1.user_id = c.user_id) WHERE 1";

        $implode = array();
        if (!empty($data['filter_username'])) {
            $implode[] = "c.username LIKE '" . $this->db->escape($data['filter_username']) . "%'";
        }
        if (!empty($data['filter_name'])) {
            $implode[] = "CONCAT(c.username,' ',c.nickname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }

        if (!empty($data['filter_email'])) {
            $implode[] = "c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
        }

        if (!empty($data['filter_customer_group_id'])) {
            $implode[] = "c.customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
        }

        if (!empty($data['filter_ip'])) {
            $implode[] = "c.customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
        }

        if (isset($data['filter_in_charge']) && !is_null($data['filter_in_charge'])) {
            $implode[] = "c.in_charge = '" . (int)$data['filter_in_charge'] . "'";
        }

        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $sort_data = array(
            'name',
            'c.email',
            'c.username',
            'customer_group',
            'c.status',
            'c.in_charge',
            'c.ip',
            'c.date_added',
            'c.company',
            'c.user_id'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY c.date_added";
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

    public function getTotalCustomers($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer";

        $implode = array();
        if (!empty($data['filter_username'])) {
            $implode[] = "username LIKE '" . $this->db->escape($data['filter_username']) . "%'";
        }
        if (!empty($data['filter_name'])) {
            $implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }

        if (!empty($data['filter_email'])) {
            $implode[] = "email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
        }

        if (!empty($data['filter_customer_group_id'])) {
            $implode[] = "customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
        }

        if (!empty($data['filter_ip'])) {
            $implode[] = "customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "status = '" . (int)$data['filter_status'] . "'";
        }

        if (isset($data['filter_in_charge']) && !is_null($data['filter_in_charge'])) {
            $implode[] = "in_charge = '" . (int)$data['filter_in_charge'] . "'";
        }

        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if ($implode) {
            $sql .= " WHERE " . implode(" AND ", $implode);
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalCustomersByCustomerGroupId($customer_group_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE customer_group_id = '" . (int)$customer_group_id . "'");

        return $query->row['total'];
    }

    public function addHistory($customer_id, $comment) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_history SET customer_id = '" . (int)$customer_id . "', comment = '" . $this->db->escape(strip_tags($comment)) . "', date_added = NOW()");
    }

    public function getHistories($customer_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }

        $query = $this->db->query("SELECT comment, date_added FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

        return $query->rows;
    }

    public function getTotalHistories($customer_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int)$customer_id . "'");

        return $query->row['total'];
    }

    public function getTotalAdvertises($customer_id){
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "advertise WHERE customer_id = '" . (int)$customer_id . "'");

        return $query->row['total'];
    }
    public function getMaxAutoNum($precode){
        $fields = array(
            'one'   => true,
            'field' => 'MAX(`auto_num`) max',
            'condition'=> array('precode'=>$precode)
        );
        $result = $this->db->fetch('customer',$fields);

        return empty($result['max']) ? 1 : $result['max']+1;
    }
}