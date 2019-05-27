<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section_practice}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%section}}`
 * - `{{%practice}}`
 */
class m190209_153349_create_section_practice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section_practice}}', [
            'id' => $this->primaryKey(),
            'id_section' => $this->integer()->notNull(),
            'id_practice' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_section`
        $this->createIndex(
            '{{%idx-section_practice-id_section}}',
            '{{%section_practice}}',
            'id_section'
        );

        // add foreign key for table `{{%section}}`
        $this->addForeignKey(
            '{{%fk-section_practice-id_section}}',
            '{{%section_practice}}',
            'id_section',
            '{{%section}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_practice`
        $this->createIndex(
            '{{%idx-section_practice-id_practice}}',
            '{{%section_practice}}',
            'id_practice'
        );

        // add foreign key for table `{{%practice}}`
        $this->addForeignKey(
            '{{%fk-section_practice-id_practice}}',
            '{{%section_practice}}',
            'id_practice',
            '{{%practice}}',
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
            '{{%fk-section_practice-id_section}}',
            '{{%section_practice}}'
        );

        // drops index for column `id_section`
        $this->dropIndex(
            '{{%idx-section_practice-id_section}}',
            '{{%section_practice}}'
        );

        // drops foreign key for table `{{%practice}}`
        $this->dropForeignKey(
            '{{%fk-section_practice-id_practice}}',
            '{{%section_practice}}'
        );

        // drops index for column `id_practice`
        $this->dropIndex(
            '{{%idx-section_practice-id_practice}}',
            '{{%section_practice}}'
        );

        $this->dropTable('{{%section_practice}}');
    }
}
