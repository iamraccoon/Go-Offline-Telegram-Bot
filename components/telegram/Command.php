<?php

namespace app\components\telegram;

use app\models\Log;
use app\models\User;
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
     * @var string
     */
    protected $firstName;

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
        $this->firstName = $message->getChat()->getFirstName();

        $this->data['chat_id'] = $this->chatId;

        //!!!
        //   it's so stupid, but I can't use behaviors with this component
        //!!!
        $this->saveSystemDate();

        return parent::preExecute();
    }

    /**
     * @return bool
     */
    private function saveSystemDate()
    {
        $this->saveUser();
        $this->saveLog();

        return true;
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

    /**
     * @return bool
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    private function saveUser()
    {
        $log = new User();
        $log->checkUser([
            'userId' => $this->chatId,
            'firstName' => $this->firstName
        ]);

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