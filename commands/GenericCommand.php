<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use app\components\telegram\Command;
use Longman\TelegramBot\Request;

/**
 * Class GenericCommand
 * @package Longman\TelegramBot\Commands\UserCommands
 */
class GenericCommand extends Command
{
    /**
     * @return mixed
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $this->data['text'] = 'Command not found :(';

        return Request::sendMessage($this->data);
    }
}
