<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->decimal('score', 5, 2);
            $table->text('content')->nullable();
            $table->text('reviews')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->boolean('published')->default(true);
            $table->bigInteger('started_at')->unsigned();
            $table->bigInteger('ended_at')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
