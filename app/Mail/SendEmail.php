<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,Order $order)
    {
        $this->name = $name;
        $this->order  = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $fullSum = $this->order->getFullPrice();
        return $this->subject('Уведомление о заказе')->view('mail.send_message',[
          'name' => $this->name,
          'fullSum'=>$fullSum ,
          'order'=> $this->order]);
    }
}
