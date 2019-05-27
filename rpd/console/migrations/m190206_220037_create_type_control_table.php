<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_control}}`.
 */
class m190206_220037_create_type_control_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_control}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_control}}');
    }
}
