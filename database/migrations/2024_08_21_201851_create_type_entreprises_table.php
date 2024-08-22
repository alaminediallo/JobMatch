<?php

use App\Models\TypeEntreprise;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('type_entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->after('description_entreprise', function () use ($table) {
                $table->foreignIdFor(TypeEntreprise::class)->nullable()->constrained()->cascadeOnDelete();
            });
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('type_entreprise_id');
        });

        Schema::dropIfExists('type_entreprises');
    }
};
