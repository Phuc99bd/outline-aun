<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Outline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //$table->id();
        Schema::create('outlines', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('version');
            $table->string('subject_id');
            $table->double("version_outline");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
