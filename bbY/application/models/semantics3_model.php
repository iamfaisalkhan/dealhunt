<?php if ( ! defined('BASEPATH')) exit('');

include_once(APPPATH.'libraries/oauth-php/library/OAuthStore.php');
include_once(APPPATH.'libraries/oauth-php/library/OAuthRequester.php');

class Semantics3_model extends CI_Model {

   function __construct()
   {
  }
   
   public function search($txt = FALSE)
   {

      $url = 'https://api.semantics3.com/v1/products?q={"search":"Apple Macbok"}';
      $options = array( 
        'consumer_key' => 'SEM341A572DF804E42DB091C09240070C984',
        'consumer_secret' => 'YzM5NzA2ZjY0MDkzMTU2N2FjMjM1NTg4MTZlMDljYTk'
      );

      OAuthStore::instance("2Leg", $options );
      $request = new OAuthRequester($url, 'GET', "");
      $result = $request->doRequest();
      $response = $result['body'];

      echo $response;
   }

}

