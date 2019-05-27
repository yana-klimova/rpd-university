<?php

namespace common\modules\organizer\controllers;

use yii\web\Controller;
use Yii;
use yii\helpers\ArrayHelper;
use common\models\Discipline;

use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;

use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;

use common\models\Can;
use common\models\File;
use common\models\TeacherFile;
use common\models\InformationFile;
use common\models\Know;
use common\models\Own;
use common\models\Section;
use common\models\Site;
use common\models\CommentSearch;
use common\models\Comment;
use common\models\Tab;
use common\models\Login;
use common\models\Equipment;
use common\models\Literature;
use common\models\LabWork;
use common\models\Practice;
use common\models\Information;
use common\models\Material;
use common\models\Notification;
use common\models\TypeControl;
use common\models\FormControl;
use common\models\Classroom;
use common\models\TaskIntermediateCertification;
use common\models\CurrentCertification;
use common\models\CompetencyDiscipline;

use yii\data\ActiveDataProvider;

/**
 * Default controller for the `organizer` module
 */
class SiteController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'main';
        $session = Yii::$app->session;

        $informations = Information::getActiveOrganizerInfo();
        $materials = Material::getActiveOrganizerMaterials();
        $notifications = Notification::getActiveOrganizerNotifications();
        $allYears=ArrayHelper::map(Discipline::find()->orderby('year')->all(), 'year', 'current_year');
        foreach ($materials as $material) {
            $file = Yii::getAlias('@uploads').'/'.$material->material;
            if (!file_exists($file)){
                $material->delete();
            } 
        }

        foreach ($informations as $information) {
            foreach ($information->informationFiles as $informationFile) {
                $file = Yii::getAlias('@uploads').'/'.$informationFile->file_name;
                    if (!file_exists($file)){
                    $informationFile->delete();
                } 
            }
            
        }
        
        return $this->render('index', compact('informations', 'materials', 'notifications'));
    }



}
