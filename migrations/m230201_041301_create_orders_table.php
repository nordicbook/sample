<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m230201_041301_create_orders_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'userPhone' => $this->string(),
            'status' => $this->smallInteger(),
            'comment' => $this->text(),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('now()'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('now()'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
