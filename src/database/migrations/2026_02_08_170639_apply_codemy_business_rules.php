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
        Schema::table('briefs', function (Blueprint $table) {
            if (!Schema::hasColumn('briefs', 'is_published')) {
                $table->boolean('is_published')->default(false);
            }
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->unique(['student_id', 'brief_id'], 'unique_student_brief_submission');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('briefs', function (Blueprint $table) {
            $table->dropColumn('is_published');
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->dropUnique('unique_student_brief_submission');
        });
    }
};
