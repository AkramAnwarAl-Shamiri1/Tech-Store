<?php

use Illuminate\Support\Facades\Route;




Route::apiResource('products', App\Http\Controllers\ProductController::class);



    Route::apiResource('roles', App\Http\Controllers\RoleController::class);
    Route::apiResource('users', App\Http\Controllers\UserController::class);
    Route::apiResource('categories', App\Http\Controllers\CategoryController::class);
    Route::apiResource('addresses', App\Http\Controllers\AddressController::class);
    Route::apiResource('shipping_methods', App\Http\Controllers\ShippingMethodController::class);
    Route::apiResource('payment_methods', App\Http\Controllers\PaymentMethodController::class);
    Route::apiResource('orders', App\Http\Controllers\OrderController::class);
    Route::apiResource('order_items', App\Http\Controllers\OrderItemController::class);
    Route::apiResource('order_status_history', App\Http\Controllers\OrderStatusHistoryController::class);
    Route::apiResource('reviews', App\Http\Controllers\ReviewController::class);
    Route::apiResource('coupons', App\Http\Controllers\CouponController::class);
    Route::apiResource('payments', App\Http\Controllers\PaymentController::class);
    Route::apiResource('notifications', App\Http\Controllers\NotificationController::class);
    Route::apiResource('wishlists', App\Http\Controllers\WishlistController::class);
    Route::apiResource('transactions', App\Http\Controllers\TransactionController::class);
    Route::apiResource('vendors', App\Http\Controllers\VendorController::class);
    Route::apiResource('product_images', App\Http\Controllers\ProductImageController::class);
    Route::apiResource('cart_items', App\Http\Controllers\CartItemController::class);
    Route::apiResource('stock_histories', App\Http\Controllers\StockHistoryController::class);
    Route::apiResource('activity_logs', App\Http\Controllers\ActivityLogController::class);
    Route::apiResource('messages', App\Http\Controllers\MessageController::class);
    Route::apiResource('photos', App\Http\Controllers\PhotoController::class);
    Route::apiResource('product_tags', App\Http\Controllers\ProductTagController::class);
    Route::apiResource('settings', App\Http\Controllers\SettingController::class);
    Route::apiResource('tags', App\Http\Controllers\TagController::class);
    Route::apiResource('cart', App\Http\Controllers\CartController::class);
    Route::apiResource('order_coupons', App\Http\Controllers\OrderCouponController::class);

