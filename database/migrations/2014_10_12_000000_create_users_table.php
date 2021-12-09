<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('avatar')->default('avatar.png');
            $table->string('cover')->default('cover.png');
            $table->longText('about')->nullable();
            $table->string('website')->nullable();
            $table->string('skill')->nullable();
            $table->string('profession')->nullable();
            $table->text('status')->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('active')->default(true);
            $table->string('activation_token')->nullable();
            $table->dateTime('banned_untill')->nullable();
            $table->boolean('is_admin')->nullable()->default(false);
            $table->timestamp('last_login')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
