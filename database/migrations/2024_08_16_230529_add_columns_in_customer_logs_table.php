<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInCustomerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('action_by')->unsigned()->index()->after('customer_id');
            $table->text('payload')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_logs', function (Blueprint $table) {
            $table->dropColumn('action_by');
            $table->dropColumn('payload');
        });
    }
}
