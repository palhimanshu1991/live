<?php

class WelcomeController extends BaseController {


    protected $layout = 'master';


    // retunrs the number of unread notifications
    public function step1() {

            // gets the user details fro username
            $users = DB::table('users')
                    ->orderBy('id','desc')
                    ->paginate(50);

            $userCount = DB::table('users')->count();
            $reviewCount = DB::table('film_review')->count();

            $this->layout->content = View::make('admin.index', compact('users','userCount','reviewCount'));

    
    }


}
