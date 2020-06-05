<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Payment
 *
 * @property int $id
 * @property int $user_id
 * @property int $receipt_id
 * @property int $pay_amount
 * @property int $previous_balance
 * @property int $new_balance
 * @property string $payment_type
 * @property string $payment_tag
 * @property int $extra_amount
 * @property int|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Receipt $Receipt
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereExtraAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereNewBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment wherePayAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment wherePaymentTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment wherePreviousBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereReceiptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereUserId($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{

    protected $fillable = [
        'user_id', 'receipt_id', 'pay_amount', 'previous_balance', 'new_balance', 'payment_type', 'payment_tag', 'extra_amount', 'description',
    ];

    public function Receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
