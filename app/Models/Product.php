<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $table = "m_product";
    protected $primaryKey = "id";
    protected $keyType = "uuid";
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        "name",
        "product_category_id",
        "price",
        "image",
        "is_active"
    ];

    public function categoryProduct(): BelongsTo
    {
        return $this->belongsTo(CategoryProduct::class, "product_category_id", "id");
    }
}
