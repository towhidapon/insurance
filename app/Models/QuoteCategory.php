<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteCategory extends Model
{
    public function quoteRequest()
    {
        return $this->hasMany(QuoteRequest::class);
    }
}
