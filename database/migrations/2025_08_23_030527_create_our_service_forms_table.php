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
        Schema::create('our_service_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar');
            $table->enum('type', ['text', 'number', 'email', 'select', 'radio', 'checkbox', 'date', 'time', 'datetime', 'file', 'image'])->default('text');
            $table->boolean('required')->default(false);
            $table->string('placeholder')->nullable();
            $table->string('placeholder_ar')->nullable();
            $table->json('options')->nullable();
            $table->json('options_ar')->nullable();
            $table->integer('col')->default(12)->nullable();
            $table->foreignId('our_service_id')->constrained('our_services')->cascadeOnDelete();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_service_forms');
    }
};
