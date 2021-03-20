<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use rizalafani\rajaongkirlaravel\RajaOngkir;

/**
 * App\Models\Regency
 *
 * @property-read \App\Province $province
 * @method static Builder|Regency newModelQuery()
 * @method static Builder|Regency newQuery()
 * @method static Builder|Regency query()
 * @mixin Eloquent
 */
class Regency extends Model
{
    protected $fillable = ['id', 'province_id', 'name'];

    public static function populate() {
        foreach (RajaOngkir::Kota()->all() as $kota) {
            $model = static::firstOrNew(['id' => $kota['city_id']]);
            $model->province_id = $kota['province_id'];
            $model->name = $kota['type'] . ' ' . $kota['city_name'];
            $model->save();
        }
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
