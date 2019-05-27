<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%form_report}}`.
 */
class m190206_222739_create_form_report_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%form_report}}', [
            'id' => $this->primaryKey(),
            'report' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%form_report}}');
    }
}
