<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_verification_task}}`.
 */
class m190206_222641_create_type_verification_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_verification_task}}', [
            'id' => $this->primaryKey(),
            'type_task' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_verification_task}}');
    }
}
