<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_model extends CI_Model
{
   
   function __construct()
   {
      parent::__construct();
      $this->load->database();
      $this->tablename = "items";
   }
   
   /**
    * 
    * @param unknown $name
    */
   public function add($name)
   {
      
      $data = array('category_id' => 1,
                    'name' => $name);
      
      $this->db->insert($this->tablename, $data);
   }
   
   /**
    * 
    * @param $id if supplied, the method will only return that specific item.
    * @poaram $by_recnet If TRUE order results by most recent item
    */
   public function get_user_items($user = FALSE, $by_recent = TRUE)
   {

      if ($user == FALSE) return FALSE;

      $result = array();
      
      $this->db->select('items.id', 'items.category_id', 
          'items.title', 'user.user_id');

      if ($by_recent == TRUE)
            $this->db->order_by("items.date_created", "desc");

      $this->db->join('user_items', 'user_items.item_id = items.id');

      $query = $this->db->get($this->tablename);
          
      return $query->result();
      
   }
   
   /**
    * 
    * @param  $id Unique identifier of the product to remove
    */
   public function remove($id = NULL)
   {
      if ($id == NULL) return;
      
      $this->db->delete($this->tablename, array("id" => $id));
      
      return $this->db->affected_rows();
      
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
