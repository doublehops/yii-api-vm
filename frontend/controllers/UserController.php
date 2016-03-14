<?php

namespace frontend\controllers;

use yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\auth\HttpBearerAuth;
use common\models\User;

class UserController extends BaseController
{
    public $modelClass = 'common\models\User';


    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => HttpBearerAuth::className(),
                'except' => ['login'],
            ],
        ], parent::behaviors());
    }

    public function prepareDataProvider()
    {
        $searchModel = new \common\models\UserSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    /**
     * Logout app/user
     */
    public function actionLogout()
    {
        $user = User::findOne(\Yii::$app->user->id);
        $user->access_token = null;
        if($user->save()) {
            return $this->sendJson(['message' => 'You have been logged out']);
        } else {
            return $this->sendJson(['message' => 'Unable to logout'], $failureReturnCode);
        }
    }

    /**
     * Login user and receive bearer token
     */
    public function actionLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        if(!$username || !$password) {
            return ['message' => 'Parameters not passed'];
        }

        if(!$user = User::findIdentityByUsernamePassword($username, $password)) {
            return ['message' => 'User credentials not found'];
        }

        return $user;
    }
}
