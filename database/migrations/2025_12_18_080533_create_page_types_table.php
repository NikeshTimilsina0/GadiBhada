<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('page_types', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g., "Home", "About", "Contact", "Notice"
            $table->boolean('is_active')->default(true); // optional status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_types');
    }
};
