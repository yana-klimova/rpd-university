<?php
namespace frontend\components;

use yii\validators\Validator;

class LabTimeValidator extends Validator
{
	 public function init()
    {
        parent::init();
        $this->message = 'Invalid status input.';
    }

    public function validate($value, &$error=Null)
    {
    	if($value[0]>$value[1] || $value[0]<0){
    		return false;
    	}
    	return true;
    }

    public function clientValidateAttribute($model, $attribute, $value)
    {
       
        $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return <<<JS

if ($value[0]>$value[1] || $value[0]<0 {
    messages.push($message);
}
JS;
    }
}