<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class SystemNotification extends Notification
{
    protected $type;
    protected $action;
    protected $message;
    protected $item_id;

    public function __construct($type, $action, $message, $item_id = null)
    {
        $this->type = $type;
        $this->action = $action;
        $this->message = $message;
        $this->item_id = $item_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => $this->type,
            'action' => $this->action,
            'message' => $this->message,
            'item_id' => $this->item_id,
        ];
    }
}
