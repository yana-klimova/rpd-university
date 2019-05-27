<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
?>


<div class="tab-content">
  <?php //var_dump($selectedUser)?>


  
  <div id="signup" class="tab-pane fade<?php if($this->context->activePill == 'users'){
    echo 'in active';
  }?>">

		  		<?= $this->render('_registration', compact('roles', 'model', 'userSearchModel', 'userDataProvider')); ?>

  </div>
    <div id="access-right" class="tab-pane fade <?php if($this->context->activePill == 'access-right'){
    echo 'in active';
  }?>">
    <?php Pjax::begin(['enablePushState' => false, 'id'=>'pj-access', 'timeout'=>600000]); ?>

      <?= $this->render('_access-right', compact('authSearchModel', 'authDataProvider', 'authAssignmentModel', 'users', 'roles', 'update')); ?>
    <?php Pjax::end(); ?>
  </div>

</div>
