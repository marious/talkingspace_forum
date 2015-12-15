<?php

namespace App\models;

use Illuminate\Database\Capsule\Manager as DB;


class Category
{
    public static function getCategories()
    {
        global $match;

        $action = isset($match['params']['action']) ? urldecode($match['params']['action']) : 'null';

        $categories = self::categories();

        $active = (!isset($match['params']['action'])) ? 'active' : '';

        $output = "<a href=\"/topics\" class=\"list-group-item {$active}\">All Topics</a>";

        foreach ($categories as $category) {
            if (isset($action) && $action == $category->name) {
                $active = 'active';
            } else {
                $active = '';
            }
            $output .= "<a href='/topics/category/" . urlencode($category->name) . "' class=\"list-group-item {$active}\">{$category->name}</a>";
        }

        return $output;

    }

    public static function categories()
    {
        return DB::table('categories')->get();
    }

    public static function count()
    {
        return DB::table('categories')->count();
    }

}