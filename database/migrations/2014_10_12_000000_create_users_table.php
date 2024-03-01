<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('password');
            $table->string('idicon')->nullable();
            $table->integer('num_comments')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
