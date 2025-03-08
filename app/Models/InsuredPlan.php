<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuredPlan extends Model
{
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function policyHolder()
    {
        return $this->hasMany(PolicyHolder::class);
    }

    public function claimRequest()
    {
        return $this->hasMany(ClaimRequest::class);
    }
}
