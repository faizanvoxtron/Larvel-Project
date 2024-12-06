<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRndAgentIdInLeadcenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leadcenter', function (Blueprint $table) {
            $table->unsignedBigInteger('rnd_agent_id')->unsigned()->index()->nullable()->after('agent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leadcenter', function (Blueprint $table) {
            $table->dropColumn('rnd_agent_id');
        });
    }
}
