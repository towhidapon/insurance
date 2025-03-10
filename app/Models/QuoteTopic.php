<?php
namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class QuoteTopic extends Model
{
    use GlobalStatus;

    public function quote()
    {
        return $this->hasMany(Quote::class);
    }
}
