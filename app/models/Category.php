<?php

class Category extends Eloquent {

	// which field can be filled
	protected $fillable = array('name');

    public function questions() {
        return $this->hasMany('Question','category_id');
    }
}