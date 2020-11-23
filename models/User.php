<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $is_admin
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $address
 *
 * @property AuthenticationToken $authenticationToken
 * @property Cart[] $carts
 * @property Comment[] $comments
 * @property Order[] $orders
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'is_admin'], 'required'],
            [['is_admin'], 'integer'],
            [['username', 'password', 'first_name', 'last_name', 'address'], 'string', 'max' => 45],
            [['username'], 'unique'],
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
            'is_admin' => 'Is Admin',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'address' => 'Address',
        ];
    }

    /**
     * Gets query for [[AuthenticationToken]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthenticationToken()
    {
        return $this->hasOne(AuthenticationToken::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }
}
