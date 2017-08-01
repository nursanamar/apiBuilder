<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("apimod");
	}
	
	public function index()
	{
		$input = array("dataName" => "data di input");
		$data = $this->apimod->getAll("data");
		print_r($data);
	}
	
	public function delete($id)
	{
		
	}
}	
 ?>