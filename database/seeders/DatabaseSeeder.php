<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
       $this->call([
    RoleSeeder::class,
    UserSeeder::class,
    RoleUserSeeder::class,
    ShippingMethodSeeder::class,   
    PaymentMethodSeeder::class,   
    CategorySeeder::class,
    ProductSeeder::class,
    ReviewSeeder::class,
    WishlistSeeder::class,
    TagSeeder::class,
    ProductTagSeeder::class,
    AddressSeeder::class,
    VendorSeeder::class,
    FileSeeder::class,
    SettingSeeder::class,
    CartSeeder::class,
    CartItemSeeder::class,
    OrderSeeder::class,            
    OrderItemSeeder::class,
    OrderStatusHistorySeeder::class,
     CouponSeeder::class,
    OrderCouponSeeder::class,
    PaymentSeeder::class,
    TransactionSeeder::class,
    ActivityLogSeeder::class,
    MessageSeeder::class,
    StockHistorySeeder::class,
]);

    }
}
