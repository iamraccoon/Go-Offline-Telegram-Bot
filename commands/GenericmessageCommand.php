<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use app\components\telegram\Command;
use Longman\TelegramBot\Request;

/**
 * Generic message command
 */
class GenericmessageCommand extends Command
{
    /**
     * @return mixed
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $this->data['text'] = 'Нэт!';

        return Request::sendMessage($this->data);
    }
}
