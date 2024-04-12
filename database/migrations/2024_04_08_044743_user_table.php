<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Auth\Socialite;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('provider_id')->nullable();
      $table->string('avatar')->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });
    }   

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
