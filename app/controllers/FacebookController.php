<?php

class FacebookController extends BaseController {

    protected $layout = 'master';

    /*
      |--------------------------------------------------------------------------
      | Facebook Controller
      |--------------------------------------------------------------------------
      |
      |
      | Route::get('/facebook', 'FacebookController');
      |
     */

    public function checkFb() {


        $fb_uid = Input::get('fb_uid');    // fb user id

        $check = User::where('oauth_id', $fb_uid)->first();

        if ($check) {
            // user exit login return false
            $user = User::find($check->id);
            Auth::login($user);

            return 'false';
        } else {
            // user does not exist signup
            return 'true';
        }
    }

    public function checkUsername() {

        $username = Input::get('username');    // fb user username
        $check = User::where('username', $username)->first();

        if ($check) {
            return 'false'; // user exists return false
        } else {
            return 'true'; // user does not exist retur true
        }
    }

    public function checkEmail() {

        $email = Input::get('email');
        $check = User::where('usr_email', $email)->first();

        if ($check) {
            return 'false'; // user exists return false
        } else {
            return 'true'; // user does not exist retur true
        }
    }

    public function addUser() {

        include 'public/facebook/facebook.php';

        $uid = Input::get('uid');
        $email = Input::get('email');
        $fname = Input::get('fname');
        $lname = Input::get('lname');
        $link = Input::get('link');
        $fb_gender = Input::get('gender');
        $token = Input::get('token');
        $username = Input::get('username');
        $pass = Hash::make(Input::get('pass'));


        if ($fb_gender == 'male') {
            $gender = 'm';
        } else if ($fb_gender == 'female') {
            $gender = 'f';
        }

        $config = array(
            'appId' => Config::get('url.fb_id'),
            'secret' => Config::get('url.fb_secret'),
        );

        $facebook = new Facebook($config);
        $facebook->setExtendedAccessToken();
        $fb_token = $facebook->getAccessToken();


        $user = new User;
        $user->usr_fname = $fname;
        $user->usr_lname = $lname;
        $user->username = $username;
        $user->usr_email = $email;
        $user->password = $pass;
        $user->usr_gender = $gender;
        $user->usr_fb_link = $link;
		$user->berdict_key = $this->generateRandomString();		
        $user->fb_access_token = $fb_token;
        $user->oauth_provider = 'facebook';
        $user->oauth_id = $uid;
        $user->fb_uid = $uid;
        $user->usr_image = '';
        $user->usr_status = '1';
        $user->usr_updated_date = \time();
        $user->save();

        $insertedId = $user->id;

        // user exit login
        $user = User::find($insertedId);
        Auth::login($user);

        //creating a directory for the user with blank index.php
        $id = $insertedId;

		$invite = New InviteController;
		$invite->createCodes($insertedId);		
		
        $index = ('public/user_uploads/1000/' . $id . '/index.php');

        //Makes the directories if the index file does not exist
        if (!File::exists($index)) {
            File::makeDirectory('public/user_uploads/1000/' . $id . '', 0777, true);
            $handle = fopen($index, 'x+');
            fclose($handle);
        }

        // image file
        $time = \time();
        $file = 'http://graph.facebook.com/' . $uid . '/picture?width=200&height=200';
        // Getting the image from fb
        $data = file_get_contents($file);
        $image_name = md5($time) . ".jpg";
        // the final new image file with the name
        $new = ("public/user_uploads/1000/" . $id . "/" . $image_name);
        // Write the contents back to a new file
        file::put($new, $data);

        if (!$image_name == "") {
            $user = User::find($insertedId);
            $user->usr_image = $image_name;
            $user->save();
        }
		
		//Adding facebook friends into database		
		$friends = $facebook->api('' . $uid . '/friends', 'GET',
									array(
									  'access_token' => $user->fb_access_token
								 ));				

		try {
			foreach ($friends["data"] as $value) {

				DB::table('user_facebook')->insert(
						array(
							'ufb_usr_id' => $insertedId, // berdict id of the current user
							'ufb_fb_id' => $uid, // facebook id of the current user
							'ufb_friend_id' => $value["id"], // facebook id of the friend
							'ufb_friend_name' => $value["name"], // name of the facebook friend
							'ufb_status' => '0'                     // friendship status
						)
				);
			}
		} catch (Exception $error) {
		
				
			DB::table('errors')->insert(
				array(
				'er_controller' => 'FaceboookController',
				'er_usr_id' => Auth::user()->id,
				'er_error' => $error,
				'er_date' => date('d M Y H:i:s', time())
				)
			);	
		
		}
		
		$this->followAll();			

		
    }

    public function getFacebookFriends($uid, $insertedId, $facebook) {

        //Gets the list of facebook friends and stores in DB
        $friends = $facebook->api('/me/friends');

		try {
			foreach ($friends["data"] as $value) {

				DB::table('user_facebook')->insert(
						array(
							'ufb_usr_id' => $insertedId, // berdict id of the current user
							'ufb_fb_id' => $uid, // facebook id of the current user
							'ufb_friend_id' => $value["id"], // facebook id of the friend
							'ufb_friend_name' => $value["name"], // name of the facebook friend
							'ufb_status' => '0'                     // friendship status
						)
				);
			}
		} catch (Exception $error) {
		
				
			DB::table('errors')->insert(
				array(
				'er_controller' => 'FaceboookController',
				'er_usr_id' => Auth::user()->id,
				'er_error' => $error,
				'er_date' => date('d M Y H:i:s', time())
				)
			);	
		
		}
		
		$this->followAll();	
		
    }

    public function friends() {
	
	
			DB::table('errors')->insert(
				array(
				'er_controller' => 'FaceboookController',
				'er_usr_id' => Auth::user()->id,
				'er_error' => 'testing error',
				'er_date' => date('d M Y H:i:s', time())
				)
			);		
	
        $user = DB::table('user_facebook')
                ->where('ufb_usr_id', Auth::user()->id)
                ->join('users', 'users.oauth_id', '=', 'user_facebook.ufb_friend_id')
                ->orderBy(DB::raw('RAND()'))
                ->get();

        $friendCount = DB::table('user_facebook')
                ->where('ufb_usr_id', Auth::user()->id)
                ->join('users', 'users.oauth_id', '=', 'user_facebook.ufb_friend_id')
                ->count();

        $this->layout->content = View::make('facebook.friends', compact('user', 'friendCount'));
    }

    public function postFbRating($fl_id, $vote, $fb_uid, $access_token) {

        include 'public/facebook/facebook.php';

        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
            'appId' => '437161969726572',
            'secret' => '6ffba69aa1afab022a596fed0b75427a',
        ));


        // Post the rating
        $ret_obj = $facebook->api('' . $fb_uid . '/video.rates', 'POST', array(
            'access_token' => $access_token,
            'rating:value' => "$vote",
            'rating:scale' => "10",
            'movie' => "http://www.berdict.com/movie/" . $fl_id . "/"
                )
        );
    }

    public function postFbReview($fl_id, $review, $vote, $fb_uid, $access_token, $fbshare) {

        include 'public/facebook/facebook.php';

        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
            'appId' => '437161969726572',
            'secret' => '6ffba69aa1afab022a596fed0b75427a',
        ));

        // Post the review
        $ret_obj = $facebook->api('' . $fb_uid . '/video.rates', 'POST', array(
            'access_token' => $access_token,
            'rating:value' => "$vote",
            'rating:scale' => "10",
            'review_text' => "$review",
            'review_link' => "http://www.berdict.com/movie/" . $fl_id . "/",
            'movie' => "http://www.berdict.com/movie/" . $fl_id . "/"
                )
        );

        if($fbshare==1){
			$ret_obj = $facebook->api('' . $fb_uid . '/feed', 'POST',
										array(
										  'link' => "http://www.berdict.com/movie/" . $fl_id . "/",
										  'message' => "Review: " . $review . ""
									 ));			
		}		
		

	
    }

    public function postFbFavourite($fl_id, $fb_uid, $access_token) {

        include 'public/facebook/facebook.php';

        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
            'appId' => '437161969726572',
            'secret' => '6ffba69aa1afab022a596fed0b75427a',
        ));

        // Post the review
        $response = $facebook->api('' . $fb_uid . '/berdict:favourite', 'POST', array(
            'access_token' => $access_token,
            'movie' => "http://www.berdict.com/movie/" . $fl_id . "/"
                )
        );
    }

    public function postFbWatchlist($fl_id, $fb_uid, $access_token) {

        include 'public/facebook/facebook.php';

        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
            'appId' => '437161969726572',
            'secret' => '6ffba69aa1afab022a596fed0b75427a',
        ));

        // Post the review
        $response = $facebook->api('' . $fb_uid . '/video.wants_to_watch', 'POST', array(
            'access_token' => $access_token,
            'movie' => "http://www.berdict.com/movie/" . $fl_id . "/"
                )
        );
    }

    public function postFbFollow($username, $fb_uid, $access_token) {

        include 'public/facebook/facebook.php';

        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
            'appId' => '437161969726572',
            'secret' => '6ffba69aa1afab022a596fed0b75427a',
        ));

        // Post the review
        $response = $facebook->api('' . $fb_uid . '/og.follows', 'POST', array(
            'access_token' => $access_token,
            'profile' => "http://www.berdict.com/" . $username . "/"
                )
        );
    }
	
    public function followAll() {

        $subject_type = 'user';                 // always user, the user who triggered this notification
        $subject_id = Auth::user()->id;         // id of the user who triggered the notification
        $object_type = 'user';
        $object_id = Auth::user()->id;
        $type = 'follow';

        $friend = DB::table('user_facebook')
                ->where('ufb_usr_id', Auth::user()->id)
                ->join('users', 'users.oauth_id', '=', 'user_facebook.ufb_friend_id')
                ->get();

        foreach ($friend as $friend) {
            // check if already following
            $follow = $this->followCheck($friend->id);
            if ($follow) {

                // if not then follow     
            } else {

                $query = DB::table('user_friends')->insertGetId(
                        array(
                            'friend_user_id' => $friend->id,
                            'follower_user_id' => Auth::user()->id
                        )
                );
                // creating a notification
                $noti = new Notification;                    // notification instance
                $noti->user_id = $friend->id;                // the user who will get this notification
                $noti->subject_type = $subject_type;         // user
                $noti->subject_id = $subject_id;             // the uset who liked the review
                $noti->object_type = $object_type;           // object is review 
                $noti->object_id = $object_id;               // id of the review in picture
                $noti->type = $type;                         // liked - notification type
                $noti->read = '0';                           // default '0' as it is unread
                $noti->time = \time();                       // default '0' as it is unread
                $noti->save(); 
				
				// insert into the user actions
                $act = new Activity;               // notification instance
                $act->type_id = '4';                   // the user who will get this notification
                $act->subject_id = $subject_id;   // user
                $act->object_type = 'user';            // object is review 
                $act->object_id = $friend->id;               // id of the review in picture
                $act->action_date = \time();           // default '0' as it is unread
                $act->save();                          // saves activity     
				
				$mail = new UsersController;
				$mail->newFollowMail($friend->id);
            }
        }
    }	
	
    /**
     * checks user follow , id is required to check 
     *
     * @param  int  $id
     * @return Response
     */
    public function followCheck($id) {

        return DB::table('user_friends')
                        ->where('friend_user_id', $id)
                        ->where('follower_user_id', Auth::user()->id)
                        ->first();
    }	
	
	public function generateRandomString($length = 50) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
		return $randomString;
	}		

}
