<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Information */

?>
<div class="access-right-update">

    <?= $this->render('_form-update', [
        'authAssignmentModel' => $authAssignmentModel, 'roles'=>$roles, 'users'=>$users]) ?>

</div>
