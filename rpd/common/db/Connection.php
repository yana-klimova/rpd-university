<?php
namespace common\db;


use Yii;

/**
 * 
 */
class Connection{

		public function uploadEdicationPlan($year) {
		$year = '01-JAN-'.$year;
		$educationPlan = Yii::$app->db_external->createCommand("select * from MIREA_DOCS.V_EDUCATION_PLAN_MAIN_INFO where upper(dep_name) like '%КБ-4%' and upper(ed_plan_start_date) = :year")->bindValues([':year' => $year])->queryAll();
        return $educationPlan;
	}



		public function uploadCompetency($disc_id, $plan_id) {
		$competency = Yii::$app->db_external->createCommand('select comp_name, comp_descr from MIREA_DOCS.V_EDUCATION_PLAN_DISC_COMP where disc_id= :disc_id and ed_plan_id= :plan_id')->bindValues([':disc_id' => $disc_id, ':plan_id'=>$plan_id])->queryAll();
		return $competency;
	}


		public function uploadEmploee($disc_id, $plan_id){
		$emploee = Yii::$app->db_external->createCommand('select * from MIREA_DOCS.V_EDUCATION_PLAN_EMPLOEE where disc_id= :disc_id and ed_plan_id= :plan_id')->bindValues([':disc_id' => $disc_id, ':plan_id'=>$plan_id])->queryAll();
		return $emploee;
	}

		public function uploadTitle($title_id){
		$title = Yii::$app->db_external->createCommand('select * from mirea_docs.ACADEMIC_TITLE where ACADEMIC_TITLE_ID = :title_id')->bindValues([':title_id' => $title_id])->queryAll();
		return $title;
	}

		public function uploadDegree($degree_id){
		$degree = Yii::$app->db_external->createCommand('select * from mirea_docs.ACADEMIC_DEGREE where ACADEMIC_DEGREE_ID = :degree_id')->bindValues([':degree_id' => $degree_id])->queryAll();
		return $degree;
	}

	// 	public function uploadDegree(){
	// 	$degree = Yii::$app->db_external->createCommand('select * from mirea_docs.ACADEMIC_DEGREE')->queryAll();
	// 	return $degree;
	// }

	// 	public function uploadEmploee(){
	// 		$emploee = Yii::$app->db_external->createCommand('select * from MIREA_DOCS.V_EDUCATION_PLAN_EMPLOEE')->queryAll();
	// 		return $emploee;
	// }
}