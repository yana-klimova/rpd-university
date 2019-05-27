<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%intermediate_assessment}}`.
 */
class m190503_071722_create_intermediate_assessment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%intermediate_assessment}}', [
            'id' => $this->primaryKey(),
            'id_discipline' => $this->integer(),
            'id_procedure' => $this->integer()->defaultValue(1),
            'id_duration_control' => $this->integer()->defaultValue(1),
            'id_form_current_control' => $this->integer()->defaultValue(1),
            'id_form_intermediate_control' => $this->integer()->defaultValue(1),
            'id_handout' => $this->integer()->defaultValue(1),
            'id_type_verification_task' => $this->integer()->defaultValue(1),
            'id_form_report' => $this->integer()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%intermediate_assessment}}');
    }
}
