<?php

namespace app\components\telegram;

class Message
{
    public static function joy($query)
    {
        return $query;
    }

    public static function start()
    {
        return 'start';
    }

    public static function help()
    {
        return 'help';
    }

    public static function info()
    {
        return 'info';
    }
}