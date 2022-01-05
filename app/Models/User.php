<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * User Model
 *
 * @property $id
 * @property $name
 * @property $phone
 * @property $password
 * @property $avatar
 * @property $is_active
 * @property $country_code_id
 *
 * @method static user where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static User first($columns = ['*'])
 * @method static User create(array $attributes = [])
 */

class User extends Authenticatable implements JWTSubject
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'avatar',
        'is_active',
        'country_code_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function countryCode(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_code_id');
    }

    public function partnershipProposal()
    {
        return $this->hasOne(PartnershipProposal::class);
    }

    public function shop() {
        return $this->hasMany(Shop::class);
    }


}
