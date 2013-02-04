<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_items extends CI_Controller {
   
   function __construct()
   {
      parent::__construct();
      
      // For calling function like base_url
      $this->load->helper('url');
   }

   public function add()
   {
      
      //print_r($_GET);
      echo 0;
      
   }
}