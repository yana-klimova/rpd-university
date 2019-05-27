<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%know}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%competency_discipline}}`
 */
class m190206_215415_create_know_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%know}}', [
            'id' => $this->primaryKey(),
            'know' => $this->text()->notNull(),
            'id_competency_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_competency_discipline`
        $this->createIndex(
            '{{%idx-know-id_competency_discipline}}',
            '{{%know}}',
            'id_competency_discipline'
        );

        // add foreign key for table `{{%competency_discipline}}`
        $this->addForeignKey(
            '{{%fk-know-id_competency_discipline}}',
            '{{%know}}',
            'id_competency_discipline',
            '{{%competency_discipline}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%competency_discipline}}`
        $this->dropForeignKey(
            '{{%fk-know-id_competency_discipline}}',
            '{{%know}}'
        );

        // drops index for column `id_competency_discipline`
        $this->dropIndex(
            '{{%idx-know-id_competency_discipline}}',
            '{{%know}}'
        );

        $this->dropTable('{{%know}}');
    }
}
