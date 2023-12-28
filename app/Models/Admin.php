<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class   Admin extends Authenticatable
{
    use HasFactory;
    protected $fillable=[
        'email',
        'password'
    ];
    public function stories()
    {
        return $this->hasMany(Story::class, 'creator_id', 'id');
    }
}
