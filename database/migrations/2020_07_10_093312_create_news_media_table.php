<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('project_date')->nullable();
            $table->unsignedInteger('project_id')->index();
            $table->string('location')->nullable();
            $table->string('featured')->nullable();
            $table->longText('body');
            $table->boolean('hidden')->default(false);
            $table->string('uuid')->nullable();
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
        Schema::dropIfExists('news_media');
    }
}
