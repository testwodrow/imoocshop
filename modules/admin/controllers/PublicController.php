<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/25
 * Time: 15:10
 */

namespace app\modules\admin\controllers;


use yii\web\Controller;

class PublicController extends Controller
{
    public function actionLogin()
    {
        $this->layout = false;
        return $this->render('login');
    }
}