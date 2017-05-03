<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = ['id', 'order_id', 'product_id', 'quantity', 'price',
        'fee', 'total_price'];

    public static function boot() {
        parent::boot();

        static::saved(function($model) {
            if ($model->total_price < 1) {
                $model->refreshTotalPrice();
            }
            $model->order->refreshTotalPayment();
        });
    }

    public function refreshTotalPrice()
    {
        $total_price = ($this->price + $this->fee) * $this->quantity;
        $this->total_price = $total_price;
        $this->save();
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
