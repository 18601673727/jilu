<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColumnToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function ($table) {
            // Changing existing part of events table
            $table->dropColumn('name');
            $table->decimal('score', 5, 2)->default('5.00')->change();

            // Add our new column
            $table->string('type')->after('id')->default('masturbation');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function ($table) {
            $table->dropColumn('type');
        });
    }
}
