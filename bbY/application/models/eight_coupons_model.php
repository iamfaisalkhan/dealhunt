<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eight_coupons_model extends CI_Model {
	
	function __construct()
	{
		$this->load->spark('restclient/2.1.0');
		$this->load->library('rest');
		$this->rest->initialize(array('server' => 'http://api.8coupons.com/v1/'));
		
	}
	
	/**
	 * Query 8coupons server for list of deals categories
	 * 
	 * @return An array of key-value pairs on success execution
	 * 			otherwise the method returns flase.
	 */
	public function get_all_categories()
	{
		$result = array();
		
		$response =  $this->rest->get('getcategory');
		if (!is_array($response)) return FALSE;
		if (count($response) < 1) return FALSE;
		foreach ($response as $el)
		{
			if (!isset($el->categoryID) || !isset($el->category)) continue;
			$result[$el->categoryID] = $el->category;
				
		}
		
		return $result;

	}
	
	public function get_all_subcategories()
	{
		
		
	}
}