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
        Schema::create('todolist', function (Blueprint $table) {
            $table->id();
            $table->string('todo');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('todolist');
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todolist');
    }
};
