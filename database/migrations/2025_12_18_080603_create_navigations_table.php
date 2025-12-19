<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('parent_id')->default(0); // reference to same table, not a FK
            $table->integer('position')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('page_type_id')->nullable(); // reference to page type
            $table->string('icon')->nullable();

            // Page content
            $table->text('short_content')->nullable();
            $table->longText('main_content')->nullable();
            $table->string('banner')->nullable();

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('page_type_id')->references('id')->on('page_types')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigations');
    }
};
