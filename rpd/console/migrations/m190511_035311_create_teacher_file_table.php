<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teacher_file}}`.
 */
class m190511_035311_create_teacher_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%teacher_file}}', [
            'id' => $this->primaryKey(),
            'discipline_id'=>$this->integer(),
            'title'=>$this->string()->notNull(),
            'file_name'=>$this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%teacher_file}}');
    }
}
