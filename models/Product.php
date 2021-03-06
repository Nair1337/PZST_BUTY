<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string|null $description
 * @property int $stock
 * @property float $tax_rate
 * @property string|null $ean
 * @property string|null $picture_url
 * @property float|null $weight
 * @property int|null $warranty
 *
 * @property CartProduct[] $cartProducts
 * @property Comment[] $comments
 * @property OrderProduct[] $orderProducts
 * @property ProductCategory[] $productCategories
 * @property ProductFeature[] $productFeatures
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['name', 'tax_rate'], 'required'],
            [['price', 'tax_rate', 'weight'], 'number', 'min' => 0],
            [['stock', 'warranty'], 'integer', 'min' => 0],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
            [['ean', 'picture_url'], 'string', 'max' => 90],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'stock' => 'Stock',
            'tax_rate' => 'Tax Rate',
            'ean' => 'Ean',
            'picture_url' => 'Picture Url',
            'weight' => 'Weight',
            'warranty' => 'Warranty',
        ];
    }

    /**
     * Gets query for [[CartProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartProducts()
    {
        return $this->hasMany(CartProduct::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[OrderProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductFeatures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductFeatures()
    {
        return $this->hasMany(ProductFeature::className(), ['product_id' => 'id']);
    }

    public function getCategories() {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('product_category', ['product_id' => 'id']);
    }

    public function loadForm($form)
    {
        $this->id = $form->id;
        $this->name = $form->name;
        $this->price = $form->price;
        $this->description = $form->description;
        $this->stock = $form->stock;
        $this->tax_rate = $form->tax_rate;
        $this->ean = $form->ean;
        $this->picture_url = $form->picture_url;
        $this->weight = $form->weight;
        $this->warranty = $form->warranty;
    }
}
