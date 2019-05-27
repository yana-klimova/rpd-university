<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discipline_equipment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%equipment}}`
 * - `{{%discipline}}`
 */
class m190209_130005_create_discipline_equipment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%discipline_equipment}}', [
            'id' => $this->primaryKey(),
            'id_equipment' => $this->integer()->notNull(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_equipment`
        $this->createIndex(
            '{{%idx-discipline_equipment-id_equipment}}',
            '{{%discipline_equipment}}',
            'id_equipment'
        );

        // add foreign key for table `{{%equipment}}`
        $this->addForeignKey(
            '{{%fk-discipline_equipment-id_equipment}}',
            '{{%discipline_equipment}}',
            'id_equipment',
            '{{%equipment}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-discipline_equipment-id_discipline}}',
            '{{%discipline_equipment}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-discipline_equipment-id_discipline}}',
            '{{%discipline_equipment}}',
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
        // drops foreign key for table `{{%equipment}}`
        $this->dropForeignKey(
            '{{%fk-discipline_equipment-id_equipment}}',
            '{{%discipline_equipment}}'
        );

        // drops index for column `id_equipment`
        $this->dropIndex(
            '{{%idx-discipline_equipment-id_equipment}}',
            '{{%discipline_equipment}}'
        );

        // drops foreign key for table `{{%discipline}}`
        $this->dropForeignKey(
            '{{%fk-discipline_equipment-id_discipline}}',
            '{{%discipline_equipment}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-discipline_equipment-id_discipline}}',
            '{{%discipline_equipment}}'
        );

        $this->dropTable('{{%discipline_equipment}}');
    }
}
