<?php

class User extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('agency'),
		array('group'),
	);
	
	static $has_many = array(
		array('dealerships'),
	);
	
	static $validates_uniqueness_of = array(
		array('email'),
	);
	
	function set_first_name($first_name)
    {
		$this->assign_attribute('first_name', ucfirst(strtolower($first_name)));
    }
	
	function set_last_name($last_name)
    {
		$this->assign_attribute('last_name', ucfirst(strtolower($last_name)));
    }

}