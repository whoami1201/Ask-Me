<?php

class Question extends Eloquent {
	protected $fillable = array('title', 'user_id', 'question','viewed','answered','votes');
	public static $add_rules = array(
		'title'=>'required|min:6',
		'question'=>'required|min:10'
		);
	// Create relations with User table
	public function users() {
		return $this->belongsTo('User','user_id');
	}

	public function tags() {
		return $this->belongsToMany('Tag','question_tags')->withTimestamps();
	}
}