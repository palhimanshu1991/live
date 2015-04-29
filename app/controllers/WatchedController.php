<?php

class WatchedController extends BaseController {



    /**
     * Display a listing of the resource.
     *
     */
    public function index() {
	
		$me 	= Input::get('me');	
		$user 	= Input::get('user');	
		
        $watchlist = Watched::where('watched_usr_id', $user)
                ->join('film', 'user_watched.watched_fl_id', '=', 'film.fl_id')
                ->orderBy('watched_updated_date', 'desc')
				->take(20)
                ->get();

        return Response::json($watchlist);
    }
	
    /**
     * Display a listing of the resource.
     *
     */
    public function more() {
	
		$me 	= Input::get('me');	
		$user 	= Input::get('user');	
		$skip	= Input::get('lastIndex');		
		
        $watchlist = Watched::where('watched_usr_id', $user)
                ->join('film', 'user_watched.watched_fl_id', '=', 'film.fl_id')
                ->orderBy('watched_updated_date', 'desc')
				->skip($skip)	
				->take('20')				
                ->get();

        return Response::json($watchlist);
    }	
	
    /**
     * Watched movie count
     *
     */
    public function moviesCount($user) {
	
        return Watched::where('user_watched', $user)->count();

    }	
	
    /**
     * add to watched movies
     *
     */
    public function add() {
		
        $film = Input::get('movie');
		$me = Auth::user()->id;
		
		$check	 = $this->watchCheck($film,$me);
		
		if($check) {
		
		} else {
		
			$query = DB::table('user_watched')->insertGetId(
					array(
						'watched_fl_id' => $film,
						'watched_usr_id' => $me,
						'watched_updated_date' => time()
					)
			);
			
			/*
			// insert a new user actions
			$act = new Activity;                        // notification instance
			$act->type_id = '7';                        // activity type
			$act->subject_id = $me;        				// id of the user
			$act->object_type = 'film';                 // type of object 
			$act->object_id = $film;                 	// id of the object
			$act->action_date = \time();                // time of the activity 
			$act->save();                               // saves activity     
			*/

			/*if (Auth::user()->fb_access_token) {
				$fb = new FacebookController();
				$execute = $fb->postFbWatchlist($film, Auth::user()->fb_uid, Auth::user()->fb_access_token);
			}*/
			
			if ($query) {
				return 'true';
			} else {
				return 'false';
			}			
		}
		 return 'false';
    }

    /**
     * add to watched movies
     *
     */
    public function watched($me,$film) {
		
		$check	 = $this->watchCheck($film,$me);
		
		if($check) {
		
		} else {
		
			$query = DB::table('user_watched')->insertGetId(
					array(
						'watched_fl_id' => $film,
						'watched_usr_id' => $me,
						'watched_updated_date' => time()
					)
			);

			/*
			// insert a new user actions
			$act = new Activity;                        // notification instance
			$act->type_id = '7';                        // activity type
			$act->subject_id = $me;        				// id of the user
			$act->object_type = 'film';                 // type of object 
			$act->object_id = $film;                 	// id of the object
			$act->action_date = \time();                // time of the activity 
			$act->save();                               // saves activity     

			/*if (Auth::user()->fb_access_token) {
				$fb = new FacebookController();
				$execute = $fb->postFbWatchlist($film, Auth::user()->fb_uid, Auth::user()->fb_access_token);
			}*/
			
			if ($query) {
				return 'true';
			} else {
				return 'false';
			}			
		}
		 return 'false';
    }	
	
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function remove() {

        $film = Input::get('movie');
		$me = Auth::user()->id;

        $query = DB::table('user_watched')
                ->where('watched_fl_id', '=', $film)
                ->where('watched_usr_id', '=', $me)
                ->delete();

        // deletes the watchlist action related 
        /*Activity::where('object_id', $film)
                ->where('type_id', '3')
                ->where('subject_id', $me)
                ->where('object_type', 'film')
                ->delete();*/

        if ($query) {
            return 'true';
        } else {
            return 'false';
        }
    }
	
    /**
     * Watchlist check.
     *
     * @param  int  $id
     * @return Response
     */
    public function watchCheck($film,$me) {

		return DB::table('user_watched')
                ->where('watched_fl_id', '=', $film)
                ->where('watched_usr_id', '=', $me)
                ->first();
    }	

}
