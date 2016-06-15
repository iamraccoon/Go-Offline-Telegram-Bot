<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use app\components\helpers\DateHelper;
use app\components\helpers\StringHelper;
use app\components\telegram\Command;
use app\models\Event;
use Longman\TelegramBot\Entities\InlineKeyboardButton;
use Longman\TelegramBot\Request;

/**
 * Class EventsCommand
 * @package Longman\TelegramBot\Commands\UserCommands
 */
class EventsCommand extends Command
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $dateEvents;

    /**
     * @var array
     */
    private $inlineKeyboard;

    public function execute()
    {
        $data = Event::find()->select('*')->where(['>', 'date', $this->dateEvents])->orderBy('date')->asArray()->all();

        $message = [];
        foreach ($data as $cur) {
            $date = '<em>' . DateHelper::format($cur['date']) . '</em>';
            $name = '<b>' . $cur['name'] . '</b>';
            $message[] = $date . "\n" . $name;

            $this->inlineKeyboard[] = new InlineKeyboardButton([
                'text' => StringHelper::getLimitWorlds($cur['name'], 2),
                'callback_data' => '/events'
                //'callback_data' => $cur['id']
            ]);
        }

        if (count($message)) {
            $this->text = implode("\n\n", $message);
        } else {
            $this->text = $this->getEmptyMessage();
        }

        $this->data['parse_mode'] = 'HTML';
        $this->data['text'] = $this->text;

        return Request::sendMessage($this->data);
    }

    /**
     * @return \Longman\TelegramBot\Entities\ServerResponse
     */
    public function preExecute()
    {
        $this->dateEvents = $this->getDate();

        return parent::preExecute();
    }

    /**
     * @return string
     */
    private function getEmptyMessage()
    {
        //TODO make more answers
        $message = 'Тусовок нет, го в Fallout!)';

        return $message;
    }

    /**
     * @return string
     */
    private function getDate()
    {
        $date = new \DateTime();
        $date->modify('-2 hour');

        return $date->format('Y-m-d H:i:s');
    }
}