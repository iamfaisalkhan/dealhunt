<?php

class Deals extends CI_Controller {

    public function index()
    {
        $fb_config = array(
            'appId' => '377429082349634',
            'secret' => 'c5aa362252715c02a7e48a128e85bd9e'
        );

        $this->load->library('facebook', $fb_config);
        $user = $this->facebook->getUser();

        if ($user)
        {
            try 
            {
                $data['user_profile'] = $this->facebook->api('/me');

            } catch (FacebookApiException $e) 
            {
                $user = null;
            }
        }
        
        if ($user)
        {
            $data['logout_url'] = $this->facebook->getLogoutUrl();
        }
        else 
        {
            $data['login_url'] = $this->facebook->getLoginUrl();

        }

        $this->load->view('deals/dealsView2', $data);

    }

    public function zip($zip='53705')
    {
        echo $zip;

        $data['title'] = 'Budget Buy 101';

        var_dump($_SERVER);

        $this->load->model('Deals_model');

        $this->load->view('templates/header', $data);

        if (! ($deals = $this->Deals_model->fetch_by_zip($zip) ) )
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

?>
