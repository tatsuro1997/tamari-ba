<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('gender')->nullable()->change();
            $table->foreignId('prefecture_id')->nullable()->change();
            $table->integer('years_of_experience')->nullable()->change();
            $table->boolean('through')->nullable()->change();
            $table->string('uid')->nullable()->change();
            $table->boolean('agree')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
