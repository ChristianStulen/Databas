<?php
/** 
 * En klass som beskriver en produkt
 */

 class Product {
     /** 
      * Instansvariabler
      */

      private $productid;
      private $name;
      private $description;
      private $price;
      private $image;
      private $in_stock;

      /**
       * Konstruktor
       **/

      public function __construct($productid, $name, $description, $price, $image, $in_stock)
      {
        $this->productid = $productid;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->in_stock = $in_stock;
      }

      /**
     * En metdod som konverterar ett objekt till en array
     */
    public function toArray()
    {
        $array = array(
            "productid" => $this->productid,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "image" => $this->image,
            "in_stock" => $this->in_stock,
        );
        
        return $array;
    }
}