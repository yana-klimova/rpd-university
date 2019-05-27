<?php

namespace backend\controllers;

use Yii;
use common\models\AuthAssignment;
use common\models\User;
use common\models\Registration;
use common\models\UserSearch;
use common\models\AuthAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AccessControlController extends Controller
{
    public $activePill;
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

    /**
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='access-control';
        $roles = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
        $users = ArrayHelper::map(User::find()->all(), 'id', 'username');
        $model = new Registration();
        $model->generatePassword();

        $authAssignmentModel = new AuthAssignment();
        $userSearchModel = new UserSearch();
        $userDataProvider = $userSearchModel->search(Yii::$app->request->queryParams);

        $authSearchModel = new AuthAssignmentSearch();
        $authDataProvider = $authSearchModel->search(Yii::$app->request->queryParams);
        $update = false;

        if(Yii::$app->session->hasFlash('redirect')){
            $this->activePill = Yii::$app->session->getFlash('redirect');
        } else {
            $this->activePill = 'users';
        }

        return $this->render('index', compact('roles', 'model', 'userSearchModel', 'userDataProvider', 'authSearchModel', 'authDataProvider', 'authAssignmentModel', 'users', 'update'));
    }


 
}
