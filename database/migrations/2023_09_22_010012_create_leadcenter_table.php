<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadcenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leadcenter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->unsigned()->index();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('surname')->nullable();
            $table->text('phone')->nullable();
            $table->string('gen_code')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('state_abbr')->nullable();
            $table->string('ssn')->nullable();

            $table->boolean('is_complete')->default(0);
            $table->boolean('is_used')->default(0);
            $table->boolean('in_rnd')->default(0);
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
        Schema::dropIfExists('leadcenter');
    }
}
