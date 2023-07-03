<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id('ud_id');
            $table->unsignedBigInteger('user_id');
            $table->string('ud_photo')->nullable();
            $table->text('ud_address')->nullable();
            $table->tinyInteger('ud_gender')->nullable();
            $table->string('ud_phone')->nullable();
            $table->date('ud_birthday')->nullable();
            $table->string('ud_placeofbirth')->nullable();
            $table->string('ud_accountnumber')->nullable();
            $table->string('ud_bank')->nullable();
            $table->string('ud_lasteducation')->nullable();
            $table->string('ud_university')->nullable();
            $table->string('ud_programstudy')->nullable();
            $table->string('ud_faculty')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
