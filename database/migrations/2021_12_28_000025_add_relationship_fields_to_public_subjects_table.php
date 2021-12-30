<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPublicSubjectsTable extends Migration
{
    public function up()
    {
        Schema::table('public_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_category_id')->nullable();
            $table->foreign('subject_category_id', 'subject_category_fk_5689502')->references('id')->on('subjects_categories');
        });
    }
}
