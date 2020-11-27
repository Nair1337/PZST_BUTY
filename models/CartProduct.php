<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Cart_product".
 *
 * @property int $id
 * @property int $owner_id
 * @property int $product_id
 * @property int $quantity
 */
class CartProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Cart_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['owner_id', 'product_id'], 'required'],
            [['owner_id', 'product_id', 'quantity'], 'integer'],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['quantity'], 'integer', 'min' => 1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'owner_id' => 'Owner ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
        ];
    }

    public function getProduct($product_id) {
        return Product::findOne(['id' => $product_id]);
    }

    public function getSummary($user_id) {
        $entries = CartProduct::find()->where(['owner_id' => $user_id])->all();
        $sum = 0;
        foreach($entries as &$entry) {
            $sum += CartProduct::getProduct($entry->product_id)->price * $entry->quantity;
        }
        return $sum;
    }
}
