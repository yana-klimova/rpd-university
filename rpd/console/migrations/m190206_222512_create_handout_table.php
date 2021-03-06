<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%handout}}`.
 */
class m190206_222512_create_handout_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%handout}}', [
            'id' => $this->primaryKey(),
            'material' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%handout}}');
    }
}
