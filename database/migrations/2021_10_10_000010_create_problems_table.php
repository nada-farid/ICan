<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('email')->unique();
            $table->string('phone');
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
