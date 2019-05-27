<?php
namespace common\modules\organizer\components;
use yii\base\Widget;
use common\models\Discipline;
use yii\helpers\ArrayHelper;

/**
 * 
 */
class MenuWidget extends Widget
{
	public $year;
	
	public $menuHtml;
	public $allDirections;

	public function init() {
		parent::init();
	}

	public function run() {
		$this->allDirections = $this->getAllDirect($this->year);
		$this->menuHtml = $this->getMenuHtml();

		return $this->menuHtml;
	}

	public function getAllDirect($year) {
		$directions['Бакалавриат'] = Discipline::getDirections('Бакалавриат', $year);
		$directions['Магистратура'] = Discipline::getDirections('Магистратура', $year);
		$directions['Специалитет'] = Discipline::getDirections('Специалитет', $year);
		$directions['Аспирантура'] = Discipline::getDirections('Аспирантура', $year);
		return $directions;

	}

	protected function getMenuHtml() {
		$str = '';
		foreach ($this->allDirections as $qualification => $directions) {
				$str .= $this->catToTemplate($qualification, $directions);
				
		}
		return $str;
	}

	protected function catToTemplate($qualification, $directions) {
		ob_start();
		include __DIR__.'/menu_tpl/menu.php';
		return ob_get_clean();
	}
}