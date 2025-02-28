<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyHolder extends Model
{
    public function insuredPlan()
    {
        return $this->belongsTo(InsuredPlan::class);
    }
}
