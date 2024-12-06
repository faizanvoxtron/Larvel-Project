<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloserAndToIdColumnsInCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('closer_id')->unsigned()->after('m_id')->nullable();
            $table->unsignedBigInteger('to_person_id')->unsigned()->after('closer_id')->nullable();
            $table->string('mmn')->nullable();
            $table->timestamp('completed_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('closer_id');
            $table->dropColumn('to_person_id');
            $table->dropColumn('mmn');
            $table->dropColumn('completed_on');
        });
    }
}
