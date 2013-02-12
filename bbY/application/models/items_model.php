<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_model extends CI_Model
{
   
   function __construct()
   {
      parent::__construct();
      $this->load->database();
      $this->tablename = "items";

      // Define categories, make sure that id of these
      // categories matches the one in categories table. 
      $this->categories = array();
      $this->categories[] = array('id' => 1, 'title' => 'Electronics');
      $this->categories[] = array('id' => 2, 'title' => 'Travel');
      $this->categories[] = array('id' => 3, 'title' => 'Restaurants');
      $this->categories[] = array('id' => 4, 'title' => 'Shopping');
      $this->categories[] = array('id' => 5, 'title' => 'Entertainment');
      $this->categories[] = array('id' => 6, 'title' => 'Outdoor Activities');
      $this->categories[] = array('id' => 7, 'title' => 'Services');
      $this->categories[] = array('id' => 8, 'title' => 'Software');
      $this->categories[] = array('id' => 9, 'title' => 'Groceries');
      $this->categories[] = array('id' => 10, 'title' => 'Beauty & Spa');
      $this->categories[] = array('id' => 11, 'title' => 'Clothing, Accessories and Apparels');
      $this->categories[] = array('id' => 12, 'title' => 'Jewellery');

   }
   
   /**
    * 
    * @param unknown $name
    */
   public function add($user, $category, $item)
   {
      
      $datetime = gmdate("Y-m-d H:i:s", time());

      $data = array('category_id' => $category,
                    'title' => $item,
                    'date_created' => $datetime,
                    'date_modified' => $datetime);
      
      $this->db->insert($this->tablename, $data);
      
      $item_id = $this->db->insert_id();

      $data = array('item_id' => $item_id,
                     'user_id' => $user);
      $this->db->insert('user_items', $data);

      return $item_id;

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
      
      $this->db->select('items.id, items.category_id, 
                         items.title');

      $this->db->from($this->tablename);

      $this->db->join('user_items', 'user_items.item_id = items.id');

      $this->db->where('user_items.user_id', $user);

      if ($by_recent == TRUE)
            $this->db->order_by("items.date_created", "desc");

      $query = $this->db->get();
          
      return $query->result();
      
   }

   public function get_all_items()
   {

      $this->db->select('items.id, user_items.user_id, categories.name as category, 
                         items.title as item');
      $this->db->from($this->tablename);
      $this->db->join('user_items', 'user_items.item_id = items.id');
      $this->db->join('categories', 'items.category_id=categories.id');
      $query = $this->db->get();
      
      $this->load->dbutil();
      $delimiter = ",";
      $newline = "\n";
      
      return $this->dbutil->csv_from_result($query, $delimiter, $newline);

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

   public function get_categories()
   {
      return $this->categories;
   }
   
}
