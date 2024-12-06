<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpecialistsFieldsInCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->boolean('through_re_approval')->default(false);
            $table->unsignedBigInteger('specialist_rna_id')->unsigned()->index();
            $table->unsignedBigInteger('specialist_cb_id')->unsigned()->index();
            $table->unsignedBigInteger('specialist_decline_id')->unsigned()->index();
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
            $table->dropColumn('through_re_approval');
            $table->dropColumn('specialist_rna_id');
            $table->dropColumn('specialist_cb_id');
            $table->dropColumn('specialist_decline_id');
        });
    }
}
