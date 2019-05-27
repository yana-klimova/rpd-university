<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discipline_software}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%software}}`
 * - `{{%discipline}}`
 */
class m190209_121916_create_discipline_software_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%discipline_software}}', [
            'id' => $this->primaryKey(),
            'id_software' => $this->integer()->notNull(),
            'id_discipline' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_software`
        $this->createIndex(
            '{{%idx-discipline_software-id_software}}',
            '{{%discipline_software}}',
            'id_software'
        );

        // add foreign key for table `{{%software}}`
        $this->addForeignKey(
            '{{%fk-discipline_software-id_software}}',
            '{{%discipline_software}}',
            'id_software',
            '{{%software}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-discipline_software-id_discipline}}',
            '{{%discipline_software}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-discipline_software-id_discipline}}',
            '{{%discipline_software}}',
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
        // drops foreign key for table `{{%software}}`
        $this->dropForeignKey(
            '{{%fk-discipline_software-id_software}}',
            '{{%discipline_software}}'
        );

        // drops index for column `id_software`
        $this->dropIndex(
            '{{%idx-discipline_software-id_software}}',
            '{{%discipline_software}}'
        );

        // drops foreign key for table `{{%discipline}}`
        $this->dropForeignKey(
            '{{%fk-discipline_software-id_discipline}}',
            '{{%discipline_software}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-discipline_software-id_discipline}}',
            '{{%discipline_software}}'
        );

        $this->dropTable('{{%discipline_software}}');
    }
}
