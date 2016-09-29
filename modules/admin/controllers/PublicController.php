<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/25
 * Time: 15:10
 */

namespace app\modules\admin\controllers;


use app\modules\admin\models\Admin;
use yii\web\Controller;

class PublicController extends Controller
{
    public function actionLogin()
    {
        $this->layout = false;
        $model = new Admin();
        if (\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            if ($model->login($post)){
                $this->redirect(['/admin/default/index']);
            }
        }
        return $this->render('login', [
            'model'=>$model,
        ]);
    }

    public function actionLogout()
    {
        \Yii::$app->session->removeAll();
        if (!isset(\Yii::$app->session['admin']['isLogin'])){
            $this->redirect(['/admin/public/login']);
        }else{
            $this->goBack();
        }
    }

    public function actionSeekpassword()
    {
        $this->layout = false;
        $model = new Admin();
        if (\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            if ($model->seekPass($post)){
                \Yii::$app->session->setFlash('info', 'send ok');
            }
        }
        return $this->render('seekpassword', [
            'model'=>$model,
        ]);
    }
}