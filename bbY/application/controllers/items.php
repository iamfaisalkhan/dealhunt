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
   
   public function add_ajax()
   {
      
      if ($this->my_usession->logged_in == FALSE)
      {
         $ret = array("redirect" => "home/index");
         $this->output->set_output(json_encode($ret));
         return;
      }

      $user_id = $this->my_usession->userdata('user_id');

      $item = $this->input->get('item', TRUE);
      $item_category = $this->input->get('id', TRUE);
      
      $this->Items_model->add($user_id, $item_category, $item);

      $ret = array("status" => 1,
                   "item_id", );

      $this->output->set_output(json_encode($ret));
      
   }

   public function test()  {
      $item = "my_item";
      $item_category = 2;
      $user_id = 2;

      $this->Items_model->add($user_id, $item_category, $item);

   }

   
}