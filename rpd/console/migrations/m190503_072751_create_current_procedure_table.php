<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%current_procedure}}`.
 */
class m190503_072751_create_current_procedure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%current_procedure}}', [
            'id' => $this->primaryKey(),
            'id_discipline' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%current_procedure}}');
    }
}
