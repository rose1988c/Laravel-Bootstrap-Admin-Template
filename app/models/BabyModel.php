<?php
/**
 * BabyModel.php
 * 
 * @author: Cyw
 * @email: chenyunwen01@bianfeng.com
 * @created: 2014-9-1 下午4:16:39
 * @logs: 
 *       
 */
class BabyModel extends Eloquent
{
    protected $table = 'baby_info';
    protected $fillable = array();
    protected $guarded  = array();
    protected $softDelete = true;
    protected $hidden = array('created_at', 'updated_at', 'deleted_at');
}
