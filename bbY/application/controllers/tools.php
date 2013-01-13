<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {

  public function build_categories()
	{
	    
		$this->load->model('Eight_coupons_model');
		$categories = $this->Eight_coupons_model->get_all_categories();
		$sub_categories = $this->Eight_coupons_model->get_all_subcategories();
		
		if ($categories == FALSE || $sub_categories == FALSE)
		{
		    echo "Failed to build sub-categories using 8coupons API";
		    return;
		}
		
		// Load the database.
		$this->load->database();
		
		$this->add_categories($categories, $sub_categories);
		
		//$this->db->get('category');
		
		
	}
	
	private function add_categories($categories, $sub_categories)
	{
	    // Delete existing categories using ids
	    $this->db->where_in('eight_coupon_id', array_keys($categories));
	    $this->db->delete('category');
	    
	    // Insert all categories to the database
	    foreach ($categories as $categoryId => $category)
	    {
	    	echo "Inserting $categoryId => $category <br>";
	    
	    	$data = array('eight_coupon_id' => $categoryId,
	    	              'title' => $category);
	    	$this->db->insert('category', $data);
	    	$id = $this->db->insert_id();
	    
	    	if (isset($sub_categories["$categoryId"]))
	    	{
    	    	
	    	    // Insert sub categories associated with given id
    	    	$this->add_sub_categories($id, $sub_categories["$categoryId"]);
	    	    
	    	}
	    }	    
	}
	
	private function add_sub_categories($id, $sub_categories)
	{
	    $this->db->where_in('eight_coupon_id', array_keys($sub_categories));
	    $this->db->delete('sub_category');
	            
	    foreach ($sub_categories as $categoryId => $category) 
	    {
	        echo "Inserting sub-category $categoryId => $category <br>";
	        $data = array('category_id' => "$id",
	                      'eight_coupon_id' => "$categoryId",
	                       'title' => "$category");
	        
	        $this->db->insert('sub_category', $data);
	        
	    }
	    
	}
	
}

?>