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
        Schema::create('stadium', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->string('photo')->nullable();
            $table->longText('history')->nullable();
            $table->string('capacity')->nullable();
            $table->string('surface')->nullable();
            $table->string('year_built')->nullable();
            $table->string('location')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stadium');
    }
};
