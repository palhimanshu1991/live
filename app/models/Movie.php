<?php

class Movie extends Eloquent {

    protected $guarded = array();
    public static $rules = array();
    public $primaryKey = 'fl_id';
    protected $table = 'film';
    public $timestamps = false;

}
