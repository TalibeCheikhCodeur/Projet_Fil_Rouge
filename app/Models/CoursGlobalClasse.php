<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Stmt\Return_;

class CoursGlobalClasse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function session_cours(): HasMany
    {
        return $this->hasMany(SessionCour::class, 'cours_global_classe_id');
    }

    public function cours_globals(): BelongsTo
    {
        return $this->belongsTo(Cours_globals::class, 'cours_global_id');
    }

    public function classes():BelongsTo
    {
        return $this->belongsTo(Classe::class,'classe_id');
    }
}
