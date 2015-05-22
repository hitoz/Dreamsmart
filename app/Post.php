<?php namespace App;

use Jenssegers\Mongodb\Model;

class Post extends \Moloquent {

	protected $collection = 'post';
	protected $connection = 'mongodb';

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function tags() {
		return $this->hasMany('App\Tag');
	}

}