<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MccUserTable extends Migration {


    protected $table_name = 'mcc_user';
    
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
            $table->string('username', 255)->default('');
            $table->string('password', 255)->default('');
            $table->string('email', 255)->default('');
            $table->string('truename', 255)->default('');
            $table->string('nickname', 255)->default('');
            $table->tinyInteger('roleid')->default(3);
            $table->string('ip', 50)->default('');
            $table->string('remember_token', 100)->default('');
            $table->dateTime('login_at')->default('0000-00-00 00:00:00');
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
