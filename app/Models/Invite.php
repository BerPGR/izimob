<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agency;

class Invite extends Model
{
    protected $fillable = ['agency_id', 'email', 'role', 'token', 'expires_at'];

    protected $casts = [
        'expires_at'  => 'datetime',
        'accepted_at' => 'datetime',
    ];

    public function agency() {
        return $this->belongsTo(Agency::class);
    }
}
