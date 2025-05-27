<?php

use App\Models\Country;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('email')->unique();
            $table->foreignIdFor(Country::class)->nullable();
            $table->string('phone')->unique()->nullable();
            $table->boolean('phone_verified')->default(false);
            $table->enum('type', User::$TYPE)->nullable();
            $table->integer('age')->nullable()->unsigned();
            $table->enum('gender', User::$GENDER)->nullable();
            $table->string('password');

            // Followers
            $table->string('image')->nullable();
            $table->integer('height')->unsigned()->nullable();
            $table->integer('weight')->unsigned()->nullable();
            $table->string('job_title')->nullable();
            $table->boolean('blood_pressure')->nullable();
            $table->boolean('diabetes')->nullable();
            $table->boolean('cholesterol')->nullable();
            $table->string('genetic_disease')->nullable();
            $table->boolean('heart_defects')->nullable();
            $table->boolean('smoking')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
