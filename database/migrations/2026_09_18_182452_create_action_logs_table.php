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
        Schema::create('action_logs', function (Blueprint $table) {
            $table->integer('resource_id')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('resource_type', ['TASK', 'USER', 'CATEGORY', 'SUBTASK', 'COMMENT'])->nullable();
            $table->enum('action_status', ['SUCCESS', 'FAILURE', 'NA'])->default('NA');
            $table->timestampTz('created_at')->default('now()');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_logs');
    }
};
