<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMasterQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_question', function (Blueprint $table) {
            // Make the mct_id column nullable
            $table->foreignId('mct_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_question', function (Blueprint $table) {
            // Revert the nullable change if needed (this is optional)
            $table->foreignId('mct_id')->constraint('master_component')->onDelete('restrict')->change();
        });
    }
}
