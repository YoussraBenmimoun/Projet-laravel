<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->timestamp('date_de_publication')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('image');
            $table->string('temps_de_preparation');
            $table->string('temps_de_cuisson');
            $table->string('niveau_de_difficulte');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
