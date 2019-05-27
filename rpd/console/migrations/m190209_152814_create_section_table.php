<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%discipline}}`
 */
class m190209_152814_create_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull()->unique(),
            'name' => $this->text()->notNull()->unique(),
            'content' => $this->text(),
            'question' => $this->text(),
            'lection_time' => $this->integer(),
            'practice_time' => $this->integer(),
            'lab_time' => $this->integer(),
            'selfwork_time' => $this->integer(),
            'full_time_contact' => $this->integer(),
            'full_time' => $this->integer(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-section-id_discipline}}',
            '{{%section}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-section-id_discipline}}',
            '{{%section}}',
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
            '{{%fk-section-id_discipline}}',
            '{{%section}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-section-id_discipline}}',
            '{{%section}}'
        );

        $this->dropTable('{{%section}}');
    }
}
