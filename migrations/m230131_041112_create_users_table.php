<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m230131_041112_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'accessToken' => $this->string(),
            'email' => $this->string(),
            'username' => $this->string(),
            'password' => $this->string(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'status' => $this->integer(),
            'role' => $this->smallInteger(),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('now()'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('now()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
