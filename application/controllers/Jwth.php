<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jwth extends MY_Controller {

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
		$this->load->dbforge();
		$this->load->library('jwt');
	}
	
	public function login()
	{
		$user = array("nursan","amar");
		$response = array();
		$body = $this->getBody();
		$userAgent = $this->input->get_request_header("User-agent",true);
		$id = $body["user"];
		$data = array("iss" => $userAgent,"id" => $id);
		if($user[0]  === $body["user"] && $user[1] === $body['pass'])
		{
			$token  = $this->jwt->encode($data,$userAgent."nursan");
			$response = 	array("status" => "Ok","desc" => "login succes","data" => array("token"  => $token));
		}else{
			$response = array("status" => "Failed","desc" => "login failed, chek your cerdentials");
		}
		$headers = array(
			"X-Custom-header" => "Value",
			"X-Api-Builder-version" => "Beta 1.0"
			);
		return $this->sendResponse($response,$headers);
	}
}