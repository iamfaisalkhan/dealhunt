<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

   public function index()
   {
      $this->load->helper("url");
      
      $this->load->view("templates/header");
      
      $this->load->view("user/user_view");
      
      $this->load->view("templates/footer");
   }

  
}

?>
