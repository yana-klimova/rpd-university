<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%control_know}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%know}}`
 * - `{{%type_control}}`
 */
class m190206_221459_create_control_know_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%control_know}}', [
            'id' => $this->primaryKey(),
            'id_know' => $this->integer()->notNull(),
            'id_type_control' => $this->integer()->notNull()->defaultValue(1),
        ]);

        // creates index for column `id_know`
        $this->createIndex(
            '{{%idx-control_know-id_know}}',
            '{{%control_know}}',
            'id_know'
        );

        // add foreign key for table `{{%know}}`
        $this->addForeignKey(
            '{{%fk-control_know-id_know}}',
            '{{%control_know}}',
            'id_know',
            '{{%know}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_type_control`
        $this->createIndex(
            '{{%idx-control_know-id_type_control}}',
            '{{%control_know}}',
            'id_type_control'
        );

        // add foreign key for table `{{%type_control}}`
        $this->addForeignKey(
            '{{%fk-control_know-id_type_control}}',
            '{{%control_know}}',
            'id_type_control',
            '{{%type_control}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%know}}`
        $this->dropForeignKey(
            '{{%fk-control_know-id_know}}',
            '{{%control_know}}'
        );

        // drops index for column `id_know`
        $this->dropIndex(
            '{{%idx-control_know-id_know}}',
            '{{%control_know}}'
        );

        // drops foreign key for table `{{%type_control}}`
        $this->dropForeignKey(
            '{{%fk-control_know-id_type_control}}',
            '{{%control_know}}'
        );

        // drops index for column `id_type_control`
        $this->dropIndex(
            '{{%idx-control_know-id_type_control}}',
            '{{%control_know}}'
        );

        $this->dropTable('{{%control_know}}');
    }
}
