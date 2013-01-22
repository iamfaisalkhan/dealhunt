<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
   
   function __construct()
   {
      parent::__construct();
      
      // For calling function like base_url
      $this->load->helper('url');
      $this->load->model('Products_model');
      $this->load->model('Deals_model');
   }

   public function index()
   {
      
      $this->load->view("templates/header");
      
      $products = $this->Products_model->get();
      $data['products'] = $products;
      
      $deals = $this->Deals_model->get();
      $data['deals'] = $deals;
      
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
   
   /**
    * Delete the product from the model and redirect the user to index page.
    * @param unknown $id
    */
   public function del($id=NULL)
   {
      
      //TODO: If database query returns in error, set an error message
      // flag for the view to show it to the user.
      
      if ($id != NULL)
      {
         $this->Products_model->remove($id);    
      }
      
      redirect("/user/index");
      
   }
}