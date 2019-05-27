<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tab}}`.
 */
class m190512_234541_create_tab_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tab}}', [
            'id' => $this->primaryKey(),
            'tab_name'=>$this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tab}}');
    }
}
