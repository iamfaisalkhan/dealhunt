<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model
{

   function __construct() 
   {
      
      $user = new stdClass;
      $this->load->database();
      
   }
   
   public function getUser()
   {
      return $this->user;
   }
   
   private function generateSalt($max = 15) 
   {
      $characterList = 
      "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
      $i = 0;
      $salt = "";
      while ($i < $max) {
         $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
         $i++;
      }
      return $salt;
   }
      
}


