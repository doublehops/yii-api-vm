<?php
namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;

/**
 * Base controller
 */
class BaseController extends ActiveController
{
    public function behaviors() {

        return ArrayHelper::merge([
            'corsFilter' => [
                'class' => Cors::className(),
            ],
            [
                'class' => HttpBearerAuth::className(),
                'except' => ['options'],
            ],
        ], parent::behaviors());

        return $behaviors;
    }
}
