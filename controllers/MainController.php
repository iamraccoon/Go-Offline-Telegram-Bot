<?php

namespace app\controllers;

use yii;
use yii\base\Controller;

/**
 * Class MainController
 * @package app\controllers
 */
class MainController extends Controller
{
    /**
     * Proxy action
     */
    public function actionIndex()
    {
        $bot = Yii::$app->bot;

        $bot->init();
        $bot->handle();
    }
}