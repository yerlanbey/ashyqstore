<?php

namespace App;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable = ['user_id'];

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['count','admin_id'])->withTimestamps();
    }

    public function foods(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Food::class)->withPivot(['count','admin_id'])->withTimestamps();
    }

    public function  getFullPrice(): int
    {
        $sum=0;
        foreach ($this->foods()->withTrashed()->get() as $product) {
            if(Auth::check() && Auth::user()->isAdmin()){
                if(Auth::user()->id == $product->user_id){
                    $sum+= $product->getPriceForCount();
                }
            }elseif(Auth::check()){
                $sum+= $product->getPriceForCount();
            }else{
                $sum+= $product->getPriceForCount();
            }
        }
        return $sum;
    }
    public function saveOrder($name, $phone, $address,
                              $comment, $apartment, $floor,
                              $date, $time, $payment_spot, $payment_transfer): bool
    {

        if($this->status==0){
            $this->name = $name;
            $this->phone = $phone;
            $this->address = $address;
            $this->comment = $comment;
            $this->apartment = $apartment;
            $this->floor = $floor;
            $this->date = $date;
            $this->time = $time;
            $this->payment_spot = $payment_spot;
            $this->payment_transfer = $payment_transfer;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');
            return true;
        } else {
            return false;
        }
    }
}
