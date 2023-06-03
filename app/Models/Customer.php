<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected  $guarded = [];


    public function getAssignedUser()
    {
        return $this->hasOne(User::class , 'id' , 'user_id');
    }
}
