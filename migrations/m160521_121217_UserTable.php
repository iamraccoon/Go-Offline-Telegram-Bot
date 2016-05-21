<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160521_121217_UserTable extends Migration
{
    private $tableName = 'user';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci COMMENT="Пользователи" AUTO_INCREMENT=1';
        }

        $this->createTable($this->tableName, [
               'id' => Schema::TYPE_PK,
               'firstName' => Schema::TYPE_STRING . '(300) NOT NULL',
               'createAt' => Schema::TYPE_DATETIME,
               'updateAt' => Schema::TYPE_DATETIME,
           ],
           $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
