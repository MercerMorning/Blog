<?php
require "../../config.php";

class User extends Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    public $table = "micro_blog";
    protected $primaryKey = "id";
    protected $connection = CONNECTION_DEFAULT;

    public function posts()
    {
        return $this->hasMany('Post', 'user_id', 'id');
    }
}

class Post extends Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    public $table = "micro_blog_messages";
    protected $primaryKey = "id";
    protected $connection = CONNECTION_DEFAULT;

    public function userdata()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}