<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
   
   function __construct()
   {
      parent::__construct();
      
      // For calling function like base_url
      $this->load->helper('url');
      $this->load->model('User_model');
      $this->load->model('Deals_model');
      $this->load->mode('Items_model');
   }
   
   public function index($user_id = 0)
   {

      if ($this->my_usession->logged_in == FALSE)
      {
         redirect('home/index');
      }

      $user_id_session = $this->my_usession->userdata('user_id');

      if ($user_id != $user_id_session) 
      {
         redirect('home/index');
      }

      $deals = $this->Deals_model->get();
      $data['deals'] = $deals;

      // Define categories, make sure that id of these
      // categories matches the one in categories table. 
      $categories = array();
      $categories[] = arry("id" => 1, "title" => 'Electronics');
      $categories[] = arry("id" => 2, "title" => 'Travel');
      $categories[] = arry("id" => 3, "title" => 'Resturant');
      $data['categories'] = $categories;

      var_dump($this->Items_model->get_all_items());
      
      $this->load->view('templates/header');
      $this->load->view('items/items_view', $data);
      $this->load->view('templates/footer');
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
         $password = set_value('password');

         $exists = $this->User_model->check_user($email);

         if ($exists == TRUE) {
            $ret['status'] = 0;
            $ret['error_msg'] = 'This email already exists. Please login or sign up with a different email address.';
         } else {
            // Try to register the user
            $user = new stdClass();
            $user->email = $email;
            $user->name = $username;
            $user->secret = $password;
            $user->date_joined = gmdate("Y-m-d H:i:s", time());
            $user->last_login = $user->date_joined;
            $id = $this->User_model->new_user($user);
            $ret['status'] = 1;
            $ret['id'] = $id;
            $sdata = array('user_id' => $id);
            $this->my_usession->set_userdata($sdata);
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
   
   public function test($id=0)
   {
      $user = new stdClass();
      $user->name = "faisal";
      $user->email = "faisal.nust@gmail.com";
      $user->secret = "abc";
      $user->salt = "8n";
      var_dump(time());
      $user->date_joined = gmdate("Y-m-d H:i:s", time());
      $user->last_login = $user->date_joined;
      $this->load->model("User_model");
      $this->User_model->new_user($user);
      // var_dump($this->User_model->get_verified_user($user->email, '\'));
   }
}