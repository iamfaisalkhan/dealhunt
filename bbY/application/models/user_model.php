<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model
{

   function __construct() 
   { 
      $user = new stdClass;
      $this->load->database();
      $this->tablename = 'user';
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

   public function generate_salt($max = 15) 
   {
      $characterList = 
      "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $i = 0;
      $salt = "";
      while ($i < $max) {
         $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
         $i++;
      }
      return $salt;
   }

   /**
    * Query database to find a user matching the given email and password
    */
   public function get_verified_user($email, $password) {
      $this->db->where('email', $email);
      $query = $this->db->get($this->tablename);
      $user = $query->row();

      if (!$user) return FALSE;

      // verify the password
      $hashpasswd = crypt($password, $user->salt);

      if ($hashpasswd == $user->secret) return $user->id;

      return FALSE;

   }

   public function new_user($user)
   {
      $user->salt = $this->generate_salt(2);
      $user->secret = crypt($user->secret, $user->salt);
      $this->db->insert('user', $user);
      return $this->db->insert_id();
   }
      
}


