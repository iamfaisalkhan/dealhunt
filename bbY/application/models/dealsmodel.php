<?php

class DealsModel extends CI_Model {
  
    public function fetchDealsByZip($zip=53705)
    {
        # Load cache drivers and firt check if we already have queried
        # the remote server using the given zip. 
        $this->load->driver('cache');

        if (! $deals = $this->cache->memcached->get('53705') )
        {
            if (! $deals = $this->queryLesserThan() )
            {
               echo "Failed to query remote service LesserThan.com";
               return false;
            }

            $this->cache->memcached->save('53705', $deals);
        }

        $result = false;

        if (isset($deals->status) && $deals->status='OK')
        {
           $items = $deals->items;
           $result = array();
           $index = 0;
           foreach ($items as $item)
           {
              if (!isset($item->deal)) continue;
              $deal = $item->deal;
              $result[$index] = array();
              $result[$index]["description"] = $deal->description;
              $result[$index]["discount"] = $deal->discount;
              $result[$index]["image"] = $deal->image;
              $result[$index]["image_thumb"] = $deal->image_thumb;
              $index = $index + 1;
           }
        }

        return $result;
    }

    public function query8coupon()
    {
        $this->load->spark('restclient/2.1.0');
        $this->load->library('rest');
        $this->rest->initialize(array('server' => 'http://api.8coupons.com/v1/'));

        $categories = $this->rest->get('getdeals');
        
        print_r($categories);
    }

    private function queryLesserThan($zip=53705)
    {
       $this->load->spark('restclient/2.1.0');

       $this->load->library('rest');

       $this->rest->initialize(array('server' => 'http://lesserthan.com/api.getDealsZip'));

			 $deals = $this->rest->get('53705/json');

			 if (isset($deals->status) && $deals->status == 'OK')
			 {
           return $deals;
			 }

       return false;
    }
}

?>
