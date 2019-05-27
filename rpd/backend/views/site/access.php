<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
?>

<?php //Pjax::begin(['enablePushState' => false, 'id'=>'pj-registration', 'timeout'=>600000]); ?>
<div class="tab-content">

  <div id="users" class="tab-pane fade <?php if($this->context->activePill == 'users'){
    echo 'in active';
  }?>">
    <?= $this->render('_users', compact('userSearchModel', 'userDataProvider')); ?>
  </div>
  
  <div id="signup" class="tab-pane fade">
  	<?php Pjax::begin(['enablePushState' => false, 'id'=>'pj-registration', 'timeout'=>600000]); ?>
		  		<?= $this->render('_registration', compact('roles', 'model')); ?>
	<?php Pjax::end();?>
  </div>
    <div id="access-right" class="tab-pane fade <?php if($this->context->activePill == 'access-right'){
    echo 'in active';
  }?>">
    <?php Pjax::begin(['enablePushState' => false, 'id'=>'pj-access', 'timeout'=>600000]); ?>

      <?= $this->render('_access-right', compact('authSearchModel', 'authDataProvider', 'authAssignmentModel', 'users', 'roles', 'update', 'user')); ?>
    <?php Pjax::end(); ?>
  </div>

</div>
<?php //Pjax::end(); ?>