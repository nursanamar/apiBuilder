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
	}

	public function login()
	{
		try {
			$check = $this->validateLogin();
		} catch (Exception $e) {
			$this->output->set_status_header(400);
			die();
		}
    if($check){
      $token = $this->generateToken();
      $response = array(
        'status' => 'ok',
        'desc' => "Login succes",
        'data' => array(
          'token' => $token,
          'user' => $this->user,
        ),
      );

    }else {
      $response = array(
        'status' => 'failed',
        'desc' => "login failed, please check your pass",
      );
    }
    $this->sendResponse($response);
	}
}
