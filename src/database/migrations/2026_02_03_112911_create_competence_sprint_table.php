<?php

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
        Schema::create('competence_sprint', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competence_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sprint_id')->constrained()->cascadeOnDelete();
            $table->primary(['competence_id','sprint_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competence_sprint');
    }
};
