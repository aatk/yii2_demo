<?php

namespace app\controllers;

use yii\rest\Controller;

class ApiController extends Controller
{
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return parent::behaviors();
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
    
    public function actionInstall()
    {
        $res = ["result"=>"ok"];
        return  $this->asJson($res);
    }
}