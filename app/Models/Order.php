<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Order
 *
 * @property-read \App\Address $address
 * @property-read Collection|\App\OrderDetail[] $details
 * @property-read int|null $details_count
 * @property-read mixed $human_status
 * @property-read mixed $padded_id
 * @property-read \App\User $user
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @mixin Eloquent
 */
class Order extends Model
{
    protected $fillable = ['id', 'user_id', 'address_id', 'bank', 'sender', 'status', 'total_payment'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
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

    public function getPaddedIdAttribute(): string
    {
        return str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }

    public static function statusList(): array
    {
        return [
            'waiting-payment' => 'Menunggu Pembayaran',
            'packaging' => 'Order disiapkan',
            'sent' => 'Paket dikirim',
            'finished' => 'Paket diterima'
        ];
    }

    public function getHumanStatusAttribute(): string
    {
        return static::statusList()[$this->status];
    }

    public static function allowedStatus(): array
    {
        return array_keys(static::statusList());
    }
}
