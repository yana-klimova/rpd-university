<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_intermediate_certification}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%discipline}}`
 */
class m190206_213307_create_task_intermediate_certification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_intermediate_certification}}', [
            'id' => $this->primaryKey(),
            'tasks' => $this->text()->notNull(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-task_intermediate_certification-id_discipline}}',
            '{{%task_intermediate_certification}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-task_intermediate_certification-id_discipline}}',
            '{{%task_intermediate_certification}}',
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
            '{{%fk-task_intermediate_certification-id_discipline}}',
            '{{%task_intermediate_certification}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-task_intermediate_certification-id_discipline}}',
            '{{%task_intermediate_certification}}'
        );

        $this->dropTable('{{%task_intermediate_certification}}');
    }
}
