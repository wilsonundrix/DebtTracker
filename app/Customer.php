<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Customer
 *
 * @property int $id
 * @property string $real_name
 * @property string $receipt_name
 * @property string $phone_no
 * @property string|null $alternate_no
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Receipt[] $Receipts
 * @property-read int|null $receipts_count
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
 * @mixin \Eloquent
 */
class Customer extends Model
{

    protected $fillable = [
        'real_name','receipt_name','phone_no','alternate_no'
    ];

    public function Receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
