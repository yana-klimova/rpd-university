<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php 
    // $qualificationShort = mb_substr($qualification, 0, 7);
    for($i = 1; $i<=$courses; $i++): ?>
    <?php echo Html::a($i.' курс', [Url::toRoute(['site/disciplines', 'currentCourse'=>$i, 'direction' => $direction, 'qualification'=> $qualification])], ['class' => ($course == $i) ? 'list-group-item courses selectedCourse' : 'list-group-item courses', 'data-course'=>"$i", 'data-pjax'=>'1']);?>
    <?php endfor; ?>

