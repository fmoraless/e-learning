<?php

namespace App\Events;

use App\Models\WishList;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CourseAddedToWishList
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * @var WishList
     */
    public WishList $wishList;


    /**
     * Create a new event instance.
     *
     * @param WishList $wishList
     */
    public function __construct(WishList $wishList)
    {
        $this->wishList = $wishList;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
