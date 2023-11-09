<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            // Not setting unique allows to have multiple contacts with the same email
            // It makes sense because one person can be a contact for multiple users
            // and we want to avoid that editing a contact for one user changes it for another.
            // The alternative would be to have a pivot table between users and contacts
            // but it would be overkill for this project.
            // $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
