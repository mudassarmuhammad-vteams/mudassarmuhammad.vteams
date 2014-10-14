<?php

class Dealership extends ActiveRecord\Model
{
	static $has_many = array(
		array('locations'),
		array('fileuploads'),
		array('dealershipsquestionnaire'),
	);
	
	static $belongs_to = array(
		array('user'),
	);
}