<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnnonceOrder extends Mailable
{
    use Queueable, SerializesModels;
    

    public $user;
    public $link;
    public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$link,$transaction)
    {
        //

        $this->user = $user;
        $this->link= $link;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.transactionConfirmation');
    }
}
