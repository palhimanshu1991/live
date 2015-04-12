<?php

class HomeController extends BaseController {

    protected $layout = 'master';

    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function index() {

        if (Auth::check()) {

            $Movies = new MoviesController();
            $critics = $Movies->getCritics(Auth::user()->id);

            $home = new HomeController();
            $recent = DB::table('film')
                    ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                    ->take(10)
                    ->orderBy('fl_release_date', 'desc')
                    ->whereRaw('fl_id NOT IN (select fs_fl_id from film_spotlight)')
                    ->remember(10)
                    ->get();

            $other = DB::table('film')
                    ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                    ->take(20)
                    ->orderBy('fl_release_date', 'desc')
                    ->remember(10)
                    ->get();

            // gets the user details fro username
            $friends = DB::table('user_actions')
                    ->leftjoin('user_friends', 'user_friends.friend_user_id', '=', 'user_actions.subject_id')
                    ->join('users', 'users.id', '=', 'user_actions.subject_id')
                    ->where('follower_user_id', Auth::user()->id)
                    ->take('40')
                    ->orderBy('action_date', 'desc')
                    ->get();

            $User = new UsersController();
            $following = $User->getFollowing(Auth::user()->id);

            $column = array();

            foreach ($following as $following) {
                $column[] = $following->id;
            }

            if ($following) {
                $friend = DB::table('user_actions')
                        ->join('users', 'users.id', '=', 'user_actions.subject_id')
                        ->wherein('user_actions.subject_id', $column)
                        ->orWhere('user_actions.subject_id', Auth::user()->id)
                        ->take('40')
                        ->orderBy('action_date', 'desc')
                        ->get();
            } else {
                $friend = DB::table('user_actions')
                        ->join('users', 'users.id', '=', 'user_actions.subject_id')
                        ->orWhere('user_actions.subject_id', Auth::user()->id)
                        ->take('40')
                        ->orderBy('action_date', 'desc')
                        ->get();
            }
            $this->layout->content = View::make('users.feed', compact('friend', 'critics', 'recent', 'other'));
        } else {


            $Movies = new MoviesController();
            $critics = array();

            $home = new HomeController();
            $recent = DB::table('film')
                    ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                    ->take(12)
                    ->orderBy('fl_release_date', 'desc')
                    //->whereRaw('fl_id NOT IN (select fs_fl_id from film_spotlight)')
                    ->remember(10)
                    ->get();

            $other = DB::table('film')
                    ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                    ->take(20)
                    ->orderBy('fl_release_date', 'desc')
                    ->remember(10)
                    ->get();

            // gets the user details fro username
            $friends = DB::table('user_actions')
                    ->leftjoin('user_friends', 'user_friends.friend_user_id', '=', 'user_actions.subject_id')
                    ->join('users', 'users.id', '=', 'user_actions.subject_id')
                    ->take('40')
                    ->orderBy('action_date', 'desc')
                    ->get();

            $reviews = DB::table('film_review')
                    ->join('film', 'film.fl_id', '=', 'film_review.fr_fl_id')
                    ->join('users', 'users.id', '=', 'film_review.fr_usr_id')
                    ->where('fr_usr_id','<',130)
					->orderBy('fr_id', 'desc')
                    ->take('10')
                    ->distinct()
                    ->get();

            return View::make('new', compact('reviews', 'critics', 'recent', 'other'));
			
        }
    }

    // the ones shown on the right side
    public function RecentMovies($limit) {

        $other = DB::table('film')
                ->select('fl_id', 'fl_name')
                ->take($limit)
                ->orderBy('fl_release_date', 'desc')
                ->remember(10)
                ->get();

        return $other;
    }

    public function MovieCategories($limit) {

        $categories = DB::table('film_category')
                ->select('fc_name')
                ->take($limit)
                ->remember(10)
                ->get();

        return $categories;
    }

    public function about() {
        $this->layout->content = View::make('site.about');
    }

    public function privacy() {
        $this->layout->content = View::make('site.privacy');
    }

    public function terms() {
        $this->layout->content = View::make('site.terms');
    }

    public function feedback() {
        $this->layout->content = View::make('site.feedback');
    }

    public function contact() {
        $this->layout->content = View::make('site.contact');
    }

    public function press() {
        $this->layout->content = View::make('site.press');
    }

    public function jobs() {
        $this->layout->content = View::make('site.jobs');
    }
	
    public function suggestion() {
        $this->layout->content = View::make('site.suggestion');
    }	
    public function suggestionSubmit() {
	
		$name = Input::get('name');
		$id = Input::get('fl_id');
		
		
		
        $this->layout->content = View::make('site.suggestion');
    }
    public function search($query) {

        if ($query == 'advance' || $query == '') {

			return Redirect::to('/');
		
        } else {

            $searchTerms = explode(' ', $query);
            $quer = DB::table('film');
            $user = DB::table('users');

            $count = substr_count($query,' ');
			
			//in case of one word
            if ($count == 0) {

				$movies =  DB::table('film')->where('fl_name', 'LIKE',  $query )->select('fl_id', 'fl_name', 'fl_year', 'fl_image', 'fl_outline', 'fl_dir_ar_id', 'fl_stars', 'fl_genre','fl_rating')->get();
				
				$exact =  DB::table('film')->where('fl_name', 'LIKE',  $query )->select('fl_id', 'fl_name', 'fl_year', 'fl_image', 'fl_outline', 'fl_dir_ar_id', 'fl_stars', 'fl_genre', 'fl_rating')->paginate(10);
				$exact_id =  DB::table('film')->where('fl_name', 'LIKE',  $query )->select('fl_id', 'fl_name', 'fl_year', 'fl_image', 'fl_outline', 'fl_dir_ar_id', 'fl_stars', 'fl_genre', 'fl_rating')->lists('fl_id');
				
				if($exact_id=="" || $exact_id==null){
					$partial =  DB::table('film')->where('fl_tags', 'LIKE', '%' . $query . '%')->select('fl_id', 'fl_name', 'fl_year', 'fl_image', 'fl_outline', 'fl_dir_ar_id', 'fl_stars', 'fl_genre', 'fl_rating')->orderBy('fl_rating', 'desc')->paginate(10);
				} else {
					$partial =  DB::table('film')->whereNotIn('fl_id',$exact_id)->where('fl_tags', 'LIKE', '%' . $query . '%')->select('fl_id', 'fl_name', 'fl_year', 'fl_image', 'fl_outline', 'fl_dir_ar_id', 'fl_stars', 'fl_genre', 'fl_rating')->orderBy('fl_rating', 'desc')->paginate(10);
				}
					               
			//in case of more than one word	
            } else {
				$exact =  DB::table('film')->where('fl_name', 'LIKE',  $query )->select('fl_id', 'fl_name', 'fl_year', 'fl_image', 'fl_outline', 'fl_dir_ar_id', 'fl_stars', 'fl_genre', 'fl_rating')->paginate(10);
				$exact_id =  DB::table('film')->where('fl_name', 'LIKE',  $query )->select('fl_id', 'fl_name', 'fl_year', 'fl_image', 'fl_outline', 'fl_dir_ar_id', 'fl_stars', 'fl_genre', 'fl_rating')->lists('fl_id');
						
				if($exact_id=="" || $exact_id==null){
					foreach ($searchTerms as $term) {
						$partial = $quer->where('fl_tags', 'LIKE',  '%' . $term . '%')
									->orderBy('fl_rating', 'desc')
									->select('fl_id', 'fl_name', 'fl_year', 'fl_image', 'fl_outline', 'fl_dir_ar_id', 'fl_stars', 'fl_genre', 'fl_rating')
									->paginate(10);						
					}
				} else {
					foreach ($searchTerms as $term) {
						$partial = $quer->where('fl_tags', 'LIKE',  '%' . $term . '%')
									->whereNotIn('fl_id',$exact_id)
									->orderBy('fl_rating', 'desc')
									->select('fl_id', 'fl_name', 'fl_year', 'fl_image', 'fl_outline', 'fl_dir_ar_id', 'fl_stars', 'fl_genre', 'fl_rating')
									->paginate(10);						
					}
				}			

            }


            $people = $user->where('usr_fname', 'LIKE', '%' . $query . '%')
                    ->orWhere('usr_lname', 'LIKE', '%' . $query . '%')
                    ->orWhere('usr_email', 'LIKE', $query)
                    ->paginate(10);

            $this->layout->content = View::make('site.search', compact('movies','exact','partial', 'query', 'people'));
        }
    }

    public function contactMail() {

        $email_to = "himanshu@berdict.com";
        $email_subject = "Contact Form";

        $name = Input::get('con_name');
        $email_from = Input::get('con_email');
        $msg = Input::get('con_msg');

        if (!$name == "" && !$email_from == "" && !$msg == "") {

            $email_message = "Form details below.\n\n";

            function clean_string($string) {
                $bad = array("content-type", "bcc:", "to:", "cc:", "href");
                return str_replace($bad, "", $string);
            }

            $email_message .= "First Name: " . clean_string($name) . "\n";
            $email_message .= "Email: " . clean_string($email_from) . "\n";
            $email_message .= "Comments: " . clean_string($msg) . "\n";

            $data = array(
                'msg' => $msg
            );

            Mail::queue('emails.contact', $data, function($message) use ($email_from, $name) {
                $message->to('himanshu@berdict.com', 'Himanshu Pal');
                $message->subject('Contact Form');
                $message->from($email_from, $name);
            });

            return Redirect::to('/contact')
                            ->with('flash_error', 'Thank you for contacting us. We will get in touch with you soon.');
        } else {
            return Redirect::to('/contact')
                            ->with('flash_error', 'Please make sure your email address is valid, and try again.');
        }
    }

    public function sitemap() {

        return Response::view('site.sitemap')->header('Content-Type', 'application/xml');
    }

    public function invite() {

        $this->layout->content = View::make('site.invite');
    }

    public function newTest() {


        if (Auth::check()) {

            $Movies = new MoviesController();
            $critics = $Movies->getCritics(Auth::user()->id);

            $home = new HomeController();
            $recent = DB::table('film')
                    ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                    ->take(10)
                    ->orderBy('fl_release_date', 'desc')
                    ->whereRaw('fl_id NOT IN (select fs_fl_id from film_spotlight)')
                    ->remember(10)
                    ->get();

            $other = DB::table('film')
                    ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                    ->take(20)
                    ->orderBy('fl_release_date', 'desc')
                    ->remember(10)
                    ->get();

            // gets the user details fro username
            $friends = DB::table('user_actions')
                    ->leftjoin('user_friends', 'user_friends.friend_user_id', '=', 'user_actions.subject_id')
                    ->join('users', 'users.id', '=', 'user_actions.subject_id')
                    ->where('follower_user_id', Auth::user()->id)
                    ->take('40')
                    ->orderBy('action_date', 'desc')
                    ->get();

            $User = new UsersController();
            $following = $User->getFollowing(Auth::user()->id);

            $column = array();

            foreach ($following as $following) {
                $column[] = $following->id;
            }

            if ($following) {
                $friend = DB::table('user_actions')
                        ->join('users', 'users.id', '=', 'user_actions.subject_id')
                        ->wherein('user_actions.subject_id', $column)
                        ->orWhere('user_actions.subject_id', Auth::user()->id)
                        ->take('40')
                        ->orderBy('action_date', 'desc')
                        ->get();
            } else {
                $friend = DB::table('user_actions')
                        ->join('users', 'users.id', '=', 'user_actions.subject_id')
                        ->orWhere('user_actions.subject_id', Auth::user()->id)
                        ->take('40')
                        ->orderBy('action_date', 'desc')
                        ->get();
            }
            $this->layout->content = View::make('users.feed', compact('friend', 'critics', 'recent', 'other'));
        } else {

            $Movies = new MoviesController();
            $critics = array();

            $home = new HomeController();
            $recent = DB::table('film')
                    ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                    ->take(10)
                    ->orderBy('fl_release_date', 'desc')
                    ->whereRaw('fl_id NOT IN (select fs_fl_id from film_spotlight)')
                    ->remember(10)
                    ->get();

            $other = DB::table('film')
                    ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                    ->take(20)
                    ->orderBy('fl_release_date', 'desc')
                    ->remember(10)
                    ->get();

            // gets the user details fro username
            $friends = DB::table('user_actions')
                    ->leftjoin('user_friends', 'user_friends.friend_user_id', '=', 'user_actions.subject_id')
                    ->join('users', 'users.id', '=', 'user_actions.subject_id')
                    ->take('40')
                    ->orderBy('action_date', 'desc')
                    ->get();

            $review = DB::table('film_review')
                    ->join('film', 'film.fl_id', '=', 'film_review.fr_fl_id')
                    ->join('users', 'users.id', '=', 'film_review.fr_usr_id')
                    ->take('6')
                    ->get();

            return View::make('new', compact('review', 'critics', 'recent', 'other'));
        }
    }

    public function inviteSend() {

        $subjectName = Input::get('name');
        $subjectEmail = Input::get('email');
        $emailSubject = 'Hey ' . $subjectName . ', congratulations you have been awarded an exclusive Super Critic Badge on Berdict.';


        /* $check = DB::table('invite_critics')
          ->where('ic_email',$subjectEmail)
          ->first();

          if($check) {

          return Redirect::to('/invite')
          ->with('flash_error', 'Email already sent to this email on'.$check->invited_at);

          } else {
         */
        $data = array(
            'subjectName' => $subjectName
        );

        Mail::queue('emails.badge', $data, function($message) use ($subjectEmail, $subjectName, $emailSubject) {
            $message->to($subjectEmail, $subjectName);
            $message->subject($emailSubject);
            $message->from('himanshu@berdict.com', 'Berdict');
        });

        /*
          DB::table('invite_critics')->insert(
          array(
          'ic_name' => $subjectName,
          'ic_email' => $subjectEmail,
          'invited_at' => date('d M Y H:i:s', time())
          )
          );
         */

        return Redirect::to('/invite')
                        ->with('flash_success', 'An Invitation has been sent.');


        //}
    }

    public function inviteAll() {

        $user = DB::table('tblwebdata')->get();

        foreach ($user as $invite) {

            $subjectName = '';
            $subjectEmail = $invite->email;
            $emailSubject = 'An exclusive invitation to join Berdict';

            $check = DB::table('invite_critics')
                    ->where('ic_email', $subjectEmail)
                    ->first();

            if ($check) {
                
            } else {
                $data = array(
                    'subjectName' => $subjectName
                );

                Mail::queue('emails.invite', $data, function($message) use ($subjectEmail, $subjectName, $emailSubject) {
                    $message->to($subjectEmail, $subjectName);
                    $message->subject($emailSubject);
                    $message->from('no-reply@berdict.com', 'Berdict');
                });

                DB::table('invite_critics')->insert(
                        array(
                            'ic_name' => $subjectName,
                            'ic_email' => $subjectEmail,
                            'invited_at' => date('d M Y H:i:s', time())
                        )
                );
            }
        }
        return Redirect::to('/invite')
                        ->with('flash_success', 'An Invitation has been sent.');
    }

    public function country() {

        $this->layout->content = View::make('site.country');
    }

    public function countryUpdate() {

        $star = Input::get('star');
        $country = Input::get('country');
        $start = Input::get('start');
        $end = Input::get('end');

        if ($star == "" || $country = "") {
            return Redirect::to('/country')->with('flash_error', 'Please enter all the details.')->withInput();
        }

        $movie = Movie::where('fl_stars', 'LIKE', '%' . $star . '%')->whereBetween('fl_id', array($start, $end))->get();

        foreach ($movie as $film) {
            if ($film->fl_country == "" || $film->fl_country == null) {
                DB::table('film')->where('fl_id', $film->fl_id)->update(array('fl_country' => $country));
            }
        }

        return Redirect::to('/country')->with('flash_success', 'Country updated.')->withInput();
        ;
    }

    public function globalFeed() {

        $friend = DB::table('user_actions')
                ->join('users', 'users.id', '=', 'user_actions.subject_id')
                ->where('type_id', '2')
                ->whereNotIn('user_actions.subject_id', array(Auth::user()->id))
                ->take('20')
                ->orderBy('action_date', 'desc')
                ->remember('5')
                ->get();

        return View::make('users.global', compact('friend'));
    }
	
    public function indexPost() {

        $email = Input::get('email');
		
		
        if ($email) {

			$query = DB::table('invitation')->insertGetId(
					array(
						'email' => $email
					)
			);			

            return Redirect::to('/')
                            ->with('flash_error', 'Thanks for the mail. We will get in touch with you soon :)');
        } else {
            return Redirect::to('/')
                            ->with('flash_error', 'Please make sure your email address is valid, and try again.');
        }
    }	

}
