<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
use HasFactory;

protected $fillable = ['alternative_id', 'criteria_id', 'bobot'];

public function alternative()
{
return $this->belongsTo(Alternative::class);
}
}
