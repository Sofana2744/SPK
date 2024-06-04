<?php

namespace App\Models;

use App\Models\SubAlternative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NormalisasiAlternative extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function SubAlternative():BelongsTo{
        return $this->belongsTo(SubAlternative::class);
    }
}
