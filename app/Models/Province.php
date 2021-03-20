<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use rizalafani\rajaongkirlaravel\RajaOngkir;

/**
 * App\Models\Province
 *
 * @method static Builder|Province newModelQuery()
 * @method static Builder|Province newQuery()
 * @method static Builder|Province query()
 * @mixin Eloquent
 */
class Province extends Model
{
    protected $fillable = ['id', 'name'];

    public static function populate() {
        foreach (RajaOngkir::Provinsi()->all() as $province) {
            $model = static::firstOrNew(['id' => $province['province_id']]);
            $model->name = $province['province'];
            $model->save();
        }
    }
}
