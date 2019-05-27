<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%practice}}`.
 */
class m190209_153039_create_practice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%practice}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull()->unique(),
            'theme' => $this->text()->notNull()->unique(),
            'time' => $this->integer(),
            'target' => $this->text(),
            'task' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%practice}}');
    }
}
