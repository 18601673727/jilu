<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('email')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('nickname')->nullable();

            // 0 -> male, 1 -> female, 2 -> transsexual(f2m), 3 -> transsexual(m2f)
            $table->unsignedTinyInteger('gender')->default(0);

            $table->string('language')->default('zh_CN');
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('email');
            $table->dropColumn('avatar');
            $table->dropColumn('nickname');
            $table->dropColumn('gender');
            $table->dropColumn('language');
            $table->dropColumn('city');
            $table->dropColumn('province');
            $table->dropColumn('country');
        });
    }
}
