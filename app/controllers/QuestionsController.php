<?php

class QuestionsController extends \BaseController {

	/**
	 * GET New question form.
	 *
	 * @return View
	 */
	public function getNew()
	{
		return View::make('qa.ask')->with('title','New question');
	}


	/**
	 * POST method to process the form
	 *
	 * @return Redirect
	 */


	public function postNew()
	{
		// validate the form
		$validation = Validator::make(Input::all(),Question::$add_rules);

		if($validation->passes()) {

			// if pass, create the question
			$create = Question::create(array(
				'user_id' => Sentry::getUser()->id,
				'title' => Input::get('title'),
				'question' => Input::get('question'),
                'category_id' => Input::get('category')
				));

			// Get the insert id of question
			$insert_id = $create->id;

			// Find the question to attach the tag
			$question = Question::find($insert_id);

			// Check if tags column is filled, split strings, add new tag and relation
			if (Str::length(Input::get('tags'))) {

				// 'explode' all tags from commmas
				$tags_array = explode(',', Input::get('tags'));

				// Check new tag to add to database and attach to new question
				if (count($tags_array)) {

					foreach ($tags_array as $tag) {

						// Get rid of blank spaces
						$tag = trim($tag);

						// Double check length for commas (tag1,,tag2)
						// Check slugged version for meaningless characters
						// (tag1,(#*@(*#,tag2)))
						if (Str::length(Str::slug($tag))) {

							// URL-friendly version of the tag
							$tag_friendly = Str::slug($tag);

							// Check if already exist in database
							$tag_check = Tag::where('tag_friendly',$tag_friendly);
							if ($tag_check->count()==0) {
								$tag_info = Tag::create(array(
									'tag'=>$tag,
									'tag_friendly'=> $tag_friendly
									));
							} else {
								$tag_info = $tag_check->first();
							}
						}

						$question->tags()->attach($tag_info->id);
					}
				}
			}

			return Redirect::route('ask')
			->with('success',
				'Your question has been created successfully. '.
				HTML::linkRoute('question_details','Check it out!', array(
					'id'=> $insert_id,
					'title'=> Str::slug($question->title)
					)));

		} else {

			return Redirect::route('ask')
			->withInput()->with('error',$validation->errors()->first());
			
		}
	}
	 /**
         * Details page
         **/

         public function getDetails($id,$title) {

          //First, let's try to find the question:
          $question = Question::with('users','tags','answers','categories')->find($id);

          if($question) {
            //We should increase the "viewed" amount
            $question->update(array(
              'viewed' => $question->viewed+1
            ));
            return View::make('qa.details')
              ->with('title',$question->title)
              ->with('question',$question)
              ->with('answers',$question->answers_paginated);

          } else {

            return Redirect::route('browse')
            ->with('error','Question not found');

          }

         }
    /**
     * Details page of a random question
     **/

    public function getRandom() {
        // Retrieve a random question from the database
        $question = Question::orderByRaw('RAND()')->first();
        if ($question) {
            // Call function getDetail in QuestionsController with necessary parameters
            return Redirect::action('QuestionsController@getDetails',
                array('id'=>$question->id,
                    'title'=>Str::slug($question->title)));
        } else {

            return Redirect::route('browse')
                ->with('error', 'Question not found');
        }


    }


    /** 
      * Vote AJAX Request 
    **/ 

    public function getVote($direction,$id) { 

      //request has to be AJAX Request 

      if(Request::ajax()) { 

        $question = Question::find($id);

        //if the question id is valid 
        if($question) { 

          //new vote count 
          if($direction == 'up') { 
            $newVote = $question->votes+1; 
          } else { 
            $newVote = $question->votes-1; 
          } 

          //now the update 
          $update = $question->update(array( 
            'votes' => $newVote 
          )); 

          //we return the new number 
          return $newVote; 

        } else { 

          //question not found 
          Response::make("FAIL", 400); 

        } 
      } else { 

        return Redirect::route('browse')
            ->with('error', 'Something went wrong, please try again later.');

      } 

     }
     /** 
     * Deletes the question 
     **/

    public function getDelete($id) { 

      //First, let's try to find the question: 

      $question = Question::find($id); 

      if($question) { 

        //We delete the question directly 

        $question->delete();
        return Redirect::route('browse')

          ->with('success','Question deleted successfully!'); 

      } else { 

        return Redirect::route('index') 

          ->with('error','Nothing to delete!'); 

      } 

    }  


	/**
	 * Show questions with specific tab
	 *
	 * @param  string $tag
	 * @return Response
	 */
	public function getTaggedWith($tag)
	{
		$tag = Tag::where('tag_friendly',$tag)->first();

        if($tag) {
            return View::make('qa.browsee')
                ->with('title','Questions tagged with: '.$tag->tag)
                ->with('questions',$tag->questions()
                    ->with('users','tags','answers')->simplePaginate(4));
        } else {
            return Redirect::route('qa.browsee')
                ->with('error','Tag not found');
        }
	}


    /**
     * Show questions with specific tab
     *
     * @param  string $category
     * @return Response
     */
    public function getCategory($category)
    {
        $category = Category::where('name',$category)->first();
        if($category) {
            return View::make('qa.browsee')
                ->with('title','Category: '.$category->name)
                ->with('questions',$category->questions()
                    ->with('users','tags','answers')->simplePaginate(4));
        } else {
            return Redirect::route('qa.browsee')
                ->with('error','Category not found');
        }
    }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
