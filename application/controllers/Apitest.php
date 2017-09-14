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
		$response = array();
		try {
			if ($this->checkTable($table)) {
				$data = $this->apimod->getAll($table);
				$response["status"] = "ok";
				$response["desc"] = "data fetched";
				$response["data"] = $data;
				$this->sendResponse($response);
			}
		} catch (Exception $e) {
			$this->sendError($e->getMessage());
		}
	}

	public function getById($table,$id)
	{
		$response = array();
		try {
			if ($this->checkTable($table)) {
				$data = $this->apimod->getWhere(array("id"  => $id),$table);
				$response["status"] = "ok";
				$response["desc"] = "data fetched";
				$response["data"] = $data;
				$this->sendResponse($response);
			}
		} catch (Exception $e) {
			$this->sendError($e->getMessage());
		}

	}

	public function deleteById($table,$id)
	{
		$response = array();
		try {
			if ($this->checkTable($table)) {
				$data = $this->apimod->delete(array("id" => $id),$table);
				$response["status"] = $data ? "ok":"failed";
				$this->output->set_status_header(204);
				$this->sendResponse($response);
			}
		} catch (Exception $e) {
			$this->sendError($e->getMessage());
		}


	}

	public function updateById($table,$id)
	{
		try {
			$response = array();
			if ($this->checkTable($table)) {
				$data = $this->getBody();
				$status = $this->apimod->update(array("id" => $id),$data,$table);
				$response = array(
					"status" => $status ? "ok":"failed",
					"desc" => $status,
					"data" => $data
				);
				$this->sendResponse($response);
			}
		} catch (Exception $e) {
			$this->sendError($e->getMessage());
		}

	}

	public function add($table)
	{
		try {
			if ($this->checkTable($table)) {
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
		} catch (Exception $e) {
			$this->sendError($e->getMessage());
		}

	}
}
 ?>
