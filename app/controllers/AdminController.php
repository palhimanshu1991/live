<?php

class AdminController extends BaseController {


    protected $layout = 'master';


    // retunrs all latest users
    public function admin() {

        if (Auth::user()->usr_level == 2) {
            // gets the user details fro username
            $users = DB::table('users')
                    ->orderBy('id','desc')
                    ->paginate(50);

            $userCount = DB::table('users')->count();
            $reviewCount = DB::table('film_review')->count();

            $this->layout->content = View::make('admin.index', compact('users','userCount','reviewCount'));
        } else {
            return Redirect::to(Config::get('url.home'));
        }        
    
    }

    // retunrs all latest reviews
    public function reviews() {

        if (Auth::user()->usr_level == 2) {
            // gets the user details fro username
            $reviews = DB::table('film_review')
                    ->orderBy('fr_id','desc')
                    ->paginate(50);

            $userCount = DB::table('users')->count();
            $reviewCount = DB::table('film_review')->count();

            $this->layout->content = View::make('admin.reviews', compact('reviews','userCount','reviewCount'));
        } else {
            return Redirect::to(Config::get('url.home'));
        }        
    
    }    

    // Deletes a review
    public function reviewsDelete($review) {

        if (Auth::user()->usr_level == 2) {


        $rev = DB::table('film_review')
                ->where('fr_id', $review)
                ->first();

            if ($rev) {

                DB::table('user_actions')
                        ->where('type_id', 2)
                        ->where('subject_id', $rev->fr_usr_id)
                        ->where('object_id', $rev->fr_fl_id)
                        ->delete();

                DB::table('user_notifications')
                        ->where('type', 'liked')
                        ->where('object_type', 'review')
                        ->where('user_id', $rev->fr_usr_id)
                        ->where('object_id', $review)
                        ->delete();

                DB::table('film_review')
                        ->where('fr_usr_id', $rev->fr_usr_id)
                        ->where('fr_id', $review)
                        ->delete();

                DB::table('review_likes')
                        ->where('review_id', $review)
                        ->delete();
            }            

            return Redirect::to(Config::get('url.home')."admin/reviews");

        } else {
            return Redirect::to(Config::get('url.home'));
        }        
    
    }  

}
