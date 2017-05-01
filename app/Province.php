<?php

namespace App;

use RajaOngkir;
use Illuminate\Database\Eloquent\Model;

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
