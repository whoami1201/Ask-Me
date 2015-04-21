<?php

class Answer extends Eloquent {

	// Relation with users
	public function users() {
		return $this->belongsTo('User','user_id');
	}

	// relation with questions
	public function questions() {
		return $this->belongsTo('Question','question_id');
	}

	// which field can be filled
	protected $fillable = array('question_id','user_id', 'answer', 'correct', 'votes');

	// Answer Form Validation rules
	public static $add_rules = array(
		'answer' => 'required|min:10'
		);
}