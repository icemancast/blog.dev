<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostsController extends \BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth', array('except' => array('index', 'show')));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index()
    {
        // set a value in the session
        $query = Post::with('user');

        if (Input::has('search')) {
            $search = Input::get('search');

            $query->where('title', 'like', "%$search%");

            $query->orWhereHas('user', function($q) use ($search) {
                $q->where('first_name', 'like',  "%$search%");
            });

            $query->orWhereHas('user', function($q) use ($search) {
                $q->where('last_name', 'like',  "%$search%");
            });
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(5);

        return View::make('posts.index')->with('posts', $posts);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store()
    {
        $post = new Post();

        $post->user()->associate(Auth::user());

        return $this->validateAndSave($post);
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::find($id);

        if(!$post) {
            Session::flash('errorMessage', "Post with id of $id is not found");

            App::abort(404);
        }

        Log::info("post of id $id found");

        return View::make('posts.show')->with(array('post' => $post));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $post = Post::find($id);

        if(!$post) {
            Session::flash('errorMessage', "Post with id of $id is not found");

            App::abort(404);
        }

		return View::make('posts.edit')->with(['post' => $post]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('errorMessage', "Post with id of $id is not found");

            App::abort(404);
        }

        return $this->validateAndSave($post);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('errorMessage', "Post with id of $id is not found");

            App::abort(404);
        }

        $post->delete();


        if (Request::wantsJson()) {
            return Response::json(array('result' => 'Ok'));
        } else {
            Session::flash('successMessage', "Deleted \"$post->title\"!");

            return Redirect::action('PostsController@index');
        }
    }

    public function getManage()
    {
        return View::make('posts.manage');
    }

    public function getList()
    {
        $posts = Post::with('user')->get();

        return Response::json($posts);
    }

    protected function validateAndSave(Post $post)
    {
        // create the validator
        $validator = Validator::make(Input::all(), Post::$rules);

        // attempt validation
        if ($validator->fails()) {
            Session::flash('errorMessage', 'Failed to save the post, sorry.');

            Log::info('Validator failed', Input::all());

            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            // validation succeeded, create and save the post
            $post->title = Input::get('title');
            $post->body  = Input::get('body');

            $post->save();

            Log::info('Post successfully saved.', Input::all());

            Session::flash('successMessage', 'Post "' . $post->title . '" saved!');

            return Redirect::action('PostsController@show', $post->id);
        }
    }
}
