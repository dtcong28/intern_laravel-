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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->unsignedInteger('team_id')->nullable(false);
            $table->string('email', 128)->nullable(false);
            $table->string('first_name', 128)->nullable(false);
            $table->string('last_name', 128)->nullable(false);
            $table->string('password', 64)->nullable(false);
            $table->char('gender',1)->nullable(false);
            $table->date('birthday')->nullable(false);
            $table->string('address', 256)->nullable(false);
            $table->string('avatar', 128)->nullable(false);
            $table->integer('salary')->nullable(false);
            $table->char('position',1)->nullable(false);
            $table->char('status',1)->nullable(false);
            $table->char('type_of_work',1)->nullable(false);
            $table->integer('ins_id')->nullable(false);
            $table->integer('upd_id')->nullable();
            $table->dateTime('ins_datetime')->nullable(false);
            $table->dateTime('upd_datetime')->nullable();
            $table->char('del_flag',1)->nullable(false)->default(0);

            $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
