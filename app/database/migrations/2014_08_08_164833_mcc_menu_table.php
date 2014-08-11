<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MccMenuTable extends Migration
{
    
    protected $table_name = 'mcc_menu';

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
            $table->integer('pid')->unsigned();
            $table->string('name', 255);
            $table->string('url', 255);
            $table->string('icons', 255)->nullable();
            $table->smallInteger('sorts')->default(0);
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
        Schema::drop($this->table_name);
    }

}
