<?php

class RoleModel extends \Eloquent {
	protected $table = 'mcc_role';
	protected $fillable = array();
	protected $guarded  = array();
	protected $softDelete = true;
}