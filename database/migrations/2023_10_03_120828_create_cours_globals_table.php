<?php

use App\Models\Module;
use App\Models\Professeur;
use App\Models\Semestre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cours_globals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Semestre::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Professeur::class)->constrained()->cascadeOnDelete();
            $table->enum('etat',['en cours','terminer'])->default('en cours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_globals');
    }
};
