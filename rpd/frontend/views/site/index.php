<?php
use yii\widgets\ActiveField;
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\Discipline;
?>
<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
      <div class="col-md-6">
        <div class="panel panel-info">
          
            <div class="panel-heading">
              
              <h3 class="panel-title">Учебные года. Текущий: 20<?php echo $selectedYear." - 20".($selectedYear+1);?></h3>

            </div>
          
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline']]); ?>
                <?= Html::dropDownList('currentYear', $selectedYear, $allYears, ['class'=>'form-group form-control'])?>
                  <div class="form-group ">
                    <?= Html::submitButton('Сделать текущим', ['class' => 'btn btn-success']) ?>
                  </div>
                  <?php ActiveForm::end(); ?>
            </div>
            
        </div>

        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Объявления</h3>
          </div>
          <div class="panel-body">
            <?php if($notifications) {
              foreach ($notifications as $notification) :?>
                <div class="row">
                  <div class="col-md-12">
                    <h4 style="margin-top: 0px"><?=$notification->title?></h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <?=$notification->content?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="pull-right">
                      <?=date("d-m-Y", strtotime($notification->date))?>
                    </div>
                  </div>
                </div>
              <?php endforeach; } else  {?>
                <div class="row">
                  <div class="col-md-12">
                    <h4 style="margin-top: 0px">Объявлений нет</h4>
                  </div>
                </div> 
              <?php }?>
            
          </div>
        </div>
        <?php if(isset($this->params['name'])):?>
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Последняя просмотренная дисциплина</h3>
          </div>
          <div class="panel-body">
            <?php echo Html::a('Дисциплина: '.$this->params['name'].'<br>Направление: '.$this->params['direction'].'<br>Квалификация: '.$this->params['qualification'].'<br>('.$this->params['course'].' курс - '.$this->params['semester'].' семестр)', Url::toRoute(['site/discipline', 'id' => Yii::$app->session['last_discipline']]))?>
          </div>
        </div>
      <?php endif; ?>
      </div>
      <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Информация для преподавателя</h3>
            </div>
          <div class="panel-body">
            <?php if($informations) {
                foreach ($informations as $information) :?>
                  <div class="row">
                    <div class="col-md-12">
                      <?=Html::a($information->title, Url::toRoute(['site/information-view', 'id'=>$information->id]))?></h4>
                      
                    </div>
                  </div>                      
                <?php endforeach; } else  {?>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="margin-top: 0px">Информации нет</h4>
                </div>
              </div> 
            <?php }?>
          </div>
        </div>
        <div class="panel panel-info">
              <div class="panel-heading">
                  <h3 class="panel-title">Материалы</h3>
              </div>
            <div class="panel-body">
                <?php if($materials) {
                  foreach ($materials as $material) :?>
                    <div class="row">
                      <div class="col-md-12">
                        <?=Html::a($material->title, Url::toRoute(['site/material-view', 'id'=>$material->id]))?></h4>                       
                      </div>
                    </div>                      
                  <?php endforeach; }?>
            </div>
          </div>
        </div>
</body>
</html>
