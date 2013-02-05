<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {
   
   function __construct()
   {
      parent::__construct();
      
      // For calling function like base_url
      $this->load->helper('url');
      $this->load->model('Items_model');
      $this->load->model('Deals_model');
      
   }
   
   public function index() 
   {
      
      $deals = $this->Deals_model->get();
      $data['deals'] = $deals;
      
      $this->load->view('templates/header');
      $data['categories'] = array('Electronics', 'Resturant', 'Travel');
      $this->load->view('items/items_view', $data);
      $this->load->view('templates/footer');
   }
   
   public function ajax_add()
   {
      
      $item = $this->input->get('item', TRUE);
      $item_category = $this->input->get('cat', TRUE);
      
      
      $ret = array("status" => 1);
      $this->output->set_output(json_encode($ret));
      
   }
   
}