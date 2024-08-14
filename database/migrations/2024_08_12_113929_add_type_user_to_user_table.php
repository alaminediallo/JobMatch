<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('name', function () use ($table) {
                $table->string('prenom')->nullable();
            });

            $table->after('email', function () use ($table) {
                $table->enum('type_user', ['Candidat', 'Administrateur', 'Entreprise']);
            });

            $table->after('password', function () use ($table) {
                $table->string('adresse')->nullable();
                $table->string('nom_entreprise')->nullable();  // Specific to Entreprise
                $table->text('description_entreprise')->nullable();  // Specific to Entreprise
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
};
