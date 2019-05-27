<?php

namespace common\modules\organizer;

/**
 * organizer module definition class
 */
class Organizer extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\organizer\controllers';
    public $defaultRoute = 'site';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->layout = 'main';
        \Yii::$app->homeUrl = '/organizer';




        // custom initialization code goes here
    }


}
