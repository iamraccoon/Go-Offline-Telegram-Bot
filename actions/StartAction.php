<?php

namespace app\actions;

use Yii;
use app\components\telegram\Message;
use yii\base\Action;

class StartAction extends Action
{
    public function run()
    {
        return Message::start();
    }
}