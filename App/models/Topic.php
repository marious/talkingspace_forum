<?php

namespace App\models;

use Illuminate\Database\Capsule\Manager as DB;

class Topic
{

    public static $createTopicRules = [
        'title' => 'required|min:5',
        'category' => 'required',
        'body' => 'required|min:10'
    ];


    public static function allTopics($limit = 100, $offset = 0)
    {
        return DB::table('topics')
                    ->join('users', 'topics.user_id', '=', 'users.id')
                    ->join('categories', 'topics.category_id', '=', 'categories.id')
                    ->select('topics.*', 'users.name as user_name', 'users.avatar', 'categories.name as category_name')
                    ->orderBy('topics.create_date', 'desc')
                    ->limit($limit)
                    ->offset($offset)
                    ->get();
    }

    public static function count()
    {
        return DB::table('topics')->count();
    }

    public static function topic($id)
    {
        return DB::table('topics')
                ->join('users', 'topics.user_id', '=', 'users.id')
                ->select('topics.*', 'users.username', 'users.avatar')
                ->where('topics.id', '=', $id)
                ->first();
    }

    public static function getTopicByCategory($categoryName)
    {
        return DB::table('topics')
                ->join('users', 'topics.user_id', '=', 'users.id')
                ->join('categories', 'topics.category_id', '=', 'categories.id')
                ->orderBy('topics.create_date', 'desc')
                ->select('topics.*', 'users.name as user_name', 'users.avatar', 'categories.name as category_name')
                ->where('categories.name', '=', $categoryName)
                ->get();
    }

    public static function create($data = array())
    {
        return DB::table('topics')->insert($data);
    }

}