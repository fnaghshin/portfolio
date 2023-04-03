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
        Schema::create('skill_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('skill_id');
            $table->string('language');
            $table->string('icon')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->date("year")->nullable();
//            $table->foreign('skill_id')
//                ->references('id')
//                ->on('skills')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_contents');
    }
};
