<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MccRoleTableSeeder extends Seeder
{
    
    protected $table_name = 'mcc_role';

    public function run()
    {
        
        DB::table($this->table_name)->truncate();
        
        DB::table($this->table_name)->insert(array (
            array (
                'id' => 1,
                'mid' => 'all',
                'name' => '超级管理员',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array (
                'id' => 2,
                'mid' => '',
                'name' => '管理员',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array (
                'id' => 3,
                'mid' => '',
                'name' => '普通用户',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ) 
        ));
    
    }

}