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
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use \Illuminate\Auth\Reminders\RemindableInterface;
class UserModel extends Eloquent implements RemindableInterface, UserInterface
{
    use UserTrait, RemindableTrait;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mcc_user';
    
    protected $guarded = array ();
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    
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
