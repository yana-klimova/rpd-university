<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%information_file}}`.
 */
class m190510_154424_create_information_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%information_file}}', [
            'id' => $this->primaryKey(),
            'information_id'=>$this->integer(),
            'title'=>$this->string()->notNull(),
            'file_name'=>$this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%information_file}}');
    }
}
