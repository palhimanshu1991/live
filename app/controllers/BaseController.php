<?php

class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    // retunrs the number of unread notifications
    public function notCount() {

        return DB::table('user_notifications')
                        ->where('user_id', Auth::user()->id)
                        ->where('read', '=', '0')
                        ->count();
    }

    public function noti() {

        return DB::table('user_notifications')
                        ->where('user_id', Auth::user()->id)
                        ->where('read', '=', '0')
                        ->orderBy('time','desc')
                        ->get();
    }

    public function getTime($old_time) {

        $post_time = $old_time;                              // time in database 
        $time = time();                                         // current time
        $actual_date = date('d M Y', $post_time);         // retruns d M Y H:i:s 17 Jul 2013 11:20:23
        $diff = $time - $post_time;                             // difference between now 
        $the_time = 0;                                          // sets the initial time to 0
        if ($diff < 60) {
            $the_time = $diff . ' seconds ago';
        } else if ($diff < 120) {
            $the_time = intval($diff / 60) . ' minute ago';
        } else if ($diff < 3600) {
            $the_time = intval($diff / 60) . ' minutes ago';
        } else if ($diff < 7200) {
            $the_time = intval($diff / 3600) . ' hour ago';
        } else if ($diff < 86400) {
            $the_time = intval($diff / 3600) . ' hours ago';
        } else if ($diff < 172800) {
            $the_time = 'Yesterday';
        } else if ($diff > 172800) {
            $the_time = $actual_date;
        }
        
        
        return $the_time;
    }

}
