<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%current_certification}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%discipline}}`
 */
class m190206_213514_create_current_certification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%current_certification}}', [
            'id' => $this->primaryKey(),
            'tasks' => $this->text()->notNull(),
            'title' => $this->string()->notNull(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-current_certification-id_discipline}}',
            '{{%current_certification}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-current_certification-id_discipline}}',
            '{{%current_certification}}',
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
            '{{%fk-current_certification-id_discipline}}',
            '{{%current_certification}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-current_certification-id_discipline}}',
            '{{%current_certification}}'
        );

        $this->dropTable('{{%current_certification}}');
    }
}
