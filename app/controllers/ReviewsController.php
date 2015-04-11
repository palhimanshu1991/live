<?php

class ReviewsController extends BaseController {

    protected $layout = 'master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('reviews.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        $this->layout->content = View::make('reviews.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function delete() {

        $review = Input::get('review');

        $rev = DB::table('film_review')
                ->where('fr_usr_id', Auth::user()->id)
                ->where('fr_id', $review)
                ->first();

        if ($rev) {

            DB::table('user_actions')
                    ->where('type_id', 2)
                    ->where('subject_id', Auth::user()->id)
                    ->where('object_id', $rev->fr_fl_id)
                    ->delete();

            DB::table('user_notifications')
                    ->where('type', 'liked')
                    ->where('object_type', 'review')
                    ->where('user_id', Auth::user()->id)
                    ->where('object_id', $review)
                    ->delete();

            DB::table('film_review')
                    ->where('fr_usr_id', Auth::user()->id)
                    ->where('fr_id', $review)
                    ->delete();

            DB::table('review_likes')
                    ->where('review_id', $review)
                    ->delete();
        }
        return 'true';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $film = $_POST['film_id'];
        $user = $_POST['user_id'];
        $review = $_POST['review_text'];
        $vote = $_POST['review_vote'];

        if (!$review == "") {

            DB::table('reviews')->insert(
                    array(
                        'film_id' => $film,
                        'user_id' => $user,
                        'review_text' => $review,
                        'review_vote' => $vote
                    )
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {

        // gets the review details from the given id
        $review = DB::table('film_review')
                ->where('fr_id', $id)
                ->remember(1)
                ->first();

        // gets the movie details from the review
        $film = DB::table('film')
                ->where('fl_id', $review->fr_fl_id)
                ->remember(1)
                ->first();

        // get the user details from the review
        $user = DB::table('users')
                ->where('id', $review->fr_usr_id)
                ->remember(1)
                ->first();

        $this->layout->content = View::make('reviews.show', compact('review', 'film', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $review = Review::find($id);

        if (Auth::check()) {
            if ($review->fr_usr_id == Auth::user()->id) {
                $this->layout->content = View::make('reviews.edit', compact('review'));
            } else {
                return Redirect::to(Config::get('url.home'));
            }
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
    public function saveEdit($id) {

        $review = Input::get('review_text');

        DB::table('film_review')
                ->where('fr_id', $id)
                ->update(array(
                    'fr_review' => $review,
                    'fr_date' => \time()
        ));

        Redirect::to(Config::get('url.home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        
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
    public function add() {
        $film = Input::get('film');
        $user = Input::get('user');
        $review = Input::get('review');
        $vote = Input::get('vote');
        $fbshare = Input::get('fbshare');

        $check = $this->reviewCheck($film);

        if ($check) {
            
        } else if (!$review == "") {
            // inserts the review
            $rev = new Review;               // revie instance
            $rev->fr_fl_id = $film;
            $rev->fr_usr_id = Auth::user()->id;
            $rev->fr_review = $review;
            $rev->fr_vote = $vote;
            $rev->fr_date = \time();
            $rev->save();                          // saves review
            // insert a new user actions
            $act = new Activity;                        // notification instance
            $act->type_id = '2';                        // activity type 2 for review
            $act->subject_id = Auth::user()->id;        // id of the user
            $act->object_type = 'film';                 // type of object
            $act->object_id = $film;                 // id of the object
            $act->action_date = \time();                // time of the activity
            $act->save();                               // saves activity
            //Deleting the rating action

            $delete = $this->deleteRatingAction($film);

            // Sending mails to all followers 
            // Film id & review JSON
            $this->newReviewMail($film, $rev);

            //posts on fb if access token avaiable
            if($fbshare) {
                if (Auth::user()->fb_access_token) {
                    $fb = new FacebookController();
                    $execute = $fb->postFbReview($film, $review, $vote, Auth::user()->fb_uid, Auth::user()->fb_access_token, $fbshare);
                }
            }
        }


        // gets the review details from the given id
        $latest = DB::table('film_review')
                ->where('fr_usr_id', Auth::user()->id)
                ->orderBy('fr_id', 'desc')
                ->first();

        $user = user::find(Auth::user()->id);

        return View::make('reviews.add', compact('latest', 'user'));
    }

    /**
     * adding a like to the review.
     */
    public function reviewCheck($film) {
        return DB::table('film_review')
                        ->where('fr_usr_id', Auth::user()->id)
                        ->where('fr_fl_id', $film)
                        ->first();
    }

    /**
     * adding a like to the review.
     */
    public function like() {

        $review = Input::get('review');
        $check = $this->likeCheck($review);

        if (!$check) {
            if (!$review == "") {
                // inserting the review like
                DB::table('review_likes')->insert(
                        array(
                            'review_id' => $review,
                            'user_id' => Auth::user()->id
                        )
                );
                $user = DB::table('film_review')->where('fr_id', $review)->first();
                // creating a notification
                $noti = new Notification;               // notification instance
                $noti->user_id = $user->fr_usr_id;      // the user who will get this notification
                $noti->subject_type = 'user';           // user
                $noti->subject_id = Auth::user()->id;   // the uset who liked the review
                $noti->object_type = 'review';          // object is review 
                $noti->object_id = $review;             // id of the review in picture
                $noti->type = 'liked';                  // liked - notification type
                $noti->read = '0';                      // default '0' as it is unread
                $noti->time = time();                      // default '0' as it is unread
                $noti->save();                          // saves notification

                $mail = $this->newLikeMail($user->fr_usr_id, $user->fr_fl_id, $user);
            }
        }
    }

    /**
     * unlike to the review.
     */
    public function likeCheck($review) {
        return DB::table('review_likes')
                        ->where('review_id', $review)
                        ->where('user_id', Auth::user()->id)
                        ->first();
    }

    /**
     * unlike to the review.
     *
     * @param  int  $id
     * @return Response
     */
    public function unlike() {

        $review = Input::get('review');

        if (!$review == "") {

            DB::table('review_likes')
                    ->where('review_id', $review)
                    ->where('user_id', Auth::user()->id)
                    ->delete();
        }
    }

    /**
     * rating
     *
     * @param  int  $id
     * @return Response
     */
    public function rate() {

        $film = Input::get('film');
        $value = Input::get('value');

        $rating = DB::table('rating')
                ->where('rt_fl_id', $film)
                ->where('rt_usr_id', Auth::user()->id)
                ->first();

        if ($rating) {

            if ($value == "0") {
                // if value provided is 0 then delete the rating
                DB::table('rating')
                        ->where('rt_fl_id', $film)
                        ->where('rt_usr_id', Auth::user()->id)
                        ->delete();

                $delete = $this->deleteRatingAction($film);
            } else {
                //updating the rating if is alredy there
                DB::table('rating')
                        ->where('rt_fl_id', $film)
                        ->where('rt_usr_id', Auth::user()->id)
                        ->update(array(
                            'rt_vote' => $value,
                            'rt_type' => 'f'
                ));
            }
        } else {

            // inserting the review like
            DB::table('rating')->insert(
                    array(
                        'rt_fl_id' => $film,
                        'rt_usr_id' => Auth::user()->id,
                        'rt_vote' => $value,
                        'rt_type' => 'f'
                    )
            );

            // Insert a new user actions
            $act = new Activity;                        // notification instance
            $act->type_id = '1';                        // activity type 2 for review
            $act->subject_id = Auth::user()->id;        // id of the user
            $act->object_type = 'film';                 // type of object
            $act->object_id = $film;                 // id of the object
            $act->action_date = \time();                // time of the activity
            $act->save();                               // saves activity

            if (Auth::user()->fb_access_token) {
                $fb = new FacebookController();
                $execute = $fb->postFbRating($film, $value, Auth::user()->fb_uid, Auth::user()->fb_access_token);
            }
        }
    }

    // adds the moderator review
    public function modAdd() {

        $film = Input::get('film');
        $user = Input::get('user');
        $review = Input::get('review');
        $vote = Input::get('vote');
		
		$check = DB::table('film_review')
					->where('fr_usr_id', $user)
					->where('fr_fl_id', $film)
					->first();

		if ($check) {
		
		} else {
	        if (!$review == "") {
				// inserts the review
				$rev = new Review;               // revie instance
				$rev->fr_fl_id = $film;
				$rev->fr_usr_id = $user;
				$rev->fr_review = $review;
				$rev->fr_vote = $vote;
				$rev->fr_date = \time();
				$rev->save();                          // saves review
				// insert a new user actions
				$act = new Activity;                        // notification instance
				$act->type_id = '2';                        // activity type 2 for review
				$act->subject_id = $user;        // id of the user
				$act->object_type = 'film';                 // type of object 
				$act->object_id = $film;                 // id of the object
				$act->action_date = \time();                // time of the activity 
				$act->save();                               // saves activity     
			}		
		}

        // gets the review details from the given id
        $latest = DB::table('film_review')
                ->where('fr_usr_id', $user)
                ->orderBy('fr_id', 'desc')
                ->first();

        $user = user::find($user);

        return View::make('reviews.add', compact('latest', 'user'));
    }

    public function deleteRatingAction($film) {
        DB::table('user_actions')
                ->where('type_id', 1)
                ->where('subject_id', Auth::user()->id)
                ->where('object_id', $film)
                ->delete();
    }

    public function deleteReviewAction($film) {
        DB::table('user_actions')
                ->where('type_id', 2)
                ->where('subject_id', Auth::user()->id)
                ->where('object_id', $film)
                ->delete();
    }

    public function peopleWho($id) {

        $people = DB::table('review_likes')
                ->where('review_id', $id)
                ->join('users', 'users.id', '=', 'review_likes.user_id')
                ->get();

        return View::make('reviews.people', compact('people'));
    }
	
    public function loadMore() {
	
		$skip = Input::get('count');
		$film = Input::get('film');
		


		if (Auth::check()) {
		
			$ser = new UsersController();
			$following = $ser->getFollowing(Auth::user()->id);		

			$column = array();
			foreach ($following as $following) {
				$column[] = $following->id;
			}				
			$review = DB::table('film_review')
						->join('users', 'users.id', '=', 'film_review.fr_usr_id')
						->where('fr_fl_id', $film)
						->whereNotIn('fr_usr_id', $column)
						->WhereNotIn('fr_usr_id', array(Auth::user()->id))
						->skip($skip)
						->take(5)
						->orderBy('fr_date')
						->get();		
		} else {
			$review = DB::table('film_review')
						->join('users', 'users.id', '=', 'film_review.fr_usr_id')
						->where('fr_fl_id', $film)
						->skip($skip)
						->take(5)
						->orderBy('fr_date')
						->get();		
		}
					
        return View::make('reviews.more', compact('review'));
    }	

    public function newLikeMail($subject, $film, $review) {

        $user = User::where('id', $subject)->first();
        $movie = Movie::where('fl_id', $film)->first();

        if ($movie->fl_image) {
            $filmImage = 'http://www.berdict.com/public/uploads/movie/' . $movie->fl_year . '/' . $movie->fl_image;
        } else {
            $filmImage = 'http://www.berdict.com/public/berdict/img/default_poster.jpg';
        }
        $filmUrl = 'http://www.berdict.com/movie/' . $movie->fl_id . '/' . Common::cleanUrl($movie->fl_name);

        $subjectEmail = $user->usr_email;
        $subjectName = $user->usr_fname . ' ' . $user->usr_lname;
        $emailSubject = '' . $user->usr_fname . '! ' . Auth::user()->usr_fname . ' ' . Auth::user()->usr_lname . ' agreed with your review for ' . $movie->fl_name;

        $data = array(
            'subjectName' => $user->usr_fname,
            'filmName' => $movie->fl_name,
            'filmYear' => $movie->fl_year,
            'filmUrl' => $filmUrl,
            'filmImage' => $filmImage,
            'filmReview' => $review->fr_review,
            'reviewId' => $review->fr_id,
            'objectId' => Auth::user()->id,
            'objectName' => Auth::user()->usr_fname . ' ' . Auth::user()->usr_lname,
            'objectUsername' => Auth::user()->username,
            'filmName' => $movie->fl_name
        );

        Mail::send('emails.agree', $data, function($message) use ($subjectEmail, $subjectName, $emailSubject) {
            $message->to($subjectEmail, $subjectName);
            $message->subject($emailSubject);
            $message->from('no-reply@berdict.com', 'Berdict');
        });
    }

    public function newReviewMail($film, $review) {

        //Get All Followers of the loggedn in user 
        $users      = new UsersController;
        $followers  = $users->getFollower(Auth::user()->id);
        $movie = Movie::where('fl_id', $film)->first();

        foreach ($followers as $subject) {

            //The follower to whom this email will be sent
            $user = User::where('id', $subject->id)->first();

            if ($movie->fl_image) {
                $filmImage = 'http://www.berdict.com/public/uploads/movie/' . $movie->fl_year . '/' . $movie->fl_image;
            } else {
                $filmImage = 'http://www.berdict.com/public/berdict/img/default_poster.jpg';
            }
            $filmUrl = 'http://www.berdict.com/movie/' . $movie->fl_id . '/' . Common::cleanUrl($movie->fl_name);

            $subjectEmail = $user->usr_email;
            $subjectName = $user->usr_fname . ' ' . $user->usr_lname;
            $emailSubject = 'Hey ' . $user->usr_fname . '! Your friend ' . Auth::user()->usr_fname . ' ' . Auth::user()->usr_lname . ' wrote a review for ' . $movie->fl_name;

            $data = array(
                'subjectName' => $user->usr_fname,
                'filmName' => $movie->fl_name,
                'filmYear' => $movie->fl_year,
                'filmUrl' => $filmUrl,
                'filmImage' => $filmImage,
                'filmReview' => $review->fr_review,
                'reviewId' => $review->fr_id,
                'objectId' => Auth::user()->id,
                'objectName' => Auth::user()->usr_fname . ' ' . Auth::user()->usr_lname,
                'objectUsername' => Auth::user()->username,
                'filmName' => $movie->fl_name
            );

            Mail::send('emails.newReview', $data, function($message) use ($subjectEmail, $subjectName, $emailSubject) {
                $message->to($subjectEmail, $subjectName);
                $message->subject($emailSubject);
                $message->from('no-reply@berdict.com', 'Berdict');
            });
        }
    }    
}
