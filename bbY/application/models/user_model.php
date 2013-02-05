<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model
{

   function __construct() 
   { 
      $user = new stdClass;
      $this->load->database();
   }
   
   /**
   * Check wheather user with the given email exists in the database 
   * @return True if user exists, false otherwise. 
   */
   public function check_user($email="")
   {
      $this->db->where('email', $email);
      $query = $this->db->get('user');
      $cnt = count($query->result());

      if ($cnt == 0) return FALSE;

      return TRUE;
   }

   public function new_user($user)
   {

      $this->db->insert('user', $user);
      return $this->db->insert_id();
      
   }
   
   private function generate_salt($max = 15) 
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


