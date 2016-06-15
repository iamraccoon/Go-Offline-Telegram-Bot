<?php

namespace app\components\telegram;

use app\models\Log;
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
     * @var string
     */
    protected $chatMessage;

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
        $this->chatMessage = $message->getText();

        $this->data['chat_id'] = $this->chatId;

        //!!!
        //   it's so stupid, but I can't use behaviors with this component
        //!!!
        $this->saveUser();
        $this->saveLog();

        return parent::preExecute();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function saveLog()
    {
        $log = new Log();
        $log->saveLog([
            'userId' => $this->chatId,
            'message' => $this->chatMessage
        ]);

        return true;
    }

    private function saveUser()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        return false;
    }
}