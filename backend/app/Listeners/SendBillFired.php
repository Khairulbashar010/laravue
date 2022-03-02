<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendBill;
use Mail;

class SendBillFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendBill  $event
     * @return void
     */
    public function handle(SendBill $event)
    {
        $data = $event->mailData;
        Mail::send('bill_email', ['data' => $data], function($email) use ($data) {
            $email->to($data['billTo']['email']);
            $email->from($data['billerInfo']['email']);
            $email->subject('Monthly Bill');
        });
    }
}
