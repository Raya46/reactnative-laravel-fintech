<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        "users_id", "credit", "debit", "status"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "users_id")->withTrashed();
    }
}
