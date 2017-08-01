<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apimod extends CI_Model {
	
	public function getAll($table)
	{
		return $this->db->get($table)->result_array();
	}
	
	public function getWhere($data,$table)
	{
		return $this->db->get_where($table,$data)->result_array();
	}
	
	public function insert($data,$table)
	{
		return $this->db->insert($table,$data);
	}
	
	public function update($id,$data,$table)
	{
		$this->db->where($id);
		return $this->db->update($table,$data);
	}
	
	public function delete($id,$table)
	{
		return $this->db->delete($table,$id);
	}
}
 ?>