<?php

class Post extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo('User');
    }

    public static $rules = array(
        'title'      => 'required|max:100',
        'body'       => 'required|max:10000'
    );

}
