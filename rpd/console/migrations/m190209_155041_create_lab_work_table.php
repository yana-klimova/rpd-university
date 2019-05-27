<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lab_work}}`.
 */
class m190209_155041_create_lab_work_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lab_work}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull()->unique(),
            'theme' => $this->text()->notNull(),
            'time' => $this->integer(),
            'task' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lab_work}}');
    }
}
