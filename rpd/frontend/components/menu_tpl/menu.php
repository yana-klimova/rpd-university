<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle btn-teacher-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$qualification?><span class="caret"></span></a>
  <ul class="dropdown-menu">
        <?php 
        	foreach ($directions as $direction): ?>
        		<li role="separator" class="divider"></li>
    			<li>
				<?= Html::a($direction['direction'], [Url::toRoute(['site/disciplines', 'direction' => $direction['direction'], 'qualification' => $qualification, 'currentCourse' => 1])]);?> 
        		</li>
  		<?php 
  			endforeach; 
  		
		?>  
    </ul>
</li>

