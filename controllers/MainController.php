<?php

namespace app\controllers;

use yii;
use yii\base\Controller;

class MainController extends Controller
{
//    public function behaviors()
//    {
//        return [
//            'user' => [
//                'class' => 'app\components\behaviors\UserBehavior',
//                'actions' => array_keys($this->actions()),
//                'currentAction' => Yii::$app->controller->action->id
//            ],
//            'log' => [
//                'class' => 'app\components\behaviors\LogBehavior',
//                'actions' => array_keys($this->actions()),
//                'currentAction' => Yii::$app->controller->action->id
//            ]
//        ];
//    }

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