<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration
{
    
    public function up()
    {
        Schema::create('friendships', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('username_friend');
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('friendships');
    }
}

