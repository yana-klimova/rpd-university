<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discipline}}`.
 */
class m190206_192911_create_discipline_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%discipline}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'semester' => $this->integer()->notNull(),
            'year' => $this->integer()->notNull(),
            'department' => $this->string()->notNull(),
            'direction' => $this->string()->notNull(),
            'profile' => $this->string()->notNull(),
            'qualification' => $this->string()->notNull(),
            'form_study' => $this->string()->notNull(),
            'short_department' => $this->string(),
            'lecture' => $this->integer(),
            'practice' => $this->integer(),
            'lab' => $this->integer(),
            'selfwork' => $this->integer(),
            'control_t' => $this->integer(),
            'control' => $this->string(),
            'fulltime_contact' => $this->integer(),
            'fulltime' => $this->integer(),
            'unit' => $this->integer(),
            'course' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%discipline}}');
    }
}
