<?php

include_once('manufacturer.php');
include_once('url.php');

/**
 * A single product
 */
class Product
{
   
   function __construct()
   {
      $id = 0;
      $name = "Generic";
      $color = "Unknown";
      $brand = "Unknown";
      $width = 0.0;
      $height = 0.0;
      $price = 0.0; 
   
      $manufacturer = new Manufacturer();
      $features = array();
      $offers = array();
      $stores = array();
      $url = new URL();
      $category = array();
   }

}
