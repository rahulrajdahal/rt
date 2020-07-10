<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->softDeletes();
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('project_date')->nullable();
            $table->string('location')->nullable();
            $table->boolean('event')->default(false);
            $table->string('featured');
            $table->longText('body');
            $table->boolean('hidden')->default(false);
            $table->string('uuid');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('projectyear_id')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
