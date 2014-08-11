<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MccActionLogTableSeeder extends Seeder
{

    protected $table_name = 'mcc_action_log';
    
    public function run()
    {
        
        DB::table($this->table_name)->truncate();
        
        DB::table($this->table_name)->insert(array(
            'username' => 'Blog Post',
            'ip' => Str::slug('Blog Post'),
            'method' => 'GET',
            'action' => 'ccc',
            'url' => strip_tags('Blog Post'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime() 
        ));
    }

}