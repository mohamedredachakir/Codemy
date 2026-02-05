<?php

use App\Enums\BriefTypeEnum;
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
        Schema::create('briefs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('estimated_time');

            $table->enum('type', [BriefTypeEnum::INDIVIDUAL, BriefTypeEnum::GROUP]);

            $table->foreignId('sprint_id')->constrained('sprints');
            $table->foreignId('class_id')->constrained('school_classes');
            $table->foreignId('teacher_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('briefs');
    }
};
