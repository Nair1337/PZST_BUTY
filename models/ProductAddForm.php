<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ProductAddForm extends Product
{
    public $id;
    public $name;
    public $price;
    public $description;
    public $stock;
    public $tax_rate;
    public $ean;
    public $picture_url;
    public $weight;
    public $warranty;
    public $imageFile;
    public $categories;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if (!empty($this->imageFile) && $this->imageFile->size !== 0) {
            if ($this->validate()) {
                $this->picture_url = 'imgs/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs($this->picture_url);
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function loadProduct($product)
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->stock = $product->stock;
        $this->tax_rate = $product->tax_rate;
        $this->ean = $product->ean;
        $this->picture_url = $product->picture_url;
        $this->weight = $product->weight;
        $this->warranty = $product->warranty;
        $this->categories = $product->categories;
    }

}
