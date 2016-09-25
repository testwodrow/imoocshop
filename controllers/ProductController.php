<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/25
 * Time: 13:31
 */

namespace app\controllers;


use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'ly2';
        return $this->render('index');
    }

    public function actionDetail()
    {
        $this->layout = 'ly2';
        return $this->render('detail');
    }
}