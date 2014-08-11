<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MccRoleTable extends Migration {

    protected $table_name = 'mcc_role';
    
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
            $table->string('mid', 255)->default('')->nullable();
            $table->string('name', 255);
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
