<?php

namespace App;

use RajaOngkir;
use Illuminate\Database\Eloquent\Model;

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

    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
