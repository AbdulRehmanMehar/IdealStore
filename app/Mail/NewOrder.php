<?php

namespace App\Mail;

use App\User;
use App\Order;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $data = [
        'orders' => Order::where('buyer_email', Auth::user()->email)->get()
      ];
      return $this->view('client.verify.OrderEmailData')->with($data);
    }
}
