<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Question extends Eloquent {
	public $fillable = array('title', 'user_id', 'question','viewed','answered','votes');


    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    public $searchable = [
        'columns' => [
            'title' => 10,
            'question' => 10,
            'id' => 2
        ]
    ];






	public static $add_rules = array(
		'title'=>'required|min:6',
		'question'=>'required|min:10'
		);
	// Create relations with User table
	public function users() {
		return $this->belongsTo('User','user_id');
	}

    /**
     * @return mixed
     */
	public function tags() {
		return $this->belongsToMany('Tag','question_tags')->withTimestamps();
	}

    public function answers() {
        return $this->hasMany('Answer','question_id');
    }

    public function getAnswersPaginatedAttribute() {
        return $this->answers()->paginate(6);
    }
}