<?php
/**
 * MenuModel.php
 * 
 * @author: rose1988c
 * @email: rose1988.c@gmail.com
 * @created: 2014-7-1 下午3:02:54
 * @logs: 
 *       
 */
class MenuModel extends Eloquent
{
    protected $table = 'mcc_menu';
    protected $fillable = array();
    protected $guarded  = array();
    protected $softDelete = true;
    protected $hidden = array('created_at', 'updated_at', 'deleted_at');
}
