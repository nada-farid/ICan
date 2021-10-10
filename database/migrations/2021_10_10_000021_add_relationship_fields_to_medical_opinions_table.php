<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMedicalOpinionsTable extends Migration
{
    public function up()
    {
        Schema::table('medical_opinions', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_fk_5070451')->references('id')->on('users');
        });
    }
}
