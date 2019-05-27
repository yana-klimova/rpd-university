<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assessment_tool}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%discipline}}`
 * - `{{%duration_control}}`
 * - `{{%form_current_control}}`
 * - `{{%form_intermediate_control}}`
 * - `{{%handout}}`
 * - `{{%type_verification_task}}`
 * - `{{%form_report}}`
 */
class m190209_115533_create_assessment_tool_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assessment_tool}}', [
            'id' => $this->primaryKey(),
            'id_discipline' => $this->integer()->notNull(),
            'id_procedure' => $this->integer()->notNull()->defaultValue(1),
            'id_duration_control' => $this->integer()->notNull()->defaultValue(1),
            'id_form_current_control' => $this->integer()->notNull()->defaultValue(1),
            'id_form_intermediate_control' => $this->integer()->notNull()->defaultValue(1),
            'id_handout' => $this->integer()->notNull()->defaultValue(1),
            'id_type_verification_task' => $this->integer()->notNull()->defaultValue(1),
            'id_form_report' => $this->integer()->notNull()->defaultValue(1),
        ]);

        // creates index for column `id_discipline`
        $this->createIndex(
            '{{%idx-assessment_tool-id_discipline}}',
            '{{%assessment_tool}}',
            'id_discipline'
        );

        // add foreign key for table `{{%discipline}}`
        $this->addForeignKey(
            '{{%fk-assessment_tool-id_discipline}}',
            '{{%assessment_tool}}',
            'id_discipline',
            '{{%discipline}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-assessment_tool-id_procedure}}',
            '{{%assessment_tool}}',
            'id_procedure'
        );

        // add foreign key for table `{{%duration_control}}`
        $this->addForeignKey(
            '{{%fk-assessment_tool-id_procedure}}',
            '{{%assessment_tool}}',
            'id_procedure',
            '{{%procedure}}',
            'id',
            'SET DEFAULT'
        );

        // creates index for column `id_duration_control`
        $this->createIndex(
            '{{%idx-assessment_tool-id_duration_control}}',
            '{{%assessment_tool}}',
            'id_duration_control'
        );

        // add foreign key for table `{{%duration_control}}`
        $this->addForeignKey(
            '{{%fk-assessment_tool-id_duration_control}}',
            '{{%assessment_tool}}',
            'id_duration_control',
            '{{%duration_control}}',
            'id',
            'SET DEFAULT'
        );

        // creates index for column `id_form_current_control`
        $this->createIndex(
            '{{%idx-assessment_tool-id_form_current_control}}',
            '{{%assessment_tool}}',
            'id_form_current_control'
        );

        // add foreign key for table `{{%form_current_control}}`
        $this->addForeignKey(
            '{{%fk-assessment_tool-id_form_current_control}}',
            '{{%assessment_tool}}',
            'id_form_current_control',
            '{{%form_current_control}}',
            'id',
            'SET DEFAULT'
        );

        // creates index for column `id_form_intermediate_control`
        $this->createIndex(
            '{{%idx-assessment_tool-id_form_intermediate_control}}',
            '{{%assessment_tool}}',
            'id_form_intermediate_control'
        );

        // add foreign key for table `{{%form_intermediate_control}}`
        $this->addForeignKey(
            '{{%fk-assessment_tool-id_form_intermediate_control}}',
            '{{%assessment_tool}}',
            'id_form_intermediate_control',
            '{{%form_intermediate_control}}',
            'id',
            'SET DEFAULT'
        );

        // creates index for column `id_handout`
        $this->createIndex(
            '{{%idx-assessment_tool-id_handout}}',
            '{{%assessment_tool}}',
            'id_handout'
        );

        // add foreign key for table `{{%handout}}`
        $this->addForeignKey(
            '{{%fk-assessment_tool-id_handout}}',
            '{{%assessment_tool}}',
            'id_handout',
            '{{%handout}}',
            'id',
            'SET DEFAULT'
        );

        // creates index for column `id_type_verification_task`
        $this->createIndex(
            '{{%idx-assessment_tool-id_type_verification_task}}',
            '{{%assessment_tool}}',
            'id_type_verification_task'
        );

        // add foreign key for table `{{%type_verification_task}}`
        $this->addForeignKey(
            '{{%fk-assessment_tool-id_type_verification_task}}',
            '{{%assessment_tool}}',
            'id_type_verification_task',
            '{{%type_verification_task}}',
            'id',
            'SET DEFAULT'
        );

        // creates index for column `id_form_report`
        $this->createIndex(
            '{{%idx-assessment_tool-id_form_report}}',
            '{{%assessment_tool}}',
            'id_form_report'
        );

        // add foreign key for table `{{%form_report}}`
        $this->addForeignKey(
            '{{%fk-assessment_tool-id_form_report}}',
            '{{%assessment_tool}}',
            'id_form_report',
            '{{%form_report}}',
            'id',
            'SET DEFAULT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%discipline}}`
        $this->dropForeignKey(
            '{{%fk-assessment_tool-id_discipline}}',
            '{{%assessment_tool}}'
        );

        // drops index for column `id_discipline`
        $this->dropIndex(
            '{{%idx-assessment_tool-id_discipline}}',
            '{{%assessment_tool}}'
        );

        // drops foreign key for table `{{%duration_control}}`
        $this->dropForeignKey(
            '{{%fk-assessment_tool-id_duration_control}}',
            '{{%assessment_tool}}'
        );

        // drops index for column `id_duration_control`
        $this->dropIndex(
            '{{%idx-assessment_tool-id_duration_control}}',
            '{{%assessment_tool}}'
        );

        $this->dropForeignKey(
            '{{%fk-assessment_tool-id_procedure}}',
            '{{%assessment_tool}}'
        );

        // drops index for column `id_duration_control`
        $this->dropIndex(
            '{{%idx-assessment_tool-id_procedure}}',
            '{{%assessment_tool}}'
        );

        // drops foreign key for table `{{%form_current_control}}`
        $this->dropForeignKey(
            '{{%fk-assessment_tool-id_form_current_control}}',
            '{{%assessment_tool}}'
        );

        // drops index for column `id_form_current_control`
        $this->dropIndex(
            '{{%idx-assessment_tool-id_form_current_control}}',
            '{{%assessment_tool}}'
        );

        // drops foreign key for table `{{%form_intermediate_control}}`
        $this->dropForeignKey(
            '{{%fk-assessment_tool-id_form_intermediate_control}}',
            '{{%assessment_tool}}'
        );

        // drops index for column `id_form_intermediate_control`
        $this->dropIndex(
            '{{%idx-assessment_tool-id_form_intermediate_control}}',
            '{{%assessment_tool}}'
        );

        // drops foreign key for table `{{%handout}}`
        $this->dropForeignKey(
            '{{%fk-assessment_tool-id_handout}}',
            '{{%assessment_tool}}'
        );

        // drops index for column `id_handout`
        $this->dropIndex(
            '{{%idx-assessment_tool-id_handout}}',
            '{{%assessment_tool}}'
        );

        // drops foreign key for table `{{%type_verification_task}}`
        $this->dropForeignKey(
            '{{%fk-assessment_tool-id_type_verification_task}}',
            '{{%assessment_tool}}'
        );

        // drops index for column `id_type_verification_task`
        $this->dropIndex(
            '{{%idx-assessment_tool-id_type_verification_task}}',
            '{{%assessment_tool}}'
        );

        // drops foreign key for table `{{%form_report}}`
        $this->dropForeignKey(
            '{{%fk-assessment_tool-id_form_report}}',
            '{{%assessment_tool}}'
        );

        // drops index for column `id_form_report`
        $this->dropIndex(
            '{{%idx-assessment_tool-id_form_report}}',
            '{{%assessment_tool}}'
        );

        $this->dropTable('{{%assessment_tool}}');
    }
}
