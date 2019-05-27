<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;
        
        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...
        
//Создание ролей
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $teacher = $auth->createRole('teacher');
        $teacher->description = 'Преподаватель';
        $organizer = $auth->createRole('organizer');
        $organizer->description = 'Организатор';
        // -----запишем их в БД
        $auth->add($admin);
        $auth->add($teacher);
        $auth->add($organizer);

//
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';
        
        $viewTeacherPage = $auth->createPermission('viewTeacherPage');
        $viewTeacherPage->description = 'Просмотр страниц для преподавателей';

        $viewOrganizerPage = $auth->createPermission('viewOrganizerPage');
        $viewOrganizerPage->description = 'Просмотр страниц для организатора';
   

        $auth->add($viewAdminPage);
        $auth->add($viewTeacherPage);
        $auth->add($viewOrganizerPage);


        $auth->addChild($teacher, $viewTeacherPage);
        $auth->addChild($admin, $viewAdminPage);
        $auth->addChild($organizer, $viewOrganizerPage);


    }
}