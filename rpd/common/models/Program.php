<?php

namespace common\models;
use yii\base\Model;
use Yii;

class Program extends Model {
	public $program;



	public function rules()
    {
        return [

            [['program'], 'text', 'max'=>255],
        ];
	}

}