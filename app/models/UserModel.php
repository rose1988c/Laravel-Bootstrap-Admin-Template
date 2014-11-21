<?php
/**
 * UserModel.php
 * 
 * @author: rose1988c
 * @email: rose1988.c@gmail.com
 * @created: 2014-7-1 下午5:51:17
 * @logs: 
 *       
 */
use \Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Auth\UserInterface;
class UserModel extends Eloquent implements RemindableInterface, UserInterface
{
    protected $table = 'mcc_user';
    protected $fillable = array ();
    protected $guarded = array ();
    protected $hidden = array('password', 'remember_token', 'deleted_at');
    protected $softDelete = true;
    
    public function getReminderEmail()
    {
        return $this->username;
    }
    
    public function getAuthIdentifier()
    {
        return $this->attributes['id'];
    }
    
    public function getAuthRoleId()
    {
        return $this->attributes['roleid'];
    }

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }
    
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }
    
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

}
