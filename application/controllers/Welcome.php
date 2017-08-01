<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->model("model");
	}
	public function index()
	{
		//$this->load->view('welcome_message');
		$data = $this->model->ambil();
		$json = json_encode($data->result_array());
		echo $json;
	}
	public function table() {
		$this->load->view("home");
		print_r($_GET);
	}
	public function tambah($nama,$kelas){
		//$nama ="nama";// $this->input->post['nama'];
		//$kelas = "kelas";//$this->input->post['kelas'];
		$data = array("nama" => $nama,"kelas" => $kelas);
		$this->model->tambah($data);
		echo "berhasil";
	}
}