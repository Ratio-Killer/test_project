<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class RegistrationToken extends Model
{
    protected $fillable = [
        'token',
        'expires_at',
        'used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    public function isExpired(): bool
    {
        return $this->expires_at->lt(Carbon::now());
    }
}
