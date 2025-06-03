<?php

use App\Models\User;
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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('image')->nullable();
            $table->integer('height')->unsigned()->nullable();
            $table->integer('weight')->unsigned()->nullable();
            $table->string('job_title')->nullable();
            $table->boolean('blood_pressure')->default(false);
            $table->boolean('diabetes')->default(false);
            $table->boolean('cholesterol')->default(false);
            $table->string('genetic_disease')->nullable();
            $table->boolean('heart_defects')->default(false);
            $table->boolean('smoking')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
