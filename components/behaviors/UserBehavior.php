<?php

namespace app\components\behaviors;

use app\models\User;
use Longman\TelegramBot\Exception\TelegramException;
use yii;
use yii\base\Behavior;
use yii\base\Controller;

/**
 * Class UserBehavior
 * @package app\components\behaviors
 */
class UserBehavior extends Behavior
{
    /**
     * @var array
     */
    public $actions;

    /**
     * @var string
     */
    public $currentAction;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $firstName;
    
    /**
     * @return array
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    /**
     * @return bool
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function beforeAction()
    {
        if ($this->validate()) {
            if (!($user = User::find()->select('id')->where('id=:id', [':id' => $this->userId])->one())) {

                $user = new User();
                $user->id = $this->userId;
                $user->firstName = $this->firstName;
                if (!$user->validate() or !$user->save(false)) {
                    throw new TelegramException('User creation error');
                }
            } else {
//                if (!$user->update()) {
//                    throw new TelegramException('User update error');
//                }
            }
        }

        return true;
    }

    /**
     * Initializes the object
     */
    public function init()
    {
        $this->userId = Yii::$app->bot->getChatId();
        $this->firstName = Yii::$app->bot->getFirstName();
    }

    /**
     * @return bool
     */
    private function validate()
    {
        if (in_array($this->currentAction, $this->actions)) {
            return true;
        }

        return false;
    }
}
