<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apitest extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->checkAuth();
		$this->load->model("apimod");
	}
	
	
	public function index()
	{
		
		$data = $this->payload;
		$this->sendResponse($data);
	}
	
	public function getAll($table)
	{
		$data = $this->apimod->getAll($table);
		$response["status"] = "ok";
		$response["desc"] = "data fetched";
		$response["data"] = $data;
		$this->sendResponse($response);
	}
	
	public function getById($table,$id)
	{
		$data = $this->apimod->getWhere(array("dataId"  => $id),$table);
		 $response["status"] = "ok";
		$response["desc"] = "data fetched";
		$response["data"] = $data;
		$this->sendResponse($response);
	}
	
	public function deleteById($table,$id)
	{
		$data = $this->apimod->delete(array("dataId" => $id),$table);
		$response["status"] = $data ? "ok":"failed";
		$this->sendResponse($response);
	}
	
	public function updateById($table)
	{
		$data = $this->getBody();
		$id = $data["dataId"];
		$status = $this->apimod->update($id,$data,$table);
		$response = array(
			"status" => $status ? "ok":"failed",
			"desc" => $status,
			"data" => $data
		);
		$this->sendResponse($response);
	}
}	
 ?>