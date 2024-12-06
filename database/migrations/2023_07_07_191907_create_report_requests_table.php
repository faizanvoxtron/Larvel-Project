<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->unsigned()->index();
            $table->unsignedBigInteger('manager_id')->unsigned()->nullable()->index();
            $table->unsignedBigInteger('agent_id')->unsigned()->index();
            $table->unsignedBigInteger('report_id')->unsigned()->nullable()->index();
            $table->string('type');
            $table->string('priority')->enum(['default', 'high'])->default('default');
            $table->string('progress')->enum(['pending', 'fulfilled'])->default('pending');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('report_requests');
    }
}
