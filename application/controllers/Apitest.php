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
		$data = $this->apimod->getWhere(array("id"  => $id),$table);
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

	public function updateById($table,$id)
	{
		$data = $this->getBody();
		$status = $this->apimod->update(array("id" => $id),$data,$table);
		$response = array(
			"status" => $status ? "ok":"failed",
			"desc" => $status,
			"data" => $data
		);
		$this->sendResponse($response);
	}

	public function add($table)
	{
		$datas = $this->getBody();
		$iserted = array();
		$count = 0;
		foreach($datas as $data)
		{
			$status = $this->apimod->insert($data,$table);
			if ($status['status'] === 'ok') {
				foreach ($status['data'] as $value) {
					array_push($iserted,$value);
				}
				$count++;
			}
		}
		$response  = array(
			"status" =>  "ok",
			'effect' => $count,
			'data' => $iserted
		);
		$this->sendResponse($response);
	}
}
 ?>
