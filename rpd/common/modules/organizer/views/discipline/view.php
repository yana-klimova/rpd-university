<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model common\models\Discipline */


?>
<div class="col-md-12">
    <div class="panel panel-info">   
        <div class="panel-heading">
            <h4>
                <?php
                switch ($discipline->status) {
                    case 1:
                      echo '<span class="glyphicon glyphicon-edit" style="color: #e01010"></span> '.$discipline->name;
                      break;
                    case 2:
                      echo '<span class="glyphicon glyphicon-share" style="color: #f7a62d"></span> '.$discipline->name;;
                      break;
                    case 3:
                      echo '<span class="glyphicon glyphicon-check" style="color: #18c721"></span> '.$discipline->name;;
                      break;
                  }
                ?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table discipline-table">
                <thead>
                    <tr>
                        <th>Квалификация</th>
                        <th>Направление</th>
                        <?php if($discipline->qualification =='Бакалавриат'){?>
                            <th>Профиль</th>
                        <?php } elseif ($discipline->qualification=='Магистратура') {?>
                            <th>Программа</th>
                        <?php } elseif ($discipline->qualification=='Специалитет'){?>
                            <th>Специализация</th>
                        <?php } else { ?>
                        <th>Профиль</th>
                        <?php }?>
                        <th>Код</th>
                        <th>Курс</th>
                        <th>Семестр</th>
                        <th>Учебный год</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$discipline->qualification?></td>
                        <td><?=$discipline->direction?></td>
                        <td><?=$discipline->profile?></td>
                        <td><?=$discipline->code_direction?></td>
                        <td><?=$discipline->course?></td>
                        <td><?=$discipline->semester?></td>
                        <td>20<?=$discipline->year." - 20".($discipline->year+1)?></td>
                    </tr>
                </tbody>
            </table>

        <div class="row">
            <div class="col-md-8">
                <b>Компетенции: </b>
                <?php

                    foreach ($discipline->competencyDisciplines as $i => $value) {
                        echo $value['code']."; ";
                    }
                ?>
                <br>

                <b>Индекс: </b><?=$discipline->code_discipline?> <br> 
                <b>Контроль: </b><?=$discipline->control?><br>
                <?php if($discipline->program){?>
                    <b>Программа: </b><?=$discipline->program?><br>
                <?php }?>
                <b>Состояние: </b>
                <?php if($discipline->status==1){?>
                    Разработка<br>
                <?php } elseif ($discipline->status==2) {?>
                    Проверка<br>
                <?php } elseif ($discipline->status==3) {?>
                    Проверено<br>
                <?php }?>
                Дисциплина относится к 
                <?php
                    if(mb_substr($discipline->code_discipline, 0, 4)=== "Б1.Б") {
                        echo " базовой части";
                    } elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б1.В") {
                        echo " вариативной части";
                    } elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б2.У") {
                        echo " учебно-практической части";
                    } elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б2.Н") {
                        echo " научно-исследовательской части";
                    } elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б2.П") {
                        echo " производственно-практической части";
                    }
                    elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б3.Г") {
                        echo " подготовке и сдаче государственного экзамена";
                    }elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б3.Г.1") {
                        echo " государственному экзамену";
                    }elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б3.Д") {
                        echo " подготовке и защите ВКР";
                    }elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б3.Д.1") {
                        echo " выпускной квалификационной работе";
                    }
                
                if ($discipline->status==2){?>
                    <div class="row">
                        <div class="col-md-8">
                            <h4 style="color: #04d66a"><b>РПД на проверку:</b></h4>
                            <?php 
                                echo Html::a($discipline->doc_file, Url::toRoute(['discipline/download', 'id'=>$discipline->id, 'status'=>$discipline->status, 'doc'=>true]), ['title'=>'Скачать']);
                                echo '<br>'.Html::a($discipline->pdf_file, Url::toRoute(['discipline/download', 'id'=>$discipline->id, 'status'=>$discipline->status, 'pdf'=>true]), ['title'=>'Скачать']);
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php 
                            echo Html::a('<h4><span class="glyphicon glyphicon-remove" style="color: #e01010"></span> На разработку</h4>', Url::toRoute(['discipline/change-status', 'id'=>$discipline->id, 'currentStatus'=>$discipline->status, 'targetStatus'=>1]), ['data-method'  => 'post', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите отправить РПД на разработку?')]);?>
                        </div>
                        <div class="col-md-3">
                            <?php echo Html::a('<h4><span class="glyphicon glyphicon-ok" style="color: #18c721"></span> Утверждено</h4>', Url::toRoute(['discipline/change-status', 'id'=>$discipline->id, 'currentStatus'=>$discipline->status, 'targetStatus'=>3]), ['data-method'  => 'post', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите утвердить РПД?')]); 
                        ?>
                        </div>
                    </div>
                <?php } elseif ($discipline->status==3){?>
                    <div class="row">
                        <div class="col-md-8">
                            <h4 style="color: #04d66a"><b>Утвержденная РПД:</b></h4>
                            <?php echo Html::a($discipline->doc_file, Url::toRoute(['discipline/download', 'id'=>$discipline->id, 'status'=>$discipline->status, 'doc'=>true]));
                            echo '<br>'.Html::a($discipline->pdf_file, Url::toRoute(['discipline/download', 'id'=>$discipline->id, 'status'=>$discipline->status, 'pdf'=>true]));?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo Html::a('<h4><span class="glyphicon glyphicon-remove" style="color: #e01010"></span> На разработку</h4>', Url::toRoute(['discipline/change-status', 'id'=>$discipline->id, 'currentStatus'=>$discipline->status, 'targetStatus'=>1]), ['data-method'  => 'post', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите отправить РПД на разработку?')]);?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            
        </div>
        <div style="margin-top: 20px">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="pill" href="#connect">Связь с преподавателем</a></li>
                        <li><a data-toggle="pill" href="#developers">Разработчики</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="connect" class="tab-pane fade in active">
                            <?php Pjax::begin(['enablePushState' => false, 'id'=>'pj-comment', 'timeout'=>600000]); ?>
                                <?= $this->render('_comment', compact('commentModel', 'commentSearchModel', 'discipline', 'commentDataProvider', 'commentModel', 'tabs', 'discipline')); ?>
                            <?php Pjax::end();?>
                        </div>
                        <div id="developers" class="tab-pane fade">
                            <div class="container">
                                <h3>Menu 1</h3>
                                <p>Some content in menu 1.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
