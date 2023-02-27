<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mac')->nullable();
            $table->string('vendor')->nullable();
            $table->string('lastIp')->nullable();
            $table->datetime('lastUp')->nullable();
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
        Schema::dropIfExists('hosts_addresses');
    }
}
