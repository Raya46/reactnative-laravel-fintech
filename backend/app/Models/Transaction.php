<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        "users_id", "products_id", "status", "order_code", "price", "quantity"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "id")->withTrashed();
    }

    public function products()
    {
        return $this->belongsTo(Product::class, "products_id")->withTrashed();
    }

    public function userTransactions()
    {
        return $this->belongsToMany(User::class, "user_transactions")->withTrashed();
    }
}
