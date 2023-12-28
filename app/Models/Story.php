<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'approved',
        'approve_token',
        'creator_id'
    ];
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'creator_id', 'id');
    }
}
