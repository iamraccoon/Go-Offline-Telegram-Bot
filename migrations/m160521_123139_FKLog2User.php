<?php

use yii\db\Migration;

class m160521_123139_FKLog2User extends Migration
{
    private $tableNameLog = 'log';
    private $tableNameUser = 'user';

    public function up()
    {
        $this->addForeignKey(
           $this->tableNameLog . '2' .$this->tableNameUser,
           $this->tableNameLog,
           'userId',
           $this->tableNameUser,
           'id',
           'CASCADE',
           'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey($this->tableNameLog . '2' .$this->tableNameUser, $this->tableNameLog);
    }
}
