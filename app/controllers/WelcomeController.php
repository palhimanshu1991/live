<?php

class WelcomeController extends BaseController {


    protected $layout = 'master';


    // retunrs the number of unread notifications
    public function step1() {

            $genre      =   DB::table('film_category')->get();
            $movies     =   DB::table('user_suggestions')
                            ->join('film', 'film.fl_id', '=', 'user_suggestions.us_fl_id')
                            ->take('42')
                            ->get();


            $this->layout->content = View::make('welcome.step1', compact('genre','movies'));

    
    }


}
