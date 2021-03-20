<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Product
 *
 * @property-read Collection|\App\Cart[] $carts
 * @property-read int|null $carts_count
 * @property-read Collection|\App\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $category_lists
 * @property-read mixed $photo_path
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @mixin Eloquent
 */
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

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getCategoryListsAttribute(): ?array
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

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
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
