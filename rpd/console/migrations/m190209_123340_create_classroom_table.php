<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%classroom}}`.
 */
class m190209_123340_create_classroom_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%classroom}}', [
            'id' => $this->primaryKey(),
            'room' => $this->text()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%classroom}}');
    }
}
