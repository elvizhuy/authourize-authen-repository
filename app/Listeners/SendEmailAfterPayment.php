<?php

namespace App\Listeners;

use App\Events\OrderPayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailAfterPayment implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPayment $event): void
    {
        $amount = $event->order->amount;
        $note = $event->order->note;
        $content = "Amount: ".$amount ."\nNote: ".$note;
        file_put_contents('./data.txt',$content);
    }
}
