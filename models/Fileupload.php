<?php

class Fileupload extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('dealership'),
	);

}
