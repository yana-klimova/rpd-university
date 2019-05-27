<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%own}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%competency_discipline}}`
 */
class m190206_215434_create_own_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%own}}', [
            'id' => $this->primaryKey(),
            'own' => $this->text()->notNull(),
            'id_competency_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_competency_discipline`
        $this->createIndex(
            '{{%idx-own-id_competency_discipline}}',
            '{{%own}}',
            'id_competency_discipline'
        );

        // add foreign key for table `{{%competency_discipline}}`
        $this->addForeignKey(
            '{{%fk-own-id_competency_discipline}}',
            '{{%own}}',
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
            '{{%fk-own-id_competency_discipline}}',
            '{{%own}}'
        );

        // drops index for column `id_competency_discipline`
        $this->dropIndex(
            '{{%idx-own-id_competency_discipline}}',
            '{{%own}}'
        );

        $this->dropTable('{{%own}}');
    }
}
