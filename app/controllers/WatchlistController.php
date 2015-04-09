<?php

class WatchlistController extends BaseController {

    protected $layout = 'master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $watch = Watchlist::where('uw_usr_id', Auth::user()->id)
                ->join('film', 'user_watchlist.uw_fl_id', '=', 'film.fl_id')
                ->orderBy('uw_id', 'desc')
                ->paginate(10);

        $this->layout->content = View::make('watchlist.index', compact('watch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('watchlist.create');
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
        return View::make('watchlist.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return View::make('watchlist.edit');
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

        //return 'whats';
    }

    /**
     * add to watchlist.
     *
     * @param  int  $id
     * @return Response
     */
    public function add() {

        $film_id = Input::get('film');

        $query = DB::table('user_watchlist')->insertGetId(
                array(
                    'uw_fl_id' => $film_id,
                    'uw_usr_id' => Auth::user()->id
                )
        );

        // insert a new user actions
        $act = new Activity;                        // notification instance
        $act->type_id = '3';                        // activity type
        $act->subject_id = Auth::user()->id;        // id of the user
        $act->object_type = 'film';                 // type of object 
        $act->object_id = $film_id;                 // id of the object
        $act->action_date = \time();                // time of the activity 
        $act->save();                               // saves activity     

        if (Auth::user()->fb_access_token) {
            $fb = new FacebookController();
            $execute = $fb->postFbWatchlist($film_id, Auth::user()->fb_uid, Auth::user()->fb_access_token);
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

        $query = DB::table('user_watchlist')
                ->where('uw_fl_id', '=', $film_id)
                ->where('uw_usr_id', '=', Auth::user()->id)
                ->delete();

        // deletes the watchlist action related 
        Activity::where('object_id', $film_id)
                ->where('type_id', '3')
                ->where('subject_id', Auth::user()->id)
                ->where('object_type', 'film')
                ->delete();

        if ($query) {
            return 'true';
        } else {
            return 'false';
        }
    }

}
