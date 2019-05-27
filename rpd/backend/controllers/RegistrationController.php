<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Registration;
use common\models\Login;
use common\models\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
use backend\controllers\SendEmailController;
/**
 * Site controller
 */
class RegistrationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,

                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    // [
                    //     'actions' => ['index'],
                    //     'allow' => true,
                    //     'roles' => ['admin'],
                    // ],

                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Registration();
        $userSearchModel = new UserSearch();
        $userDataProvider = $userSearchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        
        }

        if(Yii::$app->request->isPost ) {
                $model->attributes = Yii::$app->request->post('Registration');
                $user_id = $model->registration();
                if($user_id){
                    $sendEmail = new SendEmailController();

                    $sendEmail->send($user_id);

                    Yii::$app->session->setFlash('success', "Пользователь зарегистрирован!");

                    $roles = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
                    $model = new Registration();
                    $model->generatePassword();


                   return $this->redirect(['access-control/index']);
                } else{

                     return $this->redirect(['access-control/index']);
                }
            }

        return $this->redirect(['access-control/index']);

    }
  
}
