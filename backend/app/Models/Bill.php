<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function biller()
    {
        return $this->belongsTo(User::class, 'biller_id');
    }
}
