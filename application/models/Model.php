<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class model extends	CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function ambil() {
		$this->db->select("*");
		$this->db->from("data");
		return $this->db->get();
	}
	public function tambah($data) {
		$this->db->insert("data",$data);
	}
}
 ?>