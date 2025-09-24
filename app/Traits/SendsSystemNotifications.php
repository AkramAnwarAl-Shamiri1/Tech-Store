<?php

namespace App\Traits;

use App\Notifications\SystemNotification;
use App\Models\User;

trait SendsSystemNotifications
{
   
    public function notifyAdmins($type, $action, $message, $item_id = null)
    {
        User::where('role_id', 1)->get()->each(function($admin) use ($type, $action, $message, $item_id) {
            $admin->notify(new SystemNotification($type, $action, $message, $item_id));
        });
    }

 
    public function notifyUser($userId, $type, $action, $message, $item_id = null)
    {
        $user = User::find($userId);
        if ($user) {
            $user->notify(new SystemNotification($type, $action, $message, $item_id));
        }
    }

   
    public function notifyAllUsers($type, $action, $message, $item_id = null)
    {
        User::all()->each(function($user) use ($type, $action, $message, $item_id) {
            $user->notify(new SystemNotification($type, $action, $message, $item_id));
        });
    }
}
