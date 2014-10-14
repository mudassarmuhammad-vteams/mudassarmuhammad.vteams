<?php

class Location extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('dealership'),
	);
}
