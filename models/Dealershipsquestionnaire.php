<?php

class Dealershipsquestionnaire extends ActiveRecord\Model
{
	static $table_name = "dealershipsquestionnaire";
	static $belongs_to = array(
		array('dealership'),
	);
}
