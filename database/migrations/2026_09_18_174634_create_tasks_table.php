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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->index();
            $table->string('description')->nullable();
            $table->integer('priority', unsigned: true)->index();
            $table->timestampTz('deadline')->default(DB::raw('CURRENT_TIMESTAMP'))->index();
            $table->enum('status', ['ONGOING', 'COMPLETED'])->index();
            $table->timestampsTz();
        });

        DB::statement('
            ALTER TABLE tasks
            ADD CONSTRAINT tasks_priority_check
            CHECK (priority BETWEEN 1 AND 20)
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
