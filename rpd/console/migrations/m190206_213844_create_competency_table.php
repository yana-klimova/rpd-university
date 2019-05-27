<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%competency}}`.
 */
class m190206_213844_create_competency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%competency}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->unique(),
            'description' => $this->text()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%competency}}');
    }
}
