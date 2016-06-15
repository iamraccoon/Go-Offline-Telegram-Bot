<?php

namespace app\models;

use Longman\TelegramBot\Exception\TelegramException;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $firstName
 * @property string $createAt
 * @property string $updateAt
 *
 * @property Log[] $logs
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createAt',
                'updatedAtAttribute' => 'updateAt',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName'], 'default'],
            [['createAt', 'updateAt'], 'safe'],
            [['firstName'], 'string', 'max' => 300],
        ];
    }

    /**
     * @param $data
     * @return bool
     * @throws TelegramException
     */
    public function checkUser($data)
    {
        if (!($user = User::find()->select('*')->where('id=:id', [':id' => $data['userId']])->one())) {

            $user = new User();
            $user->id = $data['userId'];
            $user->firstName = $data['firstName'];
            
            if (!$user->validate() or !$user->save(false)) {
                throw new TelegramException('User creation error');
            }
        } else {
//            if (!$user->update(false)) {
//                throw new TelegramException('User update error');
//            }
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
            'firstName' => 'First Name',
            'createAt' => 'Create At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['userId' => 'id']);
    }
}
