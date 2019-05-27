<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%material_file}}`.
 */
class m190511_035241_create_material_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%material_file}}', [
            'id' => $this->primaryKey(),
            'material_id'=>$this->integer(),
            'title'=>$this->string()->notNull(),
            'file_name'=>$this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%material_file}}');
    }
}
