<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id', 'post_fk_5314499')->references('id')->on('public_subjects');
        });
    }
}
