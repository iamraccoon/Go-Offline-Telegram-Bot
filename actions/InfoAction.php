<?php

namespace app\actions;

use app\components\telegram\Message;
use yii;
use yii\base\Action;

class InfoAction extends Action
{
    public function run()
    {
        return Message::info();
    }
}