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
        Schema::table('evaluations', function (Blueprint $table) {
            
            $table->dropForeign(['student_id']);
            $table->dropForeign(['brief_id']);
            $table->dropForeign(['competence_id']);
            $table->dropForeign(['teacher_id']);

            $table->foreignId('student_id')->change()->constrained('users')->cascadeOnDelete();
            $table->foreignId('brief_id')->change()->constrained('briefs')->cascadeOnDelete();
            $table->foreignId('competence_id')->change()->constrained('competences')->cascadeOnDelete();
            $table->foreignId('teacher_id')->change()->constrained('users')->cascadeOnDelete();

         
            $table->unique(['student_id', 'brief_id', 'competence_id'], 'evaluations_unique_student_brief_competence');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropUnique('evaluations_unique_student_brief_competence');
        });
    }
};
