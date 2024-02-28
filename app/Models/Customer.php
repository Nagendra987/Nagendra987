<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $guarded  = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function userName()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
