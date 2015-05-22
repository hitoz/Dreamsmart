<?php namespace App;

use Jenssegers\Mongodb\Model;

class Tag extends \Moloquent {

	protected $collection = 'tag';
	protected $connection = 'mongodb';

	public function post() {
		return $this->belongsTo('App\Post');
	}

}
