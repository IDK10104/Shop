<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id','status','subtotal','total','currency',
        'stripe_session_id','stripe_payment_intent',
        'customer_name','customer_email','shipping_address','shipping_city','shipping_country',
    ];

    public function items() { return $this->hasMany(OrderItem::class); }
    public function user() { return $this->belongsTo(User::class); }

    public function getTotalFormattedAttribute(): string {
        return '$' . number_format($this->total / 100, 2);
    }
}
