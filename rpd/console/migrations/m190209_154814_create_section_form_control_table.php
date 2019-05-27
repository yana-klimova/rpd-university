<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section_form_control}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%section}}`
 * - `{{%form_control}}`
 */
class m190209_154814_create_section_form_control_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section_form_control}}', [
            'id' => $this->primaryKey(),
            'id_section' => $this->integer()->notNull(),
            'id_form_control' => $this->integer()->notNull()->defaultValue(1),
        ]);

        // creates index for column `id_section`
        $this->createIndex(
            '{{%idx-section_form_control-id_section}}',
            '{{%section_form_control}}',
            'id_section'
        );

        // add foreign key for table `{{%section}}`
        $this->addForeignKey(
            '{{%fk-section_form_control-id_section}}',
            '{{%section_form_control}}',
            'id_section',
            '{{%section}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_form_control`
        $this->createIndex(
            '{{%idx-section_form_control-id_form_control}}',
            '{{%section_form_control}}',
            'id_form_control'
        );

        // add foreign key for table `{{%form_control}}`
        $this->addForeignKey(
            '{{%fk-section_form_control-id_form_control}}',
            '{{%section_form_control}}',
            'id_form_control',
            '{{%form_control}}',
            'id',
            'SET DEFAULT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%section}}`
        $this->dropForeignKey(
            '{{%fk-section_form_control-id_section}}',
            '{{%section_form_control}}'
        );

        // drops index for column `id_section`
        $this->dropIndex(
            '{{%idx-section_form_control-id_section}}',
            '{{%section_form_control}}'
        );

        // drops foreign key for table `{{%form_control}}`
        $this->dropForeignKey(
            '{{%fk-section_form_control-id_form_control}}',
            '{{%section_form_control}}'
        );

        // drops index for column `id_form_control`
        $this->dropIndex(
            '{{%idx-section_form_control-id_form_control}}',
            '{{%section_form_control}}'
        );

        $this->dropTable('{{%section_form_control}}');
    }
}
