<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
   
   function __construct()
   {
      parent::__construct();
      
      // For calling function like base_url
      $this->load->helper('url');
      $this->load->model('User_model');

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
   
   /**
    * Called when user fully registers the 
    */
   public function register_ajax()
   {  

      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');

      $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[1]|max_length[15]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordconf]|min_length[6]|max_length[8]');
      $this->form_validation->set_rules('passwordconf', 'Confirm Password', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      $this->form_validation->set_error_delimiters('', '<br>');

      $ret = array();
      if ($this->form_validation->run() == FALSE)
      {
         $ret['status'] = 0;
         $ret['error_msg'] = validation_errors();
      } else {
         // Check unique email
         $email = set_value('email');
         $username = set_value('username');

         $exists = $this->User_model->check_user($email);

         if ($exists == TRUE) {
            $ret['status'] = 0;
            $ret['error_msg'] = 'This email already exists. Please login or sign up with a different email address.';
         } else {
            // Try to register the user
            $user = new stdClass();
            $user->email = $email;
            $user->name = $username;
            $id = $this->User_model->new_user($user);
            $ret['status'] = 1;
            $ret['id'] = $id;
         }
      }
      
      $this->output->set_output(json_encode($ret));
   }
   
   public function add()
   {
      $item = $this->input->post('item', TRUE);
      if ($item != FALSE)
      {
         $clean = strip_tags($item);
         if (! empty($clean))
         {
            $this->Products_model->add($clean);
         }
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