<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question_intermediate_certification}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%discipline}}`
 */
class m190206_213104_create_question_intermediate_certification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question_intermediate_certification}}', [
            'id' => $this->primaryKey(),
            'questions' => $this->text()->notNull(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-question_intermediate_certification-id_discipline}}',
            '{{%question_intermediate_certification}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-question_intermediate_certification-id_discipline}}',
            '{{%question_intermediate_certification}}',
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
            '{{%fk-question_intermediate_certification-id_discipline}}',
            '{{%question_intermediate_certification}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-question_intermediate_certification-id_discipline}}',
            '{{%question_intermediate_certification}}'
        );

        $this->dropTable('{{%question_intermediate_certification}}');
    }
}
