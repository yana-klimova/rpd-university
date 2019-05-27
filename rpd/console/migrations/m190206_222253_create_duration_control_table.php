<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%duration_control}}`.
 */
class m190206_222253_create_duration_control_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%duration_control}}', [
            'id' => $this->primaryKey(),
            'duration' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%duration_control}}');
    }
}
