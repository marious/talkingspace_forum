<?php

namespace App\models;

use Illuminate\Database\Capsule\Manager as DB;

class Replies
{
    public static $rules = [
        'body' => 'required|min:5'
    ];

    public static function getReplies()
    {
        return DB::talbe('replies')->get();
    }

    public static function create($data = array())
    {
        return DB::table('replies')->insert($data);
    }

    public static function getRepliesForTopic($id)
    {
        return DB::table('replies')
                    ->join('users', 'replies.user_id', '=', 'users.id')
                    ->select('replies.body', 'users.avatar', 'users.username')
                    ->get();
    }

    public static function countRepliesForTopic($topic_id = null)
    {
        return DB::table('replies')->where('topic_id', '=', $topic_id)->count();
    }
}