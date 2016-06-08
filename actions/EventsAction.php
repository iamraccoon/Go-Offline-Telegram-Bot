<?php

namespace app\actions;

use app\models\Event;
use yii;
use yii\base\Action;

class EventsAction extends Action
{
    private $dateEvents;

    private $message = '';

    private $emptyMessage = 'Тусовок нет, сидит дома ((';

    public function beforeRun()
    {
        $this->dateEvents = $this->getDate();

        return true;
    }

    public function run()
    {
        $data = Event::find()->select('*')->where(['>', 'date', $this->dateEvents])->orderBy('date')->asArray()->all();

        $message = [];
        foreach ($data as $cur) {
            $message[] = '<b>' . $cur['name'] . '</b>';
        }

        $this->message = implode('<br/>', $message);

        return $this->message ?: $this->emptyMessage;
    }

    private function getDate()
    {
        $date = new \DateTime();
        $date->modify('+3 hour');
        return $date->format('Y-m-d H:i:s');
    }
}