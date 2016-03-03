<?php
class ModelFinanceCustomerBalance extends Model {



	public function getTotalCustomers($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer";

		$implode = array();
		if (!empty($data['filter_customer_id'])) {
			$implode[] = "customer_id = '" . (int)$data['filter_customer_id'] . "'";
		}
		if (!empty($data['filter_customer'])) {
			$implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%' OR email LIKE '%" . $this->db->escape($data['filter_customer']) . "%' ";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getCustomersInfo($data = array()) {
		$sql = "SELECT CONCAT(c.firstname, ' ', c.lastname) AS name, c.email email, c.customer_id customer_id,c.username username FROM " . DB_PREFIX . "customer c ";

		$implode = array();
		if (!empty($data['filter_customer_id'])) {
			$implode[] = "c.customer_id = '" . (int)$data['filter_customer_id'] . "'";
		}
	    if (!empty($data['filter_username'])) {
			$implode[] = "c.username = '" . $this->db->escape($data['filter_username']) . "'";
		}
		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%' ";
		}
	    if (!empty($data['filter_email'])) {
			$implode[] = "c.email LIKE '%" . $this->db->escape($data['filter_email']) . "%' ";
		}
		
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'username',
			'name',
			'c.email',

			);
				
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY c.customer_id";
			}
				
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
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


	
	public function getCustomerNameById($customerid){

		$sql = "SELECT CONCAT(c.firstname, ' ', c.lastname) AS customer , email,username,customer_id FROM `" . DB_PREFIX . "customer` c WHERE customer_id = '{$customerid}'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getCustomerBalanceTotal($customer_id,$date_due) {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "advertise_balance WHERE customer_id = '" . (int)$customer_id . "' AND DATE(date_added) <= DATE('" . $date_due . "')");

		return $query->row['total'];
	}
	
    public function getCustomerBalanceDetail($data = array()){
    	
    	$sql = "SELECT a.*, pd.name name,pd2.name fromname FROM " . DB_PREFIX . "advertise_balance a LEFT JOIN ".DB_PREFIX."priority_description pd ON ( pd.priority_id = a.priority_id AND pd.language_id = '".$this->config->get('config_language_id')."' ) LEFT JOIN ".DB_PREFIX."priority_description pd2 ON ( pd2.priority_id = a.from_priority AND pd2.language_id = '".$this->config->get('config_language_id')."' ) WHERE customer_id = '" . (int)$data['customer_id'] . "' ";
    	$implode = array();

	    if (!empty($data['filter_type'])) {
			$implode[] = "type = '" . (int)$data['filter_type'] . "'";
		}
        if (!empty($data['filter_amount'])) {
			$implode[] = "amount = '" . $data['filter_amount'] . "'";
		}
        if (!empty($data['filter_advertise_id'])) {
			$implode[] = "advertise_id = '" . (int)$data['filter_advertise_id'] . "'";
		}
        if (!empty($data['filter_advertise_sn'])) {
			$implode[] = "advertise_sn = '" . $data['filter_advertise_sn'] . "'";
		}
    	if ($implode) {
			$sql .=" AND ".implode(" AND ", $implode);
		}
    		$sort_data = array(
			'type',
			'advertise_id',
    		'advertise_sn',
			'priority_id',
            'date_added',
			);
				
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY date_added";
			}
				
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
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

    public function getTotalBalanceDetails($data = array()){
    	$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "advertise_balance WHERE customer_id = '" . (int)$data['customer_id'] . "' ";

		$implode = array();
        if (!empty($data['filter_type'])) {
			$implode[] = "type = '" . (int)$data['filter_type'] . "'";
		}
        if (!empty($data['filter_amount'])) {
			$implode[] = "amount = '" . $data['filter_amount'] . "'";
		}
        if (!empty($data['filter_advertise_id'])) {
			$implode[] = "advertise_id = '" . (int)$data['filter_advertise_id'] . "'";
		}
        if (!empty($data['filter_advertise_sn'])) {
			$implode[] = "advertise_sn = '" . $data['filter_advertise_sn'] . "'";
		}
    	if ($implode) {
			$sql .=" AND " .implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
    }
    public function editBalance($customer_id, $data){
    	 $fields = array(
    	    'customer_id'   => (int)$customer_id,
            'type'         => $data['filter_type'],
            'amount'     => $data['amount'],
            'user_id'        => $this->user->getId(),
    	    'note'        => $this->db->escape($data['note']),
            'date_added'    => date('Y-m-d H:i:s'),         
        );
        $this->db->insert("advertise_balance",$fields);
    }

    public function getLatestDealTime($customer_id){
    	$sql="SELECT date_added FROM " . DB_PREFIX . "advertise_balance WHERE `customer_id`='".(int)$customer_id."' ORDER BY `date_added` DESC LIMIT 1";
        $query = $this->db->query($sql);
        if($query->num_rows){
        	return $query->row['date_added'];
        }else{
        	return false;
        }
		
    }
}