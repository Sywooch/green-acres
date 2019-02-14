<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 26.05.18
 * Time: 13:52
 */

namespace shop\forms\auth;

use shop\entities\user\User;
use yii\base\Model;

class LoginForm extends Model
{

    public $username;
    public $password;
    public $rememberMe = true;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {

        return [

            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить'


        ];


    }

}

