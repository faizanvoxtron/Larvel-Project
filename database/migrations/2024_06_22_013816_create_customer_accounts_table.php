<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->unsigned()->index();
            $table->unsignedBigInteger('added_by')->unsigned()->index();
            $table->string('noc');
            $table->string('account_name');
            $table->string('toll_free')->nullable();
            $table->string('exp');
            $table->string('account_number');
            $table->string('cvv1');
            $table->string('cvv2')->nullable();
            $table->string('balance')->nullable();
            $table->string('available')->nullable();
            $table->string('lp')->nullable();
            $table->string('dp')->nullable();
            $table->string('apr')->nullable();
            $table->string('poa');
            $table->string('full_name')->nullable();
            $table->string('address')->nullable();
            $table->string('ssn')->nullable();
            $table->string('mmm')->nullable();
            $table->string('dob')->nullable();
            $table->string('relation')->nullable();
            $table->boolean('charge_card')->default(false);
            $table->string('charge')->nullable();
            $table->boolean('status')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('customer_accounts');
    }
}
