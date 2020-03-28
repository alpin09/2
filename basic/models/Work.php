<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $surname
 * @property string $firstname
 * @property string $patronymic
 * @property string $phone
 * @property string $email
 *
 * @property Order[] $orders
 */
class Work extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->username;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }
    public static function findByUsername($username)
    {
        self::findOne(['username'=>$username]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'surname', 'firstname', 'patronymic', 'phone', 'email'], 'required'],
            [['username'], 'string', 'max' => 50],
            [['password', 'surname', 'firstname', 'phone', 'email'], 'string', 'max' => 40],
            [['patronymic'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'surname' => 'Surname',
            'firstname' => 'Firstname',
            'patronymic' => 'Patronymic',
            'phone' => 'Phone',
            'email' => 'Email',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['username' => 'username']);
    }
}
