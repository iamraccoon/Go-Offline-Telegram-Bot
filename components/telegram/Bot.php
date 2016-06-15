<?php

namespace app\components\telegram;

use Longman\TelegramBot\Exception\TelegramException;
use yii;
use yii\base\Configurable;
use Longman\TelegramBot\Telegram;

/**
 * Class Bot
 * @package components\telegram
 */
class Bot extends Telegram implements Configurable
{
    /**
     * @var string
     */
    public $botToken;

    /**
     * @var string
     */
    public $botName;

    /**
     * Bot constructor.
     * @param array $config
     * @throws TelegramException
     */
    public function __construct($config = [])
    {
        if (!empty($config)) {
            Yii::configure($this, $config);
        }

        if (empty($this->botToken) or empty($this->botName)) {
            throw new TelegramException('botToken and botName are both required');
        }

        parent::__construct($this->botToken, $this->botName);
    }

    /**
     * init settings
     */
    public function init()
    {
        $this->addCustomCommandsPath();
    }

    /**
     * @throws TelegramException
     */
    private function addCustomCommandsPath()
    {
        $path = Yii::getAlias('@app') . '/commands';

        parent::addCommandsPath($path, true);
    }
}