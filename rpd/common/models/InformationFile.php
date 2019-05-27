<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "information_file".
 *
 * @property int $id
 * @property int $information_id
 * @property string $title
 * @property string $file_name
 *
 * @property Information $information
 */
class InformationFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'information_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['information_id'], 'default', 'value' => null],
            [['information_id'], 'integer'],
            [['title', 'file_name'], 'required'],
            [['title', 'file_name'], 'string', 'max' => 255],
            [['information_id'], 'exist', 'skipOnError' => true, 'targetClass' => Information::className(), 'targetAttribute' => ['information_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'information_id' => 'Information ID',
            'title' => 'Title',
            'file_name' => 'File Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInformation()
    {
        return $this->hasOne(Information::className(), ['id' => 'information_id']);
    }

    public function setInformation($id_information){
        if($id_information){
            $information = Information::findOne($id_information);
            $this->information_id = $id_information;
            $this->save(false);
        }
    }

    public function setFileTitle($title){
        $this->title = $title;
        return $this->save();
    }

    public function setFile($fileName){
        $this->file_name=$fileName;
        return $this->save(false);
    }
}
