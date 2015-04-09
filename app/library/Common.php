<?php

class Common {

    public static function cleanUrl($title) {
        $title1 = str_replace(":", "-", $title);
        $title2 = str_replace(array(';','.','-', ',', '%', '&', '$', '"'), '', $title1);
        $new_title = str_replace(" ", "-", $title2);
        return $new_title;
    }
	
    public static function cleanUsername($title) {
        $title1 = str_replace(":", "-", $title);
        $title2 = str_replace(array(';','.','-', ',', '%', '&', '$', '"'), '', $title1);
        return $title2;
    }	
	
    public static function getTime($old_time) {

        $post_time = $old_time;                              // time in database 
        $time = time();                                         // current time
        $actual_date = date('d M', $post_time);         // retruns d M Y H:i:s 17 Jul 2013 11:20:23
        $diff = $time - $post_time;                             // difference between now 
        $the_time = 0;                                          // sets the initial time to 0
        if ($diff < 60) {
            $the_time = $diff . ' s';
        } else if ($diff < 120) {
            $the_time = intval($diff / 60) . ' m';
        } else if ($diff < 3600) {
            $the_time = intval($diff / 60) . ' m';
        } else if ($diff < 7200) {
            $the_time = intval($diff / 3600) . ' hr';
        } else if ($diff < 86400) {
            $the_time = intval($diff / 3600) . ' hrs';
        } else if ($diff < 172800) {
            $the_time = 'Yesterday';
        } else if ($diff > 172800) {
            $the_time = $actual_date;
        }
        
        
        return $the_time;
    }	
}
