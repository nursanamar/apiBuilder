<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apitest extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('jwt');
		$this->checkAuth();
	}
	
	
	public function index()
	{
		
		$data = array("hello","auth");
		$this->sendResponse($data);
	}
}	
 ?>