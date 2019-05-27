<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>Компетенции</h3>
	    <table class="table discipline-comp">
			<thead>
				<tr>
					<th>Код</th>
					<th>Характеризуется</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($competens as $i => $comp): ?>
					<tr>
						<td>
							<?=$comp->code?>
						</td>
						<td>
							<?php echo ucfirst($comp->description)?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		</div>
	</div>
</div>