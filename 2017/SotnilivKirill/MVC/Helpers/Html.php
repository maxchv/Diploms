<?php namespace MVC\Helpers;

class Html
{
    public static function actionLink($action, $link, $controller = '', $id = '', $attr = [])
    {
        //echo "<a href='http://blogdiplom.zzz.com.ua/$controller/$action/$id'>$link</a>";
        echo "<a href='/$controller/$action/$id'>$link</a>";
    }
}