<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'value', 'balance'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
