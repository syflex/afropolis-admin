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
            $table->longText('description')->nullable();
            $table->longText('about')->nullable();
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();

            $table->string('price')->default(0.0);
            $table->string('event_type')->nullable();
            $table->string('discount')->nullable();
            $table->string('start');
            $table->string('end');
            
            $table->string('time');
            $table->string('session');
            $table->jsonb('multiple')->nullable();


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
