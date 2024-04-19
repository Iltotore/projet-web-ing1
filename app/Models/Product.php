<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\File;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'icon',
        'unit_price',
        'amount',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function buyers(): BelongsToMany {
        return $this
            ->belongsToMany(User::class, table: "shopping_cart")
            ->withPivot(['amount']);
    }

    public function clearIcon(): void {
        $file_path = public_path("/product/" . $this->icon);
        if (File::exists($file_path)) File::delete($file_path);
    }
}
