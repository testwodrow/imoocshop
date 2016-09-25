<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/25
 * Time: 14:05
 */

namespace app\controllers;


use yii\web\Controller;

class MemberController extends Controller
{
    public function actionAuth()
    {
        $this->layout = "ly2";
        return $this->render('auth');
    }
}