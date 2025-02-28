<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use GlobalStatus;

    protected $casts = [
        'benefit' => 'array',
    ];
    public function plan()
    {
        return $this->hasMany(Plan::class);
    }
}
