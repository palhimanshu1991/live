<?php

class FavouriteController extends BaseController {

    protected $layout = 'master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $fav = DB::table('user_fav')
                ->where('fav_usr_id', Auth::user()->id)
                ->join('film', 'user_fav.fav_fl_id', '=', 'film.fl_id')
                ->orderBy('fav_id', 'desc')
                ->paginate(10);

        $this->layout->content = View::make('favourites.index', compact('fav'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('favourites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return View::make('favourites.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return View::make('favourites.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
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
    public function getFav($id) {

        $fav = DB::table('user_fav')
                ->join('users', 'users.id', '=', 'user_fav.fav_usr_id')
                ->where('fav_usr_id', $id)
                ->orderBy('fav_updated_date', 'desc')
                ->remember(10)
                ->get();
    }

    /**
     * add to watchlist.
     *
     * @param  int  $id
     * @return Response
     */
    public function add() {

        $film_id = Input::get('film');
        $check = $this->checkFav($film_id);

        if ($check) {
            
        } else {
            $query = DB::table('user_fav')->insertGetId(
                    array(
                        'fav_fl_id' => $film_id,
                        'fav_usr_id' => Auth::user()->id
                    )
            );

            /// insert into the user actions
            $act = new Activity;                   // notification instance
            $act->type_id = '5';                   // activity type
            $act->subject_id = Auth::user()->id;        // id of the user
            $act->object_type = 'film';            // type of object 
            $act->object_id = $film_id;               // id of the object
            $act->action_date = \time();           // time of the activity 
            $act->save();                          // saves activity    

            if (Auth::user()->fb_access_token) {
                $fb = new FacebookController();
                $execute = $fb->postFbFavourite($film_id, Auth::user()->fb_uid, Auth::user()->fb_access_token);
            }
        }


        if ($query) {
            return 'true';
        } else {
            return 'false';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete() {

        $film_id = Input::get('film');

        $query = DB::table('user_fav')
                ->where('fav_fl_id', '=', $film_id)
                ->where('fav_usr_id', '=', Auth::user()->id)
                ->delete();


        Activity::where('object_id', $film_id)
                ->where('type_id', '5')
                ->where('subject_id', Auth::user()->id)
                ->where('object_type', 'film')
                ->delete();

        if ($query) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function checkFav($film) {
        return DB::table('user_fav')
					->where('fav_fl_id', $film)
                    ->where('fav_usr_id', Auth::user()->id)
                    ->first();
    }

}
