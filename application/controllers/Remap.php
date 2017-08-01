<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 
	 */
	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view("formjs");
	}
	public function cekId($id)
	{
		if($id === "asd123")
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}
	private function create($data)
	{
		echo "has been created <br>";
		var_dump($data);
	}
	
	public function wrongId($id)
	{
		$data = array("status" => "failed", "description" => "id not correct");
		$this->sendResponse($data);
	}
	
	public function methodWrong($method)
	{
		echo $method." not match any method";
	}
	
	public function tes()
	{
		$data = array("status" => "sukses","desc" => "Its work!!");
		return $this->sendResponse($data);
	}
	
	public function inFalidRequest()
	{
		$data = array("status" => "failed","description" => "Request not valid");
		return $this->sendResponse($data);
	}
	
	/**************************
	*Sending Response with Header
	*
	@param array $data data for body respose
	*@return mixed
	*
	**************/
	public function sendResponse($data)
	{
		 $this->output->set_content_type("application/json");
		 $this->output->set_header("Access-Control-Allow-Origin : *");
		 $this->output->set_header("X-Message : ApiBuilder/1.0");
		 $this->output->set_header("Server : ApiBuilder",true);
		$this->output->set_output(json_encode($data));
	}
	
	public function update()
	{
		$data = json_decode($this->input->raw_input_stream);
		$response = array("status" => "sukses","description" => "data has been added", "data" => $data);
		return $this->sendResponse($response);
	}
	
	public function _remap($method = null,$params = array())
	{
		if(!(isset($params[0])))
		{
			return $this->inFalidRequest();
		}
		$id = $params[0];
		unset($params[0]);
		if($this->cekId($id) === false ){
			return $this->wrongId($id);
		}
		$data = [];
		foreach($params as $param){
			$data[] = $param;
		}
		if(method_exists($this,$method)){
			return $this->$method($data);
		}else{
			return $this->methodWrong($method);
		}
	}
	
}