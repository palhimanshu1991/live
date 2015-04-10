<?php
//Just
//include_once 'views/header.php';
Route::post('upload', function (){
	if (Input::hasFile('image')) {
		$me = Input::get('me');
		$name = Input::file('image')->getClientOriginalName();
		$destinationPath = 'public/user_uploads/1000/'.$me.'/';
		
		if(Input::file('image')->move($destinationPath, $name)) {

			//Update Movie Details
			$rev = User::find($me);
			$rev->usr_image = $name;
			$rev->save();			
			
		}
		
		return $name.' post';
	} else {
			return 'post';
	}
});

Route::get('getting-started', 'HomeController@Starting');
Route::get('top', 'HomeController@top');

Route::get('suggestions', 'MoviesController@suggest');
Route::post('suggestions', 'MoviesController@suggestions');

Route::post('suggestion/add', 'MoviesController@suggestionAdd')->before('auth');
Route::post('suggestion/remove', 'MoviesController@suggestionRemove')->before('auth');

Route::get('suggestion', 'HomeController@suggestion');
Route::post('suggestion', 'HomeController@suggestionSubmit');

Route::get('addsuggestions', function (){

	$year	= '2002';
	$array	= 'Spider-Man,Talk to Her,Infernal Affairs,City of God,The Lord of the Rings: The Two Towers,Harry Potter and the Chamber of Secrets,Catch Me If You Can,Gangs of New York,Red Dragon,A Walk to Remember,The Pianist,Star Wars: Episode II - Attack of the Clones,8 Mile,Scooby-Doo,We Were Soldiers,28 Days Later...,About a Boy,The Bourne Identity,Die Another Day,Bend It Like Beckham,The Ring,Resident Evil,Equilibrium,Panic Room,The Count of Monte Cristo,Minority Report,Unfaithful,Secretary,Chicago,Ice Age,Lilo & Stitch,Insomnia,The Sweetest Thing,Irreversible,Road to Perdition,Reign of Fire,Signs,The Transporter,Treasure Planet,xXx,Van Wilder,Men in Black II,Blade II,The Hot Chick,25th Hour,Maid in Manhattan,Adaptation.,Ali G Indahouse,Ghost Ship,Sweet Home Alabama,The Time Machine,The Hours';
	$movies = explode(",", $array);
	
	
	foreach($movies as $movie) {
	
		//Find if the movie exists
		$film = DB::table('film')->where('fl_name', 'LIKE', $movie)->where('fl_year','=',$year)->orderBy('fl_rating','desc')->first();
		
		if($film){
			//Check if already added or not
			$check = DB::table('user_suggestions')->where('us_fl_id', $film->fl_id)->get();
			
			if($check){			
			
				//Update Movie Details
				$rev = Movie::find($film->fl_id);
				$rev->fl_language = 'English';
				$rev->fl_country = 'USA';
				$rev->save();
				
				echo 'Already added '. $film->fl_name.''.'<br/>';
				echo '<img width="60px" src="http://localhost/lara/public/uploads/movie/'.$film->fl_year.'/'.$film->fl_image.'"/>'.'<br/>';	
				
			} else {
				$query = DB::table('user_suggestions')->insertGetId(
						array(
							'us_fl_id' => $film->fl_id
						)
				);	

				//Update Movie Details
				$rev = Movie::find($film->fl_id);
				$rev->fl_language = 'English';
				$rev->fl_country = 'USA';
				$rev->save();
				
				//Updated
				echo 'Just added in suggestion '.$film->fl_name.''.'<br/>';
				echo '<img width="60px" src="http://localhost/lara/public/uploads/movie/'.$film->fl_year.'/'.$film->fl_image.'"/>'.'<br/>';		
			}			
			
		} else {
		
			echo '<b>Not found </b>'.$movie.''.'<br/>';
			
		  
		}
		
	}


});

Route::get('ajax/{query}', function($query) {
	
	
    /*$dback = DB::table('film')
            ->where('fl_name', 'LIKE', '%' . $query . '%')
            ->select('fl_id', 'fl_name', 'fl_year', 'fl_image')
            ->orderBy('fl_rating', 'desc')
            ->take(15)
            ->get();
	*/
	//$dback = DB::select("select * from film where match(fl_name) against('+{$query}*' IN BOOLEAN MODE) ORDER BY fl_rating desc limit 10 ");
	/*
	$dback = DB::table('film')
			->whereRaw("MATCH(fl_name) AGAINST((+?) IN BOOLEAN MODE)", array($query))
			->orderBy('fl_rating', 'desc')
            ->take(15)
			->get();
	*/
	
	$searchTerms = explode(' ', $query);
	$quer = DB::table('film');

/*    foreach($searchTerms as $term)
    {
        $quer->where('fl_tags', 'LIKE', '%'. $term .'%');
    }

    $result = $quer->orderBy('fl_rating', 'desc')
			->select('fl_id', 'fl_name', 'fl_year', 'fl_image')
            ->take(15)
			->get();
*/
	
	$count = substr_count($query, ' ');

	if ($count==0) {
       
		foreach($searchTerms as $term)
		{
			
		$result =  $quer->where('fl_tags', 'LIKE',  $term .'%')
						->orWhere('fl_tags', 'LIKE', '%'. $term)
						->orWhere('fl_name', 'LIKE', $term)
						->orderBy('fl_rating', 'desc')
						->select('fl_id', 'fl_name', 'fl_year', 'fl_image')
						->take(15)
						->get();			
		}
		
	} else {
	
		foreach($searchTerms as $term)	{
			
		$result =  $quer->where('fl_tags', 'LIKE', '%'. $term .'%')
						->orderBy('fl_rating', 'desc')
						->select('fl_id', 'fl_name', 'fl_year', 'fl_image')
						->take(15)
						->get();			
		}
		
	}
		
    $results = array();
    foreach ($result as $row) {
        $results[] = array(
            'id' => $row->fl_id,
            'name' => $row->fl_name,
            'year' => $row->fl_year,
            'image' => $row->fl_image,
            'url' => Common::cleanUrl($row->fl_name)
        );
    }
    return json_encode($results);
});

Route::get('invite', 'UsersController@invite');
Route::post('invite', 'HomeController@inviteSend');
Route::post('invite/add', 'InviteController@add');
Route::get('invite/add', 'InviteController@add');
Route::get('invite/friend', 'InviteController@friend');
Route::post('invite/friend', 'InviteController@friend');


Route::get('myscore', function (){
	echo $action = DB::table('user_actions')
				->where('subject_id', Auth::user()->id)
				->where('object_type','film')
				->where('film.fl_rating','!=','0')
				->join('film', 'film.fl_id', '=', 'user_actions.object_id')
				->avg('fl_rating');
});

Route::get('randoms', 'UsersController@randoms');
Route::get('random/{id}', 'UsersController@random');


Route::get('feed/global', 'HomeController@globalFeed');

Route::get('change', function (){

	$name = Movie::whereBetween('fl_id', array(1, 20000))->get();

	foreach ($name as $film) {
	
		//tag1 without spaces without expressions
		//tag2 with spaces without expressions
		//tag3 same as name
		$tag1 = str_replace(array(' ',"'",';',':','.','-', ',', '%', '&', '$', '"','_',')','(','@'), '', $film->fl_name);
		$tag2 = str_replace(array(';',"'",':','.','-', ',', '%', '&', '$', '"','_',')','(','@'), '', $film->fl_name);
	
		$tags = $tag1.', '.$tag2.', '.$film->fl_name;
	
		echo $film->fl_id.'<br/>';
        DB::table('film')->where('fl_id', $film->fl_id)->update(array('fl_tags' => $tags));     
	}
});



/* 
// inserts the review
   

	return Redirect::to('/');

  Route::get('ajax/{query}', function($query) {
  $dback = DB::table('film')
  ->where('fl_name', 'LIKE', '%' . $query . '%')
  ->select('fl_id', 'fl_name', 'fl_year')
  ->take(10)
  ->get();

  $results = array();
  foreach ($dback as $row) {
  $results[] = $row;
  }
  return json_encode($results);
  });
 */

// Site Controller
Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@indexPost');
Route::get('about', 'HomeController@about');
Route::get('terms', 'HomeController@terms');
Route::get('privacy', 'HomeController@privacy');
Route::get('feedback', 'HomeController@feedback');
Route::get('jobs', 'HomeController@jobs');
Route::get('press', 'HomeController@press');
Route::get('contact', 'HomeController@contact');
Route::post('contact', 'HomeController@contactMail');

Route::get('site/sitemap', 'HomeController@sitemap');
Route::get('newtest', 'HomeController@newTest');
// Country
Route::get('country', 'HomeController@country');
Route::post('country', 'HomeController@countryUpdate');


Route::post('search/{id}', 'HomeController@search');
Route::get('search/{id}', 'HomeController@search');
Route::get('search', array(function() {
return Redirect::to('/search/advance')
                ->with('flash_notice', 'You are successfully logged out.');
}));

Route::get('genre/{id}', 'MoviesController@genre');
Route::get('actors/{id}', 'MoviesController@actors');

Route::get('feed', 'UsersController@feed');

// CUSTOM USER ROUTES
Route::get('login', 'UsersController@login')->before('guest');

Route::get('signup', 'UsersController@signup')->before('guest');
Route::post('signup', 'UsersController@create')->before('guest');
Route::post('user/create', 'UsersController@create')->before('guest');

Route::get('edit', 'UsersController@edit')->before('auth');
Route::post('edit', 'UsersController@update')->before('auth');

Route::get('{id}/followers', 'UsersController@Userfollowers');
Route::get('{id}/following', 'UsersController@Userfollowing');

Route::resource('users', 'UsersController');


// LOGOUT
Route::get('logout', array('as' => 'logout', function () {
Auth::logout();
return Redirect::to('/')
                ->with('flash_notice', 'You are successfully logged out.');
}))->before('auth');


// follow and unfollow button
Route::post('users/follow', 'UsersController@follow');
Route::post('users/unfollow', 'UsersController@unfollow');
Route::post('users/followAll', 'UsersController@followAll');

// facebook routes
Route::post('/facebook/addUser', 'FacebookController@addUser');
Route::post('/facebook/check', 'FacebookController@check');
Route::post('/facebook/add', 'FacebookController@add');
Route::post('/facebook/update', 'FacebookController@update');
Route::post('/facebook/checkFb', 'FacebookController@checkFb');
Route::post('/facebook/checkUsername', 'FacebookController@checkUsername');
Route::post('/facebook/checkEmail', 'FacebookController@checkEmail');


Route::get('/facebook/friends', 'FacebookController@friends')->before('auth');
Route::resource('facebook', 'FacebookController');


// Review
Route::post('/review/add', 'ReviewsController@add')->before('auth');
Route::post('/review/modAdd', 'ReviewsController@modAdd')->before('auth');
Route::post('/review/like', 'ReviewsController@like')->before('auth');
Route::post('/review/unlike', 'ReviewsController@unlike')->before('auth');
Route::post('/review/rate', 'ReviewsController@rate')->before('auth');
Route::post('/reviews/{id}/edit', 'ReviewsController@saveEdit')->before('auth');
Route::post('/review/delete', 'ReviewsController@delete')->before('auth');
Route::get('/reviews/{id}/people', 'ReviewsController@peopleWho');
Route::post('/reviews/more', 'ReviewsController@loadMore');
Route::resource('reviews', 'ReviewsController');

//Reply 
Route::post('comment/add', 'CommentsController@add')->before('auth');

// Watchlist Button
Route::post('/watchlist/delete', 'WatchlistController@delete')->before('auth');
Route::post('/watchlist/add', 'WatchlistController@add')->before('auth');

// Favourite Button
Route::post('/favourite/delete', 'FavouriteController@delete')->before('auth');
Route::post('/favourite/add', 'FavouriteController@add')->before('auth');

Route::get('/favourites', 'FavouriteController@index')->before('auth');
Route::get('/watchlist', 'WatchlistController@index')->before('auth');
Route::resource('watchlist', 'WatchlistController');


// notifications viewable to only logged in users
Route::get('/notifications', 'NotificationController@index')->before('auth');
Route::post('/notifications/read', 'NotificationController@read')->before('auth');
Route::post('/notifications/readall', 'NotificationController@readAll')->before('auth');

//include_once 'views/footer.php';
Route::get('movie/{id}/edit', 'MoviesController@edit')->where('id', '[0-9]+')->before('auth');
Route::post('movie/{id}/edit', 'MoviesController@update')->where('id', '[0-9]+');
Route::get('movie-{id}', 'MoviesController@show')->where('id', '[0-9]+');
Route::get('{id}-{name}', 'MoviesController@show')->where('id', '[0-9]+');
Route::get('movie/{id}/{name}', 'MoviesController@show')->where('id', '[0-9]+');
Route::get('movie/{id}/{name}/reviews', 'MoviesController@allReviews')->where('id', '[0-9]+');


Route::resource('movie', 'MoviesController');

Route::resource('favourites', 'FavouriteController');


Route::get('email', function () {

    $name = 'Himanshu';
    $subjectName = 'Himanshu';
	$filmName = 'The Lord of The Rings';
	$filmUrl = 'http://www.berdict.com/movie/101585/Mandela-Long-Walk-to-Freedom';
	$filmId = 'The Lord of The Rings';
	$filmReview = 'Just a heads-up — Ankit Agrawal agreed with your review for "The Lord of The Rings" on Berdict. Just a heads-up — Ankit Agrawal agreed with your review for "The Lord of The Rings" on Berdict.';
	$reviewId = 'The Lord of The Rings';
    $objectName = 'Ankit Agrawal';
    $objectUsername = 'ankit';
    $objectId = '1';
    $filmImage = 'http://www.berdict.com/public/uploads/movie/2013/1387926503_bullet_raja_ver3_xlg.jpg';
    $followerCount = '145';
    $reviewCount = '56';

    return View::make('emails.invite', compact('filmUrl','filmReview','filmImage','filmName','name','subjectName','objectId','objectImage','objectName','objectUsername','followerCount','reviewCount'))->render();
});
//for creating a new user
/// doing the login
Route::post('login', function () {

    $email = Input::get('username');
    $pass = Input::get('password');

    if (preg_match("/@/i", $email)) {


        $input = array(
            'usr_email' => Input::get('username'),
            'password' => Input::get('password')
        );

        $user = DB::table('users')
                ->where('usr_email', $email)
                ->first();

        if (isset($user)) {

            // If their password is still MD5
            if ($user->password == md5($_POST['password'])) {

                // Convert to new format
                $new = $user->password = Hash::make($_POST['password']);

                // update the new hashed pasword in DB
                $changed = DB::table('users')
                        ->where('usr_email', $email)
                        ->update(array('password' => $new));

                // then attempt to login
                if (Auth::attempt($input, true)) {
                    // user login
						DB::table('users')
								->where('id', Auth::user()->id)
								->update(array(
									'last_login' => date('d M Y H:i:s', time())
						));					
					
                    return Redirect::to('/')
                                    ->with('flash_notice', 'You are successfully logged in.');
                }
            } else {

                if (Auth::attempt($input, true)) {
						DB::table('users')
								->where('id', Auth::user()->id)
								->update(array(
									'last_login' => date('d M Y H:i:s', time())
						));		

						return Redirect::to('/')
                                    ->with('flash_notice', 'You are successfully logged in.');
                }
            }
        }
    } else {
        $remember = Input::get('remember');
        $input = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        $user = DB::table('users')
                ->where('username', Input::get('username'))
                ->first();

        if (isset($user)) {

            // If their password is still MD5
            if ($user->password == md5($_POST['password'])) {

                // Convert to new format
                $new = $user->password = Hash::make($_POST['password']);

                // update the new hashed pasword in DB
                DB::table('users')
                        ->where('username', $_POST['username'])
                        ->update(array('password' => $new));

                // then attempt to login
                if (!empty($remember)) {
                    if (Auth::attempt($input, true)) {
						DB::table('users')
								->where('id', Auth::user()->id)
								->update(array(
									'last_login' => date('d M Y H:i:s', time())
						));		

					return Redirect::to('/')
                                        ->with('flash_notice', 'You are successfully logged in.');
                    }
                } else {
                    if (Auth::attempt($input)) {
						DB::table('users')
								->where('id', Auth::user()->id)
								->update(array(
									'last_login' => date('d M Y H:i:s', time())
						));		
											
						return Redirect::to('/')
                                        ->with('flash_notice', 'You are successfully logged in.');
                    }
                }
            } else {

                if (!empty($remember)) {
                    if (Auth::attempt($input, true)) {
						DB::table('users')
								->where('id', Auth::user()->id)
								->update(array(
									'last_login' => date('d M Y H:i:s', time())
						));							
                        return Redirect::to('/')
                                        ->with('flash_notice', 'You are successfully logged in.');
                    }
                } else {
                    if (Auth::attempt($input)) {
						DB::table('users')
								->where('id', Auth::user()->id)
								->update(array(
									'last_login' => date('d M Y H:i:s', time())
						));							
					
                        return Redirect::to('/')
                                        ->with('flash_notice', 'You are successfully logged in.');
                    }
                }
            }
        }
    }

    // if (Auth::attempt($user)) {
    //     return Redirect::to('/')
    //                    ->with('flash_notice', 'You are successfully logged in.');
    // }

    return Redirect::to('login')
                    ->with('flash_error', 'Username/Password Incorrect.')
                    ->withInput();
});













// for user friends urls based on username
Route::get('/{id}', 'UsersController@show');




/*
 * 
 * 
 * Route::get('login', array('as' => 'login', function () {
if (Auth::check()) {
    return Redirect::to('/')
                    ->with('flash_notice', 'You are successfully logged in.');
}
return View::make('users.login');
}))->before('guest');
 * 
 * 
 * 
 */
