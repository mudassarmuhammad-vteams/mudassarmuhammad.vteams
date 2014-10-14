<?php

class Group extends ActiveRecord\Model
{
	static $has_many = array(
		array('users'),
	);
}
