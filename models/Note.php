<?php

class Note extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('dealership'),
		array('user'),
		array('agency'),
	);
}
