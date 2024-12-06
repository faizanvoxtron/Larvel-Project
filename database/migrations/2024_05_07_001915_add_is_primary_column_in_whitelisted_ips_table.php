<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPrimaryColumnInWhitelistedIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('whitelisted_ips', function (Blueprint $table) {
            $table->boolean('is_primary')->default(false)->after('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('whitelisted_ips', function (Blueprint $table) {
            $table->dropColumn('is_primary');
        });
    }
}
