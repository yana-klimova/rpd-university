<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "discipline_literature".
 *
 * @property int $id
 * @property string $name
 * @property string $authors
 * @property int $year
 * @property string $publish
 * @property int $id_type
 * @property int $id_discipline
 *
 * @property Discipline $discipline
 * @property TypeLiterature $type
 */
class Literature extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'literature';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message'=>'Необходимо ввести название'],
            [['year'], 'required', 'message'=>'Необходимо ввести год'],
            [['authors'], 'required', 'message'=>'Необходимо ввести авторов'],
            [['name', 'authors', 'type'], 'string'],
            [['year', 'id_discipline'], 'integer'],
            [['publish'], 'string', 'max' => 255],
            [['name', 'authors', 'publish'], 'trim'],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'authors' => 'Authors',
            'year' => 'Year',
            'publish' => 'Publish',
            'id_type' => 'Id Type',
            'id_discipline' => 'Id Discipline',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }

    public function setDiscipline($id_discipline) {
        if($id_discipline) {
            $discipline = Discipline::findOne($id_discipline);
            $this->link('discipline', $discipline);
        }
    }


}
