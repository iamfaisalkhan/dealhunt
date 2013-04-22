<?php if ( ! defined('BASEPATH')) exit('');

include_once(APPPATH.'libraries/oauth-php/library/OAuthStore.php');
include_once(APPPATH.'libraries/oauth-php/library/OAuthRequester.php');

class Semantics3_model extends CI_Model {

   function __construct()
   {
      parent::__construct();
      $this->base_url='https://api.semantics3.com/v1/';
      $this->options = array( 
        'consumer_key' => 'SEM341A572DF804E42DB091C09240070C984',
        'consumer_secret' => 'YzM5NzA2ZjY0MDkzMTU2N2FjMjM1NTg4MTZlMDljYTk'
      );
   }

   /**
    * Returns an array of Product class.
    */
   private function parse($json_data = FALSE)
   {
      if ($json_data == FALSE) return new Product();

      // Create array of Product object. 
      $result = array(); 

   }
   
   public function search($txt = FALSE)
   {

      if ($txt == FALSE) return;

      $url = $this->base_url.'products?q={"search":"'.$txt.'"}';
      OAuthStore::instance("2Leg", $this->options );
      $request = new OAuthRequester($url, 'GET', "");
      $result = $request->doRequest();
      $response = $result['body'];

      return parse(json_decode($response));
   }

}

