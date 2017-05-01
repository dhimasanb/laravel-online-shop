<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fee;

class Product extends Model
{
    protected $fillable = ['name', 'photo', 'model', 'price', 'weight'];

    protected $appends = ['photo_path'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($model) {
            // remove relations to category
            $model->categories()->detach();
            // remove relation to cart
            $model->carts()->detach();
        });
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function getCategoryListsAttribute()
    {
        if ($this->categories()->count() < 1) {
            return null;
        }
        return $this->categories->pluck('id')->all();
    }

    public function getPhotoPathAttribute()
    {
        if ($this->photo !== '') {
            return url('/img/' . $this->photo);
        } else {
            return 'http://placehold.it/850x618';
        }
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function getCostTo($destination_id)
    {
        return Fee::getCost(
            config('rajaongkir.origin'),
            $destination_id,
            $this->weight,
            config('rajaongkir.courier'),
            config('rajaongkir.service')
        );
    }
}
