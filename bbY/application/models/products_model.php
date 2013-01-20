<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model
{
   
   function __construct()
   {
      parent::__construct();
      $this->load->database();
      $tablename = "products";
   }
   
   /**
    * 
    * @param unknown $name
    */
   public function add($name)
   {
      
   }
   
   /**
    * 
    * @param unknown $id
    */
   public function get($id = FALSE)
   {
      $result = array();
      
      // Select everything
      if ($id == FALSE)
      {
         $query = $this->db->select($tablename);
         foreach ($query->result() as $row)
         {
            print $row->name;
            print "<br>";
         }
       
         return;
      }
      
      // Select where id=$id
      $idnum = intval($id);
      if ($idnum <= 0) return FALSE;
      
      $result = $this->db->get_where($tablename, array('id' => $id));
      
   }
   
   /**
    * 
    * @param  $id Unique identifier of the product to remove
    */
   public function revmoe($id)
   {
      
      
   }
   
   /**
    * Modify the name of 
    * 
    * @param $id Unique identifier of the product
    * @param $name Modified name
    */
   public function set($id, $name)
   {
      
   }
   
   
   
}
