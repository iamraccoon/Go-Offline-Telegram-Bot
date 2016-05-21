<?php

namespace app\components\telegram;

use yii;

/**
 * Class BotAction
 * @package app\components\telegram
 */
class BotAction
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    public $actionsList = [
        'start',
        'help',
        'chat',
        'info'
    ];

    /**
     * @param $controller
     * @param $action
     * @return int|mixed
     */
    public function makeAnswer($controller, $action)
    {
        $this->action = $this->getActionName($action);

        return Yii::$app->runAction($controller . '/' . $this->action);
    }

    /**
     * @param $action
     * @return mixed
     */
    private function getActionName($action)
    {
        if (in_array($action, $this->actionsList)) {
            return $action;
        }

        return Yii::$app->bot->methodDefault;
    }
} 