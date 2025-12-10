<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        "name",
        "note",
        "targeted_amount",
        "already_saved",
        "desired_date",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
