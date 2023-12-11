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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('user_id')->constrained(table: 'users', indexName: 'user_id')->onDelete('cascade');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender',['M','F','O'])->nullable();;
            $table->string('age')->nullable();
            $table->string("profile_image")->nullable();
            $table->string('preffered_line')->nullable();
            $table->string('spoc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profile');
    }
};
