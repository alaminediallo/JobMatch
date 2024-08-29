<?php

use App\Enums\TypeOffre;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedMediumInteger('salaire_proposer');
            $table->enum('type_offre', TypeOffre::getValues());
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('description')->nullable();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
