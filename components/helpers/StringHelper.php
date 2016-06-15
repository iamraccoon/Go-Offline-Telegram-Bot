<?php

namespace app\components\helpers;

use yii\helpers\StringHelper as Helper;

/**
 * Class Text
 * @package app\components\helpers
 */
class StringHelper extends Helper
{
    /**
     * @param $text
     * @param $limit
     *
     * @return string
     */
    public static function getLimitWorlds($text, $limit)
    {
        $tmp = explode(' ', $text);
        $string = implode(' ', array_slice($tmp, 0, $limit));

        return $string;
    }
} 