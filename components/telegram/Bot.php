<?php

namespace app\components\telegram;

use Longman\TelegramBot\Exception\TelegramException;
use yii;
use yii\base\Configurable;
use yii\helpers\Json;
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
    public $api_key;

    /**
     * @var string
     */
    public $bot_name;

    /**
     * @var string
     */
    public $controllerName;

    /**
     * @var string
     */
    public $methodDefault;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $request;

    /**
     * @var int
     */
    private $chatId;

    /**
     * @var string
     */
    private $message;

    /**
     * @throws Exception
     */
    public function init()
    {
        $this->getRequest();
        $this->getMethodName();
        $this->getMessage();
    }

    public function __construct($config = [])
    {
        if (!empty($config)) {
            Yii::configure($this, $config);
        }

        if (empty($this->api_key)) {
            throw new TelegramException('api_key is required');
        }

        parent::__construct($this->api_key, $this->bot_name);
    }

    /**
     * @throws Exception
     */
    private function getRequest()
    {
        $input = file_get_contents("php://input");
        $this->request = Json::decode($input);

        if (!isset($this->request['message']['text'])) {
            throw new Exception('Indefinite text in request');
        }
    }

    /**
     * @return string
     */
    private function getMethodName()
    {
        if ($this->method) {
            return $this->method;
        }

        $this->method = $this->methodDefault;
        if (isset($this->request['message']['text']) and (substr($this->request['message']['text'], 0, 1) === '/')) {
            $this->method = substr($this->request['message']['text'], 1);
        }

        return $this->method;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        if (isset($this->request['message']['text'])) {
            $this->message = $this->request['message']['text'];
        }

        return $this->message;
    }

    /**
     * @return int
     */
    public function getChatId()
    {
        $this->chatId = $this->getMessageFromRequest('id');

        return (int)$this->chatId;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->getMessageFromRequest('first_name');
    }

    /**
     * @param $param
     * @return string
     */
    private function getMessageFromRequest($param)
    {
        if (isset($this->request['message']['from'][$param])) {
            return $this->request['message']['from'][$param];
        }

        return '';
    }

    /**
     * @return int|mixed
     */
    public function makeAnswer()
    {
        $botAction = new BotAction();
        $answer = $botAction->makeAnswer($this->controllerName, $this->getMethodName());

        return $answer;
    }
}