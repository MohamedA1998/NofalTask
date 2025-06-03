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
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('main')->default(0);
			$table->string('code')->nullable();
			$table->string('flag')->nullable();
			$table->boolean('status')->default(true);
			$table->timestamps();
        });

        Schema::create('country_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('country_id');
            $table->string('language'); 
            $table->string('name'); 
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_translations');
        Schema::dropIfExists('countries');
    }
};
