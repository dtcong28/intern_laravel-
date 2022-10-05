<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_teams', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('name', 128)->nullable(false);
            $table->integer('ins_id')->nullable(false);
            $table->integer('upd_id')->nullable();
            $table->dateTime('ins_datetime')->nullable(false);
            $table->dateTime('upd_datetime')->nullable();
            $table->char('del_flag',1)->nullable(false)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_teams');
    }
};
