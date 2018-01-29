<?php

class newsletter {

	protected $id;
	protected $email;
	protected $name;
	protected $company;
	protected $areas;
	protected $code;
	protected $date;
	protected $date_update;
	protected $active;

	public function __construct() {

	}

	public function setId($i) {
		$this->id = $i;
	}

	public function setEmail($e) {
		$this->email = $e;
	}

	public function setName($n) {
		$this->name = $n;
	}

	public function setCompany($m) {
		$this->company = $m;
	}

	public function setAreas($r) {
		$this->areas = $r;
	}

	public function setCode($c = null) {
		$this->code = sha1(md5(sha1(md5(time() . "_" . $c))));
	}

	public function setDate() {
		$this->date = date('Y-m-d H:i:s', time());
	}

	public function setDateUpdate() {
		$this->date_update = date('Y-m-d H:i:s', time());
	}

	public function insert() {
		global $cfg, $db;

		$query = sprintf(
			"INSERT INTO %s_newsletters (email, name, company, areas, code, date) VALUES ('%s', '%s', '%s', '%s','%s','%s')",
			$cfg->db->prefix, $this->email, $this->name, $this->company, $this->areas, $this->code, $this->date
		);

		$toReturn = $db->query($query);

		$this->id = $db->insert_id;

		return $toReturn;
	}

	public function update() {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_newsletters SET email = '%s', name = '%s', company = '%s', areas = '%s', code = '%s', date_update = '%s' WHERE id = '%s'",
			$cfg->db->prefix, $this->email, $this->name, $this->company, $this->areas, $this->code, $this->date_update, $this->id
		);

		return $db->query($query);
	}

	public function delete() {
		global $cfg, $db;

		$query = sprintf(
			"DELETE FROM %s_newsletters WHERE id = '%s'",
			$cfg->db->prefix, $this->id
		);

		return $db->query($query);
	}

	public function returnObject() {
		return array(
			'email' => $this->email,
			'name' => $this->name,
			'company' => $this->company,
			'areas' => $this->areas,
			'code' => $this->code,
			'date' => $this->date,
			'date_update' => $this->date_update
		);
	}

	public function returnOneRegistry() {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_newsletters WHERE id = '%s' LIMIT 1",
			$cfg->db->prefix, $this->id
		);
		$source = $db->query($query);

		if ($source->num_rows > 0) {
			return $source->fetch_assoc();
		}

		return false;
	}

	public function returnOneRegistryByEmail() {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_newsletters WHERE email = '%s' LIMIT 1",
			$cfg->db->prefix, $this->email
		);
		$source = $db->query($query);

		if ($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return false;
	}

	public function existRegistryByEmail() {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_newsletters WHERE email = '%s' LIMIT 1",
			$cfg->db->prefix, $this->email
		);
		$source = $db->query($query);

		return $source->num_rows;
	}

	public function existRegistryByCode() {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_newsletters WHERE code = '%s' LIMIT 1",
			$cfg->db->prefix, $this->code
		);
		$source = $db->query($query);

		return $source->num_rows;
	}

	public function returnAllRegistries() {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_newsletters WHERE true",
			$cfg->db->prefix
		);
		$source = $db->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public function enable() {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_newsletters SET active = '%s' WHERE id = '%s'",
			$cfg->db->prefix, true, $this->id
		);
		return $db->query($query);
	}

	public function disable() {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_newsletters SET active = '%s' WHERE id = '%s'",
			$cfg->db->prefix, false, $this->id
		);
		return $db->query($query);
	}

}
