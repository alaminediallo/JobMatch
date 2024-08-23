<?php

use App\Enums\Niveau;
use App\Models\Langue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Création de la table 'langues'
        Schema::create('langues', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
        });

        // Création de la table pivot 'candidat_langue'
        Schema::create('candidat_langue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidat_id')->constrained('users')->cascadeOnDelete(); // Référence à la table users
            $table->foreignIdFor(Langue::class)->constrained()->cascadeOnDelete(); // Référence à la table langues
            $table->enum('niveau', Niveau::getValues()); // Niveau de maîtrise de la langue
        });
    }

    public function down(): void
    {
        // Suppression de la table pivot en premier, car elle dépend de la table 'langues'
        Schema::dropIfExists('candidat_langue');

        // Suppression de la table 'langues'
        Schema::dropIfExists('langues');
    }
};
