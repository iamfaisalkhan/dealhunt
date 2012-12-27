<?php

class Deals extends CI_Controller {

	 public function zip($zip='53705')
	 {
	     $data['title'] = 'Budget Buy 101';

		   $this->load->model('DealsModel');

			 $this->load->view('templates/header', $data);

       if (! ($deals = $this->DealsModel->fetchDealsByZip() ) )
       {
          echo "Failed to find deals for the given zip code";
       }
       else
       {
           $data['deals'] = $deals;
           $this->load->view('deals/dealsView', $data);
       }

			 $this->load->view('templates/footer', $data);
	 }

   public function eightCoupon()
   {
       $this->load->model('DealsModel');
       $this->DealsModel->query8coupon();
   }
}
