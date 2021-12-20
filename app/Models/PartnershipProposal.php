<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * PartnershipProposal Model
 *
 * @property $id
 * @property $user_id
 * @property $passport_front_side
 * @property $passport_back_side
 * @property $selfie_with_passport
 * @property $type
 * @property $status
 * @method static PartnershipProposal create(array $attributes = [])
 */

class PartnershipProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'passport_front_side'.
        'passport_back_side',
        'selfie_with_passport',
        'type',
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
