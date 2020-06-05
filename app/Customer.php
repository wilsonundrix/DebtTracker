<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Customer
 *
 * @property int $id
 * @property int $user_id
 * @property string $real_name
 * @property string $receipt_name
 * @property string $phone_no
 * @property string|null $alternate_no
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Account|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Receipt[] $receipts
 * @property-read int|null $receipts_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereAlternateNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer wherePhoneNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereReceiptName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereUserId($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{

    protected $fillable = [
        'real_name', 'receipt_name', 'phone_no', 'alternate_no'
    ];

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
