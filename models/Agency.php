<?php

class Agency extends ActiveRecord\Model
{
	static $has_many = array(
		array('users'),
	);

}
