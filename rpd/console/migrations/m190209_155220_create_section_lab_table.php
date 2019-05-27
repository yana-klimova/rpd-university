<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section_lab}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%section}}`
 * - `{{%lab_work}}`
 */
class m190209_155220_create_section_lab_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section_lab}}', [
            'id' => $this->primaryKey(),
            'id_section' => $this->integer()->notNull(),
            'id_lab' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_section`
        $this->createIndex(
            '{{%idx-section_lab-id_section}}',
            '{{%section_lab}}',
            'id_section'
        );

        // add foreign key for table `{{%section}}`
        $this->addForeignKey(
            '{{%fk-section_lab-id_section}}',
            '{{%section_lab}}',
            'id_section',
            '{{%section}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_lab`
        $this->createIndex(
            '{{%idx-section_lab-id_lab}}',
            '{{%section_lab}}',
            'id_lab'
        );

        // add foreign key for table `{{%lab_work}}`
        $this->addForeignKey(
            '{{%fk-section_lab-id_lab}}',
            '{{%section_lab}}',
            'id_lab',
            '{{%lab_work}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%section}}`
        $this->dropForeignKey(
            '{{%fk-section_lab-id_section}}',
            '{{%section_lab}}'
        );

        // drops index for column `id_section`
        $this->dropIndex(
            '{{%idx-section_lab-id_section}}',
            '{{%section_lab}}'
        );

        // drops foreign key for table `{{%lab_work}}`
        $this->dropForeignKey(
            '{{%fk-section_lab-id_lab}}',
            '{{%section_lab}}'
        );

        // drops index for column `id_lab`
        $this->dropIndex(
            '{{%idx-section_lab-id_lab}}',
            '{{%section_lab}}'
        );

        $this->dropTable('{{%section_lab}}');
    }
}
