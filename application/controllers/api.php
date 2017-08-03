<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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
	
	public function index()
	{
		$this->load->view("form");
	}
	public function getPost()
	{
		$data = $this->input->raw_input_stream;
		print_r($data);
	}
	
	public function jwtEc()
	{
		$data = array("id" => "nursan");
		$userAgent = $this->input->get_request_header("User-agent",true);
		$payload = array("iss" => $userAgent,"id" => $data["id"]);
		$token = $this->jwt->encode($payload,$userAgent."nursan");
		echo $token;
	}
	public function jwtDc()
	{
		$token = " eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJNb3ppbGxhXC81LjAgKExpbnV4OyBBbmRyb2lkIDQuNC4yOyAtU0VNQVIgS0FNVlJFVCAtIEJ1aWxkXC9LVlQ0OUwpIEFwcGxlV2ViS2l0XC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWVcLzM2LjAuMTk4NS4xMjggTW9iaWxlIFNhZmFyaVwvNTM3LjM2IiwiaWQiOiJudXJzYW4ifQ.dTyN7-d4Yj1GLso9Prxw0fYO__68IUmA0J7myZf3vY8";
		try{
			$valid = $this->jwt->decode($token,"nursan");	
			}catch( \UnexpectedValueException $ec) {
			print_r($ec);
		}
		print_r($valid);
	}
	public function post()
	{
		var_dump($_POST);
		//echo "ghjj";
		//var_dump($this->input->post());
	}
	public function createTable()
	{
		$fields = array(
			"id" => array(
				"type" => "INT",
				"constraint" => "5",
				"auto_increment"  => TRUE
			),
			"dataName" => array(
				"type" => "VARCHAR",
				"constraint" => "100"
			),
			"dataStatus" => array(
				"type" => "VARCHAR",
				"constraint" => "100"
			),
		);
		
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key("id",TRUE);
		if($this->dbforge->create_table("data")){
			echo "sukses";
		}else{
			echo "gagal";
		}
		
	}
	
	public function getHeader()
	{
		$this->load->library('user_agent');
		print_r($this->input->request_headers());
	//	print_r($this->output->);
		echo $this->agent->platform().$this->agent->version();
	}
}