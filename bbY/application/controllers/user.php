<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
   
   function __construct()
   {
      parent::__construct();
      
      // For calling function like base_url
      $this->load->helper('url');
      $this->load->model('Products_model');
   }

   public function index()
   {
      
      $this->load->view("templates/header");
      
      $products = $this->Products_model->get();
      $data['products'] = $products;
      
      // Load the associate view. 
      $this->load->view("user/user_view", $data);
      
      // Load the footer
      $this->load->view("templates/footer", $data);
   }
  
   
   public function add()
   {
      if ($this->input->post('item') != FALSE)
      {
         $this->Products_model->add($this->input->post('item'));
      }
      
      redirect("/user/index");
      
   }
}