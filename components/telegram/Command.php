<?php

namespace app\components\telegram;

use \Longman\TelegramBot\Commands\Command as BotCommand;

/**
 * Class Command
 * @package app\components\telegram
 */
class Command extends BotCommand
{
    /**
     * @var int
     */
    protected $chatId;

    /**
     * @var array
     */
    protected $data;

    /**
     * @return \Longman\TelegramBot\Entities\ServerResponse
     */
    public function preExecute()
    {
        $message = $this->getMessage();
        $this->chatId = (int)$message->getChat()->getId();

        $this->data['chat_id'] = $this->chatId;

        return parent::preExecute();
    }

    public function getCommand()
    {
        
    }

    /**
     * @return bool
     */
    public function execute()
    {
        return false;
    }
}