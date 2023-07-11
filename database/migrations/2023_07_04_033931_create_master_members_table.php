<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_members', function (Blueprint $table) {
            $table->id('mm_id');
            $table->string('mm_name');
            $table->unsignedBigInteger('mm_nik')->length(16);
            $table->string('mm_position');
            $table->unsignedBigInteger('mm_phone')->length(25);
            $table->string('mm_email');
            $table->unsignedBigInteger('mm_nim_nip')->length(25)->nullable();
            $table->string('mm_socialmedia')->nullable();

            /* Insert foreign key here */
            $table->foreignId('mu_id')->nullable()->constrained('master_universitas', 'mu_id')->onDelete('restrict')->nullable();
            /* */

            $table->string('mm_npwp')->nullable();
            $table->string('mm_cv')->nullable();
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
        Schema::dropIfExists('master_members');
    }
}
