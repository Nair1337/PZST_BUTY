<?php

namespace app\models;

use Yii;
use \DateTime;

/**
 * This is the model class for table "Comment".
 *
 * @property int $id
 * @property int $product_id
 * @property int $author_id
 * @property string|null $comment
 * @property int $stars
 * @property string|null $timestamp
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'author_id'], 'required'],
            [['product_id', 'author_id', 'stars'], 'integer'],
            [['timestamp'], 'safe'],
            [['comment'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'author_id' => 'Author ID',
            'comment' => 'Comment',
            'stars' => 'Stars',
            'timestamp' => 'Timestamp',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {

        $this->timestamp = '2020-06-02 03:06:15';

        if ($this->getIsNewRecord()) {
            return $this->insert($runValidation, $attributeNames);
        }

        return $this->update($runValidation, $attributeNames) !== false;
    }
}
