<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use app\components\telegram\Command;
use Longman\TelegramBot\Request;

/**
 * Class StartCommand
 * @package Longman\TelegramBot\Commands\UserCommands
 */
class StartCommand extends Command
{
    /**
     * @return mixed
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $this->data['text'] = 'Gо Offline не ставит перед собой никаких целей, кроме как встать из-за компьютера и пообщаться с живыми людьми.';

        return Request::sendMessage($this->data);
    }
}
