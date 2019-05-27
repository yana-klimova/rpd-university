<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%control_own}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%own}}`
 * - `{{%type_control}}`
 */
class m190206_221532_create_control_own_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%control_own}}', [
            'id' => $this->primaryKey(),
            'id_own' => $this->integer()->notNull(),
            'id_type_control' => $this->integer()->notNull()->defaultValue(1),
        ]);

        // creates index for column `id_own`
        $this->createIndex(
            '{{%idx-control_own-id_own}}',
            '{{%control_own}}',
            'id_own'
        );

        // add foreign key for table `{{%own}}`
        $this->addForeignKey(
            '{{%fk-control_own-id_own}}',
            '{{%control_own}}',
            'id_own',
            '{{%own}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_type_control`
        $this->createIndex(
            '{{%idx-control_own-id_type_control}}',
            '{{%control_own}}',
            'id_type_control'
        );

        // add foreign key for table `{{%type_control}}`
        $this->addForeignKey(
            '{{%fk-control_own-id_type_control}}',
            '{{%control_own}}',
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
        // drops foreign key for table `{{%own}}`
        $this->dropForeignKey(
            '{{%fk-control_own-id_own}}',
            '{{%control_own}}'
        );

        // drops index for column `id_own`
        $this->dropIndex(
            '{{%idx-control_own-id_own}}',
            '{{%control_own}}'
        );

        // drops foreign key for table `{{%type_control}}`
        $this->dropForeignKey(
            '{{%fk-control_own-id_type_control}}',
            '{{%control_own}}'
        );

        // drops index for column `id_type_control`
        $this->dropIndex(
            '{{%idx-control_own-id_type_control}}',
            '{{%control_own}}'
        );

        $this->dropTable('{{%control_own}}');
    }
}
