<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use app\components\helpers\DateHelper;
use app\components\telegram\Command;
use app\models\Event;
use Carbon\Carbon;
use Coduo\PHPHumanizer\StringHumanizer;
use Longman\TelegramBot\Entities\InlineKeyboardButton;
use Longman\TelegramBot\Request;

/**
 * Class EventsCommand
 * @package Longman\TelegramBot\Commands\UserCommands
 */
class EventsCommand extends Command
{
    /**
     * @const int
     */
    const HOURS_AFTER_BEGINNING_EVENT = 2;

    /**
     * @const int
     */
    const TRUNCATE_CHARACTER_COUNT = 2;
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

        $messages = [];
        foreach ($data as $cur) {
            $date = '<em>' . DateHelper::format($cur['date']) . '</em>';
            $name = '<b>' . $cur['name'] . '</b>';
            $messages[] = $date . "\n" . $name;

            $this->inlineKeyboard[] = new InlineKeyboardButton([
                'text' => StringHumanizer::truncate($cur['name'], self::TRUNCATE_CHARACTER_COUNT),
                'callback_data' => '/events'
            ]);
        }

        if (count($messages)) {
            $this->text = implode("\n\n", $messages);
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
        return Carbon::now()->subHours(self::HOURS_AFTER_BEGINNING_EVENT);
    }
}