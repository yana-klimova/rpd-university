<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%software}}`.
 */
class m190209_121610_create_software_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%software}}', [
            'id' => $this->primaryKey(),
            'software' => $this->text()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%software}}');
    }
}
