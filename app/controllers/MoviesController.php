<?php

class MoviesController extends BaseController {

    protected $layout = 'master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('movies.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function discover() {

        $genre      =   DB::table('film_category')->get();


        $this->layout->content = View::make('movies.discover',compact('genre'));
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        if (Auth::user()->usr_level == 2) {
            $this->layout->content = View::make('movies.create');
        } else {
            return Redirect::to(Config::get('url.home'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $time = time();
        $name = Input::get('name');
        $year = Input::get('year');
        $director = Input::get('director');
        $writer = Input::get('writer');
        $stars = Input::get('stars');
        $outline = Input::get('outline');
        $story = Input::get('story');
        $genre = Input::get('genre');
        $release = Input::get('release');
        $rating = Input::get('rating');
        $duration = Input::get('duration');
        $country = Input::get('country');
		
		$chars = preg_replace('/[^a-zA-Z0-9\s]/', '', $name); 	// Removes special chars.		
	    $space = str_replace(' ', '', $chars); 					// Replaces all spaces
		
		$tags = $name.', '.$chars.', '.$space;
		

		$image_name = '';
		
		if (Input::hasFile('image')) {
		
			
			$original = Input::file('image')->getClientOriginalName();
			$image_name = $time. "_" .$original;
			
			$destinationPath = 'public/uploads/movie/'.$year.'/';
			
			if(Input::file('image')->move($destinationPath, $image_name)) {		
			
			}
			
		} 		

        $rev = new Movie;

        $rev->fl_name = $name;
        $rev->fl_year = $year;
        $rev->fl_dir_ar_id = $director;
        $rev->fl_writer = $writer;
        $rev->fl_stars = $stars;
        $rev->fl_outline = $outline;
        $rev->fl_story = $story;
        $rev->fl_genre = $genre;
        $rev->fl_releasedate = $release;
        $rev->fl_rating = $rating;
		$rev->fl_tags = $tags;
        $rev->fl_duration = $duration;
        $rev->fl_country = $country;
        $rev->fl_status = '1';
        $rev->fl_image = $image_name;

        $rev->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {

        $movie = DB::table('film')
                ->where('fl_id', $id)
				->remember(10)
                ->first();

        $movieRating = $this->betterRating($id, $movie->fl_rating);


        if (Auth::check()) {

            $ser = new UsersController();
            $following = $ser->getFollowing(Auth::user()->id);

            $myReview = $this->myReview($id);

            if ($following) {

                $column = array();
                foreach ($following as $following) {
                    $column[] = $following->id;
                }
			
				$reviewCount = DB::table('film_review')
							->join('users', 'users.id', '=', 'film_review.fr_usr_id')
							->where('fr_fl_id', $id)
							->whereNotIn('fr_usr_id', $column)
							->WhereNotIn('fr_usr_id', array(Auth::user()->id))
							->count();			

                $frreviews = DB::table('film_review')
                        ->join('users', 'users.id', '=', 'film_review.fr_usr_id')
                        ->where('fr_fl_id', $id)
                        ->wherein('fr_usr_id', $column)
                        ->take(10)
                        ->get();

                $reviews = DB::table('film_review')
                        ->join('users', 'users.id', '=', 'film_review.fr_usr_id')
                        ->where('fr_fl_id', $id)
                        ->whereNotIn('fr_usr_id', $column)
                        ->WhereNotIn('fr_usr_id', array(Auth::user()->id))
                        ->take(5)
                        ->orderBy('fr_date')
                        ->get();
            } else {
                $frreviews = array();
                $reviews = DB::table('film_review')
                        ->join('users', 'users.id', '=', 'film_review.fr_usr_id')
                        ->where('fr_fl_id', $id)
                        ->take(10)
                        ->orderBy('fr_date')
                        ->get();
						
			$reviewCount = DB::table('film_review')
						->join('users', 'users.id', '=', 'film_review.fr_usr_id')
						->where('fr_fl_id', $id)
						->count();	
						
            }
        } else {
		
			$reviewCount = DB::table('film_review')
						->join('users', 'users.id', '=', 'film_review.fr_usr_id')
						->where('fr_fl_id', $id)
						->count();				
            $myReview = "";
            $frreviews = array();
            $reviews = DB::table('film_review')
                    ->join('users', 'users.id', '=', 'film_review.fr_usr_id')
                    ->where('fr_fl_id', $id)
                    ->take(10)
                    ->orderBy('fr_date')
                    ->get();
        }
		foreach($reviews as $view) {
			$views = ++$view->fr_views;
				DB::table('film_review')
					->where('fr_id',$view->fr_id)
					->update(array('fr_views' => $views));
		}
		foreach($frreviews as $view) {
			$views = ++$view->fr_views;
				DB::table('film_review')
					->where('fr_id',$view->fr_id)
					->update(array('fr_views' => $views));
		}		
		

        if (Auth::check()) {
            $critics = $this->getCritics(Auth::user()->id);
        } else {
            $critics;
        }
        if (Auth::check()) {
            $commonFav = $this->getCommonFav($id);
        } else {
            $commonFav;
        }

        $rate = '0';
        if (Auth::check()) {
            $user = Auth::user()->id;
            $watch = DB::table('user_watchlist')
                    ->where('uw_fl_id', $id)
                    ->where('uw_usr_id', Auth::user()->id)
                    ->first();
            $rating = DB::table('rating')
                    ->where('rt_fl_id', $id)
                    ->where('rt_usr_id', Auth::user()->id)
                    ->first();
            if ($rating) {
                $rate = $rating->rt_vote;
            }
            if ($watch) {
                $watch = '1';
            } else {
                $watch = '0';
            }

            $watchModel = new WatchedController();
            $watched = $watchModel->watchCheck($id,Auth::user()->id);            

            if ($watched) {
                $watched = '1';
            } else {
                $watched = '0';
            }


            $fav = DB::table('user_fav')
                    ->where('fav_fl_id', $id)
                    ->where('fav_usr_id', Auth::user()->id)
                    ->first();
            if ($fav) {
                $fav = '1';
            } else {
                $fav = '0';
            }
        } else {
            $watch = '3';
            $fav = '3';
            $user = '';
        }

        // Invoking that non-static method.
        $home = new HomeController();
        $recent = $home->RecentMovies(7);

        if ($movie->fl_stars) {

            $count = substr_count($movie->fl_stars, ",");
            $first = "";
            $second = "";
            $third = "";

            if ($count == 0) {
                $comma = explode(", ", $movie->fl_stars);
                $first = '%' . $comma[0] . '%';
                $second = "";
                $third = "";
            } else if ($count == 1) {
                $comma = explode(", ", $movie->fl_stars);
                $first = '%' . $comma[0] . '%';
                $second = '%' . $comma[1] . '%';
                $third = "";
            } else if ($count == 2) {
                $comma = explode(", ", $movie->fl_stars);
                $first = '%' . $comma[0] . '%';
                $second = '%' . $comma[1] . '%';
                $third = '%' . $comma[2] . '%';
            }
            $sugg = DB::table('film')
                    ->orWhere('fl_stars', 'LIKE', $first)
                    ->orWhere('fl_stars', 'LIKE', $second)
                    ->orWhere('fl_stars', 'LIKE', $third)
                    ->where('fl_rating', '>', 6)
                    ->take(6)
                    ->orderBy(DB::raw('RAND()'))
                    ->remember(10)
                    ->get();
        } else {
            $sugg = array();
        }

        $this->layout->content = View::make('movies.show', compact('myReview', 'frreviews', 'watchCount', 'favCount', 'commonFav', 'critics', 'movie', 'movieRating', 'sugg', 'reviews', 'reviewCount', 'recent', 'watch', 'fav', 'user', 'rate','watched'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        if (Auth::user()->usr_level == 2) {

            $movie = DB::table('film')
                    ->where('fl_id', $id)
                    ->first();

            $this->layout->content = View::make('movies.edit', compact('movie'));
        } else {
            return Redirect::to(Config::get('url.home'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {



        $time = time();
        $name = Input::get('fl_name');
        $year = Input::get('fl_year');
        $director = Input::get('fl_dir_ar_id');
        $writer = Input::get('fl_writer');
        $stars = Input::get('fl_stars');
        $outline = Input::get('fl_outline');
        $story = Input::get('fl_story');
        $genre = Input::get('fl_genre');
        $actualrelease = Input::get('fl_releasedate');
        $berdictrelease = Input::get('fl_release_date');
		$language = Input::get('fl_language');
        $rating = Input::get('fl_rating');
        $duration = Input::get('fl_duration');
        $country = Input::get('fl_country');
		
		
		$chars = preg_replace('/[^a-zA-Z0-9\s]/', '', $name); 	// Removes special chars.		
	    $space = str_replace(' ', '', $chars); 					// Replaces all spaces		
		$tags = $name.', '.$chars.', '.$space;

        $movie = Movie::find($id);
        $image_name = $movie->fl_image;

		if (Input::hasFile('image')) {
		
			
			$original = Input::file('image')->getClientOriginalName();
			$image_name = $time. "_" .$original;
			
			$destinationPath = 'public/uploads/movie/'.$year.'/';
			
			if(Input::file('image')->move($destinationPath, $image_name)) {		
			
			}
			
		} 	
		

        $rev = Movie::find($id);

        $rev->fl_name = $name;
        $rev->fl_year = $year;
        $rev->fl_dir_ar_id = $director;
        $rev->fl_writer = $writer;
        $rev->fl_stars = $stars;
        $rev->fl_outline = $outline;
        $rev->fl_story = $story;
        $rev->fl_genre = $genre;
        $rev->fl_releasedate = $actualrelease;
		$rev->fl_release_date = $berdictrelease;
		$rev->fl_language = $language;
		$rev->fl_tags = $tags;
        $rev->fl_rating = $rating;
        $rev->fl_duration = $duration;
        $rev->fl_country = $country;
        $rev->fl_status = '1';
        $rev->fl_image = $image_name;

        $rev->save();


        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function ReviewCount($id) {

        return Review::where('fr_fl_id', $id)->count();
    }

    public function FavCount($id) {

        return Favourite::where('fav_fl_id', $id)->count();
    }

    public function WatchCount($id) {

        return Watchlist::where('uw_fl_id', $id)->count();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  film id  $id
     * @param  fl_rating $old
     * @return Response
     */
    public function betterRating($id, $old) {

        $numVote = Rating::where('rt_fl_id', $id)->count();
        $sumVote = Rating::where('rt_fl_id', $id)->sum('rt_vote');
        $old = round($old, 1);

        if ($numVote == 0) {

            if ($old == 0) {
                return '-';
            } else {
                return $old;
            }
        } else if ($numVote > 0 && $numVote < 5) {

            if ($old == 0) {
                return '-';
            } else {
                return $old;
            }
        } else if ($numVote > 4) {
            return round($sumVote / $numVote, 1);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function actors($actor) {

        $query = '%' . $actor . '%';
        $movies = Movie::where('fl_stars', 'LIKE', $query)->orderBy('fl_rating', 'desc')->paginate(20);
        $this->layout->content = View::make('movies.actors', compact('movies', 'actor'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function genre($genre) {

        $query = '%' . $genre . '%';
        $movies = Movie::where('fl_genre', 'LIKE', $query)->orderBy('fl_rating', 'desc')->paginate(20);
        $this->layout->content = View::make('movies.genre', compact('movies', 'genre'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function allReviews($id) {

        // 
        $movie = DB::table('film')
                ->where('fl_id', $id)
                ->first();

        $movieRating = $this->betterRating($id, $movie->fl_rating);

        $reviews = DB::table('film_review')
                ->where('fl_id', $id)
                ->join('film', 'film.fl_id', '=', 'film_review.fr_fl_id')
                ->join('users', 'users.id', '=', 'film_review.fr_usr_id')
                ->join('rating', 'rating.rt_fl_id', '=', 'film_review.fr_fl_id')
                ->whereRaw('rating.rt_usr_id = film_review.fr_usr_id')
                ->orderBy('fr_date', 'desc')
                ->paginate(20);

        $reviewCount = $this->ReviewCount($id);


        $this->layout->content = View::make('movies.reviews', compact('reviews', 'movie', 'reviewCount'));
    }

    public function getCritics($id) {
	
		return DB::table('film_review')
					->leftjoin('users', 'users.id', '=', 'film_review.fr_usr_id')
					->select('id','usr_fname','usr_lname','usr_image','username')					
					->orderBy('fr_id','desc')
					->distinct()
					->take('8')
					->get();				
				
    }

    public function getCommonFav($film) {

        return DB::table('user_fav')
                        ->where('fav_fl_id', $film)
                        ->whereNotIn('fav_usr_id', array(Auth::user()->id))
                        ->join('users', 'users.id', '=', 'user_fav.fav_usr_id')
                        ->join('user_friends', 'user_friends.friend_user_id', '=', 'user_fav.fav_usr_id')
                        ->where('user_friends.follower_user_id', Auth::user()->id)
                        ->orderBy(DB::raw('RAND()'))
                        ->get();
    }

    public function myReview($film) {
        return DB::table('film_review')
                        ->where('fr_usr_id', Auth::user()->id)
                        ->where('fr_fl_id', $film)
                        ->join('users', 'users.id', '=', 'film_review.fr_usr_id')
                        ->first();
    }
    
	public function suggestionAdd() {

		$film = Input::get('film');
		
		$check = DB::table('user_suggestions')->where('us_fl_id', $film)->get();

		if($check){
		
		//Do nothing
		
		} else {
			$query = DB::table('user_suggestions')->insertGetId(
					array(
						'us_fl_id' => $film
					)
			);	

        $rev = Movie::find($film);
		$rev->fl_language = 'English';
        $rev->fl_country = 'USA';
        $rev->save();
			
		}		
        if ($query) {
            return 'true';
        } else {
            return 'false';
        }		
    }
    
	public function suggestionRemove() {

	    $film = Input::get('film');

        $query = DB::table('user_suggestions')
                ->where('us_fl_id', '=', $film)
                ->delete();

        if ($query) {
            return 'true';
        } else {
            return 'false';
        }
        
    }	
	
}
