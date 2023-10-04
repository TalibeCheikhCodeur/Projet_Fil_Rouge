<?php

use App\Models\CoursGlobalClasse;
use App\Models\Salle;
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
        Schema::create('session_cours', function (Blueprint $table) {
            $table->id();
            $table->integer('heure_debut');
            $table->integer('heure_fin');
            $table->integer('duree');
            $table->enum('etat',['annullee','en cours','terminee'])->default('en cours');
            $table->enum('type_cours',['en ligne','presentiel'])->default('presentiel');
            $table->foreignIdFor(CoursGlobalClasse::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Salle::class)->nullable()->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_cours');
    }
};
