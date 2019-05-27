<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%information}}`.
 */
class m190505_145459_create_information_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%information}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'description'=>$this->text(),
            'content'=>$this->text(),
            'material'=>$this->string(),
            'date'=>$this->date(),
            'status'=>$this->integer(),
            'for_teacher'=>$this->integer(),
            'for_organizer'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%information}}');
    }
}
