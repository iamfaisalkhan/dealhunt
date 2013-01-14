<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {
   
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Eight_coupons_model');
		$this->config->load('bby_config.php');
		
		// Load the database.
		$this->load->database();
	}
	
	public function deals($category="", $page="1")
	{
		$deals = $this->Eight_coupons_model->getrealtimeproductdeals($category, $page);
		if ($deals == FALSE) return;
		
		foreach ($deals as $deal)
		{
			print $deal['dealTitle'];
			print " ";
			print $deal['dealSource'];
			print "<br>";
		}
		
	}
	
	public function chain_stores()
	{
		
		$stores = $this->Eight_coupons_model->getchainstorelist();
		if ($stores == FALSE) return;

		foreach($stores as $store)
		{
			$this->db->insert('store_chains', $store);
		}
		
	}
	
    public function build_categories()
	{
	    
		$categories = $this->Eight_coupons_model->getcategory();
		$sub_categories = $this->Eight_coupons_model->getcategory();
		
		if ($categories == FALSE || $sub_categories == FALSE)
		{
		    echo "Failed to build sub-categories using 8coupons API";
		    return;
		}
		
		
		$this->add_categories($categories, $sub_categories);
		
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