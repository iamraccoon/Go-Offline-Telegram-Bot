<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160521_121210_LogTable extends Migration
{
    private $tableName = 'log';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci COMMENT="Лог запросов" AUTO_INCREMENT=1';
        }

        $this->createTable($this->tableName, [
               'id' => Schema::TYPE_PK,
               'userId' => Schema::TYPE_INTEGER,
               'message' => Schema::TYPE_TEXT,
               'createAt' => Schema::TYPE_DATETIME
           ],
           $tableOptions
        );

        $this->createIndex('userId', $this->tableName, 'userId');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
