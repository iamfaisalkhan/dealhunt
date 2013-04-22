<?php
/**
 * A single product
 */

class Product
{
   $id = 0;
   $name = "Generic";
   $color = "Unknown";
   $width = 0.0;
   $height = 0.0;
   $price = 0.0; 

   $manufacturer = new Manufacturer();
   $features = array();
   $offers = array();
   $stores = array();
   $url = new $URL();
   $category = array();

}
