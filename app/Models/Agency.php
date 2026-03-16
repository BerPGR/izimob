<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = [
        'name',
        'email',
        'telefone',
        'document',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
