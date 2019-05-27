<?php
namespace common\models;

use yii\base\Model;
use Yii;

/**
 * 
 */
class Year extends Model
{
	public $year;

	public function rules() {
		return [
			[['year'], 'required'],
		];
	}
}