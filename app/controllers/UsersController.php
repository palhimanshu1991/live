<?php


class UsersController extends BaseController {

    protected $layout = 'master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('users.index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function invite() {
    
        $left = DB::table('invite_codes')->where('ic_usr_id','=',Auth::user()->id)->where('ic_sent','=','0')->get();    
        $used = DB::table('invite_codes')->where('ic_usr_id','=',Auth::user()->id)->where('ic_sent','=','1')->get();
        
        $this->layout->content = View::make('users.invite',compact('left','used'));
    
    }   

    /**
     * Display a the login page.
     *
     * @return Response
     */
    public function login() {
        return View::make('users.login');
    }

    /**
     * form for creating a new resource.
     *
     * @return Response
     */
    public function signup() {
    
        $code = Input::get('code');
    
        $check = DB::table('invite_codes')->where('ic_code','=',$code)->first();
        
        if($check) {
        
            if($check->ic_status==1){

                $show = '0';
                $error = 'This code has been already used.';    

            } else {
            
                $show = '1';
                $error = '';                
            }       
        } else {
        
            $show = '0';
            $error = '';
        }
    
        return View::make('users.signup',compact('show','error'));
    }

    /**
     * form for creating a new resource.
     *
     * @return Response
     */
    public function feed() {

        $Movies = new MoviesController();
        $critics = $Movies->getCritics(Auth::user()->id);

        $home = new HomeController();
        $recent = DB::table('film')
                ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                ->take(7)
                ->orderBy('fl_release_date', 'desc')
                ->whereRaw('fl_id NOT IN (select fs_fl_id from film_spotlight)')
                ->remember(10)
                ->get();

        $other = DB::table('film')
                ->select('fl_id', 'fl_name', 'fl_image', 'fl_year', 'fl_stars', 'fl_genre', 'fl_outline', 'fl_dir_ar_id', 'fl_releasedate')
                ->take(7)
                ->orderBy('fl_release_date', 'desc')
                ->remember(10)
                ->get();

        // gets the user details fro username
        $friend = DB::table('user_actions')
                ->leftjoin('user_friends', 'user_friends.friend_user_id', '=', 'user_actions.subject_id')
                ->join('users', 'users.id', '=', 'user_actions.subject_id')
                ->where('follower_user_id', Auth::user()->id)
                ->orWhere('user_actions.subject_id', '=', Auth::user()->id)
                ->take('20')
                ->orderBy('action_date', 'desc')
                ->get();

        $this->layout->content = View::make('users.feed', compact('friend', 'critics', 'recent', 'other'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create() {

        $fullname = Input::get('name');
        $username = Input::get('username');
        $email = Input::get('email');
        $password = Hash::make(Input::get('password'));
        $code = Input::get('code');
        
        // Variables 
        $usr_fname = ucwords(substr($fullname, 0, strpos($fullname, " ", 0)));

        if ($usr_fname == "" || $usr_fname == " ") {
            $usr_fname = ucwords(substr($fullname, strpos($fullname, " ", 0)));
            $usr_lname = '';
        } else {
            $usr_fname = ucwords(substr($fullname, 0, strpos($fullname, " ", 0)));
            $usr_lname = ucwords(substr($fullname, strpos($fullname, " ", 0)));
        }

        
        $check = User::where('username',$username)->orWhere('usr_email',$email)->first();

        if($check){
        
        
        } else {
        
            $user = new User;
            $user->usr_fname = $usr_fname;
            $user->usr_lname = $usr_lname;
            $user->username = $username;
            $user->usr_email = $email;
            $user->berdict_key = $this->generateRandomString();
            $user->password = $password;
            $user->save();

            $insertedId = $user->id;
            
            $invite = New InviteController;
            $invite->updateInvite($code);
            $invite->createCodes($insertedId);
            
            //creating a directory for the user with blank index.php
            $id = $insertedId;
            $index = ('public/user_uploads/1000/' . $id . '/index.php');

            //Makes the directories if the index file does not exist
            if (!File::exists($index)) {
                File::makeDirectory('public/user_uploads/1000/' . $id . '', 0777, true);
                $handle = fopen($index, 'x+');
                fclose($handle);
            }

            // user exit login
            $user = User::find($insertedId);
            Auth::login($user);

            return Redirect::to('/');
        
        }       
        
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {

        // gets the user details fro username
        $user = DB::table('users')
                ->where('username', $id)
                ->join('user_level', 'user_level.ul_id', '=', 'users.user_level')
                ->first();

        $follower = $this->getFollower($user->id);
        $following = $this->getFollowing($user->id);
        $followerCount = $this->getFollowerCount($user->id);
        $followingCount = $this->getFollowingCount($user->id);
        $reviewCount = $this->getReviewCount($user->id);
        $viewCount = $this->getViewCount($user->id);
        $movieCount = $this->getMovieCount($user->id);


        //gets the favourite
        $fav = $this->getFav($user->id);

        // gets the recent acitivities of the user
        $action = $this->getAction($user->id);

        // check for the follow button
        if (Auth::check()) {

            if (Auth::user()->username == $user->username) {
                $follow = '3';
            } else {

                $follow = $this->followCheck($user->id);

                if ($follow) {
                    $follow = '1';
                } else {
                    $follow = '0';
                }
            }
        } else {
            $follow = '2';
        }



        $this->layout->content = View::make('users.show', compact('user', 'fav', 'action', 'follow', 'follower', 'followerCount', 'following', 'followingCount', 'reviewCount','viewCount','movieCount'));
    }

    public function getAction($id) {

        return $action = DB::table('user_actions')
                ->leftJoin('user_actiontypes', 'user_actiontypes.actiontype_id', '=', 'user_actions.type_id')
                ->where('subject_id', $id)
                ->orderBy('action_date', 'desc')
                ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit() {


        //Define directory according to the 
        $dirname = Auth::user()->id;
        $indexfile = ("public/user_uploads/1000/" . "$dirname" . "/index.php");

        //Makes the directories if they don't exist
        if (!file_exists($indexfile)) {
            mkdir("public/user_uploads/1000/" . "$dirname", 0777);
            $handle = fopen("public/user_uploads/1000/" . "$dirname" . "/" . "index.php", 'x+');
            fclose($handle);
        }

        $user = User::find(Auth::user()->id);
        $country = DB::table('country')->where('cn_status', '1')->orderBy('cn_name', 'asc')->get();


        $this->layout->content = View::make('users.edit', compact('user', 'country'));
    }

    /**
     * Update the user with the stuff.
     *
     * @param  int  $id
     * @return Response
     */
    public function update() {

        $time = time();
        $user = User::find(Auth::user()->id);
        $dirname = Auth::user()->id;
        $crop = $this->Crop(Auth::user()->id, $time);
        $indexfile = ("public/user_uploads/1000/" . "$dirname" . "/index.php");

        if (isset($_FILES["file"]["tmp_name"])) { //If the temp name is set then proceed
            if ((($_FILES["file"]["type"] == "image/gif") //List of file types allowed
                    || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] < 4194304) //Less then 4 MB
                    && in_array($extension, $allowedExts)) {

                if ($_FILES["file"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                } else {

                    "Upload: " . $_FILES["file"]["name"] . "<br>";
                    "Type: " . $_FILES["file"]["type"] . "<br>";
                    "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                    "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                    $image_name = "$time" . "_" . $_FILES["file"]["name"];
                    move_uploaded_file($_FILES["file"]["tmp_name"], "public/user_uploads/1000/" . "$dirname" . "/" . $image_name);
                    //"Stored in: " . "user_uploads/1000/"."$dirname"."/".$image_name;
                }
            }
        } else {
            echo "Invalid file";
        }

        $image_name = Auth::user()->usr_image;

        if (isset($_FILES["image_file"]["type"])) {
            // check for image type
            if (($_FILES["image_file"]["type"] == "image/jpeg") || ($_FILES["image_file"]["type"] == "image/jpg")) {
                $sExt = '.jpg';
                $image_name = $time . $sExt;
            }
            if (($_FILES["image_file"]["type"] == "image/png")) {
                $sExt = '.png';
                $image_name = $time . $sExt;
            }
        }


        $user->usr_fname = Input::get('firstname');
        $user->usr_lname = Input::get('lastname');
        $user->usr_bio = Input::get('about_me');
        $user->usr_gender = Input::get('gender');
        $user->usr_cn_id = Input::get('country');
        $user->usr_image = $image_name;


        $user->save();

        return Redirect::to('/edit');
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
     * Get the user favourites
     *
     * @param  int  $id
     * @return Response
     */
    public function getFav($id) {

        return $fav = DB::table('user_fav')
                ->join('users', 'users.id', '=', 'user_fav.fav_usr_id')
                ->join('film', 'film.fl_id', '=', 'user_fav.fav_fl_id')
                ->where('fav_usr_id', $id)
                ->orderBy('fav_id', 'desc')
                ->take(20)
                ->get();
    }

    /**
     * User follow 
     *
     * @param  int  $id
     * @return Response
     */
    public function follow() {

        $user = Input::get('user');
        $follow = $this->followCheck($user);
        $subject_type = 'user';                 // always user, the user who triggered this notification
        $subject_id = Auth::user()->id;         // id of the user who triggered the notification
        $object_type = 'user';
        $object_id = Auth::user()->id;
        $type = 'follow';

        if ($follow) {
            
        } else {

            $query = DB::table('user_friends')->insertGetId(
                    array(
                        'friend_user_id' => $user,
                        'follower_user_id' => Auth::user()->id
                    )
            );


            // creating a notification
            $noti = new Notification;               // notification instance
            $noti->user_id = $user;                 // the user who will get this notification
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

            $mail = $this->newFollowMail($user);
        }

        $username = DB::table('users')
                ->where('id', $user)
                ->first();

        if (Auth::user()->fb_access_token) {
            $fb = new FacebookController();
            $execute = $fb->postFbFollow($username->username, Auth::user()->fb_uid, Auth::user()->fb_access_token);
        }

        if ($query) {
            return 'true';
        } else {
            return 'false';
        }
    }

    /**
     * User unfollow 
     *
     * @param  int  $id
     * @return Response
     */
    public function unfollow() {

        $user = Input::get('user');

        $query = DB::table('user_friends')
                ->where('friend_user_id', '=', $user)
                ->where('follower_user_id', '=', Auth::user()->id)
                ->delete();

        $new = DB::table('user_actions')
                ->where('type_id', '=', '4')
                ->where('subject_id', '=', Auth::user()->id)
                ->where('object_type', '=', 'user')
                ->where('object_id', '=', $user)
                ->delete();

        $new = DB::table('user_notifications')
                ->where('user_id', '=', $user)
                ->where('subject_id', '=', Auth::user()->id)
                ->where('object_type', '=', 'user')
                ->where('object_id', '=', Auth::user()->id)
                ->where('type', '=', 'follow')
                ->delete();

        if ($query) {
            return 'true';
        } else {
            return 'false';
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

    public function crop($dirname, $time) {

        $iWidth = $iHeight = 200; // desired image result dimensions
        $iJpgQuality = 100;
        $time = $time;

        if ($_FILES) {

            // if no errors and size less than 250kb
            if (!$_FILES['image_file']['error'] && $_FILES['image_file']['size'] < 2500 * 5024) {
                if (is_uploaded_file($_FILES['image_file']['tmp_name'])) {

                    // new unique filename

                    $sTempFileName = 'public/user_uploads/1000/' . "$dirname" . '/' . $time;

                    // move uploaded file into cache folder
                    move_uploaded_file($_FILES['image_file']['tmp_name'], $sTempFileName);

                    // change file permission to 644
                    @chmod($sTempFileName, 0644);

                    if (file_exists($sTempFileName) && filesize($sTempFileName) > 0) {
                        $aSize = getimagesize($sTempFileName); // try to obtain image info
                        if (!$aSize) {
                            @unlink($sTempFileName);
                            return;
                        }

                        // check for image type
                        switch ($aSize[2]) {
                            case IMAGETYPE_JPEG:
                                $sExt = '.jpg';

                                // create a new image from file 
                                $vImg = @imagecreatefromjpeg($sTempFileName);
                                break;
                            /* case IMAGETYPE_GIF:
                              $sExt = '.gif';

                              // create a new image from file
                              $vImg = @imagecreatefromgif($sTempFileName);
                              break; */
                            case IMAGETYPE_PNG:
                                $sExt = '.png';

                                // create a new image from file 
                                $vImg = @imagecreatefrompng($sTempFileName);
                                break;
                            default:
                                @unlink($sTempFileName);
                                return;
                        }

                        // create a new true color image
                        $vDstImg = @imagecreatetruecolor($iWidth, $iHeight);

                        // copy and resize part of an image with resampling
                        imagecopyresampled($vDstImg, $vImg, 0, 0, (int) $_POST['x1'], (int) $_POST['y1'], $iWidth, $iHeight, (int) $_POST['w'], (int) $_POST['h']);

                        // define a result image filename
                        $sResultFileName = $sTempFileName . $sExt;

                        // output image to file
                        imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
                        @unlink($sTempFileName);

                        return $sResultFileName;
                    }
                }
            }
        }
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

    public function UserFollowers($id) {

        // gets the user details fro username
        $user = DB::table('users')
                ->where('username', $id)
                ->remember(1)
                ->first();

        $follower = $this->getFollower($user->id);
        $following = $this->getFollowing($user->id);
        $followerCount = $this->getFollowerCount($user->id);
        $followingCount = $this->getFollowingCount($user->id);
        $reviewCount = $this->getReviewCount($user->id);

        //gets the favourite
        $fav = $this->getFav($user->id);

        // gets the recent acitivities of the user
        $action = $this->getAction($user->id);

        // check for the follow button
        if (Auth::check()) {

            if (Auth::user()->username == $user->username) {
                $follow = '3';
            } else {

                $follow = $this->followCheck($user->id);

                if ($follow) {
                    $follow = '1';
                } else {
                    $follow = '0';
                }
            }
        } else {
            $follow = '2';
        }



        $this->layout->content = View::make('users.followers', compact('user', 'fav', 'action', 'follow', 'follower', 'followerCount', 'following', 'followingCount', 'reviewCount'));
    }

    public function UserFollowing($id) {

        // gets the user details fro username
        $user = DB::table('users')
                ->where('username', $id)
                ->remember(1)
                ->first();

        $follower = $this->getFollower($user->id);
        $following = $this->getFollowing($user->id);
        $followerCount = $this->getFollowerCount($user->id);
        $followingCount = $this->getFollowingCount($user->id);
        $reviewCount = $this->getReviewCount($user->id);

        //gets the favourite
        $fav = $this->getFav($user->id);

        // gets the recent acitivities of the user
        $action = $this->getAction($user->id);

        // check for the follow button
        if (Auth::check()) {

            if (Auth::user()->username == $user->username) {
                $follow = '3';
            } else {

                $follow = $this->followCheck($user->id);

                if ($follow) {
                    $follow = '1';
                } else {
                    $follow = '0';
                }
            }
        } else {
            $follow = '2';
        }



        $this->layout->content = View::make('users.following', compact('user', 'fav', 'action', 'follow', 'follower', 'followerCount', 'following', 'followingCount', 'reviewCount'));
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
                $noti->save();                               // saves notification       
                /// insert into the user actions
                $act = new Activity;               // notification instance
                $act->type_id = '4';                   // the user who will get this notification
                $act->subject_id = $subject_id;   // user
                $act->object_type = 'user';            // object is review 
                $act->object_id = $friend->id;               // id of the review in picture
                $act->action_date = \time();           // default '0' as it is unread
                $act->save();                          // saves activity     
            }
        }

        if ($query) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function newFollowMail($subject) {

        // subject is the ID of the user who gets the email
        // object is the ID of user who is the follower or logged in user

        $user = User::where('id', $subject)->first();

        $followerCount = $this->getFollowerCount(Auth::user()->id);
        $followingCount = $this->getFollowingCount(Auth::user()->id);
        $reviewCount = $this->getReviewCount(Auth::user()->id);

        $subjectEmail = $user->usr_email;
        $subjectName = $user->usr_fname . ' ' . $user->usr_lname;
        $emailSubject = '' . $user->usr_fname . '! ' . Auth::user()->usr_fname . ' ' . Auth::user()->usr_lname . ' is now following you on Berdict.';

        $data = array(
            'subjectName' => $user->usr_fname,
            'objectName' => Auth::user()->usr_fname . ' ' . Auth::user()->usr_lname,
            'objectUsername' => Auth::user()->username,
            'objectId' => Auth::user()->id,
            'objectImage' => Auth::user()->usr_image,
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
                $mail = $this->newRandomFollowMail($user,$ran);
            }
        }

        return $ran->id." followed ".$id;

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
    
    public  function generateRandomString($length = 50) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
        return $randomString;
    }   

}
