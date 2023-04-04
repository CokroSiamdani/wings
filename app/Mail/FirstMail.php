<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->products = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('H-30 Day Maintanance ' . $this->products->product_name)
            ->from('cokro.siamdani@saranalegalitas.id')
            ->view('emails.expiredmonth')
            ->with([
                'nama' => $this->products->product_name,
                'tgl' => $this->products->expired_date,
            ]);
    }
}
