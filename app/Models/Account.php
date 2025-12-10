<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        "user_id",
        "name",
        "number",
        "account_type_id",
        "currency_id",
        "balance",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accounttype()
    {
        return $this->belongsTo(AccountType::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
