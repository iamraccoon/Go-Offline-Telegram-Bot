<?php

namespace app\actions;

use app\components\telegram\Message;
use yii;
use yii\base\Action;

class JoyAction extends Action
{
    public function run()
    {
        return Message::joy(Yii::$app->bot->getMessage());
    }
}