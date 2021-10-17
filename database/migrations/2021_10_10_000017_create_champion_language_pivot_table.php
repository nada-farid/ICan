<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionLanguagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('champion_language', function (Blueprint $table) {
            $table->unsignedBigInteger('champion_id');
            $table->foreign('champion_id', 'champion_id_fk_5070522')->references('id')->on('champions')->onDelete('cascade');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id', 'language_id_fk_5070522')->references('id')->on('languages')->onDelete('cascade'); 
        });
    }
}
