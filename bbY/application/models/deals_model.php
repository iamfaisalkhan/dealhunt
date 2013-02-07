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
   public function get($limit = 24)
   {
      // Sort deals by most recent
      $this->db->order_by('source_id', "DESC");
      $query = $this->db->get("deals", $limit);
      return $query->result();
   }

   public function get_alL()
   {

      $this->db->select('id, source_name as source, txt as description, date_posted, date_expired');
      $query = $this->db->get("deals");

      $this->load->dbutil();
      $delimiter = ",";
      $newline = "\n";
      
      return $this->dbutil->csv_from_result($query, $delimiter, $newline);

   }
}

?>
