<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cours_global extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public function coursGlobalClasse():BelongsToMany
    {
        return $this->belongsToMany(Cours_global::class,'cours_global_classes');
    }
}
