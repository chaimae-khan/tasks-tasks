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
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->string('projectname');
            $table->string('todo');
            $table->string('type')->nullable();
            $table->string('operation')->nullable();
            $table->dateTime('deadline');
            $table->string('status')->default('Pending');
            $table->text('history')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
