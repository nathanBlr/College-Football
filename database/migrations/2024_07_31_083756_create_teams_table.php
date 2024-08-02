<?php

use App\Models\Conference;
use App\Models\Stadium;
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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('hex1')->nullable();
            $table->string('hex2')->nullable();
            $table->string('hex3')->nullable();
            $table->string('logo')->nullable();
            $table->string('simble')->nullable();
            $table->longText('history')->nullable();
            $table->date('creation_date');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->foreignIdFor(Stadium::class,'stadium_id')->onDelete('cascade');
            $table->foreignIdFor(Conference::class,'conferences_id')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
