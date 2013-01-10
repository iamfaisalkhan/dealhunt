<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {

	public function update_categories()
	{
		$this->load->model('Eight_coupons_model');
		$categories = $this->Eight_coupons_model->get_all_categories();
		var_dump($categories);
	}
	
}

?>