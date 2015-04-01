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
	 * @return Response
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
				'question' => Input::get('question')
				));

			// Get the insert id of question
			$insert_id = $create->id;

			// Find the question to attach the tag
			$question = Question::find($insert_id);

			// Check if tags column is filled, split strings, add new tag and relation
			if (Str::length(Input::get('tags'))) {
				// 'explode' all tags from commnas
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

				return Redirect::route('ask')
				->with('success',
					'Your question has been created successfully. '.
					HTML::linkRoute('question_details','Check it out!', array(
						'id'=> $insert_id,
						'title'=> Str::slug($question->title)
						)));
			}
		} else {
			return Redirect::route('ask')
			->withInput()->with('error',$validation->errors()->first());
		}

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
