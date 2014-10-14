<?php

class Checklist extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('dealership'),
	);
}
