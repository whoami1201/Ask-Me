<?php

class SearchController extends \BaseController {
    function searchQuestions(){
        if(Input::get("keywords")) {
            $keywords = Input::get("keywords");
            $questions = Question::search($keywords)->get()->toArray();;
            //$results = $questions->items;
            //print_r($questions);
        }



        return View::make('qa.search')
            ->with('questions',$questions)
            ->with('title', 'Search');
    }
}
