<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jiris', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('contact_id')->constrained();
        });
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('jiri_id')->constrained();
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });
        Schema::table('implementations', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained();
            $table->foreignId('contact_id')->constrained();
            $table->foreignId('jiri_id')->constrained();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
