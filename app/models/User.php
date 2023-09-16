<?php

class User {
	public $id;
	public $first_name;
	public $last_name;
	
	public function info()
	{
		return '#'.$this->id.': '.$this->first_name.' '.$this->last_name;
	}
}