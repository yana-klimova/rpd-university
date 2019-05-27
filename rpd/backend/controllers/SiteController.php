<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\UserSearch;
use common\models\User;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\AuthAssignmentSearch;
use common\models\AuthAssignment;
use common\models\Registration;
use common\models\Login;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $activePill;
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
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

public function actionLogin() {
        if(!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }
        $this->layout = 'login';
        $login_model = new Login();

        if(Yii::$app->request->post('Login')){
            $login_model->attributes = Yii::$app->request->post('Login');
            if($login_model->validate()){
                Yii::$app->user->login($login_model->getUser(), $login_model->remember() ? 3600*24*30 : 0);

                return $this->redirect(['site/index']);
            }
        }
        return $this->render('login', compact('login_model'));
    }
}
