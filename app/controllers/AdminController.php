<?php

class AdminController extends BaseController {


    protected $layout = 'master';


    // retunrs the number of unread notifications
    public function admin() {

        if (Auth::user()->usr_level == 2) {
            // gets the user details fro username
            $users = DB::table('users')
                    ->orderBy('id','desc')
                    ->paginate(50);

            $userCount = DB::table('users')->count();

            $this->layout->content = View::make('admin.index', compact('users','userCount'));
        } else {
            return Redirect::to(Config::get('url.home'));
        }        
    
    }


}
