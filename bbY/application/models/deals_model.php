<?php

class Deals_model extends CI_Model {

   function __construct()
   {
      parent::__construct();
      $this->load->database();
   }
   
   /**
    * Get upto limit number of deals from the database. 
    * @param number $limit
    */
   public function get($limit = 25)
   {
      // Sort deals by most recent
      $this->db->order_by('source_id', "DESC");
      $query = $this->db->get("deals", $limit);
      return $query->result();
   }
}

?>
