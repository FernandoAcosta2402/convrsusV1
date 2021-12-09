<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $full_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property int $activate
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'full_name', 'last_name', 'email', 'phone', 'password', 'authKey', 'accessToken'], 'required'],
            [['activate'], 'integer'],
            [['username', 'full_name', 'last_name', 'phone'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 80],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 250],
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
            'full_name' => 'Full Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'activate' => 'Activate',
        ];
    }
}
