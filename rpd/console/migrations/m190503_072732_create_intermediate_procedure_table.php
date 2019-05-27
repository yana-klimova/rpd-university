<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%intermediate_procedure}}`.
 */
class m190503_072732_create_intermediate_procedure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%intermediate_procedure}}', [
            'id' => $this->primaryKey(),
            'id_discipline' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%intermediate_procedure}}');
    }
}
