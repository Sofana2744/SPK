<?php

namespace App\Models;

use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\NormalisasiAlternative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubAlternative extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }

    public function alternative(): BelongsTo{
        return $this->belongsTo(Alternative::class);
    }

    public function NormalisasiAlternative(): HasOne{
        return $this->hasOne(NormalisasiAlternative::class);
    }
}
