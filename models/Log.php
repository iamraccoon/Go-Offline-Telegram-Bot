<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $message
 * @property string $createAt
 *
 * @property User $user
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId'], 'integer'],
            [['message'], 'default'],
            [['createAt'], 'safe'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function saveLog($data)
    {
        $log = new Log();
        $log->load($data, '');
        $log->setAttribute('createAt', new Expression('NOW()'));

        if (!$log->validate() or !$log->save(false)) {
            throw new \Exception('Log creation error');
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'message' => 'Message',
            'createAt' => 'Create At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
