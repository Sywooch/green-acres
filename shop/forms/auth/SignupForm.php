<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 11.05.18
 * Time: 13:32
 */

namespace shop\forms\auth;


use yii\base\Model;
use shop\entities\user\User;


class SignupForm extends Model
{

    public $username;
    public $email;
    public $phone;
    public $password;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['phone', 'required'],
            ['phone', 'integer'],
        ];
    }



}