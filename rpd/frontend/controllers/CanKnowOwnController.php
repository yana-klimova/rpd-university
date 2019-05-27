<?php

namespace frontend\controllers;


use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use common\models\Discipline;
use common\models\Can;
use common\models\Know;
use common\models\Own;
use common\models\Section;
use common\models\LabWork;
use common\models\Practice;
use common\models\CompetencyDiscipline;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/**
 * KnowController implements the CRUD actions for Know model.
 */
class CanKnowOwnController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate($id, $discipline_id){
        $id=Html::encode($id);
        $discipline_id = Html::encode($discipline_id);
        $comp = CompetencyDiscipline::findOne($id);
        $discipline = Discipline::findOne($discipline_id);
            // var_dump(Yii::$app->request->post());
        $competens = $discipline->competencyDisciplines;

        if(Yii::$app->request->isAjax) 
        {

            Yii::$app->response->format = Response::FORMAT_JSON;
            $controlsCan = Yii::$app->request->post('controlsCan');

            $controlsKnow = Yii::$app->request->post('controlsKnow');
            $controlsOwn = Yii::$app->request->post('controlsOwn');

            // $comp->can->load(Yii::$app->request->post());
            $comp->can->can = Html::encode($_POST['Can']['can']);
            $comp->know->know=Html::encode($_POST['Know']['know']);
            $comp->own->own = Html::encode($_POST['Own']['own']);
            $comp->can->saveControls($controlsCan);
            $comp->know->saveControls($control_know);
            $comp->own->saveControls($controlsOwn);
            if($comp->can->save() &&
            $comp->know->save() &&
            $comp->own->save()) {
                return ['success' => true];
            }

            return ['success' => false];
        }

        return $this->renderAjax('site/discipline-info', compact('discipline','competens'));
    }

    public function actionValidate($id)
    {
        $comp = CompetencyDiscipline::findOne($id);

        $request = \Yii::$app->getRequest();

        if ($request->isPost && $comp->can->load($request->post()) && $comp->know->load($request->post()) && $comp->own->load($request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($comp->can, $comp->know, $comp->own);
        }
    }
}
