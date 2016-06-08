<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160604_071215_addTableEvent extends Migration
{
    private $tableName = 'event';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci COMMENT="Посиделки style opus" AUTO_INCREMENT=1';
        }

        $this->createTable($this->tableName, [
               'id' => Schema::TYPE_PK,
               'name' => Schema::TYPE_STRING,
               'img' => Schema::TYPE_STRING,
               'info' => Schema::TYPE_TEXT,
               'text' => Schema::TYPE_TEXT,
               'date' => Schema::TYPE_DATETIME
           ],
           $tableOptions
        );

        $this->createIndex('date', $this->tableName, 'date');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
