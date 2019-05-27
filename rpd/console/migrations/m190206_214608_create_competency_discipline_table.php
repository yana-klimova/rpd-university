<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%competency_discipline}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%competency}}`
 * - `{{%discipline}}`
 */
class m190206_214608_create_competency_discipline_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%competency_discipline}}', [
            'id' => $this->primaryKey(),
            'id_code' => $this->integer()->notNull()->defaultValue(1),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_code`
        $this->createIndex(
            '{{%idx-competency_discipline-id_code}}',
            '{{%competency_discipline}}',
            'id_code'
        );

        // add foreign key for table `{{%competency}}`
        $this->addForeignKey(
            '{{%fk-competency_discipline-id_code}}',
            '{{%competency_discipline}}',
            'id_code',
            '{{%competency}}',
            'id',
            'SET DEFAULT'
        );

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-competency_discipline-id_discipline}}',
            '{{%competency_discipline}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-competency_discipline-id_discipline}}',
            '{{%competency_discipline}}',
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
        // drops foreign key for table `{{%competency}}`
        $this->dropForeignKey(
            '{{%fk-competency_discipline-id_code}}',
            '{{%competency_discipline}}'
        );

        // drops index for column `id_code`
        $this->dropIndex(
            '{{%idx-competency_discipline-id_code}}',
            '{{%competency_discipline}}'
        );

        // drops foreign key for table `{{%discipline}}`
        $this->dropForeignKey(
            '{{%fk-competency_discipline-id_discipline}}',
            '{{%competency_discipline}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-competency_discipline-id_discipline}}',
            '{{%competency_discipline}}'
        );

        $this->dropTable('{{%competency_discipline}}');
    }
}
