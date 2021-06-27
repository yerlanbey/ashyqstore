<?php

namespace App;
use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
class   Subscribtion extends Model
{
    protected $fillable = ['email','product_id'];


    public function scopeActiveByProductId($query, $productId)
    {
      return $query->where('status',0)->where('product_id', $productId);
    }

    public function product()
    {
      return $this->belongsTo(Product::class);
    }

    public static function sendEmailAfterSubscribtion(Product $product)
    {
          $subscriptions = self::ActiveByProductId($product->id)->get();
      foreach($subscriptions as $subscription){
        Mail::to($subscription->email)->send(new SendSubscriptionMessage($product));
        $subscription->status = 1;
        $subscription->save();
    }
  }
}
