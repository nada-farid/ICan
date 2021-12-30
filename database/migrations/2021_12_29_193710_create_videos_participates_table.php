<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosParticipatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos_participates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('type');
            $table->string('status')->default('pending');
            $table->longText('embed_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos_participates');
    }
}
