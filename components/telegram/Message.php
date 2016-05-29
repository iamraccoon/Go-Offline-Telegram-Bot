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
        return 'Gо Offline не ставит перед собой никаких целей, кроме как встать из-за компьютера и пообщаться с живыми людьми.';
    }
}