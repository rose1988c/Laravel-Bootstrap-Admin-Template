<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MccMenuTableSeeder extends Seeder {

    protected $table_name = 'mcc_menu';
    
    public function run()
    {
        
        DB::table($this->table_name)->truncate();
        
        DB::table($this->table_name)->insert(array(
            array(
                'id' => 1,
                'pid' => 0,
                'name' => '首页',
                'url' => 'manage',
                'icons' => 'fa fa-home',
                'sorts' => 100,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array(
                'id' => 2,
                'pid' => 0,
                'name' => '用户管理',
                'url' => 'manage/user',
                'icons' => 'fa fa-users',
                'sorts' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array(
                'id' => 3,
                'pid' => 7,
                'name' => '菜单管理',
                'url' => 'manage/menus',
                'icons' => 'fa fa-list',
                'sorts' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array(
                'id' => 4,
                'pid' => 2,
                'name' => '用户列表',
                'url' => 'manage/user',
                'icons' => 'fa fa-user',
                'sorts' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array(
                'id' => 7,
                'pid' => 0,
                'name' => '系统管理',
                'url' => 'manage/system',
                'icons' => 'glyphicon glyphicon-cog',
                'sorts' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array(
                'id' => 8,
                'pid' => 7,
                'name' => '角色管理',
                'url' => 'manage/roles',
                'icons' => 'fa fa-cubes',
                'sorts' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array(
                'id' => 9,
                'pid' => 0,
                'name' => '宝宝信息',
                'url' => '',
                'icons' => 'glyphicon glyphicon-heart',
                'sorts' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array(
                'id' => 10,
                'pid' => 9,
                'name' => '宝宝列表',
                'url' => 'manage/baby',
                'icons' => '',
                'sorts' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
            array(
                'id' => 11,
                'pid' => 9,
                'name' => '宝宝照片',
                'url' => 'manage/photo',
                'icons' => '',
                'sorts' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime() 
            ),
        ));
    }

}