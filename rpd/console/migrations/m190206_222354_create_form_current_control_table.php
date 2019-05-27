<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%form_current_control}}`.
 */
class m190206_222354_create_form_current_control_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%form_current_control}}', [
            'id' => $this->primaryKey(),
            'form_control' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%form_current_control}}');
    }
}
