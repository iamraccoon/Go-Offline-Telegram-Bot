<?php

namespace app\actions;

use app\components\telegram\Message;
use yii\base\Action;

class HelpAction extends Action
{
    public function run()
    {
        return Message::help();
    }
}