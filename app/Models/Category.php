<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'icon',
    ];

    protected static function booted()
    {
        static::deleting(function (Category $category) {
            $category->products()->delete();
        });
    }

    use HasFactory;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
