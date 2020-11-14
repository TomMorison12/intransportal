<?php

namespace App\Listener;

use App\Providers\App\Events\ThreadHasNewReply;

class NotifyThreadSubscribers
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

    public function handle(ThreadHasNewReply $event)
    {
        $event->thread->subscriptions->where('user_id', '!=', $event->reply->user_id)

        ->each->notify($event->reply);
    }
}
