<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/25
 * Time: 13:16
 */

namespace app\controllers;


use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "ly1";
        return $this->render('index');
    }
}