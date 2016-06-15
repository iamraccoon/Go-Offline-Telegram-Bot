<?php

namespace app\components\helpers;

/**
 * Class Date
 * @package app\components\helpers
 */
class DateHelper
{
    /**
     * @param $date
     *
     * @return string
     */
    public static function format($date)
    {
        $date = new \DateTime($date);
        $result = $date->format('d.m.Y') . ' в ' . $date->format('h:m');

        return $result;
    }
} 