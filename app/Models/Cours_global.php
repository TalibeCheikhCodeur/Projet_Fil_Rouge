<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cours_global extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public function coursGlobalClasse():HasMany
    {
        return $this->hasMany(CoursGlobalClasse::class,'cours_global_id');
    }

    public function module():BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
    public function professeur():BelongsTo
    {
        return $this->belongsTo(Professeur::class);
    }
    public function semestre():BelongsTo
    {
        return $this->belongsTo(Semestre::class);
    }
   
}
