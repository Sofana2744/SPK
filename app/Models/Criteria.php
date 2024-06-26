<?php

namespace App\Models;

use App\Models\SubAlternative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Criteria extends Model
{
    use HasFactory;
    protected $guarded = ['id'] ;

    public function SubAlternative():HasMany
    {
        return $this->hasMany(SubAlternative::class);
    }

}
