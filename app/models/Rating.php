<?php

class Rating extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'rt_id';
    public $fillable = array();

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $guarded = array();

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
    protected $table = 'rating';

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


}
