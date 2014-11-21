<?php 
/**
 * PhotoModel.php
 * 
 * @author: Cyw
 * @email: chenyunwen01@bianfeng.com
 * @created: 2014-9-1 下午6:03:20
 * @logs: 
 *       
 */
class PhotoModel extends Eloquent
{
    protected $table = 'baby_photo';
    protected $fillable = array();
    protected $guarded  = array();
    protected $softDelete = true;
    protected $hidden = array('created_at', 'updated_at', 'deleted_at', 'father', 'mother', 'sex', 'birthday');
    
    public function baby()
    {
        return $this->baby = $this->belongsTo('BabyModel', 'bid');
        //return $this->belongsTo('BabyModel', 'bid');
    }
}
