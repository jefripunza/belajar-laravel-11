<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Enums;



class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "users";
    protected $primaryKey = Enums\UserColumn::ID->value;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        Enums\UserColumn::Email->value,
        Enums\UserColumn::Password->value,
        Enums\UserColumn::IsAdmin->value,

        Enums\UserColumn::ActivationCode->value,

        Enums\UserColumn::ImageURL->value,
        Enums\UserColumn::FirstName->value,
        Enums\UserColumn::LastName->value,
        Enums\UserColumn::Gender->value,
        Enums\UserColumn::PhoneNumber->value,
        Enums\UserColumn::IsWhatsAppNumber->value,
        Enums\UserColumn::Address->value,
        Enums\UserColumn::PermanentAddress->value,
        Enums\UserColumn::BirthdayDate->value,

        Enums\UserColumn::Description->value,
        Enums\UserColumn::Status->value,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        Enums\UserColumn::Password->value,
        Enums\UserColumn::RememberToken->value,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        Enums\UserColumn::ActivationAt->value => 'datetime',
        Enums\UserColumn::Password->value => 'hashed',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, Enums\PostColumn::AuthorID->value);
    }

    /**
     * Find a single user by username.
     *
     * @param string $username
     * @return User|null
     */
    public static function findOneByUsername(string $username)
    {
        return User::where(Enums\UserColumn::Username->value, $username)->first();
    }
}
