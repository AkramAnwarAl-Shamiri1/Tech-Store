<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        \App\Models\Role::class => \App\Policies\RolePolicy::class,
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Models\Product::class => \App\Policies\ProductPolicy::class,
        \App\Models\ProductFile::class => \App\Policies\ProductFilePolicy::class,
        \App\Models\Address::class => \App\Policies\AddressPolicy::class,
        \App\Models\ShippingMethod::class => \App\Policies\ShippingMethodPolicy::class,
        \App\Models\PaymentMethod::class => \App\Policies\PaymentMethodPolicy::class,
        \App\Models\Order::class => \App\Policies\OrderPolicy::class,
        \App\Models\OrderItem::class => \App\Policies\OrderItemPolicy::class,
        \App\Models\OrderStatusHistory::class => \App\Policies\OrderStatusHistoryPolicy::class,
        \App\Models\Review::class => \App\Policies\ReviewPolicy::class,
        \App\Models\Coupon::class => \App\Policies\CouponPolicy::class,
        \App\Models\Payment::class => \App\Policies\PaymentPolicy::class,
        \App\Models\Notification::class => \App\Policies\NotificationPolicy::class,
        \App\Models\Wishlist::class => \App\Policies\WishlistPolicy::class,
        \App\Models\Transaction::class => \App\Policies\TransactionPolicy::class,
        \App\Models\Vendor::class => \App\Policies\VendorPolicy::class,
        \App\Models\ProductTag::class => \App\Policies\ProductTagPolicy::class,
        \App\Models\Message::class => \App\Policies\MessagePolicy::class,
        \App\Models\StockHistory::class => \App\Policies\StockHistoryPolicy::class,
        \App\Models\ActivityLog::class => \App\Policies\ActivityLogPolicy::class,
        \App\Models\Cart::class => \App\Policies\CartPolicy::class,
        \App\Models\CartItem::class => \App\Policies\CartItemPolicy::class,
        \App\Models\OrderCoupon::class => \App\Policies\OrderCouponPolicy::class,
        \App\Models\Banner::class => \App\Policies\BannerPolicy::class,
        \App\Models\PersonalAccessToken::class => \App\Policies\TokenPolicy::class,
        \App\Models\Setting::class => \App\Policies\SettingPolicy::class,
      
    ];

   
    public function boot()
    {
        $this->registerPolicies();
    }
}
