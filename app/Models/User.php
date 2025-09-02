<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = false; // UUID
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'is_admin',
        'profileimg'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

     public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'borrowing_user_id', 'id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Accessor for profile image URL
    public function getProfileImageUrlAttribute()
    {
        return $this->profileimg ? asset('storage/' . $this->profileimg) : asset('assets/img/profile-placeholder.jpg');
    }

    public static function updateProfileImageById(string $id, array $data)
    {
        $user = self::find($id);

        if (!$user) {
            return null;
        }

        if ($user->profileimg && isset($data['profileimg'])) {
            Storage::disk('public')->delete($user->profileimg);
        }

        $user->update($data);

        return $user;
    }
}
