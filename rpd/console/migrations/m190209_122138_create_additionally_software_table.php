<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%additionally_software}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%discipline}}`
 */
class m190209_122138_create_additionally_software_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%additionally_software}}', [
            'id' => $this->primaryKey(),
            'software' => $this->text()->notNull(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-additionally_software-id_discipline}}',
            '{{%additionally_software}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-additionally_software-id_discipline}}',
            '{{%additionally_software}}',
            'id_discipline',
            '{{%discipline}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%discipline}}`
        $this->dropForeignKey(
            '{{%fk-additionally_software-id_discipline}}',
            '{{%additionally_software}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-additionally_software-id_discipline}}',
            '{{%additionally_software}}'
        );

        $this->dropTable('{{%additionally_software}}');
    }
}
