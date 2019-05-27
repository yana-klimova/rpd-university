<?php
namespace frontend\components;
use yii\base\Widget;
use common\models\Discipline;
use yii\helpers\ArrayHelper;

/**
 * 
 */
class CourseWidget extends Widget
{	
	public $menuHtml;
	public $courses;
	public $course;
	public $qualification;
	public $direction;

	public function init() {
		parent::init();
	}

	public function run() {
		$this->courses = $this->getCourseCount($this->qualification);
		$this->menuHtml = $this->getMenuHtml($this->courses, $this->qualification, $this->direction, $this->course);
		return $this->menuHtml;
	}

	public function getCourseCount($qualification) {
			return Discipline::getCountCourse($qualification);
	}


	protected function getMenuHtml($courses, $qualification, $direction, $course) {
			$str = $this->catToTemplate($courses, $qualification, $direction, $course);
			return $str;
		}

	protected function catToTemplate($courses, $qualification, $direction, $course) {
		ob_start();
		include __DIR__.'/menu_tpl/course.php';
		return ob_get_clean();
	}
}