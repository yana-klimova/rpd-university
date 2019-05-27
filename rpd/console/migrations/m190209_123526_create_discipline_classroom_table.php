<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discipline_classroom}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%classroom}}`
 * - `{{%discipline}}`
 */
class m190209_123526_create_discipline_classroom_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%discipline_classroom}}', [
            'id' => $this->primaryKey(),
            'id_classroom' => $this->integer()->notNull(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_classroom`
        $this->createIndex(
            '{{%idx-discipline_classroom-id_classroom}}',
            '{{%discipline_classroom}}',
            'id_classroom'
        );

        // add foreign key for table `{{%classroom}}`
        $this->addForeignKey(
            '{{%fk-discipline_classroom-id_classroom}}',
            '{{%discipline_classroom}}',
            'id_classroom',
            '{{%classroom}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-discipline_classroom-id_discipline}}',
            '{{%discipline_classroom}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-discipline_classroom-id_discipline}}',
            '{{%discipline_classroom}}',
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
        // drops foreign key for table `{{%classroom}}`
        $this->dropForeignKey(
            '{{%fk-discipline_classroom-id_classroom}}',
            '{{%discipline_classroom}}'
        );

        // drops index for column `id_classroom`
        $this->dropIndex(
            '{{%idx-discipline_classroom-id_classroom}}',
            '{{%discipline_classroom}}'
        );

        // drops foreign key for table `{{%discipline}}`
        $this->dropForeignKey(
            '{{%fk-discipline_classroom-id_discipline}}',
            '{{%discipline_classroom}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-discipline_classroom-id_discipline}}',
            '{{%discipline_classroom}}'
        );

        $this->dropTable('{{%discipline_classroom}}');
    }
}
