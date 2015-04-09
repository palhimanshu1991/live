<?php

class Favourite extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'fav_usr_id';
    public $fillable = array('fav_usr_id', 'fav_fl_id', 'fav_updated_date');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $guarded = array('fav_id');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public static $rules = array();

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_fav';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $timestamps = false;



}
