<?php

class Watchlist extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'uw_usr_id';
    public $fillable = array('uw_usr_id', 'uw_fl_id', 'uw_updated_date', 'uw_status');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $guarded = array('uw_id');

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
    protected $table = 'user_watchlist';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public function film() {
        return $this->hasOne('Movie');
    }

}
