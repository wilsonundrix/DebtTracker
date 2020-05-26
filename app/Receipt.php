<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Receipt
 *
 * @property int $id
 * @property int $user_id
 * @property int $customer_id
 * @property int $receipt_no
 * @property string $sale_amount
 * @property string $current_balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Customer $Customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $Payments
 * @property-read int|null $payments_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt whereCurrentBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt whereReceiptNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt whereSaleAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Receipt whereUserId($value)
 * @mixin \Eloquent
 */
class Receipt extends Model
{
    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function Payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
