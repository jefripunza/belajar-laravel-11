<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Column;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "users";
    protected $primaryKey = Column\User::ID->value;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        Column\User::Email->value,
        Column\User::Password->value,
        Column\User::IsAdmin->value,

        Column\User::ActivationCode->value,

        Column\User::ImageURL->value,
        Column\User::FirstName->value,
        Column\User::LastName->value,
        Column\User::Gender->value,
        Column\User::PhoneNumber->value,
        Column\User::IsWhatsAppNumber->value,
        Column\User::Address->value,
        Column\User::PermanentAddress->value,
        Column\User::BirthdayDate->value,

        Column\User::Description->value,
        Column\User::Status->value,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        Column\User::Password->value,
        Column\User::RememberToken->value,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        Column\User::ActivationAt->value => 'datetime',
        Column\User::Password->value => 'hashed',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, Column\Post::AuthorID->value);
    }

    /**
     * Find a single user by username.
     *
     * @param string $username
     * @return User|null
     */
    public static function findOneByUsername(string $username)
    {
        return User::where(Column\User::Username->value, $username)->first();
    }
}
