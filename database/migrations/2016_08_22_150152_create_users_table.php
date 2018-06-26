<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('status')->length(12);
            $table->string('name')->length(24);
            $table->integer('salary');
            $table->string('email')->length(255)->unique();
            $table->string('password')->length(60);
            $table->rememberToken();
            $table->string('phone')->length(15);
            $table->string('about')->length(255);
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
        Schema::drop('users');
    }
}
