<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position_id',
        'photo',
    ];


    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeById($query, $userId): mixed
    {
        return $query->where('id', $userId);
    }
}
