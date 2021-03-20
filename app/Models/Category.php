<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Category
 *
 * @property-read Collection|\App\Category[] $childs
 * @property-read int|null $childs_count
 * @property-read mixed $related_products_id
 * @property-read mixed $total_products
 * @property-read \App\Category $parent
 * @property-read Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category noParent()
 * @method static Builder|Category query()
 * @mixin Eloquent
 */
class Category extends Model
{
    protected $fillable = ['title', 'parent_id'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($model) {
            // remove parent from this category's child
            foreach ($model->childs as $child) {
                $child->parent_id = 0;
                $child->save();
            }
            // remove relations to products
            $model->products()->detach();
        });
    }

    public function childs(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function getRelatedProductsIdAttribute(): array
    {
        $result = $this->products->pluck('id')->toArray();
        foreach ($this->childs as $child) {
            $result = array_merge($result, $child->related_products_id);
        }
        return $result;
    }

    public function scopeNoParent($query)
    {
        return $this->where('parent_id', '');
    }

    public function getTotalProductsAttribute(): int
    {
        return Product::whereIn('id', $this->related_products_id)->count();
    }

    public function hasParent(): bool
    {
        return $this->parent_id > 0;
    }

    public function hasChild(): bool
    {
        return $this->childs()->count() > 0;
    }
}
