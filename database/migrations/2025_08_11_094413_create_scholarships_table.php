<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_scholarships_table.php

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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('scholarship_name');
            $table->text('eligibility_criteria');
            $table->string('award_amount');
            $table->text('application_description');
            $table->string('country');
            $table->json('application_requirements');
            $table->date('application_deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
