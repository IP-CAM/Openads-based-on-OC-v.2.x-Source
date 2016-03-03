<?php
class Customer {
	private $customer_id;
	private $username;
	private $author_id;
	private $in_charge;
	private $nickname;
	private $firstname;
	private $lastname;
	private $email;
	private $customer_group_id;
	private $company;

	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['customer_id'])) {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$this->session->data['customer_id'] . "' AND status = '1'");

			if ($customer_query->num_rows) {
				$this->customer_id = $customer_query->row['customer_id'];
				$this->author_id = $customer_query->row['author_id'];
				$this->username = $customer_query->row['username'];
				$this->in_charge = $customer_query->row['in_charge'];
				$this->nickname = $customer_query->row['nickname'];
				$this->firstname = $customer_query->row['firstname'];
				$this->lastname = $customer_query->row['lastname'];
				$this->email = $customer_query->row['email'];
				$this->customer_group_id = $customer_query->row['customer_group_id'];
				$this->company = $customer_query->row['company'];

			} else {
				$this->logout();
			}
		}
	}

	public function login($username, $password, $override = false) {
		if ($override) {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE username = '" . $this->db->escape($username) . "' AND status = '1'");
		} else {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' ");
		}
		if ($customer_query->num_rows) {
			$this->session->data['customer_id'] = $customer_query->row['customer_id'];

			$this->customer_id = $customer_query->row['customer_id'];
			$this->username = $customer_query->row['username'];
			$this->author_id = $customer_query->row['author_id'];
			$this->in_charge = $customer_query->row['in_charge'];
			$this->nickname = $customer_query->row['nickname'];
			$this->firstname = $customer_query->row['firstname'];
			$this->lastname = $customer_query->row['lastname'];
			$this->email = $customer_query->row['email'];
			$this->customer_group_id = $customer_query->row['customer_group_id'];
			$this->company = $customer_query->row['company'];

			$this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");

			return true;
		} else {
			return false;
		}
	}

	public function logout() {

		unset($this->session->data['customer_id']);

		$this->customer_id = '';
		$this->username = '';
		$this->author_id = '';
		$this->in_charge = '';
		$this->nickname = '';
		$this->firstname = '';
		$this->lastname = '';
		$this->email = '';
		$this->customer_group_id = '';
		$this->company = '';
	}

	public function isLogged() {
		return $this->customer_id;
	}

	public function getId() {
		return $this->customer_id;
	}
	public function getNickName() {
		return $this->nickname;
	}
	public function getFirstName() {
		return $this->firstname;
	}

	public function getLastName() {
		return $this->lastname;
	}
	public function getUsername() {
		return $this->username;
	}
	public function getEmail() {
		return $this->email;
	}

	public function getGroupId() {
		return $this->customer_group_id;
	}
	public function getAuthorId() {
		return $this->author_id;
	}
	public function getInCharge() {
		return $this->in_charge;
	}
	public function getCompany() {
		return $this->company;
	}

	public function getBalance() {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "advertise_balance WHERE customer_id = '" . (int)$this->customer_id . "'");

		return $query->row['total'];
	}
}