<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('interest_id')->nullable();
            $table->string('title');
            $table->longText('description');
            $table->longText('about');
            $table->string('price')->nullable();
            $table->string('eventType');
            $table->string('discount')->nullable();
            $table->string('start');
            $table->string('end');
            $table->string('city');
            $table->string('country');
            $table->string('address');
            $table->string('time');
            $table->string('session');
            $table->jsonb('multiple')->nullable();
            $table->string('video');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
