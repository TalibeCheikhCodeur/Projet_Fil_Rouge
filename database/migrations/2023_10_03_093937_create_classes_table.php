<?php

use App\Models\AnneeScolaire;
use App\Models\Filiere;
use App\Models\Niveau;
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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->unique();
            $table->foreignIdFor(Niveau::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Filiere::class)->constrained()->cascadeOnDelete();
            $table->integer('effectifs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
