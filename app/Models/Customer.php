<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected  $guarded = [];

    public function getUser()
    {
        return $this->hasOne(User::class , 'id' , 'user_id');
    }
}
