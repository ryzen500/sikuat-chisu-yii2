<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class SampleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'], // Allow guest users (not logged in)
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
