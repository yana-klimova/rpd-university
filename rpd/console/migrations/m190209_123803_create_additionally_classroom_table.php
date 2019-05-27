<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%additionally_classroom}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%discipline}}`
 */
class m190209_123803_create_additionally_classroom_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%additionally_classroom}}', [
            'id' => $this->primaryKey(),
            'classroom' => $this->text()->notNull(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-additionally_classroom-id_discipline}}',
            '{{%additionally_classroom}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-additionally_classroom-id_discipline}}',
            '{{%additionally_classroom}}',
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
            '{{%fk-additionally_classroom-id_discipline}}',
            '{{%additionally_classroom}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-additionally_classroom-id_discipline}}',
            '{{%additionally_classroom}}'
        );

        $this->dropTable('{{%additionally_classroom}}');
    }
}
