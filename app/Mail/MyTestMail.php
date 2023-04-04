<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Product;

class MyTestMail extends Mailable
{
    use Queueable, SerializesModels;

    // public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct(Product $details)
    // {
    //     $this->product_name = $details;
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this->subject('Mail from websitepercobaan.com')
    //         ->view('emails.myTestMail');
    // }
}
