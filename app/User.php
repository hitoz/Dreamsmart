<?php namespace App;

use Jenssegers\Mongodb\Model;

class User extends \Moloquent {

	protected $collection = 'user';
	protected $connection = 'mongodb';

	public function posts() {
		return $this->hasMany('App\Post');
	}

}
