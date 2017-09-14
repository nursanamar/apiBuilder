<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class login extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  }

  public function chekUser($user,$pass)
  {
    $this->db->select("*");
    $this->db->where(array('user' => $user,'pass' => $pass));
    $result = $this->db->get('users')->result_array();

    return (isset($result[0])) ? $result[0] : null;
  }
}

 ?>
