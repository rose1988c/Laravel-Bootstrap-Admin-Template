<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BabyTable extends Migration
{
    
    protected $table_name = 'baby_info';

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
            $table->integer('userid')->unsigned();
            $table->string('nickname', 100)->default('');
            $table->string('name', 100)->default('');
            $table->string('sex', 2)->default('m');
            $table->dateTime('birthday')->default('0000-00-00 00:00:00');
            $table->string('father', 50)->default('');
            $table->string('mother', 50)->default('');
            $table->string('birth_address', 255)->default('');
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
    