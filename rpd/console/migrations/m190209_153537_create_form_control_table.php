<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%form_control}}`.
 */
class m190209_153537_create_form_control_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%form_control}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%form_control}}');
    }
}
