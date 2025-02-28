<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    public function quoteCategory()
    {
        return $this->belongsTo(QuoteCategory::class);
    }

    public function quoteContacts()
    {
        return $this->hasMany(QuoteContact::class);
    }
}
