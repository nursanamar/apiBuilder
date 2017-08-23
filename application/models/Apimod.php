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
		 $this->db->insert($table,$data);
		 $data['status'] ='ok';
		 $data['data'] = $this->lastData($table);
		 return $data;
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

	public function lastData($table)
	{
		$this->db->select_max('id');
		$data = $this->db->get($table)->result_array();
		return $this->getById($data[0]['id'],$table);
	}
	public function getById($id,$table)
  {
    $this->db->select("*");
    $this->db->where("id",$id);
    return $this->db->get($table)->result_array();
  }
}
 ?>
