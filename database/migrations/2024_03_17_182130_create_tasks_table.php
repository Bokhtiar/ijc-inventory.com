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
            $table->id('task_id');
            $table->integer('company_id');
            $table->string('issue_type');
            $table->enum('type', ['work_schedule', 'task']);
            $table->longText('summary');
            $table->string('priority');
            $table->string('due_date');
            $table->integer('assign');
            $table->string('start_date');
            $table->integer('created_by');
            $table->integer('created_by_boss_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
