<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discipline_literature}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%type_literature}}`
 * - `{{%discipline}}`
 */
class m190209_131039_create_discipline_literature_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%discipline_literature}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull(),
            'authors' => $this->text()->notNull(),
            'year' => $this->integer()->notNull(),
            'publish' => $this->string()->notNull(),
            'id_type' => $this->integer()->notNull()->defaultValue(1),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_type`
        $this->createIndex(
            '{{%idx-discipline_literature-id_type}}',
            '{{%discipline_literature}}',
            'id_type'
        );

        // add foreign key for table `{{%type_literature}}`
        $this->addForeignKey(
            '{{%fk-discipline_literature-id_type}}',
            '{{%discipline_literature}}',
            'id_type',
            '{{%type_literature}}',
            'id',
            'SET DEFAULT'
        );

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-discipline_literature-id_discipline}}',
            '{{%discipline_literature}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-discipline_literature-id_discipline}}',
            '{{%discipline_literature}}',
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
        // drops foreign key for table `{{%type_literature}}`
        $this->dropForeignKey(
            '{{%fk-discipline_literature-id_type}}',
            '{{%discipline_literature}}'
        );

        // drops index for column `id_type`
        $this->dropIndex(
            '{{%idx-discipline_literature-id_type}}',
            '{{%discipline_literature}}'
        );

        // drops foreign key for table `{{%discipline}}`
        $this->dropForeignKey(
            '{{%fk-discipline_literature-id_discipline}}',
            '{{%discipline_literature}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-discipline_literature-id_discipline}}',
            '{{%discipline_literature}}'
        );

        $this->dropTable('{{%discipline_literature}}');
    }
}
