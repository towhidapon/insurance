<?php
namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use GlobalStatus;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function insuredPlan()
    {
        return $this->hasMany(InsuredPlan::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_plan');
    }
}   