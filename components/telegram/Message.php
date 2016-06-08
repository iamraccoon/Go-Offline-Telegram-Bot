<?php

namespace app\components\telegram;

/**
 * Class Message
 * @package app\components\telegram
 */
class Message
{
    public static function joy($query)
    {
        return $query;
    }

    /**
     * @return string
     */
    public static function start()
    {
        return 'Gо Offline не ставит перед собой никаких целей, кроме как встать из-за компьютера и пообщаться с живыми людьми.';
    }

    public static function help()
    {
        return 'help';
    }
}