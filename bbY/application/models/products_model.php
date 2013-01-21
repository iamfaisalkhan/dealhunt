<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model
{
   
   function __construct()
   {
      parent::__construct();
      $this->load->database();
      $this->tablename = "products";
   }
   
   /**
    * 
    * @param unknown $name
    */
   public function add($name)
   {
      $data = array('name' => $name);
      $this->db->insert($this->tablename, $data);
   }
   
   /**
    * 
    * @param $id if supplied, the method will only return that specific item.
    * @poaram $by_recnet If TRUE order results by most recent item
    */
   public function get($id = FALSE, $by_recent = TRUE)
   {
      $result = array();
      
      // Select everything
      if ($id == FALSE)
      {
         if ($by_recent == TRUE)
            $this->db->order_by("id", "desc");

         $query = $this->db->get($this->tablename);
          
         return $query->result();
      }
      
      // Select where id=$id
      $idnum = intval($id);
      if ($idnum <= 0) return FALSE;
      
      $result = $this->db->get_where($this->$tablename, array('id' => $id));
      
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
