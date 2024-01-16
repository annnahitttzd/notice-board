<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->boolean('approved')->default(false);
            $table->text('approve_token')->nullable();
            $table->foreign('creator_id')->references('id')->on('admins');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
