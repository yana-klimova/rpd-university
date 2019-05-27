<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%procedure}}`.
 */
class m190206_222157_create_procedure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%procedure}}', [
            'id' => $this->primaryKey(),
            'name_procedure' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%procedure}}');
    }
}
