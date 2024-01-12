<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        "name", "price", "stock", "photo", "desc", "categories_id", "stand"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, "categories_id")->withTrashed();
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, "products_id")->withTrashed();
    }
}
