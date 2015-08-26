<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function showWelcome()
    {
        return View::make('hello');
    }

    public function showLogin()
    {
        return View::make('login');
    }

    public function doLogin()
    {
        $email    = Input::get('email');
        $password = Input::get('password');

        if (Auth::attempt(array('email' => $email, 'password' => $password))) {
            Session::flash('successMessage', 'Welcome to the Instructors Blog');

            return Redirect::intended(action('PostsController@index'));
        } else {
            Session::flash('errorMessage', 'Sorry, that eMail or password was incorrect.');
            Log::error('User failed to authenticate!', array('email' => $email));

            return Redirect::action('HomeController@showLogin')->withInput();
        }
    }

    public function doLogout()
    {
        Auth::logout();

        Session::flash('successMessage', 'Thanks, come back soon!');

        return Redirect::to('/');
    }
}
