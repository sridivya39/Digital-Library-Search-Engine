<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClaimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('claim');
        Schema::create('claim', function (Blueprint $table) {
            $table->id('claim_id');
            $table->string('description');
            $table->string('handle_number');
            $table->string('username');
            $table->string('can_reproduce');
            $table->string('source_code');
            $table->string('datasets');
            $table->string('exp_results');
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
        Schema::dropIfExists('claim');
    }
}
