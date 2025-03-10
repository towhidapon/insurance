<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function quoteTopic()
    {
        return $this->belongsTo(QuoteTopic::class);
    }
}
