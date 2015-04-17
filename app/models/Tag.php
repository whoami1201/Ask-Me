<?php

class Tag extends Eloquent {
	protected $fillable = array('tag', 'tag_friendly');

	public function questions() {
		return $this->belongsToMany('Question','question_tags')
		->withTimestamps();
	}
}