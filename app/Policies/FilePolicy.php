<?php

namespace App\Policies;

use App\Models\User;
use App\Models\File;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    // دوال مساعدة لتحديد الدور
    protected function isAdmin(User $user): bool
    {
        return $user->role && $user->role->name === 'Admin';
    }

    protected function isVendor(User $user): bool
    {
        return $user->role && $user->role->name === 'Vendor';
    }

    protected function isCustomer(User $user): bool
    {
        return $user->role && $user->role->name === 'Customer';
    }

    protected function isSupport(User $user): bool
    {
        return $user->role && $user->role->name === 'Support';
    }

    // عرض جميع الملفات
    public function viewAny(User $user)
    {
        return $this->isAdmin($user) || $this->isSupport($user);
    }

    // عرض ملف واحد
    public function view(User $user, File $file)
    {
        if ($this->isAdmin($user) || $this->isSupport($user)) return true;

        // يمكن للمستخدم صاحب الموديل المرتبط بالملف فقط
        return $file->fileable_type === 'App\Models\User' && $file->fileable_id === $user->id;
    }

    // إنشاء ملف
    public function create(User $user)
    {
        return $this->isAdmin($user) || $this->isVendor($user) || $this->isCustomer($user);
    }

    // تحديث ملف
    public function update(User $user, File $file)
    {
        if ($this->isAdmin($user)) return true;

        // يمكن للمستخدم صاحب الموديل المرتبط بالملف فقط
        return $file->fileable_id === $user->id;
    }

    // حذف ملف
    public function delete(User $user, File $file)
    {
        return $this->update($user, $file); // نفس شروط التحديث
    }
}
