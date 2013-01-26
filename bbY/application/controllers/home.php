<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * The home page of our class. 
 * @author faisal
 *
 */
class Home extends CI_Controller 
{
   
   function __construct()
   {
      parent::__construct();
      // Load application configuration.
      $this->config->load('bby_config.php');
   }
   
   public function index()
   {
      $fb_config = array(
         'appId' => $this->config->item('fb_appID'),
         'secret' => $this->config->item('fb_secret')
      );  
      
      $this->load->library('facebook', $fb_config);
      
      $user = $this->facebook->getUser();
      
      if ($user) 
      {
         try 
         {
            $data['user_profile'] = $this->facebook->api('/me');
         }
         catch (FacebookApiException $e)
         {
            $user = null;
         } 
      }
      
      
      if ($user) 
      {
         $data['logout_url'] = $this->facebook->getLogoutUrl();
      }
      else
      {
         $data['login_url'] = $this->facebook->getLoginUrl();
      }
      
      $this->load->view("templates/header");
      $this->load->view('home/index_view', $data);
      $this->load->view("templates/footer");
   }
}
