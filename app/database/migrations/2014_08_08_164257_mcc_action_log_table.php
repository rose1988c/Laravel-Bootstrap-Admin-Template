<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MccActionLogTable extends Migration
{

    protected $table_name = 'mcc_action_log';
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table_name, function ($table)
        {
            $table->increments('id');
            $table->string('username', 255);
            $table->string('ip', 255);
            $table->string('method', 255);
            $table->string('action', 255);
            $table->string('url', 255);
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
        Schema::drop($this->table_name);
    }

}
