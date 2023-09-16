<?php


class User {
	use Model;

	protected $table = 'users';

	protected $allowedCloumns = [
		'first_name',
		'user_email',
	];

}