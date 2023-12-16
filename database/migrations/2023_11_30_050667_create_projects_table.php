<?php

use  Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description')->nullable()->default(null);
            $table->text('notes')->nullable()->default(null);
            $table->boolean('is_paid')->nullable()->default(false);
            $table->boolean('exemptable')->nullable()->default(false);
            $table->uuid('property_id')->nullable()->default(null);
            $table->uuid('building_id')->nullable()->default(null);
            // $table->uuid('suite_id')->nullable()->default(null);
            $table->uuid('employee_id')->nullable()->default(null);
            $table->timestamp('scheduled_at')->nullable()->default(null);
            $table->timestamp('completed_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
