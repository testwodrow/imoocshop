<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property string $admin_id
 * @property string $admin_user
 * @property string $admin_pass
 * @property string $admin_email
 * @property string $login_time
 * @property string $login_ip
 * @property integer $create_time
 */
class Admin extends \yii\db\ActiveRecord
{
    public $rememberMe = true;

    public static function tableName()
    {
        return '{{%admin}}';
    }

    public function rules()
    {
        return [
            [['login_time', 'login_ip', 'create_time'], 'integer'],
            [['admin_user', 'admin_pass'], 'string', 'max' => 32],
            [['admin_user'], 'required', 'on'=>['login', 'seekpass']],
            [['admin_pass'], 'required', 'on'=>['login']],
            ['admin_pass', 'validatePass'],

            [['admin_email'], 'required', 'on'=>['seekpass']],
            [['admin_email'], 'email'],
            [['admin_email'], 'validateEmail'],
            [['admin_email'], 'string', 'max' => 50],

            /*[['admin_user', 'admin_pass'], 'unique', 'targetAttribute' => ['admin_user', 'admin_pass'], 'message' => 'The combination of Admin User and Admin Pass has already been taken.'],
            [['admin_user', 'admin_email'], 'unique', 'targetAttribute' => ['admin_user', 'admin_email'], 'message' => 'The combination of Admin User and Admin Email has already been taken.'],
            ['rememberMe', 'boolean'],*/
        ];
    }

    public function validatePass()
    {
        if (!$this->hasErrors()){
//            $data = self::find()->where(['admin_user = :user and admin_pass = :pass', [':user'=>$this->admin_user, ':pass'=>md5($this->admin_pass)]])->one();
            $data = self::find()->where(['admin_user'=>$this->admin_user, 'admin_pass'=>md5($this->admin_pass)])->one();
            if (is_null($data)){
                $this->addError('admin_pass', '用户名或密码错误');
            }
        }
    }

    public function validateEmail()
    {
        if (!$this->hasErrors()){
//            $data = self::find()->where(['admin_user = :user and admin_pass = :pass', [':user'=>$this->admin_user, ':pass'=>md5($this->admin_pass)]])->one();
            $data = self::find()->where(['admin_user'=>$this->admin_user, 'admin_email'=>$this->admin_email])->one();
            if (is_null($data)){
                $this->addError('admin_email', '用户名或邮箱不匹配');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'admin_id' => Yii::t('app', 'Admin ID'),
            'admin_user' => Yii::t('app', 'Admin User'),
            'admin_pass' => Yii::t('app', 'Admin Pass'),
            'admin_email' => Yii::t('app', 'Admin Email'),
            'login_time' => Yii::t('app', 'Login Time'),
            'login_ip' => Yii::t('app', 'Login Ip'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    public function login($post)
    {
        $this->scenario = 'login';
        if ($this->load($post) && $this->validate()){
            $life_time = $this->rememberMe?24*3600:0;
            $session = Yii::$app->session;
            session_set_cookie_params($life_time);
            $session['admin'] = [
                'admin_user'=>$this->admin_user,
                'isLogin' => 1,
            ];
            $this->updateAll(['login_time'=>time(), 'login_ip'=>ip2long(Yii::$app->request->userIP)], ['admin_user'=>$this->admin_user]);
            return (boolean)$session['admin']['isLogin'];
        }
        return false;
    }

    public function seekpass($post)
    {
        $this->scenario = 'seekpass';
        if ($this->load($post) && $this->validate()){
            $mailer = Yii::$app->mailer->compose();
            $mailer->setFrom("test@test.test");
            $mailer->setTo("test1@test.test");
            $mailer->setSubject("test seek pass");
            if ($mailer->send()){
                return true;
            }
        }
        return false;
    }
}
