<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	private $jwtToken;
	
	 public function sendResponse($data,$headers = array())
	{
		foreach($headers as $key => $value){
			$this->output->set_header($key." : ".$value);
		}
		 $this->output->set_content_type("application/json");
		 $this->output->set_header("Access-Control-Allow-Origin : *");
		 $this->output->set_header("X-Message : ApiBuilder/1.0");
		 $this->output->set_header("Server : ApiBuilder",true);
		$this->output->set_output(json_encode($data));
	}
	
	public function getBody()
	{
		 $data = json_decode($this->input->raw_input_stream,true);
		 return $data;
	}
	
	public function checkToken()
	{
		$status = "auth";
		$headers = $this->input->get_request_header("Authentication");
		list($token) = sscanf($headers,"Bearer %s");
		
		if($token === null){
		 $this->output->set_status_header(401);
		 var_dump($this->input->request_headers());
		 die();
		}
		
		$this->jwtToken = $token;
	}
	
	public function checkAuth()
	{
		$this->checkToken();
		
		 try{
		 
			$valid = $this->jwt->decode($this->jwtToken,$this->input->get_request->header("User-agent")."nursan");	
			
			} catch( \UnexpectedValueException $ec) {
			 $data = array("hello","signature failed");
		$this->sendResponse($data);
		die();
		}
	}
	
}
	
 ?>