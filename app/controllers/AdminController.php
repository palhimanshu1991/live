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

    // retunrs all search results
    public function search() {

        $query = Input::get("query");

        if (Auth::user()->usr_level == 2) {
            // gets the user details fro username
            $users = DB::table('users')
                    ->orderBy('id','desc')
                    ->where('usr_fname', 'LIKE', '%' . $query . '%')
                    ->orWhere('usr_lname', 'LIKE', '%' . $query . '%')
                    ->orWhere('usr_email', 'LIKE', $query)
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

    // Boost views of a reviews 
    public function reviewsViews($review){

        if (Auth::user()->usr_level == 2) {

            DB::table('film_review')
            ->where('fr_id',$review)
            ->increment('fr_views',rand(50,100)); 
      
            return Redirect::to(Config::get('url.home')."admin/reviews");

        } else {
            return Redirect::to(Config::get('url.home'));
        }           
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function reviewEdit($id) {

        $review = Review::find($id);

         if (Auth::user()->usr_level == 2) {
                $this->layout->content = View::make('reviews.edit', compact('review'));
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
    public function reviewSave($id) {

        if (Auth::user()->usr_level == 2) {        

            $review = Input::get('review_text');

            DB::table('film_review')
                    ->where('fr_id', $id)
                    ->update(array(
                        'fr_review' => $review,
                        'fr_date' => \time()
            ));

        }

        return Redirect::to(Config::get('url.home')."admin/reviews");
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

    // Gives 1 Random Like
    public function reviewsLike($review) {

        if (Auth::user()->usr_level == 2) {


        $rev = DB::table('film_review')
                ->where('fr_id', $review)
                ->first();

            if ($rev) {

                $this->like($review);

            }            

            return Redirect::to(Config::get('url.home')."admin/reviews");

        } else {
            return Redirect::to(Config::get('url.home'));
        }        
    
    }  

    
   /**
     * User follow 
     *
     * @param  int  $id
     * @return Response
     */
    public function random($id) {

        //random follower
        $ran = DB::table('users')->whereBetween('id', array(1, 130))->orderBy(DB::raw('RAND()'))->first();              
        $random = $ran->id;
        
        $check = DB::table('user_friends')
                    ->where('friend_user_id', $id)
                    ->where('follower_user_id', $random)
                    ->first(); 
        
        $user = $id;                            // user being followed
        $follow = $check;
        $subject_type = 'user';                 // always user, the user who triggered this notification
        $subject_id = $random;         // the follower or user who triggered the notification
        $object_type = 'user';
        $object_id = $random;
        $type = 'follow';

        if ($follow) {
            
        } else {

            $query = DB::table('user_friends')->insertGetId(
                    array(
                        'friend_user_id' => $user,
                        'follower_user_id' => $random
                    )
            );


            // creating a notification
            $noti = new Notification;               // notification instance
            $noti->user_id = $user;      // the user who will get this notification
            $noti->subject_type = $subject_type;           // user
            $noti->subject_id = $subject_id;   // the uset who liked the review
            $noti->object_type = $object_type;          // object is review 
            $noti->object_id = $object_id;             // id of the review in picture
            $noti->type = $type;                  // liked - notification type
            $noti->read = '0';                      // default '0' as it is unread
            $noti->time = time();                      // default '0' as it is unread
            $noti->save();                          // saves notification       
            /// insert into the user actions
            $act = new Activity;               // notification instance
            $act->type_id = '4';                   // the user who will get this notification
            $act->subject_id = $subject_id;   // user
            $act->object_type = 'user';            // object is review 
            $act->object_id = $user;               // id of the review in picture
            $act->action_date = \time();           // default '0' as it is unread
            $act->save();                          // saves activity     

            
            if($id>130) {
                $this->newRandomFollowMail($user,$ran);
            }
        }

        return Redirect::to(Config::get('url.home')."admin");

    }
    
    
    public function newRandomFollowMail($subject,$random) {

        // subject is the ID of the user who gets the email
        // object is the ID of user who is the follower or logged in user

        $user = User::where('id', $subject)->first();

        $followerCount = $this->getFollowerCount($random->id);
        $followingCount = $this->getFollowingCount($random->id);
        $reviewCount = $this->getReviewCount($random->id);

        $subjectEmail = $user->usr_email;
        $subjectName = $user->usr_fname . ' ' . $user->usr_lname;
        $emailSubject = 'Hey ' . $user->usr_fname . '! ' . $random->usr_fname . ' ' . $random->usr_lname . ' is now following you on Berdict.';

        $data = array(
            'subjectName' => $user->usr_fname,
            'objectName' => $random->usr_fname . ' ' . $random->usr_lname,
            'objectUsername' => $random->username,
            'objectId' => $random->id,
            'objectImage' => $random->usr_image,
            'followerCount' => $followerCount,
            'followingCount' => $followingCount,
            'reviewCount' => $reviewCount
        );

        Mail::queue('emails.follower', $data, function($message) use ($subjectEmail, $subjectName, $emailSubject) {
            $message->to($subjectEmail, $subjectName);
            $message->subject($emailSubject);
            $message->from('no-reply@berdict.com', 'Berdict');
        });
    }       
    
    public function randoms() {

        //random follower
        $id = DB::table('users')->orderBy(DB::raw('RAND()'))->first();
        $ran = DB::table('users')->whereBetween('id', array(1, 130))->orderBy(DB::raw('RAND()'))->first();              
        $random = $ran->id;
        
        $check = DB::table('user_friends')
                    ->where('friend_user_id', $id->id)
                    ->where('follower_user_id', $random)
                    ->first(); 
        
        $user = $id->id;                            // user being followed
        $follow = $check;
        $subject_type = 'user';                 // always user, the user who triggered this notification
        $subject_id = $random;         // the follower or user who triggered the notification
        $object_type = 'user';
        $object_id = $random;
        $type = 'follow';

        if ($follow) {
            
        } else {

            $query = DB::table('user_friends')->insertGetId(
                    array(
                        'friend_user_id' => $user,
                        'follower_user_id' => $random
                    )
            );


            // creating a notification
            $noti = new Notification;               // notification instance
            $noti->user_id = $user;      // the user who will get this notification
            $noti->subject_type = $subject_type;           // user
            $noti->subject_id = $subject_id;   // the uset who liked the review
            $noti->object_type = $object_type;          // object is review 
            $noti->object_id = $object_id;             // id of the review in picture
            $noti->type = $type;                  // liked - notification type
            $noti->read = '0';                      // default '0' as it is unread
            $noti->time = time();                      // default '0' as it is unread
            $noti->save();                          // saves notification       
            /// insert into the user actions
            $act = new Activity;               // notification instance
            $act->type_id = '4';                   // the user who will get this notification
            $act->subject_id = $subject_id;   // user
            $act->object_type = 'user';            // object is review 
            $act->object_id = $user;               // id of the review in picture
            $act->action_date = \time();           // default '0' as it is unread
            $act->save();                          // saves activity     

            if($user>130) {
                $mail = $this->newRandomFollowMail($user,$ran);
            }
        }

        return $ran->id." followed ".$id->id;

    }       

    public function getFollower($id) {
        return DB::table('user_friends')
                        ->where('friend_user_id', $id)
                        ->join('users', 'users.id', '=', 'user_friends.follower_user_id')
                        ->get();
    }

    public function getFollowerCount($id) {
        return Friend::where('friend_user_id', $id)->count();
    }

    public function getFollowing($id) {
        return DB::table('user_friends')
                        ->where('follower_user_id', $id)
                        ->join('users', 'users.id', '=', 'user_friends.friend_user_id')
                        ->get();
    }


    public function getFollowingCount($id) {
        return Friend::where('follower_user_id', $id)->count();
    }

    public function getReviewCount($id) {
        return Review::where('fr_usr_id', $id)->count();
    }

    public function getViewCount($id) {
        return Review::where('fr_usr_id', $id)->sum('fr_views');
    }   

    public function getFavCount($id) {
        return Favourite::where('fav_usr_id', $id)->count();
    }   

    public function getWatchCount($id) {
        return Watchlist::where('uw_usr_id', $id)->count();
    }   

    public function getMovieCount($id) {
        return DB::table('user_watched')->where('watched_usr_id', $id)->count();
    }      

    /**
     * adding a like to the review.
     */
    public function like($review) {

        $user   =   rand(1,130); 
        $check  =   $this->likeCheck($review,$user);

        if (!$check) {
            if (!$review == "") {

                // inserting the review like
                DB::table('review_likes')->insert(
                        array(
                            'review_id' => $review,
                            'user_id' => $user
                        )
                );
                $review = DB::table('film_review')->where('fr_id', $review)->first();
                // creating a notification
                $noti = new Notification;               // notification instance
                $noti->user_id = $review->fr_usr_id;      // the user who will get this notification
                $noti->subject_type = 'user';           // user
                $noti->subject_id = $user;                // the user who liked the review
                $noti->object_type = 'review';          // object is review 
                $noti->object_id = $review->fr_id;             // id of the review in picture
                $noti->type = 'liked';                  // liked - notification type
                $noti->read = '0';                      // default '0' as it is unread
                $noti->time = time();                   // default '0' as it is unread
                $noti->save();                          // saves notification

                $mail = $this->newLikeMail($review->fr_usr_id, $review->fr_fl_id, $review, $user);
            }
        }
    }

    /**
     * like check to the review.
     */
    public function likeCheck($review,$user) {
        return DB::table('review_likes')
                        ->where('review_id', $review)
                        ->where('user_id', $user)
                        ->first();
    }    


    //
    // Mail for a new like on the review 
    //
    public function newLikeMail($subject, $film, $review, $random) {

        $user = User::where('id', $subject)->first();
        $Ruser = User::where('id', $random)->first();       
        $movie = Movie::where('fl_id', $film)->first();

        if ($movie->fl_image) {
            $filmImage = 'http://www.berdict.com/public/uploads/movie/' . $movie->fl_year . '/' . $movie->fl_image;
        } else {
            $filmImage = 'http://www.berdict.com/public/berdict/img/default_poster.jpg';
        }
        $filmUrl = 'http://www.berdict.com/movie/' . $movie->fl_id . '/' . Common::cleanUrl($movie->fl_name);

        $subjectEmail = $user->usr_email;
        $subjectName = $user->usr_fname . ' ' . $user->usr_lname;
        $emailSubject = '' . $user->usr_fname . '! ' . $Ruser->usr_fname . ' ' . $Ruser->usr_lname . ' agreed with your review for ' . $movie->fl_name;

        $data = array(
            'subjectName' => $user->usr_fname,
            'filmName' => $movie->fl_name,
            'filmYear' => $movie->fl_year,
            'filmUrl' => $filmUrl,
            'filmImage' => $filmImage,
            'filmReview' => $review->fr_review,
            'reviewId' => $review->fr_id,
            'objectId' => $Ruser->id,
            'objectName' => $Ruser->usr_fname . ' ' . $Ruser->usr_lname,
            'objectUsername' => $Ruser->username,
            'filmName' => $movie->fl_name
        );

        Mail::send('emails.agree', $data, function($message) use ($subjectEmail, $subjectName, $emailSubject) {
            $message->to($subjectEmail, $subjectName);
            $message->subject($emailSubject);
            $message->from('no-reply@berdict.com', 'Berdict');
        });
    }

}
