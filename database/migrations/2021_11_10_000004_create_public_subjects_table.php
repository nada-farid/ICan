<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('public_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('writer_name');
            $table->longText('description');
            $table->integer('views')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
