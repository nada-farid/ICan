<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalOpinionsTable extends Migration
{
    public function up()
    {
        Schema::create('medical_opinions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('opinion');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
