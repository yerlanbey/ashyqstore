<?php

namespace App\Observers;
use App\Subscribtion;
use App\Product;

class ProductObserver
{
    public function updating(Product $product)
    {
      $oldParametr = $product->getOriginal('count');
      if($oldParametr == 0 && $product->count > 0){
        Subscribtion::sendEmailAfterSubscribtion($product);
    }
  }
}
