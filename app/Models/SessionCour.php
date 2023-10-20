<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionCour extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function salle():BelongsTo
    {
        return $this->belongsTo(Salle::class);
    }
}
