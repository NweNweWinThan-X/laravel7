<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('race')->nullable();
            $table->string('religion')->nullable();
            $table->string('address')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('university')->nullable();
            $table->string('major')->nullable();
            $table->string('graduate_year')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cv_info');
    }
}
