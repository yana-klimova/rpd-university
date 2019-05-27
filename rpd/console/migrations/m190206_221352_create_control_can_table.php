<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%control_can}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%can}}`
 * - `{{%type_control}}`
 */
class m190206_221352_create_control_can_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%control_can}}', [
            'id' => $this->primaryKey(),
            'id_can' => $this->integer()->notNull(),
            'id_type_control' => $this->integer()->notNull()->defaultValue(1),
        ]);

        // creates index for column `id_can`
        $this->createIndex(
            '{{%idx-control_can-id_can}}',
            '{{%control_can}}',
            'id_can'
        );

        // add foreign key for table `{{%can}}`
        $this->addForeignKey(
            '{{%fk-control_can-id_can}}',
            '{{%control_can}}',
            'id_can',
            '{{%can}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_type_control`
        $this->createIndex(
            '{{%idx-control_can-id_type_control}}',
            '{{%control_can}}',
            'id_type_control'
        );

        // add foreign key for table `{{%type_control}}`
        $this->addForeignKey(
            '{{%fk-control_can-id_type_control}}',
            '{{%control_can}}',
            'id_type_control',
            '{{%type_control}}',
            'id',
            'SET DEFAULT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%can}}`
        $this->dropForeignKey(
            '{{%fk-control_can-id_can}}',
            '{{%control_can}}'
        );

        // drops index for column `id_can`
        $this->dropIndex(
            '{{%idx-control_can-id_can}}',
            '{{%control_can}}'
        );

        // drops foreign key for table `{{%type_control}}`
        $this->dropForeignKey(
            '{{%fk-control_can-id_type_control}}',
            '{{%control_can}}'
        );

        // drops index for column `id_type_control`
        $this->dropIndex(
            '{{%idx-control_can-id_type_control}}',
            '{{%control_can}}'
        );

        $this->dropTable('{{%control_can}}');
    }
}
