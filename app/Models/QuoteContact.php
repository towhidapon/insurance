<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteContact extends Model
{
    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }
}
