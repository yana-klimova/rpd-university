<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%additionally_equipment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%discipline}}`
 */
class m190209_130136_create_additionally_equipment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%additionally_equipment}}', [
            'id' => $this->primaryKey(),
            'equipment' => $this->text()->notNull(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-additionally_equipment-id_discipline}}',
            '{{%additionally_equipment}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-additionally_equipment-id_discipline}}',
            '{{%additionally_equipment}}',
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
            '{{%fk-additionally_equipment-id_discipline}}',
            '{{%additionally_equipment}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-additionally_equipment-id_discipline}}',
            '{{%additionally_equipment}}'
        );

        $this->dropTable('{{%additionally_equipment}}');
    }
}
