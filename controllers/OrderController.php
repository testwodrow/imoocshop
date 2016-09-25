<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/25
 * Time: 13:58
 */

namespace app\controllers;


use yii\web\Controller;

class OrderController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'ly2';
        return $this->render('index');
    }

    public function actionCheck()
    {
        $this->layout = 'ly1';
        return $this->render('check');
    }
}