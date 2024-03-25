<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DocumentStored implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct($name, $action)
    {
        $this->name = $name;
        $this->message = "A document was ".$action." by ".$name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['document-stored'];
        // return [
        //     new PrivateChannel('document-stored'),
        // ];
    }

    public function broadcastAs()
    {
        return 'notif';
    }
}
