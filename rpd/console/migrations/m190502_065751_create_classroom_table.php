<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%classroom}}`.
 */
class m190502_065751_create_classroom_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%classroom}}', [
            'id' => $this->primaryKey(),
            'room' => $this->string()->notNull(),
            'id_discipline' => $this->integer()
        ]);

        $this->createIndex(
            'idx-classroom-id_discipline',
            'classroom',
            'id_discipline'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-classroom-id_discipline',
            'classroom',
            'id_discipline',
            'discipline',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%classroom}}');

        $this->dropIndex(
            'idx-clssroom-id_discipline',
            'classroom'
        );
    }


}
