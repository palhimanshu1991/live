<?php

class WelcomeController extends BaseController {


    protected $layout = 'master';


    // retunrs the number of unread notifications
    public function step1() {

            $genre  =   DB::table('film_category')->get();

            $this->layout->content = View::make('welcome.step1', compact('genre'));

    
    }


}
