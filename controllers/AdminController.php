<?php

namespace app\controllers;

use app\models\Delivery;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Payment;
use app\models\ProductSearch;
use app\models\CategorySearch;
use app\models\UserSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\Product;
use app\models\User;
use app\models\Category;
use app\models\ProductCategory;
use app\models\Comment;
use yii\web\UploadedFile;
use app\models\ProductAddForm;

class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                    'create' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        else {
            return $this->render('index');
        }
    }

    public function actionProduct()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('product_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProductcreate()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $model = new ProductAddForm();
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                $productModel = new Product();
                $productModel->loadForm($model);
                $productModel->name = $post['ProductAddForm']['name'];
                $productModel->price = $post['ProductAddForm']['price'];
                $productModel->description = $post['ProductAddForm']['description'];
                $productModel->stock = $post['ProductAddForm']['stock'];
                $productModel->tax_rate = doubleval($post['ProductAddForm']['tax_rate']) / 100.00;
                $productModel->ean = $post['ProductAddForm']['ean'];
                $productModel->picture_url = $model->picture_url;
                $productModel->weight = $post['ProductAddForm']['weight'];
                $productModel->warranty = $post['ProductAddForm']['warranty'];
                $productModel->save();
                $cats = Category::find()->where(['in', 'id', $post['ProductAddForm']['categories']])->all();
                foreach ($cats as &$cat) {
                    $PrCat = new ProductCategory();
                    $PrCat->product_id = $productModel->id;
                    $PrCat->category_id = $cat->id;
                    $PrCat->save();
                }
                return $this->redirect('/admin/product');
            }
        } else \Yii::error("The product was not saved. " . VarDumper::dumpAsString($model->errors));

        return $this->render('product_create', [
            'model' => $model,
        ]);
    }

    public function actionProductupdate($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $productModel = Product::findOne($id);
        $model = new ProductAddForm();
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $productModel->loadForm($model);
            $productModel->id = $id;
            $productModel->name = $post['ProductAddForm']['name'];
            $productModel->price = $post['ProductAddForm']['price'];
            $productModel->description = $post['ProductAddForm']['description'];
            $productModel->stock = $post['ProductAddForm']['stock'];
            $productModel->tax_rate = doubleval($post['ProductAddForm']['tax_rate']) / 100.00;
            $productModel->ean = $post['ProductAddForm']['ean'];
            $productModel->weight = $post['ProductAddForm']['weight'];
            $productModel->warranty = $post['ProductAddForm']['warranty'];
            if ($model->upload()) {
                $productModel->picture_url = $model->picture_url;
            } else {
                $productModel->picture_url = Product::findOne($id)->picture_url;
            }
            $productModel->update();
            foreach (ProductCategory::find()->where(['product_id' => $id])->all() as &$pc) $pc->delete();
            $cats = Category::find()->where(['in', 'id', $post['ProductAddForm']['categories']])->all();
            foreach ($cats as &$cat) {
                $PrCat = new ProductCategory();
                $PrCat->product_id = $productModel->id;
                $PrCat->category_id = $cat->id;
                $PrCat->save();
            }
            return $this->redirect('/admin/productupdate?id=' . $id);
        }
        $model->loadProduct($productModel);
        $model->tax_rate *= 100;
        return $this->render('/admin/product_update', [
            'model' => $model,
        ]);
    }

    public function actionCommentdelete($id, $product_id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $comment = Comment::find()->where(['id' => $id])->one();
        $comment->delete();
        return $this->redirect('/admin/productupdate?id=' . $product_id);
    }

    public function actionProductdelete($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        foreach (ProductCategory::find()->where(['product_id' => $id])->all() as &$pc) $pc->delete();
        Product::find()->where(['id' => $id])->one()->delete();

        return $this->redirect(['admin/product']);
    }

    public function actionCategory()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/admin/category_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCategorycreate()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $model = new Category();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect('/admin/category');
        }
        return $this->render('category_create', [
            'model' => $model,
        ]);
    }

    public function actionCategoryupdate($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $model = Category::findOne($id);
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {
            $model->id = $id;
            $model->update();
            return $this->redirect('/admin/categoryupdate?id=' . $id);
        }
        $model = Category::findOne($id);

        return $this->render('/admin/category_update', [
            'model' => $model,
        ]);
    }

    public function actionCategorydelete($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        foreach (ProductCategory::find()->where(['category_id' => $id])->all() as &$pc) $pc->delete();
        Category::findOne($id)->delete();

        return $this->redirect(['admin/category']);
    }

    public function actionPayment()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $dataProvider = new ActiveDataProvider([
            'query' => Payment::find(),
        ]);

        return $this->render('/admin/payment_list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPaymentcreate()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $model = new Payment();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect('/admin/payment');
        }
        return $this->render('payment_create', [
            'model' => $model,
        ]);
    }

    public function actionPaymentupdate($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $model = Payment::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->id = $id;
            $model->update();
            return $this->redirect('/admin/paymentupdate?id=' . $id);
        }
        $model = Payment::findOne($id);

        return $this->render('/admin/payment_update', [
            'model' => $model,
        ]);
    }

    public function actionPaymentdelete($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        Payment::findOne($id)->delete();

        return $this->redirect(['admin/payment']);
    }

    public function actionDelivery()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $dataProvider = new ActiveDataProvider([
            'query' => Delivery::find(),
        ]);

        return $this->render('/admin/delivery_list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeliverycreate()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $model = new Delivery();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect('/admin/delivery');
        }
        return $this->render('delivery_create', [
            'model' => $model,
        ]);
    }

    public function actionDeliveryupdate($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $model = Delivery::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->id = $id;
            $model->update();
            return $this->redirect('/admin/deliveryupdate?id=' . $id);
        }
        $model = Delivery::findOne($id);

        return $this->render('/admin/delivery_update', [
            'model' => $model,
        ]);
    }

    public function actionDeliverydelete($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        Delivery::findOne($id)->delete();

        return $this->redirect(['admin/delivery']);
    }

    public function actionUser()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/admin/user_list', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionUserupdate($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $model = User::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->id = $id;
            $model->update();
            return $this->redirect('/admin/userupdate?id=' . $id);
        }

        return $this->render('/admin/user_update', [
            'model' => $model,
        ]);
    }

    public function actionOrder()
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
        ]);

        return $this->render('/admin/order_list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOrderupdate($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        $model = Order::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->id = $id;
            $model->update();
            return $this->redirect('/admin/orderupdate?id=' . $id);
        }

        return $this->render('/admin/order_update', [
            'model' => $model,
        ]);
    }

    public function actionOrderdelete($id)
    {
        if (!$this->checkAdmin()) return $this->render(Yii::$app->urlManager->createUrl('site/index'));

        foreach(OrderProduct::find()->where(['order_id' => $id])->all() as &$op) {
            $op->product->stock += $op->quantity;
            $op->product->update();
            $op->delete();
        }
        Order::findOne($id)->delete();

        return $this->redirect(['admin/order']);
    }

    private function checkAdmin()
    {
        if (Yii::$app->user->isGuest) return false;
        else return Yii::$app->user->identity->is_admin;
    }
}
