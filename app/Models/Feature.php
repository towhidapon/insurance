<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
