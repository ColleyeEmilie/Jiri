<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('implementations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('urls')->nullable();
            $table->boolean('design')->nullable();
            $table->boolean('front')->nullable();
            $table->boolean('back')->nullable();
            $table->json('scores')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('implementations');
    }
};
