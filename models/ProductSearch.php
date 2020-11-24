<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stock', 'warranty'], 'integer'],
            [['name', 'description', 'ean', 'picture_url'], 'safe'],
            [['price', 'tax_rate', 'weight'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if($params != null && array_key_exists('category', $params)) {
            $cn = $params['category'];
            $query = Product::find()->
            leftJoin('product_category', 'product.id = product_category.product_id')->
                leftJoin('category', 'category.id = product_category.category_id')->
                where(['category.name' => $cn]);
        }
        else $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'stock' => $this->stock,
            'tax_rate' => $this->tax_rate,
            'weight' => $this->weight,
            'warranty' => $this->warranty,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'ean', $this->ean])
            ->andFilterWhere(['like', 'picture_url', $this->picture_url]);


        return $dataProvider;
    }
}
