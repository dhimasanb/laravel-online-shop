<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'user_id', 'address_id', 'bank', 'sender', 'status', 'total_payment'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function details()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function refreshTotalPayment()
    {
        $total_payment = 0;
        foreach($this->details as $detail) {
            $total_payment += $detail->total_price;
        }
        $this->total_payment = $total_payment;
        $this->save();
    }

    public function getPaddedIdAttribute()
    {
        return str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }

    public static function statusList()
    {
        return [
            'waiting-payment' => 'Menunggu Pembayaran',
            'packaging' => 'Order disiapkan',
            'sent' => 'Paket dikirim',
            'finished' => 'Paket diterima'
        ];
    }

    public function getHumanStatusAttribute()
    {
        return static::statusList()[$this->status];
    }

    public static function allowedStatus()
    {
        return array_keys(static::statusList());
    }
}
