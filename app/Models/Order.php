<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['user_id', 'shipping_method_id', 'payment_method_id', 'total', 'status'];

    public function user() { return $this->belongsTo(User::class); }

    public function shippingMethod() { return $this->belongsTo(ShippingMethod::class); }

    public function paymentMethod() { return $this->belongsTo(PaymentMethod::class); }

    public function orderItems() { return $this->hasMany(OrderItem::class); }

    public function payments() { return $this->hasMany(Payment::class); }

    public function transactions() { return $this->hasMany(Transaction::class); }

    public function statusHistory() { return $this->hasMany(OrderStatusHistory::class); }
}
