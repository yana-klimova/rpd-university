<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%material}}`.
 */
class m190505_145530_create_material_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%material}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'description'=>$this->text(),
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
        $this->dropTable('{{%material}}');
    }
}
