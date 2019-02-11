<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 28.12.18
 * Time: 20:58
 */

namespace shop\entities\user;


use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $email_confirm_token
 * @property string $phone
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password

 */
class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,

        ];
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    /**
     * @param $username
     * @param $email
     * @param $phone
     * @param $password
     * @return User
     * @throws \yii\base\Exception
     */

    public static function create($username, $email, $phone, $password)
    {

        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->phone = $phone;
        $user->setPassword(!empty($password) ? $password : Yii::$app->security->generateRandomString());
        $user->created_at = time();
        $user->status = self::STATUS_ACTIVE;
        $user->auth_key = Yii::$app->security->generateRandomString();
        return $user;


    }

    /**
     * @param $username
     * @param $email
     * @param $phone
     */


    public function edit($username, $email, $phone)
    {

        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->updated_at = time();

    }


    /**
     * @param $email
     * @param $phone
     */

    public function editProfile($email, $phone)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->updated_at = time();
    }

    /**
     * @param $username
     * @param $email
     * @param $phone
     * @param $password
     * @return User
     */

    public static function requestSignup($username, $email, $phone, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->phone = $phone;
        $user->setPassword($password);
        $user->created_at = time();
        $user->status = self::STATUS_ACTIVE;
        $user->generateAuthKey();

        return $user;
    }




    /**
     * Generates password hash from password and sets it to the model
     * @param string $password
     * @throws
     */


    private function setPassword($password)
    {

        $this->password_hash = Yii::$app->security->generatePasswordHash($password);

    }

    /**
     * Generates "remember me" authentication key
     * @throws
     */
    private function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;


    }

    /**
     * Validates password
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     *
     */


    public function validatePassword($password)
    {

        return Yii::$app->security->validatePassword($password, $this->password_hash);

    }

    /**
     * @inheritdoc
     */


    public function requestPasswordReset()
    {
        if (!empty($this->password_reset_token) && self::isPasswordResetTokenValid($this->password_reset_token)) {
            throw new \DomainException('Password resetting is already requested.');
        }

        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();

    }

    /**
     * Finds out if password reset token is valid
     * @param string $token password reset token
     * @return bool
     */


    public static function isPasswordResetTokenValid($token)
    {

        if (empty($token)) {

            return false;
        }


        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();

    }


    /**
     * Finds user by password reset token
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param $password
     */

    public function resetPassword($password)
    {
        if (empty($this->password_reset_token)) {
            throw new \DomainException('Password resetting is not requested.');
        }

        $this->setPassword($password);
        $this->password_reset_token = null;


    }




}