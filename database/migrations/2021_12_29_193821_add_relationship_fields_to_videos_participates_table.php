<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVideosParticipatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos_participates', function (Blueprint $table) {
            $table->unsignedBigInteger('practical_solution_id')->nullable();
            $table->foreign('practical_solution_id', 'practical_solution_fk_5696825')->references('id')->on('practical_solutions');
            $table->unsignedBigInteger('champion_id')->nullable();
            $table->foreign('champion_id', 'champion_fk_5696826')->references('id')->on('champions');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5880010')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos_participates', function (Blueprint $table) {
            //
        });
    }
}
