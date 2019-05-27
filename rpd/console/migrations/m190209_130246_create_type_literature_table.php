<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_literature}}`.
 */
class m190209_130246_create_type_literature_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_literature}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_literature}}');
    }
}
