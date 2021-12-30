<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('subjects_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
