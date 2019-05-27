<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="site-login">
    
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($login_model, 'login')->textInput(['autofocus' => true])->label('Логин') ?>

                <?= $form->field($login_model, 'password')->passwordInput()->label('Пароль'); ?>

                <div class="form-group pull-right">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
