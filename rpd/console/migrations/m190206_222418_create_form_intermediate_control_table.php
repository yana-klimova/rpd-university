<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%form_intermediate_control}}`.
 */
class m190206_222418_create_form_intermediate_control_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%form_intermediate_control}}', [
            'id' => $this->primaryKey(),
            'form_control' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%form_intermediate_control}}');
    }
}
