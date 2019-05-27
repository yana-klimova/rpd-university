<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%can}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%competency_discipline}}`
 */
class m190206_215336_create_can_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%can}}', [
            'id' => $this->primaryKey(),
            'can' => $this->text()->notNull(),
            'id_competency_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_competency_discipline`
        $this->createIndex(
            '{{%idx-can-id_competency_discipline}}',
            '{{%can}}',
            'id_competency_discipline'
        );

        // add foreign key for table `{{%competency_discipline}}`
        $this->addForeignKey(
            '{{%fk-can-id_competency_discipline}}',
            '{{%can}}',
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
            '{{%fk-can-id_competency_discipline}}',
            '{{%can}}'
        );

        // drops index for column `id_competency_discipline`
        $this->dropIndex(
            '{{%idx-can-id_competency_discipline}}',
            '{{%can}}'
        );

        $this->dropTable('{{%can}}');
    }
}
