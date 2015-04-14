<?php

class CommentsController extends Controller {

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function show() {


	}
   
	/**
	* Add a comment/reply to the review
	*
	* @return Response
	*/
	public function add() {
	
		$me = Auth::user()->id;
		$review = Input::get('review');
		$comment = Input::get('comment');

        $check = DB::table('review_comments')
					->where('rc_user_id', $me)
					->where('rc_review_id', $review)
					->first();
		
			
			$err = new Comment;
			$err->rc_review_id = $review;
			$err->rc_user_id = $me;
			$err->rc_comment = $comment;
			$err->rc_date = \time();
			$err->save();

			$user = DB::table('film_review')->where('fr_id', $review)->first();
			$reply = Comment::where('rc_user_id', $err->rc_user_id)
								->where('rc_review_id', $err->rc_review_id)
								->leftJoin('users','users.id','=','rc_user_id')
								->orderBy('rc_date','desc')
								->select('rc_id','rc_date','rc_comment','rc_review_id','rc_user_id','id','usr_fname','usr_lname','username','usr_image')
								->first();

			$this->notification($me,$user,$review);

			$this->replyMail($me, $user->fr_usr_id, $user->fr_fl_id, $user);
			
			return View::make('reviews.reply', compact('reply'));

	}
	
	
	
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function notification($me,$user,$review) {

		// creating a notification
		$noti = new Notification;               // notification instance
		$noti->user_id = $user->fr_usr_id;      // the user who will get this notification
		$noti->subject_type = 'user';           // user
		$noti->subject_id = $me;   				// the uset who liked the review
		$noti->object_type = 'review';          // object is review 
		$noti->object_id = $review;             // id of the review in picture
		$noti->type = 'reply';                  // liked - notification type
		$noti->read = '0';                      // default '0' as it is unread
		$noti->time = time();                   // default '0' as it is unread
		$noti->save();                          // saves notification
	
	}	
	
	
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function delete() {

        $reply = Input::get('reply');
		$me = Input::get('me');
        $review = Input::get('review');
		
		//Confirming whether the user wrote the review
		$check = DB::table('review_comments')
				->where('rc_id', $reply)
				->where('rc_user_id', $me)
				->first();

		if ($check) {
		
			//deleting notifications
			DB::table('user_notifications')
					->where('type', 'reply')
					->where('object_type', 'review')
					->where('user_id', $me)
					->where('object_id', $review)
					->delete();
		
			//deleting likes associated 
			DB::table('review_comments')
					->where('rc_id', $reply)
					->delete();
					
			return 'true';	
			
		} else {
		
			return 'false';
		}		

	}

    public function replyMail($mee, $subject, $film, $review) {

		$me = User::where('id', $mee)->first();
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
        $emailSubject = 'Hey ' . $user->usr_fname . '! ' . $me->usr_fname . ' ' . $me->usr_lname . ' replied to your review for ' . $movie->fl_name;

        $data = array(
            'subjectName' => $user->usr_fname,
            'filmName' => $movie->fl_name,
            'filmYear' => $movie->fl_year,
            'filmUrl' => $filmUrl,
            'filmImage' => $filmImage,
            'filmReview' => $review->fr_review,
            'reviewId' => $review->fr_id,
            'objectId' => $me->id,
            'objectName' => $me->usr_fname . ' ' . $me->usr_lname,
            'objectUsername' => $me->username,
            'filmName' => $movie->fl_name
        );

        Mail::later(10,'emails.reply', $data, function($message) use ($subjectEmail, $subjectName, $emailSubject) {
            $message->to($subjectEmail, $subjectName);
            $message->subject($emailSubject);
            $message->from('no-reply@berdict.com', 'Berdict');
        });
    }	
	
   
   

}
