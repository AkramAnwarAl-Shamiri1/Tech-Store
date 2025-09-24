<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SendsSystemNotifications;

class BaseController extends Controller
{
    use SendsSystemNotifications;

   
    protected function createWithNotification($modelClass, $data, $type, $notifyAll = true)
    {
        $item = $modelClass::create($data);

        if ($notifyAll) {
            $this->notifyAllUsers($type, 'create', "تم إنشاء {$type} جديد", $item->id);
        } else {
            $this->notifyAdmins($type, 'create', "تم إنشاء {$type} جديد", $item->id);
        }

        return $item;
    }

    
    protected function updateWithNotification($item, $data, $type, $notifyAll = true)
    {
        $item->update($data);

        if ($notifyAll) {
            $this->notifyAllUsers($type, 'update', "تم تعديل {$type} #{$item->id}", $item->id);
        } else {
            $this->notifyAdmins($type, 'update', "تم تعديل {$type} #{$item->id}", $item->id);
        }

        return $item;
    }

    
    protected function deleteWithNotification($item, $type, $notifyAll = false)
    {
        $item->delete();

        if ($notifyAll) {
            $this->notifyAllUsers($type, 'delete', "تم حذف {$type} #{$item->id}", $item->id);
        } else {
            $this->notifyAdmins($type, 'delete', "تم حذف {$type} #{$item->id}", $item->id);
        }

        return true;
    }
}
