<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'email',
        'telefone',
        'document',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
