<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class SendBill
{
    use SerializesModels;

    public $mailData;
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }
    public function broadcastOn()
    {
        return [];
    }
}
